@extends('layouts.main-layout')

@section('page-title', 'Datos de operador')

@section('content-area')
    <h1>Datos de operador</h1>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th class="table-info h-header">Id</th>
            <td>{{$datos->id}}</td>
        </tr>
        <tr>
            <th class="table-info h-header">Nombre</th>
            <td>{{$datos->nombre}}</td>
        </tr>
        <tr>
            <th class="table-info h-header">Ciudad</th>
            <td>{{$datos->ciudad}}</td>
        </tr>
        <tr>
            <th class="table-info h-header">Dirección</th>
            <td>{{$datos->direccion}}</td>
        </tr>
        <tr>
            <th class="table-info h-header">Teléfono</th>
            <td>{{$datos->telefono}}</td>
        </tr>
        <tr>
            <th class="table-info h-header">Rango</th>
            <td>{{$datos->rango}}</td>
        </tr>
        <tr>
            <th class="table-info h-header">Gestionados</th>
            <td>{{ count($datos->tours) }}</td>
        </tr>
    </table>
@endsection
