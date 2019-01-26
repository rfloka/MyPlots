<?php

namespace MyPlots\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PlotsController extends Controller
{

    public function terre()
    {
        if (Auth::check() && Auth::user()->role == '3') {
            $cod = Auth::user()->id;
            $plot = null;
            $is1 = DB::table('plots')->pluck('id_plot');
            $is = $is1->toArray();
            $coordenadas = DB::select("SELECT coordenadas FROM plots INNER JOIN plot_user ON plots.id_plot =plot_user.id_plot WHERE plot_user.id_user = $cod");
            $num = count($coordenadas);
            $num--;
            for ($i = 0; $i <= $num; $i++) {
                foreach ($coordenadas[$i] as $coordenada) {
                    $plot = $plot . $coordenada . " , ";
                }
            }
            $plot = mb_substr($plot, 0, -1);
            $info = DB::table('plots')->where('id_plot', 1)->first();
            $iduser = DB::table('users')->join('plot_user', 'users.id', '=', 'plot_user.id_user')->select('users.id')->where('plot_user.id_plot', '=', $info->id_plot)->get()->first();
            return view('MapsPlots', ['info' => $info], ['indice' => $is])->with('plot', $plot)->with('iduser', $iduser);
        } else {
            $plot = null;
            $is1 = DB::table('plots')->pluck('id_plot');
            $is = $is1->toArray();
            $coordenadas = DB::select("SELECT coordenadas FROM plots order by id_plot ");
            $num = count($coordenadas);
            $num--;
            for ($i = 0; $i <= $num; $i++) {
                foreach ($coordenadas[$i] as $coordenada) {
                    $plot = $plot . $coordenada . " , ";
                }
            }
            $plot = mb_substr($plot, 0, -1);
            $info = DB::table('plots')->where('id_plot', 1)->first();
            $iduser = DB::table('users')->join('plot_user', 'users.id', '=', 'plot_user.id_user')->select('users.id')->where('plot_user.id_plot', '=', $info->id_plot)->get()->first();
            return view('MapsPlots', ['info' => $info], ['indice' => $is])->with('plot', $plot)->with('iduser', $iduser);
        }

    }
    public function map($id)
    {
        $plot = null;
        $coordenadas = DB::select("SELECT coordenadas FROM plots WHERE id_plot=$id");
        $dados = DB::table('plots')->where('id_plot', $id)->first();
        $iduser = DB::table('users')
            ->join('plot_user', 'plot_user.id_user', '=', 'users.id')
            ->select('users.*')->where('id_plot', $id)
            ->first();
        $num = count($coordenadas);
        $num--;
        for ($i = 0; $i <= $num; $i++) {
            foreach ($coordenadas[$i] as $coordenada) {
                $plot = $plot . $coordenada . " , ";
            }
        }
        $plot = mb_substr($plot, 0, -1);
        return view('MapsPlots',['info'=>$dados], ['indice' => $plot])->with('plot', $plot)->with('iduser', $iduser);
    }


    public function transf($id)
    {
        $user = DB::table('users')
            ->join('plot_user', 'plot_user.id_user', '=', 'users.id')
            ->select('users.*')->where('id_plot', $id)
            ->first();
        $plot = DB::table('plots')->where('id_plot', $id)->first();
        $url = "http://127.0.0.1:8000/storage/upload/fotos/1.jpg";
        return view('TransferPlot', ['plot' => $plot, 'user' => $user])->with('url', $url);
    }

    public function confirmado($id, $id2, $plot)
    {
        $very = Carbon::now();
        $oldpro = DB::table('users')->where('id', $id)->pluck('name');
        $newpro = DB::table('users')->where('id', $id2)->pluck('name');
        $plot1 = DB::table('plot_user')->where('id_user', $id)->pluck('id_plot');
        DB::table('plot_user')
            ->where('id_plot', $plot)
            ->update(['id_user' => $id2]);

        if (Auth::check() && Auth::user()->role != '3') {
            $cod = Auth::user()->id;
            $funci = Auth::user()->name;
            $time = Carbon::now();
            $plot1 = str_replace(array('[', ']'), '', $plot);
            $oldpro = str_replace(array('[', ']'), '', $oldpro);
            $newpro = str_replace(array('[', ']'), '', $newpro);
            $timestamp = $time->toDateTimeString();
            $action = "O Utilizador " . $funci . " transferiu o terreno com id " . $plot . " || Antigo Dono: " . $oldpro . " || Novo Dono: " . $newpro . ".";
            DB::insert('insert into logs (id_user,action,data) values (?,?,?)', [$cod, $action, $time]);
        }
        return redirect('/allusers');
    }
    public function showeditplot($id)
    {
        $info = DB::table('plots')->where('id_plot', $id)->first();;
        $plot = null;
        $coordenadas = DB::select("SELECT coordenadas FROM plots WHERE id_plot=$id");
        $num = count($coordenadas);
        $num--;
        for ($i = 0; $i <= $num; $i++) {
            foreach ($coordenadas[$i] as $coordenada) {
                $plot = $plot . $coordenada . ",";
            }
        }
        $plot = mb_substr($plot, 0, -1);
        return view('EditPlot', ['info' => $info])->with('plot', $plot);
    }

    public function alterarplotDB(request $request)
    {
        $id = $_POST['id_plot'];
        if ($_POST['coordenadas'] == null) {
            $coordenada = DB::table('plots')->where('id_plot', $id)->pluck('coordenadas');
            echo $coordenada;
        } else {
            $coordenada = $_POST['coordenadas'];
            $coordenada = str_replace(array('[', ']'), '', $coordenada);
        }
        $morada = $_POST['morada'];
        $area = $_POST['area'];
        $tipo_solo = $_POST['tipo_solo'];
        $numero = $_POST['numero'];
        DB::table('plots')
            ->where('id_plot', $id)
            ->update(['coordenadas' => $coordenada, 'morada' => $morada, 'area' => $area, 'tipo_solo' => $tipo_solo, 'nr_registo' => $numero]);
        if (Auth::check() && Auth::user()->role != '3') {
            $cod = Auth::user()->id;
            $funci = Auth::user()->name;
            $time = Carbon::now();
            $timestamp = $time->toDateTimeString();
            $action = "O Utilizador " . $funci . " alterou o terreno com id " . $id . ".";
            DB::insert('insert into logs (id_user,action,data) values (?,?,?)', [$cod, $action, $time]);
        }
        return redirect('/allusers');
    }
    public function eliminarplot($id)
    {
        DB::table('plots')->where('id_plot', '=', $id)->delete();
        return redirect('/allusers');
    }

    public function mapsinfo(request $request)
    {
        if ($_POST['id']==null){
            return back();
        }
        $idf = $_POST['id'];
        if (Auth::check() && Auth::user()->role == '3') {
            $cod = Auth::user()->id;
            $plot = null;
            $is1 = DB::table('plots')->pluck('id_plot');
            $is = $is1->toArray();
            $coordenadas = DB::select("SELECT coordenadas FROM plots INNER JOIN plot_user ON plots.id_plot =plot_user.id_plot WHERE plot_user.id_user = $cod");
            $num = count($coordenadas);
            $num--;
            for ($i = 0; $i <= $num; $i++) {
                foreach ($coordenadas[$i] as $coordenada) {
                    $plot = $plot . $coordenada . " , ";

                }
            }
            $plot = mb_substr($plot, 0, -1);
            $info = DB::table('plots')->where('id_plot', $idf)->first();
            $iduser = DB::table('users')->join('plot_user', 'users.id', '=', 'plot_user.id_user')->select('users.id')->where('plot_user.id_plot', '=', $info->id_plot)->get()->first();
            return view('MapsPlots', ['info' => $info], ['indice' => $is])->with('plot', $plot)->with('iduser', $iduser);
        } else {
            $plot = null;
            $coordenadas = DB::select("SELECT  coordenadas FROM plots order by id_plot ");
            $is1 = DB::table('plots')->pluck('id_plot');
            $is = $is1->toArray();
            $num = count($coordenadas);
            $num--;
            for ($i = 0; $i <= $num; $i++) {
                foreach ($coordenadas[$i] as $coordenada) {
                    $plot = $plot . $coordenada . " , ";
                }
            }
            $plot = mb_substr($plot, 0, -1);
            $info = DB::table('plots')->where('id_plot', $idf)->first();
            $iduser = DB::table('users')->join('plot_user', 'users.id', '=', 'plot_user.id_user')->select('users.id')->where('plot_user.id_plot', '=', $info->id_plot)->get()->first();
            return view('MapsPlots', ['info' => $info], ['indice' => $is])->with('plot', $plot)->with('iduser', $iduser);
        }
    }


}
