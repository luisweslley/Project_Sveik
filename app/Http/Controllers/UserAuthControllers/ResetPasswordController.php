<?php

namespace App\Http\Controllers\UserAuthControllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/user/home';


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
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm($token = null)
    {
        if (DB::table('user_password_resets')->where('token', $token)->exists()) {
            $verify = DB::table('user_password_resets')->where('token', $token)->first();
            $data_criacao = $verify->created_at;
            if (
                !(Carbon::now()->toDateTimeString() > Carbon::parse($data_criacao)->add(1, 'day')->toDateTimeString())
            ) {
            return view('user.auth.passwords.reset')->with(
                ['token' => $token]
            );
        } else {
            toastr()->warning('Token expirado.');
            return redirect('user/login');
        }
        } else {
            toastr()->error('Token invalido.');
            return redirect('user/login');
        }
    }

    public function Resetpassword(Request $request)
    {
        $request->validate(['email_user' => 'required|email',
        'password_user' => 'required|min:8|confirmed']);

        $verify = DB::table('user_password_resets')->where('email_user',$request->email)
        ->where('token', $request->token)->exists();

        if($verify == true){
        User::where('email_user', $request->email)->update([
            'password_user' => bcrypt($request->password)
        ]);

        DB::table('user_password_resets')->where('email_user',$request->email)
        ->where('token', $request->token)->delete();

        toastr()->success('Senha redefinida com sucesso.');
        return redirect('user/login');
        }else{
            toastr()->warning('algo errado.');
            return redirect('user/login');
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

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
}
