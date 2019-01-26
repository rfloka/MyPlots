@php
$holder1= "";
$homepage = "/allusers";
$currentpage = $_SERVER['REQUEST_URI'];
if($homepage!=$currentpage) {
    $holder1="none";
}

if (Auth::check() && Auth::user()->role == '2') {
$user = DB::select("SELECT * FROM users WHERE role > 2");
$display ="";
$icon1 = "fas fa-arrow-left";
$mensagem = "Selecione um utilizador";
}elseif (Auth::check() && Auth::user()->role == '1') {
$user = DB::select("SELECT * FROM users");
$display ="";
$icon1 = "fas fa-arrow-left";
$mensagem = "Selecione um utilizador";

}else{
$user =DB::select('SELECT * FROM users WHERE id ="Auth::user()->id"');
$display ="none";
$mensagem = "Não Autorizado";
$icon1 = "fas fa-hand-paper";
}
@endphp
@extends('layouts.estrutu')
@section('title', 'Utilizadores')
@section('content')
<div class="row">
    <div class="col-2">
        <aside style="display:{{$display}}">
            <div class="lista">
                <input class="disabled" type="text" id="myInput" onkeyup="myFunction()" placeholder=" Search ">
                <ul id="myUL">

                    @foreach ($user as $key =>$data)
                    @php
                    $change="none";
                    if ($cod==$data->id){
                    $cor = '#09814A';
                    $change="";
                    }else{
                    $cor = '#22352b';
                    }
                    if ($data->role == "4") {
                    $icon = 'fas fa-exclamation';
                    $change="none";
                    }else{
                    $icon = '';
                    }
                    @endphp
                    <li style="background-color:{{$cor}}"><a href="/ownerpro/{{$data->id}}" onclick="holder()"><b>ID:
                    {{$data->id}} </b>{{$data->name}}</a><a onclick="confirmar({{$data->id}})" href="#" style="display:{{$change}};float:right;color:red;"><i class="fas fa-user-minus"></i></a><a href="editaruser/{{$data->id}}"  style="display:{{$change}};float:right;color:yellow;padding-right:10px;"><i class="fas fa-pen"></i></a><i style="float:right;padding:15px;color:red;"class="{{$icon}}"></i></li>
                    @endforeach

                </ul>
            </div>
        </aside>
    </div>
    @php
    if ($cod = 0){
    $vazio = 'none';
    $holder = '';
    }else{
    $vazio = '';
    $holder = 'none';
    }
    @endphp
    <div class="col-10" style="margin-top:-10%;">
        <div class="container">
            @yield('detalhes')
        </div>
    </div>
<div class="col-10 holder" style="display:{{$holder1}};">
<h1><i  class="{{$icon1}}"></i> {{$mensagem}}</h1>
    </div>
</div>
<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

</script>

<script>
    function confirmar(id) {
  var txt;
  if (confirm("Tem acerteza que quer eliminar este utilizador e todos os seus terrenos!")) {
    window.location.href = "http://127.0.0.1:8000/eliminaruser/"+id;
  } else {
    location.reload();
  }
}

</script>

@endsection
