<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Duvidas;
use Exception;

class DuvidasController extends Controller
{
    public function index(){

        try{
        //Lista de Duvidas
        $listDuvidas = Duvidas::ListDuvidas();

        //FILTROS
        //Duvidas respondidas
        $listRespondidas = Duvidas::DuvidasRespondidas();
        //Duvidas não resposdidas
        $listNaoRespondidas = Duvidas::DuvidasNaoRespondidas();

        return view('admin.Duvidas.duvidas', ['listDuvidas' => $listDuvidas,
        'listRespondidas' => $listRespondidas,
        'listNaoRespondidas' => $listNaoRespondidas]);

        } catch (Exception $e) {
            toastr()->error('erro.');
            return redirect()->back();
        }

    }

    public function DetalhesDuvidas($id){

        try{
        $userDuvida = Duvidas::DuvidaUser($id);

        return view('', ['userDuvida' => $userDuvida]);

        } catch (Exception $e) {
            toastr()->error('erro.');
            return redirect()->back();
        }
    }

    public function EnviarResposta(Request $request, $id){

        $this->validate($request, [
            'duvida' => 'required'
        ]);
        try{
            Duvidas::where('id_duvida',$id)
            ->update([
                'ds_resposta' => $request->duvida,
                'bl_duvida' => 1
            ]);

            toastr()->success('Resposta enviada com sucesso.');
            return redirect()->route('admin.duvidas.index');

        } catch (Exception $e) {
            toastr()->error('erro.');
            return redirect()->back();
        }

    }

    public function DuvidasUser($id){

        try{

        //Lista de duvidas user
        $listUser = Duvidas::ListDuvidasUser($id);

        return view('',['listUser' => $listUser]);

        } catch (Exception $e) {
            toastr()->error('erro.');
            return redirect()->back();
        }

    }

    public function Destroy($id){

        try{
            //Deletar duvida
            Duvidas::where('id_duvida',$id)->delete();

            toastr()->success('Deletada com sucesso.');
            return redirect()->route('admin.duvidas.index');

         } catch (Exception $e) {
             toastr()->error('erro.');
             return redirect()->back();
         }

    }


}
