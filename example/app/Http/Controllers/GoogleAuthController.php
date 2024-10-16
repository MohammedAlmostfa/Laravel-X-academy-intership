<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str; // تأكد من إضافة هذا الفضاء

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateUser($googleUser);

        Auth::login($authUser, true);
        return redirect()->intended('/');  // إعادة التوجيه إلى الصفحة الرئيسية
    }

    private function findOrCreateUser($googleUser)
    {
        // البحث عن مستخدم موجود بناءً على Google ID
        $authUser = User::where('google_id', $googleUser->id)->first();

        if (!$authUser) {
            // إذا لم يوجد مستخدم، قم بإنشاء مستخدم جديد
            $authUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => $googleUser->password, // استخدام كلمة مرور عشوائية مشفرة
            ]);
        }

        return $authUser;
    }
}
