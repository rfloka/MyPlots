
@extends('layouts.estrutu')
@section('title', 'mensagens')
@section('content')
<div class="row" style="background-color:white">
        <div style="margin-top:2%;height:500px">
            <p><b>De:</b> {{$email->de}}</p>
            <p><b>Assunto:</b> {{$email->assunto}}</p>
            <p><b>Data:</b> {{$email->data}}</p>
            <br>
            <br>
            <p>{{$email->texto}}</p>
        </div>
    </div>
@endsection