@php
    $display ="";
    if (Auth::check() && Auth::user()->role == '3') {
      $display ="none";
    }
@endphp
@extends('layouts.estrutu')
@section('title', 'Terrenos')
@section('content')
<h1 style="text-align: center;color:white;">Terrenos</h1>
<input type="text" id="MyInput" onkeyup="myFunction()" placeholder=" Search ">
<div class="cc">
  <table id="myTable" class="table table-hover fl-table">
    <thead>
      <tr>
        <th scope="col">Nº Registo</th>
        <th scope="col">Morada</th>
        <th scope="col">Artigo Matricial</th>
        <th scope="col">Area</th>
        <th scope="col">Tipo de Solo</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($plots as $key =>$data)
          
      
        <tr>
          <th scope="row">{{$data->nr_registo}}</th>
          <td>{{$data->morada}}</td>
          <td><a href="/doc/{{$data->artigo_marti}}">Caderneta Perdial</a></td>
          <td>{{$data->area}}</td>
          <td>{{$data->tipo_solo}}</td>
          <td class="text-right">
          <a style="display:{{$display}};" href="/editplot/{{$data->id_plot}}"> <i class="fas fa-edit">  </i></a>
            <a href="/map/{{$data->id_plot}}"> <i class="fas fa-map-marked-alt">  </i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
    
      </div>
  </div> 
</div>
<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("MyInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("th")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  </script>

@endsection