@php
if ($user->role == "1" ){
$role = "Admin" ;
$cor = "#09814A";
} elseif ($user->role == "2" ) {
$role = "Funcionário";
$cor = "#09814A";
}elseif ($user->role == "3" )   {
$role = "Proprietário";
$cor = "#09814A";
}else{
    $role = "Não Verificado";
    $cor = "red";
}
    
@endphp
@extends('layouts.estrutu')
@section('title', 'Utilizadores')
@section('content')
<div class="row" style="background-color:white">
    <div class="profile-header-container">
        <div class="profile-header-img">
            <img class="img-circle" src="http://127.0.0.1:8000/storage/upload/fotos/1.jpg" />
            <!-- badge -->
            <div class="rank-label-container">
            <span style="background-color:{{$cor}}" class="label label-default rank-label">{{$role}}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-7" style="margin-top:5%;">
        <form method="post" action="/alteraruser">  
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">      
            <p><b>Nome:</b><input name="nome" class="form-control" value="{{$user->name}}"></p>
            <p><b>Nif:</b><input name="nif" class="form-control" value="{{$user->cc}}"></p>
            <p><b>Morada:</b><input name="morada" class="form-control" value="{{$user->morada}}"></p>
            <p><b>Email:</b><input name="email" class="form-control" value="{{$user->email}}"></p>
            <p><b>Telefone:</b><input name="telefone" class="form-control" value="{{$user->telefone}}"></p>
            <button style="background-color:#09814A;" type="submit" class="btn">Salvar alterações</button>
            <hr>
        </form>
    </div>
</div>


@endsection