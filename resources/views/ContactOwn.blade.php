@extends('layouts.estrutu')
@section('title', 'Contactar')
@section('content')
        <br>
        <div class="container" style="background-color:white">
         <br>
          <div class="row">
            <div class="col-sm-4"><img src="https://cdn1.iconfinder.com/data/icons/avatar-1-2/512/User2-512.png"  alt="Cinque Terre" width="304" height="236"> </div>
            <div class="col-sm-8">
              <p><b>Nome:</b>José Marques</p>
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
                    <div class="panel panel-default">
                            <div class="panel-body message">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <div class="col-sm-11">
                                              <input type="email" class="form-control select2-offscreen" id="to" placeholder="De" tabindex="-1">
                                        </div>
                                      </div>
                                    <div class="form-group">
                                        <div class="col-sm-11">
                                              <input type="email" class="form-control select2-offscreen" id="cc" placeholder="Para" tabindex="-1">
                                        </div>
                                      </div>
                                    <div class="form-group">
                                        <div class="col-sm-11">
                                              <input type="email" class="form-control select2-offscreen" id="bcc" placeholder="Assunto" tabindex="-1">
                                        </div>
                                      </div>
                                  
                                </form>
                                
                                <div class="col-sm-11 col-sm-offset-1">
                                    <br>	
                                    
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" name="body" rows="5" ></textarea>
                                    </div>
                                    
                                    <div class="form-group">	
                                        <button type="submit" class="btn btn-success">Send</button>
                                        <button type="submit" class="btn btn-danger">Discard</button>
                                    </div>
                                </div>	
                            </div>	
                        </div>	
              </div>
              <div class="col-sm-10"></div>
            </div>
        </div>
@endsection