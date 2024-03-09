<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PasswordResetToken;

class UserController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }

    public function loginProses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('workspace.dashboard');
        } else {
            Alert::error('Failed Message', 'Login Failed');
            return redirect()->route('login')->with('failed', 'Login Failed');
        }
    }

    public function forgotPasswordShow()
    {
        return view('authentication.forgot_password');
    }

    public function forgotPasswordProses(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        // Cek apakah pengguna adalah superadmin atau admin
        $user = User::where('email', $request->email)->first();
        if ($user && in_array($user->id_role, [1, 2])) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        // Cek apakah ada token yang berlaku dalam satu jam terakhir
        $lastHour = Carbon::now()->subHour();
        $existingToken = PasswordResetToken::where('email', $request->email)
            ->where('created_at', '>=', $lastHour)
            ->first();

        if ($existingToken) {
            return back()->withErrors(['email' => 'Password reset link has been sent recently. Please try again later.']);
        }

        // Generate new reset token
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request, $token)
    {
        return view('authentication.reset_password', ['token' => $token]);

    }

    public function resetPasswordProses(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    public function register()
    {
        return view('authentication.register');
    }

    public function registerProses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'same:password'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];


        if (!$data) {
            dd('error');
        } else {
            $result = User::create($data);
            if ($result) {
                Alert::success('Success Message', 'Register Success');
                return redirect()->route('login')->with('success', 'Register Success');
            } else {
                Alert::error('Failed Message', 'Register Failed');
                return redirect()->route('register')->with('failed', 'Register Failed');
            }

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Succesfully Logout');
    }

    public function changePasswordShow()
    {
        return view('workspace.settings', ['#tabs-activity-7']);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => ['required'],
            'newPassword' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        if ($validator->fails()) {
            Alert::error('Failed Message', 'You have failed change password.' . strval($validator->errors()));
            return redirect()->route('workspace.settings.changepassword')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(Auth::user()->id);
        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            Alert::success('Success Message', 'You have successfully change password.');
            return redirect()->route('workspace.settings.changepassword');
        } else {
            Alert::error('Failed Message', 'You have failed change password.');
            return redirect()->route('workspace.settings.changepassword');
        }
    }
}
