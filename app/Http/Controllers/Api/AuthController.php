<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|digits:11',
            'password' => 'required|confirmed|min:6',
            'region_id' => 'required|exists:regions,id',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        } else {
            request()->merge(['password' => bcrypt(request('password'))]);
            $user = User::create(request()->all());
            $user->api_token = str::random(60);
            $user->save();
            return responseJson(1, 'تم ألأضافه بنجاح', [
                'api_token' => $user->api_token,
                'data' => $user,
            ]);
        }
    }

    public function login(Request $request)
    {
        $rules = [
            'phone' => 'required|digits:11',
            'password' => 'required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        } else {
            $user = User::where('phone', request('phone'))->first();
            if ($user) {
                if (Hash::check(request('password'), $user->password)) {
                    if ($user->status == 0) {
                        return responseJson(0, 'تم حظر حسابك .. اتصل بالادارة');
                    }
                    return responseJson(1, 'تم الدخول بنجاح', [
                        'api_token' => $user->api_token,
                        'client' => $user->load('region.city')
                    ]);
                } else {
                    return responseJson(0, 'بيانات الدخول غير صحيحه');
                }
            } else {
                return responseJson(0, 'بيانات الدخول غير صحيحه');
            }
        }
    }

    public function resetPassword(Request $request)
    {
        $rules = ['phone' => 'required|digits:11'];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        }
        $data = User::where('phone', $request->phone)->first();
        if ($data) {
            $pin_code = rand(1111, 9999);
            $update = $data->update(['pin_code' => $pin_code]);
            if ($update) {
                // send email/pin_code to reset password
                Mail::to($data->email)->bcc('bankblood71@gmail.com')->send(new ResetPassword($data));
                return responseJson(1, 'تم إرسال الكود , راجع هاتفك للحصول عليه', [
                    'pin_code' => $pin_code,
                    'email' => $data->email,
                    'mail_fails' => Mail::failures()
                ]);
            } else {
                return responseJson(0, 'عفوا , حدث خطأ الرجاء المحاولة مره أحري');
            }
        } else {
            return responseJson(0, 'لا يوجد حساب مرتبط بهذا الرقم');
        }
    }

    public function newPassword(Request $request)
    {
        $rules = [
            'pin_code' => 'required',
            'phone' => 'required|digits:11',
            'password' => 'required|confirmed|min:6',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        }
        $user = User::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->where('phone', $request->phone)->first();
        if ($user) {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if ($user->save()) {
                return responseJson(1, 'تم تغيير الباسوورد بنجاح');
            } else {
                return responseJson(0, 'حدث خطأ , الرجاء المحاولة مره أحري');
            }
        } else {
            return responseJson(0, 'الكود غير صالح');
        }
    }
}
