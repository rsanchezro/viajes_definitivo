@extends('layouts.main-layout')

@section('page-title', 'Lista de operadores')

@section('content-area')
    <h1>Operadores</h1>
    <div class="row"><br></div>
    <div class="row">
        <div class="col col-sm-4">
            <div class="btn-group" role="group">
                @include('commons.clases-btn-estado')
            </div>
        </div>
        <div class="col col-sm-6">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Buscar:</span>
                </div>
                <input type="text" class="form-control" id="campo-buscar" value="{{$busqueda}}">
                <div class="input-group-append">
                    <a href="#" class="btn btn-success disabled search-link" id="search-city">En ciudad</a>
                    <a href="#" class="btn btn-success disabled search-link" id="search-name">En nombre</a>
                    <a href="#" class="btn btn-warning" id="search-clear">Borrar</a>
                </div>
            </div>
        </div>
        <div class="col col-sm-2 text-right">
            <a href="{{ route('operatorCreate') }}" class="btn btn-success btn-sm">
                Nuevo
            </a>
        </div>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <div class="col col-sm-8">
            @include('operators.ranges-selectors')
        </div>
        <div class="col col-sm-1">&nbsp;</div>
        <div class="col col-sm-1">Ver</div>
        <div class="col col-sm-2">
            <select class="form-control form-control-sm" id="selectorDeResultados">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="0">Todos</option>
            </select>
        </div>
    </div>
    <div class="row"><br></div>
    @if (count($operatorsList) > 0)
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>
                        <a href="#" id="NameOrderChange">
                            <span class="zona-rotulo-cabecera">
                                Nombre
                            </span>
                        </a>
                        @if ($criterioDeOrden == 'nombre')
                            <span class="zona-orden-cabecera">
                                @if ($sentidoDeOrden == "ASC")
                                    <i class="material-icons">keyboard_arrow_up</i>
                                @else
                                    <i class="material-icons">keyboard_arrow_down</i>
                                @endif
                            </span>
                        @endif
                    </th>
                    <th width='300'>
                        <a href="#" id="CityOrderChange">
                            <span class="zona-rotulo-cabecera">
                                Ciudad
                            </span>
                        </a>
                        @if ($criterioDeOrden == 'ciudad')
                            <span class="zona-orden-cabecera">
                                @if ($sentidoDeOrden == "ASC")
                                    <i class="material-icons">keyboard_arrow_up</i>
                                @else
                                    <i class="material-icons">keyboard_arrow_down</i>
                                @endif
                            </span>
                        @endif
                    </th>
                    <th width='70'>Rango</th>
                    <th>Ver</th>
                    <th>Est.</th>
                    <th>Viajes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operatorsList as $operator)
                    <tr>
                        <td>
                            <a href="{{ route('operatorEdit', ['operador'=>$operator->id]) }}">
                                {{$operator->nombre}}
                            </a>
                        </td>
                        <td>{{$operator->ciudad}}</td>
                        <td>{{$operator->rango}}</td>
                        <td class="celda-de-icono">
                            <a href="#" class="enlaceVerOperador" id="show{{ $operator->id }}">
                                <i class="material-icons icono-azul">visibility</i>
                            </a>
                        </td>
                        <td class="celda-de-icono">
                            <a href="#" class="enlaceEstadoOperador" id="chst{{ $operator->id }}">
                                @if (isset($operator->deleted_at))
                                    <i class="material-icons icono-rojo">check_circle_outline</i>
                                @else
                                    <i class="material-icons icono-verde">check_circle</i>
                                @endif
                            </a>
                        </td>
                        <td class="celda-de-icono">
                            <a href="#" class="enlaceViajesOperador" id="tour{{ $operator->id }}">
                                <i class="material-icons icono-gris">shop</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col col-sm-12">
                {{ $operatorsList->links() }}
            </div>
        </div>
    @else
        <p>En este momento no hay operadores según el criterio seleccionado.
    @endif

    @include("commons.operators-forms")
    @include("commons.operators-modals")

    <script languaje="javascript" src="{{ asset('js/operators/operators-list.js') }}">
    </script>

@endsection


