@extends('layouts.main-layout')

@section('page-title', 'Clientes asociados')

@section('content-area')
    <h1>Clientes de un viaje</h1>

    <div class="row">
        <div class="col col-sm-12">
            El viaje a {{ $viaje->destino }} tiene los siguientes clientes.
        </div>
    </div>
    <form action="{{ route('setCustomers') }}" method="post">
        @csrf
        <input type="hidden" name="viaje" value="{{ $viaje->id }}">
        <div class="row">
            <div class="col col-sm-12">
                <label>Clientes:
                    <select class="form-control" size="12" id="clientes" name="clientes[]" multiple>
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}" {{($cliente->selected === true)?"selected":""}}>{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-3">
                <input type="submit" class="btn btn-primary" value="Grabar">
            </div>
        </div>
    </form>

@endsection
