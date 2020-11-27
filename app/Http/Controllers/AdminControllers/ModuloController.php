<?php

namespace App\Http\Controllers\AdminControllers;

use App\Acesso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Modulo;
use App\Admin;
use App\Aula;
use App\Exercicio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\File as FacadesFile;

class ModuloController extends Controller
{

    public function index(){

        $userAtual = Auth::user()->id;

        //Queries de exibição de todos os modulos e as atividades
        $ExibirModulo = Modulo::ExibirModulosAdmin($userAtual);


        return view('admin.Modulos.modulo',['ExibirModulo' => $ExibirModulo]);
    }

    public function moduloDetalhes(int $id){

        $userdetalhes = Modulo::detalhesModulo($id);
        $listaUser = Modulo::listaUserModulo($id);

        return view('admin.Modulos.moduloDetalhes',
        ['userdetalhes' => $userdetalhes, 'listaUser' => $listaUser, 'id' => $id]);
    }

    public function CreateModulo(Request $request){

    $dataAtual = Carbon::now();
    $userID = Auth::user()->id;

    //validação
    $this->validate($request, [
        'nm_modulo' => 'required',
        'ds_modulo' => 'required',
    ]);

//  try{
    //Insert em modulo
    $autoIncrement = Modulo::max('id_modulo') + 1;
    Modulo::insert([
        'id_modulo' => $autoIncrement,
        'nm_modulo' => $request->nm_modulo,
        'ds_modulo' => $request->ds_modulo,
        'dt_criacao' => $dataAtual,
        'id_admin' => $userID,
        'id_nivel' => 1,
    ]);

        toastr()->success('sucesso.');
        return redirect()->route('admin.modulo.index');
    // }catch (Exception $e){
    //     toastr()->error('erro.');
    //     return redirect()->back();
    // }

}

    public function UpdateModulo(Request $request, $id){

    try{
        Modulo::where('id_modulo',$id)
        ->update([
            'nm_modulo' => $request->nm_modulo,
        ]);

        toastr()->success('sucesso.');
        return redirect()->route('admin.modulo.index');
    }catch (Exception $e){
        toastr()->error('erro.');
        return redirect()->back();
    }
}

    public function DeleteModulo($id){

    try{
        //check
        $userAula = Aula::where('id_modulo', $id)->get();

        foreach($userAula as $a){
        Exercicio::where('id_aula', $a->id_aula)->delete();
        }
        $pathExercicio = 'Modulos/'. $id;
        File::delete($pathExercicio);
        Aula::where('id_modulo', $id)->delete();
        Acesso::where('id_modulo', $id)->delete();
        Modulo::where('id_modulo',$id)
        ->delete();

        toastr()->success('sucesso.');
        return redirect()->route('admin.modulo.index');
    } catch (Exception $e) {
        toastr()->error('erro.');
        return redirect()->back();
    }
}
    public function AulaCriar($id){

       $verify = Modulo::where('id_modulo',$id)->first();
       $nome = $verify->nm_modulo;

        return view('admin.Modulos.moduloAulaCriar',['id' => $id, 'nome' => $nome]);
    }
    public function CreateAula(Request $request, $id){

    //validação
    $this->validate($request, [
        'nm_aula' => 'required',
        'nm_exercicio' => 'required',
        'fileExercicio' => 'required'
    ]);
        // return dd($request->request);
// try{
    //variaveis de apoio
    $increment = Aula::max('id_aula') + 1;
    $increment_exe = Exercicio::max('id_exercicio') + 1;
    $dataAtual = Carbon::now();


        if ($request->hasFile('fileExercicio') && $request->file('fileExercicio')->isValid()) {

            // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->fileExercicio->extension();

            // Define finalmente o nome
            $fileName = "{$name}.{$extension}";

            // Faz o upload:
            $documentoAtual = $request->fileExercicio;

            $upload = $documentoAtual->move(public_path('Modulos/'. $id . '/aula-'. $increment. '/'), $fileName);

            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            if ( !$upload )
            return redirect()->back();
        }
        //insert tb_aula
            Aula::insert([
                'id_aula' => $increment,
                'nm_aula' => $request->nm_aula,
                'dt_criacao' => $dataAtual,
                'id_modulo' => $id,
            ]);

        //insert tb_exercicio
            Exercicio::insert([
                'id_exercicio' => $increment_exe,
                'nm_exercicio' => $request->nm_exercicio,
                'anexo_exercicio' => $fileName,
                'dt_criacao' => $dataAtual,
                'id_aula' => $increment,
            ]);

        toastr()->success('sucesso.');
        return redirect()->route('admin.modulo.moduloDetalhes',['id' => $id]);
    // } catch (Exception $e) {
    //     toastr()->error('erro.');
    //     return redirect()->back();
    // }

    }

    public function UpdateNomeAula(Request $request, $id){

    //validação
    $this->validate($request, [
        'nm_aula' => 'required',
    ]);

        try{
        //insert tb_aula
        Aula::where('id_aula', $id)->update([
            'nm_aula' => $request->nm_aula,
        ]);

        toastr()->success('sucesso.');
        return redirect()->back();
    } catch (Exception $e) {
        toastr()->error('erro.');
        return redirect()->back();
    }
    }
    public function DeleteAula($id){

        try{
            $verify2 = Aula::where('id_aula',$id)->first();
            $id_modulo = $verify2->id_modulo;

            Exercicio::where('id_aula', $id)->delete();

            $pathExercicio = 'Modulos/'. $id_modulo . '/aula-'. $id;
            File::delete($pathExercicio);

            Aula::where('id_aula', $id)->delete();

            toastr()->success('sucesso.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error('erro.');
            return redirect()->back();
        }

    }

    public function ExercicioCriar(int $id){

        $verify = Aula::where('id_aula',$id)->first();
        $nome = $verify->nm_aula;
        return view('admin.Modulos.moduloExercicioCriar', ['id' => $id, 'nome' => $nome]);
    }

    public function ExercicioEditar($id){

        $verify = Exercicio::where('id_exercicio', $id)->first();
        $nome = $verify->nm_exercicio;
        $id_aula = $verify->id_aula;
        $verify2 = Aula::where('id_aula',$id_aula)->first();
        $nome_aula = $verify2->nm_aula;

        return view('admin.Modulos.moduloExercicioEdit',
        ['nome' => $nome, 'id' => $id, 'nome_aula' => $nome_aula]);
    }

    public function AddExercicio(Request $request,$id){

        //validação
        $this->validate($request, [
            'nm_exercicio' => 'required',
            // 'fileExercicio' => 'required'
        ]);
    // try{
      //Variaveis de apoio
      $increment_exe = Exercicio::max('id_exercicio') + 1;
      $dataAutal = Carbon::now();
      $verify2 = Aula::where('id_aula',$id)->first();
      $id_modulo = $verify2->id_modulo;


      if ($request->hasFile('fileExercicio') && $request->file('fileExercicio')->isValid()) {

        // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $request->fileExercicio->extension();

        // Define finalmente o nome
        $fileName = "{$name}.{$extension}";

        // Faz o upload:
        $documentoAtual = $request->fileExercicio;

        $upload = $documentoAtual->move(public_path('Modulos/'. $id_modulo . '/aula-'. $id. '/'), $fileName);

        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        if ( !$upload )
        return redirect()->back();
      }
          Exercicio::insert([
              'id_exercicio' => $increment_exe,
              'nm_exercicio' => $request->nm_exercicio,
              'anexo_exercicio' => $fileName,
              'dt_criacao' => $dataAutal,
              'id_aula' => $id,
          ]);

                toastr()->success('sucesso.');
                return redirect()->route('admin.modulo.moduloDetalhes',['id' => $id_modulo]);
            // } catch (Exception $e) {
            //     toastr()->error('erro.');
            //     return redirect()->back();
            // }
        }

    public function UpdateExercicio(Request $request, $id){

        //validação
        $this->validate($request, [
            'nm_exercicio' => 'required',
        ]);

        //return dd($request->request);
        $verify = Exercicio::where('id_exercicio', $id)->first();
        $oldAnexo = $verify->anexo_exercicio;
        $id_aula = $verify->id_aula;
        $verify2 = Aula::where('id_aula',$id_aula)->first();
        $id_modulo = $verify2->id_modulo;
    try{

        if ($request->hasFile('fileExercicio') && $request->file('fileExercicio')->isValid()) {

            //Apagar file
            $pathExercicio = 'Modulos/'. $id_modulo . '/aula-'. $id_aula. '/'.$oldAnexo;
            File::delete($pathExercicio);

            // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->fileExercicio->extension();

            // Define finalmente o nome
            $fileName = "{$name}.{$extension}";

            // Faz o upload:
            $documentoAtual = $request->fileExercicio;

            $upload = $documentoAtual->move(public_path('Modulos/'. $id_modulo . '/aula-'. $id_aula. '/'), $fileName);

            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            if ( !$upload )
            return redirect()->back();

        }else{
            $fileName = $oldAnexo;
        }
                Exercicio::where('id_exercicio', $id)->update([
                    'nm_exercicio' => $request->nm_exercicio,
                    'anexo_exercicio' => $fileName,
                ]);
            toastr()->success('sucesso.');
            return redirect()->route('admin.modulo.moduloDetalhes',['id' => $id_modulo]);
        } catch (Exception $e) {
            toastr()->error('erro.');
            return redirect()->back();
        }
        }

public function DeleteExercicio($id){

    try{
        $verify = Exercicio::where('id_exercicio', $id)->first();
        $oldAnexo = $verify->anexo_exercicio;
        $id_aula = $verify->id_aula;
        $verify2 = Aula::where('id_aula',$id_aula)->first();
        $id_modulo = $verify2->id_modulo;
        $pathExercicio = 'Modulos/'. $id_modulo . '/aula-'. $id_aula. '/'.$oldAnexo;
        //unlink($pathExercicio);
        File::delete($pathExercicio);
        Exercicio::where('id_exercicio', $id)->delete();
        toastr()->success('sucesso.');
        return redirect()->route('admin.modulo.moduloDetalhes',['id' => $id_modulo]);
    } catch (Exception $e) {
        toastr()->error('erro.');
        return redirect()->back();
    }

}

    public function CorrecaoCriar($id){

        $verify = Exercicio::where('id_exercicio', $id)->first();
        $nome = $verify->nm_exercicio;
        return view('admin.Modulos.moduloCorrecaoCriar', ['id' => $id, 'nome' => $nome]);
    }

    public function AddCorrecao(Request $request, $id){

        //validação
        $this->validate($request, [
            'fileCorrecao' => 'required'
        ]);
        try{
        //Variaveis de apoio
        $verify = Exercicio::where('id_exercicio', $id)->first();
        $id_aula = $verify->id_aula;
        $verify2 = Aula::where('id_aula',$id_aula)->first();
        $id_modulo = $verify2->id_modulo;


        if ($request->hasFile('fileCorrecao') && $request->file('fileCorrecao')->isValid()) {

            // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->fileCorrecao->extension();

            // Define finalmente o nome
            $fileName = "{$name}.{$extension}";

            // Faz o upload:
            $documentoAtual = $request->fileCorrecao;

            $upload = $documentoAtual->move(public_path('Modulos/'. $id_modulo . '/aula-'. $id_aula. '/correcao'), $fileName);

            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            if ( !$upload )
            return redirect()->back();
        }
            Exercicio::where('id_exercicio', $id)
            ->update([
                'anexo_correcao' => $fileName
            ]);

                    toastr()->success('sucesso.');
                    return redirect()->route('admin.modulo.moduloDetalhes',['id' => $id_modulo]);
                } catch (Exception $e) {
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

    public function DeleteCorrecao($id){

        $verify = Exercicio::where('id_exercicio', $id)->first();
        $id_aula = $verify->id_aula;
        $oldAnexo = $verify->anexo_correcao;
        $verify2 = Aula::where('id_aula',$id_aula)->first();
        $id_modulo = $verify2->id_modulo;
        $pathExercicio = 'Modulos/'. $id_modulo . '/aula-'. $id_aula . '/correcao' . $oldAnexo;
        File::delete($pathExercicio);
        Exercicio::where('id_exercicio', $id)
        ->update([
            'anexo_correcao' => null
        ]);

        toastr()->success('sucesso.');
        return redirect()->route('admin.modulo.moduloDetalhes',['id' => $id_modulo]);

    }

    public function CountAula($id){

        $AulaCount = Aula::where('id_modulo', $id)->count();

        return $AulaCount;
    }

    public function CountExercicio($id){

        $Aula = Aula::where('id_modulo', $id)->first();
        $x = $Aula->id_aula;
        $ExercicioCount = Exercicio::where('id_aula', $x)->count();

        return $ExercicioCount;
    }

    public function InfoRest($id){

        $Info = Modulo::InfoRest($id);

        return $Info;

    }

    public function getExercicios($id){

       $exercicios = Modulo::DetalhesExerciciosUser($id);

       return $exercicios;
    }

}
