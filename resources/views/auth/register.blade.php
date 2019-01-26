<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MyPlots-Registar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo asset('css/loginstyle.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/media.css')?>" type="text/css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
</head>

<body>
    <div class="container" style="margin-top:-100px;">
        <h1 class="title">MyPlots</h1>
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Registar</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input placeholder="Nome" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                name="name" value="{{ old('name') }}" required autofocus>

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
                            <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" required>

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
                            <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" required>

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
                            <input id="password-confirm" placeholder="Confirmar Password" type="password" class="form-control" name="password_confirmation"
                                required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input id="cc" placeholder="NIF" type="number" class="form-control{{ $errors->has('cc') ? ' is-invalid' : '' }}"
                                name="cc" value="{{ old('cc') }}" required autofocus>

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
                            <input id="telefone" placeholder="Telefone" type="number" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}"
                                name="telefone" value="{{ old('telefone') }}" required autofocus>

                            @if ($errors->has('telefone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('telefone') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                            </div>
                            <input id="morada" type="text" placeholder="Morada" class="form-control{{ $errors->has('morada') ? ' is-invalid' : '' }}"
                                name="morada" value="{{ old('morada') }}" required autofocus>

                            @if ($errors->has('morada'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('morada') }}</strong>
                            </span>
                            @endif
                        </div>
                </div>
                <div style="display:none"  class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('role') }}</label>

                    <div class="col-md-6">
                        <input id="role" type="text" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                            name="role" value="4" required autofocus>

                        @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0" style="display: block; margin: 0 auto;">
                    <div class="col">
                        <button type="submit" class="btn reg" style="font-size:20px;">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
