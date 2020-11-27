<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UsuariosAdmin;
use App\Duvidas;

use Exception;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Lista de usuarios query
        $listarUser = UsuariosAdmin::ListarUser();

        //Duvidas não resposdidas
        $listNaoRespondidas = Duvidas::DuvidasNaoRespondidas();

        return view('admin.home',['listarUser' => $listarUser, 'listNaoRespondidas' => $listNaoRespondidas]);
    }

}

