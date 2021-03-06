@extends('inicial')

@section('body')
    <form  action="{{route('dispensa.store')}}" method="POST">
        @csrf
        <div>
            <h1 id="titu">Solicitação de Dispensa</h1>

            <div class="escalado {{$errors->has('escalado') ? 'has-error' : ''}}">
                <label for="escalado">Devidamente Escalado No: </label>
                <input type="text" class="form-control" name="escalado" value="{{old('escalado')}}" id="escalado" size=30>
                @if($errors->has('escalado'))
                    <span style="color:red" class="help-block">
                        {{$errors->first('escalado')}}
                    </span>
                @endif
            </div>
            <div class="dia  {{$errors->has('dia') ? 'has-error' : '' }} ">
                <label for="dia">Dia do Serviço</label>
                <input type="date" class="form-control" name="dia" value="{{old('dia')}}" id="dia" size=30>
                @if($errors->has('dia'))
                    <span style="color: red" class="help-block">
                        {{$errors->first('dia')}}
                    </span>
                @endif
            </div>
            <div class="hora {{ $errors->has('das') ? 'has->error' : '' }} ">
                <label for="hora">Das:</label>
                <input type="time" class="form-control" name="das" value="{{old('das')}}" id="hora"  size=30>
                @if($errors->has('das'))
                    <span style="color: red" class="help-block">
                        {{$errors->first('das')}}
                    </span>
                @endif 
            </div>
            <div class="as {{$errors->has('as') ? 'has-error' : '' }}">
                <label for="hora">Às:</label>
                <input type="time" class="form-control" name="as" value="{{old('as')}}" id="hora"  size=30>
                @if($errors->has('as'))
                    <span style="color: red" class="help-block">
                        {{$errors->first('as')}}
                    </span>
                @endif 
            </div>
            <div class="virtude {{ $errors->has('virtude') ? 'has-error' : '' }} ">
                <label for="hora">Em virtude de:</label>
                <textarea type="text" class="form-control" id="virtude" value="{{old('virtude')}}" name="virtude" rows="3"></textarea>
                @if($errors->has('virtude'))
                    <span style="color: red" class="help-block">
                        {{$errors->first('virtude')}}
                    </span>
                @endif
            </div>
        </div>
        <button type="submit" id="btndispensa" class="btn btn-primary">Solicitar</button>
    </form>
@endsection('body')