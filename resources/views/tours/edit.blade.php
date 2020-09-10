@extends ('layouts.main-layout')

@section('page-title', 'Editar '.$viaje->destino)

@section('content-area')
    <h1>Editar viaje</h1>
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
        <form action="{{ route('tourUpdate') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $viaje->id }}">
            <legend>Nuevo viaje</legend>
            <div class="row">
                <div class="col col-sm-4">
                    <label for="destino" class="full-label">Destino:<br>
                        <input type="text" name="destino" id="destino" value="{{ old('destino') ? : $viaje->destino }}" class="form-control">
                    </label>
                </div>
                <div class="col col-sm-4">
                    <label for="precio" class="full-label">Precio:<br>
                        <div class="input-group mb-3">
                            <input type="number" name="precio" id="precio" value="{{ old('precio')  ? : $viaje->precio }}" class="form-control text-right" min="0" step="0.01">
                            <div class="input-group-append">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col col-sm-4">
                    <label for="operador" class="full-label">Operador:<br>
                        <select name="operador" id="operador" class="form-control">
                        @foreach ($operadores as $operador)
                            <option value="{{ $operador->id }}" {{(old('operador') == $operador->id) ? "selected" : (($viaje->operator_id == $operador->id)?"selected":"")}} >{{ $operador->nombre}}</option>
                        @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-4">
                    <label for="inicio-fecha" class="full-label">F.Inicio:<br>
                        <input type="date" name="inicio-fecha" id="inicio-fecha" value="{{ old('inicio-fecha') ? : $viaje->inicio_fecha }}" class="form-control text-right">
                    </label>
                </div>
                <div class="col col-sm-4">
                    <label for="inicio-hora" class="full-label">H.Inicio:<br>
                        <input type="time" name="inicio-hora" id="inicio-hora" value="{{ old('inicio-hora') ? : $viaje->inicio_hora }}" class="form-control text-right">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-4">
                    <label for="final-fecha" class="full-label">F.Fin:<br>
                        <input type="date" name="final-fecha" id="final-fecha" value="{{ old('final-fecha') ? : $viaje->final_fecha }}" class="form-control text-right">
                    </label>
                </div>
                <div class="col col-sm-4">
                    <label for="final-hora" class="full-label">H.Fin:<br>
                        <input type="time" name="final-hora" id="final-hora" value="{{ old('final-hora') ? : $viaje->final_hora }}" class="form-control text-right">
                    </label>
                </div>
                <div class="col col-sm-4">
                    <label for="duracion" class="full-label">Dias:<br>
                        <input type="number" name="duracion" id="duracion" value="{{ old('duracion') ? : $viaje->duracion }}" class="form-control text-right" step="1" min="1">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-12">
                    <label for="detalles" class="full-label">Detalles:<br>
                        <textarea name="detalles" id="detalles" rows="6" class="form-control">{{ old('detalles') ? : $viaje->detalles }}</textarea>
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

    <script languaje="javascript" src="{{ asset('js/tours/dates-tour.js') }}">
    </script>
@endsection
