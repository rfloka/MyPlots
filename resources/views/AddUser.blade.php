@extends('layouts.estrutu')
@section('title', 'Adicionar Utilizador')
@section('content')
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Adicionar Utilizador</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                            @csrf
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input placeholder="Nome" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif      
                        </div>
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif     
                        </div>
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input placeholder="Confirmar Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>    
                            </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input placeholder="Cartão de Cidadão" id="cc" type="text" class="form-control{{ $errors->has('cc') ? ' is-invalid' : '' }}" name="cc" value="{{ old('cc') }}" required autofocus>

                            @if ($errors->has('cc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cc') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input placeholder="Telefone" id="telefone" type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ old('telefone') }}" required autofocus>

                            @if ($errors->has('telefone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('telefone') }}</strong>
                                </span>
                            @endif      
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <input placeholder="Morada" id="morada" type="text" class="form-control{{ $errors->has('morada') ? ' is-invalid' : '' }}" name="morada" value="{{ old('morada') }}" required autofocus>
    
                                    @if ($errors->has('morada'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('morada') }}</strong>
                                        </span>
                                    @endif      
                        </div>
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                                </div>
                                <select id="role" name="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                        <option value=2>Funcionário</option>
                                        <option value=3>Proprietário</option>
                                        <option value=1>Admin</option>
                                      </select>
        
                                        @if ($errors->has('role'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif     
                            </div>
                            <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
@endsection