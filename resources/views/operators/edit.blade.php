@extends ('layouts.main-layout')

@section('page-title', 'Editar '.$datos->nombre)

@section('content-area')
    <h1>Editar operador</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form action="{{ route('operatorUpdate') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $datos->id }}">
            <legend>Editar operador</legend>

            <div class="row">
                <div class="col col-sm-6">
                    <label for="nombre" class="full-label">Nombre:<br>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') ? : $datos->nombre }}" class="form-control">
                    </label>
                </div>
                <div class="col col-sm-6">
                    <label for="ciudad" class="full-label">Ciudad:<br>
                        <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad') ? : $datos->ciudad }}" class="form-control">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-6">
                    <label for="direccion" class="full-label">Direccion:<br>
                        <textarea name="direccion" id="direccion" rows="4" class="form-control">{{ old('direccion') ? : $datos->direccion }}</textarea>
                    </label>
                </div>
                <div class="col col-sm-3">
                    <label for="telefono" class="full-label">Telf:<br>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') ? : $datos->telefono }}" class="form-control">
                    </label>
                </div>
                <div class="col col-sm-3">
                    <label for="rango" class="full-label">Rango:
                        <select name="rango" id="rango" class="form-control">
                            <option value="00" {{ (old('rango') == '00')?"selected":(($datos->rango == "00")?"selected":"") }}>00</option>
                            <option value="01" {{ (old('rango') == '01')?"selected":(($datos->rango == "01")?"selected":"") }}>01</option>
                            <option value="02" {{ (old('rango') == '02')?"selected":(($datos->rango == "02")?"selected":"") }}>02</option>
                            <option value="03" {{ (old('rango') == '03')?"selected":(($datos->rango == "03")?"selected":"") }}>03</option>
                            <option value="04" {{ (old('rango') == '04')?"selected":(($datos->rango == "04")?"selected":"") }}>04</option>
                            <option value="05" {{ (old('rango') == '05')?"selected":(($datos->rango == "05")?"selected":"") }}>05</option>
                            <option value="06" {{ (old('rango') == '06')?"selected":(($datos->rango == "06")?"selected":"") }}>06</option>
                            <option value="07" {{ (old('rango') == '07')?"selected":(($datos->rango == "07")?"selected":"") }}>07</option>
                            <option value="08" {{ (old('rango') == '08')?"selected":(($datos->rango == "08")?"selected":"") }}>08</option>
                            <option value="09" {{ (old('rango') == '09')?"selected":(($datos->rango == "09")?"selected":"") }}>09</option>
                            <option value="10" {{ (old('rango') == '10')?"selected":(($datos->rango == "10")?"selected":"") }}>10</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-2">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
            </div>
        </form>
    </div>
@endsection
