<?php

namespace App\Http\Controllers\UserAuthControllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\Perfil;
use App\Cidade;
use App\Estado;
use App\Mail\CadastroUserAdmin;
use App\Mail\ConfirmacaoUser;
use Exception;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('user.guest');
    // }

    public function generatePassword($qtyCaraceters = 40)
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {
         $token = $this->generatePassword();
         $increment = User::max('id') + 1;
         $dataAtual = Carbon::now();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:tb_user',
            'password' => 'required|min:8|confirmed',
            'data' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'telefone' => 'required',
            'cpf' => 'required|cpf|formato_cpf',
        ]);
        try {
            User::insert([
                'id' => $increment,
                'nm_user' => $request->name,
                'email' => $request->email,
                'remember_token' => $token,
                'password' => bcrypt($request->password),
                'created_at' => $dataAtual,
                'bl_email' => 0,
                'bl_acesso' => 0,
            ]);
            Cidade::insert([
                'id_user' => $increment,
                'nm_cidade' => $request->cidade,
                'id_estado' => $request->estado,
            ]);

            Perfil::insert([
                'id_user' => $increment,
                'cpf_perfil' => $request->cpf,
                'dt_nasc' => $request->data,
                'telefone_perfil' => $request->telefone,
            ]);

            // //Variaveis para os emails
            $nome = $request->name;
            $email = $request->email;
            $email_administrador = 'luis.weslley21@gmail.com';
            $link = url('user/confirmar' . '/' . $token);

            //Email para administrador do site
            // Mail::to($email_administrador)->send(new CadastroUserAdmin($nome, $email));

            // Email de confirmação
            Mail::to($email)->send(new ConfirmacaoUser($nome, $link));
            return redirect('user/login');
        } catch (Exception $e) {
            toastr()->error('Erro ao tentar cadastrar.');
            return redirect()->back();
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $estados = Estado::get();
        return view('user.auth.register',['estados' => $estados]);
    }

    public function ConfirmarEmailView($token = null)
    {
        if (User::where('remember_token', $token)->exists()) {
            $verify = User::where('remember_token', $token)->first();
            $data_criacao = $verify->created_at;
            // return dd([
            //     Carbon::now()->toDateTimeString(),
            //     '>',
            //     Carbon::parse($data_criacao)->add(1, 'day')->toDateTimeString(),
            // ]);
            // INVERSO(DATA ATUAL > DATA CADASTRADA + 1 DIA)
            if (
                !(Carbon::now()->toDateTimeString() > Carbon::parse($data_criacao)->add(1, 'day')->toDateTimeString())
            ) {
                return view('user.auth.emailConfirmar', [
                    'token' => $token
                ]);
            } else {
                toastr()->warning('Token expirado.');
                return redirect('user/register');
            }
        } else {
            toastr()->error('Token invalido.');
            return redirect('user/register');
        }
    }

    public function ConfirmacaoEmail($token)
    {
        $dataAtual = Carbon::now();
        User::where('remember_token', $token)->update([
            'email_verified_at' => $dataAtual,
            'bl_email' => true,
            'remember_token' => null
        ]);
        toastr()->success('E-mail validado com sucesso.');
        return redirect('user/login');
    }


    // /**
    //  * Get the guard to be used during registration.
    //  *
    //  * @return \Illuminate\Contracts\Auth\StatefulGuard
    //  */
    // protected function guard()
    // {
    //     return Auth::guard('user');
    // }
}
