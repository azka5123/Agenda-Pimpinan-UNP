<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function login()
    {
        return view('user.login.login');
    }
    
    public function forget_pass()
    {
        return view('user.login.forget_password');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::guard('user')->attempt($credentials)){
            return redirect()->route('user_dashboard');
        }else{
            return redirect()->route('user_login')->with('error','User tidak ditemukan');
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user_login')->with('Berhasil','logout success');
    }

    public function forget_submit(Request $request)
    {
        $email = User::where('email',$request->email)->first();
        if(!$email){
            return redirect()->back()->with('error','user not found');
        }
        $token = hash('sha256',time());

        $email->token = $token;
        $email->update();

        $reset_link = url('user/reset-password/'.$token.'/'.$request->email);
        $subject = 'reset password';
        $message = 'klik link <a href="'.$reset_link.'">ini</a>';

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->route('user_login')->with('berhasil','lihat email anda');
    }

    public function reset_password($token,$email)
    {
        $reset = User::where('token',$token)->where('email',$email);
        if(!$reset){
            return redirect()->route('user_login')->with('error','error');
        }
        return view('user.login.reset_password',compact('token','email'));
    }

    public function reset_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype-password' => 'required|same:password'
        ]);
        $reset = User::where('token',$request->token)->where('email',$request->email)->first();
        $reset->password = Hash::make($request->password);
        $reset->token = '';
        $reset->update();

        return redirect()->back()->with('berhasil','password berhasil diubah');
    }
}
