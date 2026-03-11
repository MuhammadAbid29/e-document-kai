<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{

    /* FORM INPUT EMAIL */
    public function form()
    {
        return view('auth.forgot-email');
    }


    /* KIRIM OTP */
    public function sendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $user = User::where('email', $request->email)->first();

    if(!$user){
        return back()->withErrors([
            'email' => 'Email tidak ditemukan'
        ]);
    }

    $otp = rand(1000,9999);

    $user->otp = $otp;
    $user->otp_expired_at = now()->addMinutes(5);
    $user->save();

    return redirect('/reset-otp/'.$user->email)
        ->with('otp',$otp);
}


    /* FORM INPUT OTP */
    public function otpForm($email)
    {
        return view('auth.reset-otp',compact('email'));
    }


    /* VERIFIKASI OTP */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'otp'=>'required'
        ]);

        $user = User::where('email',$request->email)
            ->where('otp',$request->otp)
            ->where('otp_expired_at','>',now())
            ->first();

        if(!$user){
            return back()->withErrors([
                'otp'=>'Kode salah atau expired'
            ]);
        }

        return redirect('/reset-password-form/'.$user->email);
    }


    /* FORM PASSWORD BARU */
    public function passwordForm($email)
    {
        return view('auth.reset-password',compact('email'));
    }


    /* SIMPAN PASSWORD BARU */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:4|confirmed'
        ]);

        $user = User::where('email',$request->email)->first();

        $user->update([
            'password'=>Hash::make($request->password),
            'otp'=>null,
            'otp_expired_at'=>null
        ]);

        return redirect('/login')
            ->with('status','Password berhasil direset');
    }

}