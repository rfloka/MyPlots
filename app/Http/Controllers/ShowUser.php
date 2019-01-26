<?php
namespace MyPlots\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use MyPlots\Http\Controllers\Controller;
use MyPlots\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class ShowUser extends Controller
{
    public function utili($id)
    {
        $roledisplay = "none";
        if (Auth::check() && Auth::user()->role == '1') {
            $roledisplay = "";
        }
        $users = DB::table('users')->where('id', $id)->first();
        $logs = DB::table('logs')->where('id_user', $id)->get();
        $plots = DB::table('plots')
            ->join('plot_user', 'plot_user.id_plot', '=', 'plots.id_plot')
            ->select('plots.*')->where('id_user', $id)
            ->get();
        return view('OwnerPro', ['users' => $users, 'logs' => $logs, 'plots' => $plots])->with('cod', $id)->with('roledisplay', $roledisplay);
    }
    public function addPlot($id)
    {
        $plots = DB::table('users')->where('id', $id)->first();
        return view('AddPlot', ['users' => $plots]);
        return redirect("/ownerpro/$id");
    }

    public function changerole(Request $request)
    {
        $very = Carbon::now();
        $id = $_POST['id'];
        $role = $_POST['roles'];
        if ($role == 4) {
            DB::table('users')->where('id', '=', $id)->delete();
        } else {
            DB::table('users')
                ->where('id', $id)
                ->update(['role' => $role, 'email_verified_at' => $very]);
        }

        if (Auth::check() && Auth::user()->role != '3') {
            $cod = Auth::user()->id;
            $funci = Auth::user()->name;
            $time = Carbon::now();
            $timestamp = $time->toDateTimeString();
            if ($role == 4) {
                $action = "O Utilizador " . $funci . " eliminou o utilizador com o id " . $id;;
            } else {
                $action = "O Utilizador " . $funci . " verificou o utilizador com o id " . $id;
            }
            DB::insert('insert into logs (id_user,action,data) values (?,?,?)', [$cod, $action, $time]);
        }
        return redirect('/allusers');
    }

    public function addfoto(request $request)
    {
        $id = $_POST["id"];
        $path = $request->file('foto')->store('public/upload/fotos');
        $doc = explode("s/", $path);
        $documento = $doc[1];
        DB::table('users')
            ->where('id', $id)
            ->update(['foto' => $documento]);
        return redirect("/ownerpro/$id");
    }

    public function addPlotDB(request $request)
    {
        $path = $request->file('artigo')->store('public/upload/doc');
        $id = $_POST['id'];
        $morada = $_POST['morada'];
        $doc = explode("c/", $path);
        $documento = $doc[2];
        $area = $_POST['area'];
        $tipo_solo = $_POST['tipo_solo'];
        $numero = $_POST['numero'];
        $shapeid = $_POST['shapeid'];
        $numcheck = DB::table('plots')->where('nr_registo', $numero)->pluck('nr_registo')->first();
        if ($numcheck == $numero) {
            return Redirect::back()->withErrors(['msg', 'The Message']);
            die;
        }
        $coordenada = $_POST['coordenadas'];
        $coordenada = str_replace(array('[', ']'), '', $coordenada);
        DB::insert('insert into plots (morada,coordenadas,artigo_marti,area,tipo_solo,nr_registo,shape_id) values (?,?,?,?,?,?,?)', [$morada, $coordenada, $documento, $area, $tipo_solo, $numero, $shapeid]);
        $id_plot = DB::table('plots')->where('nr_registo', $numero)->pluck('id_plot')->first();
        DB::insert('insert into plot_user (id_plot,id_user) values (?,?)', [$id_plot, $id]);
        if (Auth::check() && Auth::user()->role != '3') {
            $cod = Auth::user()->id;
            $funci = Auth::user()->name;
            $time = Carbon::now();
            $timestamp = $time->toDateTimeString();
            $action = "O User " . $funci . " adicionou um terreno com o id " . $id_plot . " no utilizador com o id " . $id;
            DB::insert('insert into logs (id_user,action,data) values (?,?,?)', [$cod, $action, $time]);
        }
        return redirect('/allusers');


    }
    public function ShowDoc($doco)
    {
        $url = Storage::url('upload/doc/' . $doco . '');
        return redirect()->away($url);
    }

    public function editaruser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('EditarUser', ['user' => $user]);
    }

    public function alteraruserDB(request $request)
    {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $nif = $_POST["nif"];
        $morada = $_POST["morada"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        DB::table('users')
            ->where('id', $id)
            ->update(['name' => $nome, 'cc' => $nif, 'morada' => $morada, 'email' => $email, 'telefone' => $telefone]);
        if (Auth::check() && Auth::user()->role != '3') {
            $cod = Auth::user()->id;
            $funci = Auth::user()->name;
            $time = Carbon::now();
            $timestamp = $time->toDateTimeString();
            $action = "O Utilizador " . $funci . " alterou o utilizador " . $nome . ".";
            DB::insert('insert into logs (id_user,action,data) values (?,?,?)', [$cod, $action, $time]);
        }
    }
    public function eliminaruser($id)
    {
        DB::table('plots')
            ->join('plot_user', 'plots.id_plot', '=', 'plot_user.id_plot')->where('plot_user.id_user', '=', $id)
            ->delete();
        DB::table('plot_user')->where('id_user', '=', $id)->delete();
        DB::table('logs')->where('id_user', '=', $id)->delete();
        DB::table('users')->where('id', '=', $id)->delete();
        if (Auth::check() && Auth::user()->role != '3') {
            $cod = Auth::user()->id;
            $funci = Auth::user()->name;
            $time = Carbon::now();
            $timestamp = $time->toDateTimeString();
            $action = " O Utilizador " . $funci . " eliminou o utilizador com o ID " . $id . " e todos os seus terrenos . ";
            DB::insert('insert into logs (id_user,action,data) values (?,?,?)', [$cod, $action, $time]);
        }

    }

    public function inbox($email)
    {
        if ($email !== Auth::user()->email) {
            return back();
        }
        $mensages = DB::table('mails')->where('para', $email)->get();
        return view('MyEmailss', ['mensagens' => $mensages]);
    }
    public function email($id)
    {
        $email = DB::table('mails')->where('id_mensagem', $id)->first();
        $user = DB::table('users')->where('email', $email->de)->first();
        DB::table('mails')
            ->where('id_mensagem', $id)
            ->update(['visto' => true]);
        return view('emaildet', ['email' => $email], ['user' => $user]);
    }

    public function getapi()
    {
        return view('getApi');
    }


    public function sendkey()
    {
        $email = $_POST['email'];
        echo $email;
    }


}