
@extends('layouts.estrutu')
@section('title', 'mensagens')
@section('content')
<h1 align="center">Mensagens</h1>
<table class="table table-hover" style="background:white">
    <tbody>
      @foreach ($mensagens as $key =>$data)
        
        <tr onclick="window.location='/emaildetalhes/{{$data->id_mensagem}}';">
            <td><strong>{{$data->de}}</strong></td>
            <td style="overflow:hidden;"><div style="width:500px;height:20px;overflow:hidden;"><strong>{{$data->assunto}}</strong>-{{$data->texto}}<span>...</span></div></td>
            <td>{{$data->data}}</td>
            <td><a href="#"><i style="color:red;" class="fas fa-trash-alt"></i></a></td>
            @if ($data->visto == false)
                <td><a href="#"><i style="color:yellow;" class="fas fa-exclamation"></i></a></td>
            @endif
        </tr>
     @endforeach
    </tbody>
  </table>


@endsection