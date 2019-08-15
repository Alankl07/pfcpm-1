<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <title>Cadastro</title>
</head>
<body>
    <form action="{{route('registrar')}}" method="post" enctype="multipart/form-data">
        <h1>Cadastro Policial</h1>
        @csrf
        <div id="div_pol">
            <div class="nomepol {{$errors->has('nome') ? 'has-error' : '' }}">
                <label for="nomepol">Nome Completo:</label>
                <input class="form-control" name="nome" value="{{old('nome')}}" id="nomepol" size=30>
                @if($errors->has('nome'))
                    <span style="color: red" class="help->block">
                        {{$errors->first('nome')}}
                    </span>
                @endif
            </div>

            <div class="fotopol {{ $errors->has('foto') ? 'has-error' : '' }} ">
                <label for="fotopol">Foto:</label><br>
                <input type="file" name="foto" id="fotopol" value="{{ old('foto') }}"><br>
                @if($errors->has('foto'))
                    <span style="color: red" class="help-block">
                        {{ $errors->first('foto') }}
                    </span>
                @endif
            </div>

            <div class="patenteTela  {{ $errors->has('patente') ? 'has-error' : '' }}">
                <label for="pelotao">Patente:</label>
                <select name="patente" id="patente">
                    <option disabled selected>---SELECIONE PATENTE---</option>
                    <option  id="postos" disabled>======POSTOS======</option>
                    <option name="patente">Coronel</option>
                    <option name="patente">Tenente-Coronel</option>
                    <option name="patente">Major</option>
                    <option name="patente">Capitão</option>
                    <option name="patente">1º Tenete</option>
                    <option id="graduacao" disabled >====GRADUAÇÕES====</option>
                    <option name="patente">Subtenente</option>
                    <option name="patente">Sargento</option>
                    <option name="patente">Cabo</option>
                    <option name="patente">Soldado 1ª Classe</option>
                </select>
                @if($errors->has('patente'))
                    <span style="color: red" class="help-block">
                        {{ $errors->first('patente') }}
                    </span>
                @endif
            </div>

            <div class="mat col-sm-2 {{ $errors->has('matricula') ? 'has-error' : '' }}">
                <label for="matricula">Número de matrícula:</label>
                <input class="form-control" name="matricula" value="{{ old('matricula') }}" id="num_mat" size=30>
                @if($errors->has('matricula'))
                    <span style="color: red" class="help-block">
                        {{ $errors->first('matricula') }}
                    </span>
                @endif
            </div>

            <div class="sexopol {{ $errors->has('sexo') ? 'has-error' : '' }} ">
                <label for="sexo">Sexo:</label><br>
                <select id="sex" value="{{old('sexo')}}" name="sexo">
                    <option value="{{''}}" >-------</option>
                    <option name="sexo">Masculino</option>
                    <option name="sexo">Feminino</option>
                </select><br>
                @if($errors->has('sexo'))
                    <span style="color: red" class="help-block">
                        {{ $errors->first('sexo') }}
                    </span>
                @endif
            </div>

            <div class="cpfpol col-sm-2 {{ $errors->has('cpf') ? 'has-error' : '' }} ">
                <label for="cpfpol">CPF:</label>
                <input class="form-control" name="cpf" id="cpfpol" value="{{ old('cpf') }}" >
                @if($errors->has('cpf'))
                    <span style="color: red" class="help-block">
                        {{ $errors->first('cpf') }}
                    </span>
                @endif
            </div>
            <div class="rgpol col-sm-2 {{ $errors->has('rg') ? 'has->error' : '' }} ">
                <label for="rgpol">RG:</label>
                <input class="form-control" name="rg" id="rgpol" value="{{ old('rg') }}" >
                @if($errors->has('rg'))
                    <span style="color: red" class="help-block">
                        {{ $errors->first('rg') }}
                    </span>
                @endif
            </div>
            <div class="estadopol {{ $errors->has('estado') ? 'has-error' : '' }} " >
                <label for="estadopol">Estado:</label>
                <input class="form-control" name="estado" id="estadopol" value="{{ old('estado') }}" >
                @if($errors->has('estado'))
                    <span style="color: red" class="help-block" >
                        {{ $errors->first('estado') }}
                    </span>
                @endif
            </div>
            <div class="cidadepol {{ $errors->has('cidade') ? 'has-error' : '' }} ">
                <label for="cidadepol">Cidade</label>
                <input class="form-control" name="cidade" id="cidadepol" value="{{ old('cidade') }}" >
                @if($errors->has('cidade'))
                    <span style="color: red" class="help-block" >
                        {{ $errors->first('cidade') }}
                    </span>
                @endif
            </div>

            <div class="datanascP {{ $errors->has('dataNascimento') ? 'has-error' : '' }} ">
                <label for="dataNascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" name="dataNascimento" value="{{ old('dataNascimento') }}" id="dataNascimento">
                @if($errors->has('dataNascimento'))
                    <span style="color: red" class="help-block" >
                        {{ $errors->first('dataNascimento') }}
                    </span>
                @endif
            </div>

            <div class="pelotaopol {{ $errors->has('pelotao') ? 'has-error' : '' }} ">
                <label for="pelotao">Unidade:</label>
                <input class="form-control" name="pelotao" id="pelotao" value="{{ old('pelotao') }}" >
                @if($errors->has('pelotao'))
                    <span style="color: red" class="help-block" >
                        {{ $errors->first('pelotao') }}
                    </span>
                @endif
            </div>

            <div class="sen {{ $errors->has('senha') ? 'has-error' : '' }} ">
                <label for="senhap">Senha:</label>
                <input type="password" class="form-control" name="senha" id="senhap">
                @if($errors->has('senha'))
                    <span style="color: red" class="help-block" >
                        {{ $errors->first('senha') }}
                    </span>
                @endif
            </div>

            <div class="confirmarsen {{ $errors->has('senhaConfirma') ? 'has-error' : '' }} " >
                <label for="senhaConfirma">Confirmar Senha:</label>
                <input type="password" class="form-control" name="senhaConfirma" id="senhap">
                @if($errors->has('senhaConfirma'))
                    <span style="color: red" class="help-block" >
                        {{ $errors->first('senhaConfirma') }}
                    </span>
                @endif
            </div>

            <div class="btnpol" >
                <button type="submit" id="btnpol" class="btn btn-primary" >Cadastrar</button>
            </div>
            
        </div>
    </form>
</body>
</html>