<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Duvidas;
use Carbon\Carbon;
use Exception;


class DuvidasController extends Controller
{
//     public function currentUser(){

//         $user = User::findOrFail(Auth::user());
//         foreach ($user as $userInfo) {
//             $userid = $userInfo->id_user;
//         }
//         return $userid;
// }
    public function index(){

        // try{
            //variaveis auxilio
            $userID = Auth::user()->id;
            //return dd($userID);
            $listarDuvidas = Duvidas::ListDuvidasUser($userID);

            //Duvidas Respondidas
            $Respondidas = Duvidas::DuvidasUserFilter($userID,1);
            //Duvidas nao Respondidas
            $NaoRespondidas = Duvidas::DuvidasUserFilter($userID,0);

            //tipos de Duvidas
            $Tipos = Duvidas::TiposDuvidas();


            return view('user.Duvidas.duvidas', ['listarDuvidas' => $listarDuvidas,
            'Respondidas' => $Respondidas,
            'NaoRespondidas' => $NaoRespondidas,
            'Tipos' => $Tipos]);

        // } catch (Exception $e) {
        //     toastr()->error('erro.');
        //     return redirect()->back();
        // }
    }

    public function create(){

        return view('user.Duvidas.duvidasCreate');
    }

    public function enviarDuvida(Request $request){

        $this->validate($request, [
            'duvida' => 'required'
        ]);
        // return dd($request->request);
    // try{
        // variaveis auxiliares
        $increment = Duvidas::max('id_duvida') + 1;
        $userID = Auth::user()->id;
        $dataAtual = Carbon::now();

        Duvidas::insert([
            'id_duvida' => $increment,
            'id_user' => $userID,
            'id_admin' => 1,
            'tipo_duvida' => $request->tipo,
            'ds_duvida' => $request->duvida,
            'dt_criacao' => $dataAtual,
            'bl_duvida' => 0
        ]);

        toastr()->success('Duvida enviada com sucesso.');
        return redirect()->route('user.duvidas.index');

    // } catch (Exception $e) {
    //     toastr()->error('erro.');
    //     return redirect()->back();
    // }

    }
}
