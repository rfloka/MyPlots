@php
if ($users->foto == null) {
$url = "http://127.0.0.1:8000/storage/upload/fotos/1.jpg";
$display1="";
}else{
$url = "http://127.0.0.1:8000/storage/upload/fotos/$users->foto";
$display1="none";
}

$display ="";
if (Auth::check() && Auth::user()->role == '3') {
$display ="none";
}
if ($users->role == "1" ){
$role = "Admin" ;
$cor = "#09814A";
} elseif ($users->role == "2" ) {
$role = "Funcionário";
$cor = "#09814A";
}elseif ($users->role == "3" ) {
$role = "Proprietário";
$cor = "#09814A";
}else{
$role = "Não Verificado";
$cor = "red";
}
@endphp
@extends('AllUsers')
@section('title', 'Perfil Utilizador')
@section('detalhes')
    <div class="row" style="background-color:white">
        <div class="profile-header-container">
            <div class="profile-header-img">
                <img class="img-circle" src="{{$url}}" />
                <!-- badge -->
                <div class="rank-label-container">
                    <span style="background-color:{{$cor}}" class="label label-default rank-label">{{$role}}</span>
                </div>
            </div>
            <form id="foto" style="display:none;margin-top:-40px;" action="/addfoto" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{$users->id}}">
                <input type="file" style="width:100px;" name="foto" required>
                <button type="submit" class="btn btn-primary">OK</button>
            </form>
            <button id="botao" onclick="foto()" style="display:{{$display1}};margin-top:-40px;" class="btn btn-success">Adicionar
                Foto</button>
        </div>
        <div class="col-sm-7" style="margin-top:5%;">
            <p><b>Nome:</b>{{$users->name}}</p>
            <p><b>Nif:</b>{{$users->cc}}</p>
            <p><b>Morada:</b>{{$users->morada }}</p>
            <p><b>Email:</b> {{$users->email }}</p>
            <p><b>Telefone:</b>{{$users->telefone}}</p>
            <button style="display:{{$display}}" onclick="fechar()" class="btn btn-success">Contactar</button>
        </div>
    </div>
    <br>
    <div id="mensagem" style="display:none;">
        <div class="row">

            <div class="card" style="width: 100%;height:340px;">
                <div class="card-body" style="overflow:auto;">
                    <i onclick="voltar()" class="fas fa-times fechar" style="float:right;"></i>
                    <h5 class="card-title"><i class="fas fa-envelope"></i> Mensagem</h5>
                    <form method="post" action="{{URL::to('/mensage')}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Meu Email</label>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input readonly type="email" name="from" value="{{Auth::user()->email}}" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <label>Para</label>
                            <input readonly type="email" name="to" class="form-control" id="exampleInputPassword1"
                                value="{{$users->email }}">
                            <label>Assunto</label>
                            <input type="text" class="form-control" name="subject" required>
                            <label for="Message">Message:</label><br /><textarea required style="width:100%;" rows="10"
                                name="message" id="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        @if ($users->role == "3")
        <div class="row">
            <h2>Terrenos</h2>
            <div class="c">
                <table id="myTable" class="table table-hover fl-table">
                    <thead>
                        <tr>
                            <th scope="col">Morada</th>
                            <th scope="col">Artigo Matricial</th>
                            <th scope="col">Area</th>
                            <th scope="col">Tipo de Solo</th>
                            <th scope="col">Nº Registo</th>
                            <th scope="col" class="text-right"><a href="/addplot/{{$users->id}}" style="color:#09814A;display:{{$display}};">
                                    <i style="color:#09814A" class="fas fa-plus-circle"> </i> Terreno</a></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plots as $key =>$data)
                        <tr>
                            <th scope="row">{{$data->morada}}</th>
                            <td><a href="/doc/{{$data->artigo_marti}}">Documento Artigo</a></td>
                            <td>{{$data->area}}</td>
                            <td>{{$data->tipo_solo}}</td>
                            <td>{{$data->nr_registo}}</td>
                            <td class="text-right">
                                <a style="display:{{$display}};" href="/editplot/{{$data->id_plot}}"> <i style="color:#09814A"
                                        class="fas fa-edit"> </i></a>
                                <a href="/map/{{$data->id_plot}}"><i style="color:#09814A" class="fas fa-map-marked-alt"></i></a>
                                <a style="display:{{$display}}" href="/transf/{{$data->id_plot}}?pro=0" id="trasf"> <i
                                        style="color:#09814A" class="fas fa-exchange-alt"></i></a>
                                <a onclick="confirmar1({{$data->id_plot}})" style="display:{{$display}}" href="#" id="trasf">
                                    <i style="color:red" class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @elseif ($users->role == "1" || $users->role == "2" )
        <div class="row">
            <h2>Historico de Ações</h2>
            <div class="c">
                <table id="myTable" style="height:100px;" class="table table-hover fl-table c">
                    <thead>
                        <tr>
                            <th scope="col">ID Ação</th>
                            <th scope="col">Ação</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <div>
                        <tbody>
                            @foreach ($logs as $key =>$data)
                            <tr>
                                <th scope="row">{{$data->id_log}}</th>
                                <td style="width:20px;overflow:auto;">{{$data->action}}</td>
                                <td>{{$data->data}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </div>
                </table>
            </div>
            @else
            <div class="row">
                <style></style>
                <div class="col"></div>
                <div class="col">
                    <form action={{URL::to('/changerole')}} method="post">
                        @csrf
                        <input type="text" name="id" value="{{$users->id}}" style="display:none">
                        <select style="font-size:20px;width:100%" name="roles">
                            <option value="3">Proprietário</option>
                            <option value="2">Funcionário</option>
                            <option value="1" style="display:{{$roledisplay}}">Admin</option>
                            <option value="4">Eliminar</option>
                        </select>
                        <p></p>
                        <input type="submit" style="font-size:30px;width:100%" class="btn btn-danger" value="Verificar Utilizador">
                    </form>
                </div>
                <div class="col"></div>
            </div>
            @endif
        </div>
    </div>
    <div class="col-sm-1"></div>
<script>
    function fechar() {
        document.getElementById("content").style.display = "none";
        document.getElementById("mensagem").style.display = "";
    }

    function voltar() {
        document.getElementById("content").style.display = "";
        document.getElementById("mensagem").style.display = "none";
    }

</script>
<script>
    function confirmar1(id) {
        var txt;
        if (confirm("Tem acerteza que quer eliminar este terreno!")) {
            window.location.href = "http://127.0.0.1:8000/eliminarterreno/" + id;
        } else {
            location.reload();
        }
    }

</script>
<script>
    function foto() {
        document.getElementById("foto").style.display = "";
        document.getElementById("botao").style.display = "none";
    }

</script>

@endsection
