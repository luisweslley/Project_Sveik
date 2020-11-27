<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Perfil;
use App\Cidade;
use App\User;
use App\Estado;
use Exception;


class PerfilController extends Controller
{

    public function index()
    {
        $userID = Auth::user()->id;

       // exibir informações user
       $DadosPerfil = Perfil::exibirDados($userID);
       $estados = Estado::get();
       //return dd($DadosPerfil);

       return view('user.Perfil.perfil', ['DadosPerfil' => $DadosPerfil,'estados' => $estados]);

    }

    public function UpdatePerfil(Request $request){

        // return dd($request->request);
            //validação
            $this->validate($request, [
                'nome' => 'required|max:255',
                'data_nasc' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
                'telefone' => 'required',
            ]);

        try{
            $userID = Auth::user()->id;

            if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid()) {

                // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->foto_perfil->extension();

                // Define finalmente o nome
                $fileName = "{$name}.{$extension}";

                // Faz o upload:
                $documentoAtual = $request->foto_perfil;

                $upload = $documentoAtual->move(public_path('Fotos_perfil/' . $userID . '/'), $fileName);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
                if ( !$upload )
                return redirect()->back();
        // Else, se o user nao quiser mudar a foto de perfil
        }else{
          $userPerfils = Perfil::where('id_user', $userID)->first();

            $fileName = $userPerfils->foto_perfil;

          }
        User::where('id',$userID)
        ->update([
            'nm_user' => $request->nome
        ]);
        Cidade::where('id_user',$userID)
        ->update([
            'nm_cidade' => $request->cidade,
            'id_estado' => $request->estado,
        ]);

        Perfil::where('id_user',$userID)
        ->update([
            'dt_nasc' => $request->data_nasc,
            'foto_perfil' => $fileName,
            'telefone_perfil' => $request->telefone,
        ]);

        return redirect()->route('user.perfil.index');
        } catch(Exception $e){
            return redirect()->back();
    }
    }
}
