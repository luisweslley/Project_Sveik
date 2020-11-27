<?php

namespace App\Http\Controllers\UserControllers;

use App\Acesso;
use App\Exercicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modulo;
use App\Aula;
use app\User;
use Exception;

class ModuloController extends Controller
{

    public function index()
    {
        $userID = Auth::user()->id;

        $userModulo = Modulo::ExibirModuloUser($userID);
    //    return dd($userModulo);
        return view('user.Modulo.modulo',['UserModulo' => $userModulo]);
    }

    public function ModuloDetalhes($id)
    {
        try{
            $userID = Auth::user()->id;
            $userModuloDetalhes = Modulo::DetalhesModulosUser($id,$userID);
            // return dd($userModuloDetalhes);
        return view('user.Modulo.moduloDetalhe', ['userModuloDetalhes' => $userModuloDetalhes]);

        }catch (Exception $e){
            toastr()->error('erro.');
            return redirect()->back();
        }
    }

    public function Download($id){

        $file = Exercicio::where('id_exercicio', $id)->first();
        $id_aula = $file->id_aula;
        $anexo = $file->anexo_exercicio;
        $verify2 = Aula::where('id_aula',$id_aula)->first();
        $id_modulo = $verify2->id_modulo;

        $filename = 'Modulos/'. $id_modulo . '/aula-'. $id_aula. '/'. $anexo ;

        return response()->download(public_path($filename));
    }

    public function DownloadCorrecao($id){

        $file = Exercicio::where('id_exercicio', $id)->first();
        $id_aula = $file->id_aula;
        $anexo = $file->anexo_correcao;
        $verify2 = Aula::where('id_aula',$id_aula)->first();
        $id_modulo = $verify2->id_modulo;

        $filename = 'Modulos/'. $id_modulo . '/aula-'. $id_aula. '/correcao'. '/' . $anexo ;

        return response()->download(public_path($filename));
    }

    public function ModuloFinalizado($id){

        try{
            $userID = $this->currentUser();
            Acesso::where('id_modulo',$id)->where('id_user',$userID)
            ->update(['bl_modulo' => 1]);

            toastr()->success('Modulo finalizado com sucesso.');
            return redirect()->route('admin.modulo.index');
        }catch (Exception $e){
            toastr()->error('erro.');
            return redirect()->back();
        }

    }

    public function getExercicios($id){

        $exercicios = Modulo::DetalhesExerciciosUser($id);

        return $exercicios;
     }

}
