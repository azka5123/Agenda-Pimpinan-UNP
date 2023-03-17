<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserLoginController extends Controller
{
    public function login()
    {   
        return view('front.login.login');
    }
    
    public function forget_pass()
    {
        return view('front.login.forget_password');
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
        if (Auth::attempt($credentials)){
            // $request->session()->regenerate();
            echo "success";
            // return redirect()->route('user_dashboard');
        }else{
            return redirect()->route('front_login')->with('error','User tidak ditemukan');
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('front_login')->with('berhasil','sukses logout');
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

        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = 'reset password';
        $message = 'klik link <a href="'.$reset_link.'">ini</a>';

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->route('admin_login')->with('berhasil','lihat email anda');
    }

    public function reset_password($token,$email)
    {
        $reset = User::where('token',$token)->where('email',$email);
        if(!$reset){
            return redirect()->route('admin_login')->with('error','error');
        }
        return view('admin.login.reset_password',compact('token','email'));
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
