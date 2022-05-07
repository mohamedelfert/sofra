<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|unique:restaurants',
            'email' => 'required|unique:restaurants',
            'phone' => 'required|unique:restaurants|digits:11',
            'second_phone' => 'unique:restaurants|digits:11',
            'password' => 'required|min:6',
            'region_id' => 'required|exists:regions,id',
            'minimum_order' => 'required',
            'delivery_fee' => 'required',
            'whatsapp' => 'digits:11',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'status' => 'required',
            'is_active' => 'required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['second_phone'] = $request->second_phone;
            $data['password'] = bcrypt($request->password);
            $data['region_id'] = $request->region_id;
            $data['minimum_order'] = $request->minimum_order;
            $data['delivery_fee'] = $request->delivery_fee;
            $data['whatsapp'] = $request->whatsapp;
            $data['image'] = $request->image;
            $data['status'] = $request->status;
            $data['is_active'] = $request->is_active;
            $restaurant = Restaurant::create($data);
            $token = $restaurant->createToken('API Token')->accessToken;
            if ($request->hasFile('image')) {
                $path = public_path();
                $destinationPath = $path . '/uploads/restaurants/';
                $file = $request->file('image');
                $file_name = time() . $file->getClientOriginalName();
                $file->move($destinationPath.$restaurant->name, $file_name);
                $restaurant->image = 'uploads/restaurants/' . $restaurant->name .'/'. $file_name;
                $restaurant->save();
            }
            $restaurant->categories()->attach($request->categories);
            return responseJson(1, 'تم ألأضافه بنجاح', [
                'token' => $token,
                'data' => $restaurant->load('region.city', 'categories'),
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
            $restaurant = Restaurant::where('email', request('email'))->first();
            if ($restaurant) {
                if (Hash::check(request('password'), $restaurant->password)) {
                    if ($restaurant->is_active == 0) {
                        return responseJson(0, 'تم حظر حسابك .. اتصل بالادارة');
                    }
                    $token = auth('restaurant')->user()->createToken('API Token')->accessToken;
                    return responseJson(1, 'تم الدخول بنجاح', [
                        'token' => $token,
                        'restaurant' => $restaurant->load('region.city', 'categories', 'reviews', 'offers', 'items', 'orders', 'transactions')
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
        $data = Restaurant::where('email', $request->email)->first();
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
        $restaurant = Restaurant::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->where('email', $request->email)->first();
        if ($restaurant) {
            $restaurant->password = bcrypt($request->password);
            $restaurant->pin_code = null;
            if ($restaurant->save()) {
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
            'email' => Rule::unique('restaurants')->ignore($request->user('restaurant')->id),
            'phone' => Rule::unique('restaurants')->ignore($request->user('restaurant')->id),
            'password' => 'min:6',
            'image' => 'image|mimes:jpg,jpeg,png',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(0, $validate->errors());
        }
        $restaurant_login = $request->user('restaurant');
        $restaurant_login->update($request->all());
        if ($request->has('password')) {
            $restaurant_login->password = bcrypt($request->password);
        }
        $restaurant_login->save();
        if ($request->hasFile('image')) {
            $restaurant_login->where('email',$request->email)->first();
            if (!empty($restaurant_login->name)){
                Storage::disk('public_path')->deleteDirectory('restaurants/'.$restaurant_login->name);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurants/';
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath.$restaurant_login->name, $file_name);
            $restaurant_login->image = 'uploads/restaurants/' . $restaurant_login->name .'/'. $file_name;
            $restaurant_login->save();
        }
        $data = ['restaurant' => $request->user('restaurant')->fresh()->load('region.city')];
        return responseJson(1, 'تم تحديث البيانات بنجاح', $data);
    }

    public function registerToken(Request $request)
    {
        $rules = [
            'token' => 'required',
            'type' => 'required|in:android,ios',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        } else {
            Token::where('token',$request->token)->delete();
            $request->user()->tokens()->create($request->all());
            return responseJson(1, 'تم التسجيل بنجاح');
        }
    }

    public function removeToken(Request $request)
    {
        $rules = ['token' => 'required',];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        } else {
            Token::where('token',$request->token)->delete();
            return responseJson(1, 'تم الحذف بنجاح');
        }
    }
}
