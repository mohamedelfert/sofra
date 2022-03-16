<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|unique:clients',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|unique:clients|digits:11',
            'password' => 'required|min:6',
            'region_id' => 'required|exists:regions,id',
            'address' => 'required',
//            'image' => 'required|image|mimes:jpg,jpeg,png',
            'image' => 'required',
            'is_active' => 'required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        } else {
            request()->merge(['password' => bcrypt(request('password'))]);
            $client = Client::create(request()->all());
            $client->api_token = str::random(60);
            $client->save();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = time() . $file->getClientOriginalName();
                $file->move(public_path() . 'Uploads/Clients/' . $client->image, $file_name);
                $client->image = 'Uploads/Clients/' . $file_name;
                $client->save();
            }
            return responseJson(1, 'تم ألأضافه بنجاح', [
                'api_token' => $client->api_token,
                'data' => $client,
            ]);
        }
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        } else {
            $client = Client::where('email', request('email'))->first();
            if ($client) {
                if (Hash::check(request('password'), $client->password)) {
                    if ($client->is_active == 0) {
                        return responseJson(0, 'تم حظر حسابك .. اتصل بالادارة');
                    }
                    return responseJson(1, 'تم الدخول بنجاح', [
                        'api_token' => $client->api_token,
                        'client' => $client->load('region.city', 'review')
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
        $rules = ['email' => 'required|email'];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        }
        $data = Client::where('email', $request->email)->first();
        if ($data) {
            $pin_code = rand(1111, 9999);
            $update = $data->update(['pin_code' => $pin_code]);
            if ($update) {
                // send email/pin_code to reset password
                Mail::to($data->email)->bcc('bankblood71@gmail.com')->send(new ResetPassword($data));
                return responseJson(1, 'تم إرسال الكود , راجع بريدك الإلكتروني للحصول عليه', [
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
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        }
        $client = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->where('email', $request->email)->first();
        if ($client) {
            $client->password = bcrypt($request->password);
            $client->pin_code = null;
            if ($client->save()) {
                return responseJson(1, 'تم تغيير الباسوورد بنجاح');
            } else {
                return responseJson(0, 'حدث خطأ , الرجاء المحاولة مره أحري');
            }
        } else {
            return responseJson(0, 'الكود غير صالح');
        }
    }

    public function profile(Request $request)
    {
        $rules = [
            'email' => Rule::unique('clients')->ignore($request->user('client')->id),
            'phone' => Rule::unique('clients')->ignore($request->user('client')->id),
            'password' => 'min:6',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(0, $validate->errors());
        }
        $client_login = $request->user('client');
        $client_login->update($request->all());
        if ($request->has('password')) {
            $client_login->password = bcrypt($request->password);
        }
        $client_login->save();
        $data = ['client' => $request->user('client')->fresh()->load('region.city')];
        return responseJson(1, 'تم تحديث البيانات بنجاح', $data);
    }
}
