<?php

namespace App\Http\Controllers\UserControllers;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\User;
use App\Perfil;
use App\Feed;
use App\Comentarios;
use Illuminate\Support\Facades\DB;
use Exception;

class FeedController extends Controller
{

    public function index(){

        // try{
            //total de post
            $Total = Feed::count('*');
            //select post
            $ExibirPost = Feed::ExibirPostAdmin();

            return view('user.Feed.feed',
            ['ExibirPost' => $ExibirPost, 'Total' => $Total ]);

        // } catch (Exception $e) {
        //     toastr()->error('erro.');
        //     return redirect()->back();
        // }
    }

    public function CriarFeed(Request $request){

        //validação
        $this->validate($request, [
            'Titulo' => 'required',
            'Descricao' => 'required',
            'fileFeed' => 'mimes:png,jpg,jpeg,docx,doc',
        ]);
        // try{
            $userID = Auth::user()->id;
            $increment = Feed::max('id_post') + 1;
            $data_atual = Carbon::now();
            Feed::insert([
                'id_post' => $increment,
                'nm_post' => $request->Titulo,
                'ds_post' => $request->Descricao,
                'dt_post' => $data_atual,
                'qt_curtida' => 0,
                'id_user' => $userID,
                'tp_user' => 'user'
            ]);


            if ($request->hasFile('fileFeed') && $request->file('fileFeed')->isValid()) {

                // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->fileFeed->extension();

                // Define finalmente o nome
                $fileName = "{$name}.{$extension}";

                // Faz o upload:
                $documentoAtual = $request->fileFeed;

                $upload = $documentoAtual->move(public_path("feed/fotos"), $fileName);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
                if ( !$upload )
                return redirect()->back();
                $increment_image = DB::table('tb_image_post')->max('id_image') + 1;
                DB::table('tb_image_post')->insert([
                    'id_image' =>  $increment_image,
                    'id_post' => $increment,
                    'nm_image' => $fileName
                ]);
                }

            toastr()->success('Post cadastrado com sucesso.');
            return redirect()->route('user.feed.index');
        // } catch (Exception $e) {
        //     toastr()->error('erro.');
        //     return redirect()->back();
        // }

    }

    public function create(){

        return view('user.Feed.feedCriar');
    }

    public function Curtir($id){

        // try{
            $qt_curtidas = Feed::where('id_post', $id)->first();
            $curtidas = $qt_curtidas->qt_curtida + 1;
            Feed::where('id_post', $id)->update([
                'qt_curtida' => $curtidas
            ]);

            toastr()->success('Postagem curtida com sucesso.');
            return redirect()->back();

        // }catch (Exception $e) {
        //     toastr()->error('erro.');
        //     return redirect()->back();
        // }

    }

    public function Comentar(Request $request,$id){

        $this->validate($request, [
            'comentario' => 'required',
        ]);

        // try{
            $data_atual = Carbon::now();
            $increment = Comentarios::max('id_comentario') + 1;
            $userID = Auth::user()->id;

            Comentarios::insert([
                'id_comentario' => $increment,
                'ds_comentario' => $request->comentario,
                'dt_comentario' => $data_atual,
                'tp_user' => 'user',
                'id_user' => $userID,
                'id_post' => $id,
            ]);

            toastr()->success('Comentario enviado com sucesso.');
            return redirect()->back();

        // } catch (Exception $e) {
        //     toastr()->error('erro.');
        //     return redirect()->back();
        // }

    }

    public function getComentarios($id){

        $comentarios = Comentarios::ExibirComentarios($id);

        return $comentarios;
    }

    public function getName($tp_user,$id_user){

        switch ($tp_user) {
            case 'admin':
               $admin = Admin::where('id', $id_user)->first();
               $name = $admin->nm_admin;
                break;

            case 'user':
                $admin = User::where('id', $id_user)->first();
               $name = $admin->nm_user;
                break;
        }

        return $name;
    }

    public function getFotoPost($id){

        $Foto = Feed::ExibirFoto($id);

        if($Foto != null){
            $foto = $Foto->nm_image;
        }else{
            $foto = null;
        }
        return $foto;
    }

    public function getFoto($tp_user,$id_user){

        switch ($tp_user) {
            case 'admin':
               $foto = null;
                break;

            case 'user':
                $admin = Perfil::where('id_user', $id_user)->first();
               $foto = $admin->foto_perfil;
                break;
        }

        return $foto;
    }


}
