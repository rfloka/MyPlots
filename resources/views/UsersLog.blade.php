@extends('layouts.estrutu')
@section('title', 'Utilizador')
@section('content')
        <br>
        <div class="container" style="background-color:white">
         <br>
          <div class="row">
            <div class="col-sm-4"><img src="https://cdn1.iconfinder.com/data/icons/avatar-1-2/512/User2-512.png"  alt="Cinque Terre" width="304" height="236"> </div>
            <div class="col-sm-8">
              
            <p><b>Nome:</b>{{$userid}}</p>
              <p><b>Proprietário</b></p>
              <p><b>Morada:</b>Rua das Antas</p>
              <p><b>Contacto:</b>jose@gmail || 928321456</p>
              <button  type="button" class="btn btn-success">Dono</button>
            </div>
          </div>
          <br>
          <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Action</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th scope="col" class="text-right">Date</th>
                  <th scope="col" class="text-right">Hour</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Eliminar Utilizador</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-right">01/02/2018 </td>
                  <td class="text-right">18:30 </td>
                </tr>
                <tr>
                        <th scope="row">1</th>
                        <td>Eliminar Utilizador</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">01/02/2018 </td>
                        <td class="text-right">18:30 </td>
                </tr>
                <tr>
                        <th scope="row">1</th>
                        <td>Eliminar Utilizador</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">01/02/2018 </td>
                        <td class="text-right">18:30 </td>
                </tr>
              </tbody>
            </table>
            
              </div>
          </div>
                
         
          <div class="col-sm-1"></div>
      </div>
              
@endsection