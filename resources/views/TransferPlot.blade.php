@php
    $novo=$_GET['pro'];
    if ($novo==0) {
       $display1="none";
       $display2="block";
       $newpro = DB::table('users')->where('id', 1)->first();
    }else{
        $newpro = DB::table('users')->where('id', $novo)->first();
        $display2="none";
        $display1="";
    }
@endphp
@extends('layouts.estrutu')
@section('title', 'Terrenos')
@section('content')
<h1 style="text-align: center;">Transferir terreno</h1>
<div class="row" style="display:{{$display1}}">
    <div class="col-5" style="">
        <div class="card">
            <div class="profile-header-img">
                <img class="card-img-top" src="{{$url}}" alt="Card image cap">
            </div>
            <div class="card-body">
                <h5 class="card-title">Dono: {{$user->name}}</h5>
                <p class="card-text"><b>Terreno: <a href="/map/{{$plot->id_plot}}">Mapa</a></b>
                    <ul>
                        <li>Morada:{{$plot->morada}}</li>
                        <li>Nº registo:{{$plot->nr_registo}}</li>
                    </ul>
            </div>
        </div>
    </div>
    <div class="col-2">
        <i style="font-size:150px;line-height:400%;" class="fas fa-exchange-alt"></i>
        <a href="/transf/{{$user->id}}/{{$newpro->id}}/{{$plot->id_plot}}" class="btn btn-success" style="font-size:30px;margin-top:-50%;">Confirmar</a>
    </div>
    <div class="col-5">
        <div class="card">
            <div class="profile-header-img">
                <img class="card-img-top" src="{{$url}}" alt="Card image cap">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$newpro->name}}</h5>
                <p class="card-text">Morada:{{$newpro->morada}}</p>
                <p class="card-text">Email:{{$newpro->email}}</p>
                <p class="card-text">Telefone:{{$newpro->telefone}}</p>
            </div>
        </div>
    </div>
</div>
<div id="myModal" style="display:{{$display2}};" class=" modal">

        <!-- Modal content -->
        <div class="modal-content">
            <h3>Selecione Proprietário</h3>
            <hr>
            @php
                $userquery = DB::table('users')->where('role', 3)->get();
            @endphp
            <form method="GET">
                <select style="font-size:20px;width:100%" name="pro">
                        @foreach ($userquery as $key =>$data)
                            <option  value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                </select>
                <hr>
                <input style="display: block;margin:auto;width:200px;" class="btn" type="submit">
            </form>
        </div>

    </div>
    @endsection
