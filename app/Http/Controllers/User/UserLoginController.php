<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Jadwal;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;



class UserLoginController extends Controller
{
    public function index()
    {

        $events = [];
        return view('user.jadwal.show_jadwal', compact('events'));
    }

    public function forget_pass()
    {
        return view('user.login.forget_password');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // dd($credentials);die;
        if (Auth::attempt($credentials) && Auth::user()->token == '') {

            return redirect()->route('show_jadwal');

            //return redirect()->route('front_show')->with('error', 'User tidak ditemukan');
        } else {
            return redirect()->route('front_show')->with('error', 'User tidak ditemukan');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('front_show')->with('berhasil', 'logout success');
    }

    public function forget_submit(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if (!$email) {
            return redirect()->back()->with('error', 'User not found');
        }
        $token = hash('sha256', time());

        $email->token = $token;
        $email->update();

        $reset_link = url('user/reset-password/' . $token . '/' . $request->email);
        $subject = 'reset password';
        $message = 'klik link ini untuk mereset akun anda <a href="' . $reset_link . '">ini</a> <br> jika link tidak bisa diklik copy dan paste ini di web browser anda<br>' . $reset_link;

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('front_show')->with('success', 'Lihat email anda');
    }

    public function reset_password($token, $email)
    {
        $reset = User::where('token', $token)->where('email', $email);
        if (!$reset) {
            return redirect()->route('front_show')->with('error', 'error');
        }
        return view('user.login.reset_password', compact('token', 'email'));
    }

    public function reset_submit(Request $request)
    {

        $userAgent = $request->header('User-Agent');
        if (strpos($userAgent, 'Android') !== false) {
            $request->validate([
                'password' => 'required',
                'retype-password' => 'required|same:password'
            ]);
            $reset = User::where('token', $request->token)->where('email', $request->email)->first();
            $reset->password = Hash::make($request->password);
            $reset->token = '';
            $reset->update();

            $url = 'agenda://agendaunp.com';

            return redirect($url);
        } else {
            $request->validate([
                'password' => 'required',
                'retype-password' => 'required|same:password'
            ]);
            $reset = User::where('token', $request->token)->where('email', $request->email)->first();
            $reset->password = Hash::make($request->password);
            $reset->token = '';
            $reset->update();

            return redirect()->route('front_show')->with('success', 'Password berhasil diubah');
        }
    }
}
