<?php

namespace App\Http\Controllers\UserAuthControllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserResetMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    //use SendsPasswordResetEmails;
    public function generatePassword($qtyCaraceters = 50)
    {
        //Letras minúsculas embaralhadas
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        //Letras maiúsculas embaralhadas
        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        //Números aleatórios
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
        //Junta tudo
        $characters = $capitalLetters . $smallLetters . $numbers;
        //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
        $password = substr(str_shuffle($characters), 0, $qtyCaraceters);
        //Retorna a senha
        return $password;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('user.auth.passwords.email');
    }

    public function ResetEmail(Request $request)
    {
        $token = $this->generatePassword();
        $dataAtual = Carbon::now();
        $verify = User::where('email_user',$request->email)->exists();
        $request->validate(['email_user' => 'required|email']);
    try{
        if($verify == true){
        $link = url('user/password/reset' . '/' . $token);
        DB::table('user_password_resets')->insert([
            'email_user' => $request->email,
            'token' => $token,
            'created_at' => $dataAtual
        ]);
        Mail::to($request->email)->send(new UserResetMail($link));
        toastr()->success('Email enviado com sucesso');
        return redirect()->back();
        }else{
            toastr()->error('Email invalido.');
            return redirect()->back();
        }
    } catch (Exception $e) {
        toastr()->error('Erro ao tentar enviar email.');
        return redirect()->back();
    }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('user');
    }
}
