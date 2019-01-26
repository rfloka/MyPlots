<?php

namespace MyPlots\Http\Controllers\API;

use Illuminate\Http\Request;
use MyPlots\Http\Controllers\Controller;
use MyPlots\User;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class MyPlotsApi extends Controller
{

    public function index($key)
    {
        $query = DB::table('ApiUsers')->where('token', '=', $key)->pluck('token');
        if ($query == "[]") {
            return response()->json('unauthorized');
        }
        $data = DB::table('users')
            ->join('plot_user', 'plot_user.id_user', '=', 'users.id')
            ->join('plots', 'plot_user.id_plot', '=', 'plots.id_plot')
            ->select('plots.*', 'users.name', 'users.email', 'users.foto', 'users.cc')->get();
        return response()->json($data);
    }

    public function terreno($key, $nr_registo)
    {
        $query = DB::table('ApiUsers')->where('token', '=', $key)->pluck('token');
        if ($query == "[]") {
            return response()->json('unauthorized');
        }
        $data = DB::table('users')
            ->join('plot_user', 'plot_user.id_user', '=', 'users.id')
            ->join('plots', 'plot_user.id_plot', '=', 'plots.id_plot')
            ->select('plots.*', 'users.name', 'users.email', 'users.cc')->where('nr_registo', '=', $nr_registo)->get();
        if ($data == "[]") {
            return response()->json('terreno nao existe');
        }
        return response()->json($data);
    }

}
