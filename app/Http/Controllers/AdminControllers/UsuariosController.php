<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Modulo;
use App\Cidade;
use App\Duvidas;
use App\Acesso;
use App\Feed;
use App\Perfil;
use App\UsuariosAdmin;
use Exception;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{

    public function index (){

    //Lista de usuarios query
    $userList = UsuariosAdmin::ListarUser();
    $NaouserList = UsuariosAdmin::ListarNaoUser();

   return view('admin.Usuarios.usuarios',
    ['userList' => $userList,
    'NaouserList' => $NaouserList]);
    }

    public function detalhesUser($id){

    // try{
        //Perfil User
        $userInfo = UsuariosAdmin::perfilUser($id);

        //Modulos
        $userModulo = UsuariosAdmin::ModulosUser($id);

        //Modulos que os usuarios não estão matriculados

        $userModuloNaoUser = UsuariosAdmin::ModulosNaoUser();

        // return dd($userModuloNaoUser);

        //Duvidas do usuario
        $listarDuvidasUser = Duvidas::ListDuvidasUser($id);

        return view('admin.Usuarios.detalhes',
        ['userInfo' => $userInfo,
        'userModulo' => $userModulo,
        'userModuloNaoUser' => $userModuloNaoUser,
        'listarDuvidasUser' => $listarDuvidasUser,
        'id_user' => $id]);

    // } catch (Exception $e) {
    //     toastr()->error('erro.');
    //     return redirect()->back();
    // }
    }

    public function LiberarEntrada($id){

        User::where('id', $id)->update([
            'bl_acesso' => 1
        ]);

        toastr()->success('Liberação feita com sucesso.');
        return redirect()->back();
    }

    public function BloquearEntrada($id){

    if(User::where('id', $id)->where('bl_acesso', 1)->exists()){
        User::where('id', $id)->update([
        'bl_acesso' => 0
    ]);
    }
    toastr()->success('Bloqueio feito com sucesso.');
    return redirect()->back();
    }

    public function ExcluirUser($id)
    {
        if(Feed::where('id_user',$id)->exists()){
            Feed::where('id_user',$id)->delete();
        }
        if(Duvidas::where('id_user',$id)->exists()){
            Duvidas::where('id_user',$id)->delete();
        }
        Perfil::where('id_user', $id)->delete();
        Cidade::where('id_user', $id)->delete();
        User::where('id',$id)->delete();

        toastr()->success('Exclusão feita com sucesso.');
        return redirect()->back();
    }
    public function LiberarAcesso (Request $request, $id){

    try{
        $data = [];
        foreach ($request->request as $check) {
            $json = json_decode($check);
            array_push($data, $json);
        }

        foreach ($data as $x) {
        if($x != null){
        Acesso::insert([
            'id_user' => $id,
            'id_modulo' => $x,
            'bl_modulo' => 0,
        ]);
        }
        }

        toastr()->success('Liberação feita com sucesso.');
        return redirect()->back();

    } catch (Exception $e) {
        toastr()->error('erro.');
        return redirect()->back();
        }
     }

    public function BloquearAcesso($id,$user){

    try{
        Acesso::where('id_modulo', $id)->where('id_user', $user)->delete();

        toastr()->success('Bloqueio feito com sucesso.');
        return redirect()->back();

        } catch (Exception $e) {
            toastr()->error('erro.');
            return redirect()->back();
        }
    }

    public function verificarModulos($id_modulo, $id_user){

        if(Acesso::where('id_modulo', $id_modulo)->where('id_user', $id_user)->exists())
        {
            return true;
        }else{
            return false;
        }
    }


}
