@extends('layouts.main-layout')

@section('page-title', 'Lista de viajes')

@section('content-area')
    <div class="row">
        <div class="col col-sm-6 text-left">
            <h1>Viajes</h1>
        </div>
        <div class="col col-sm-6 text-right">
            <br>
            <a href="{{ route('tourCreate') }}" class="btn btn-success btn-sm">Nuevo</a>
        </div>
    </div>
   <div class="row"><br></div>

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>&nbsp;</th>
                <th>Destino</th>
                <th>F. inicio</th>
                <th>F. final</th>
                <th>Duración</th>
                <th>Precio</th>
                <th>Operador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viajes as $viaje)
                <tr>
                    <td class="celda-de-ver-clientes">
                        <i class="material-icons icono-de-ver-clientes icono-verde" data-icon="{{ $viaje->id }}">visibility</i>
                    </td>
                    <td>
                        <a href="{{ route('tourEdit', ['tour'=>$viaje->id]) }}">
                            {{ $viaje->destino }}
                        </a>
                    </td>
                    <td class="celda-de-fecha">@fecha_hispana($viaje->inicio_fecha)</td>
                    <td class="celda-de-fecha">@fecha_hispana($viaje->final_fecha)</td>
                    <td>{{ $viaje->duracion }}</td>
                    <td class="celda-de-precio">@priceformat($viaje->precio)</td>
                    <td>{{ $viaje->operator()->withTrashed()->first()->nombre }}</td>
                </tr>
                <tr>
                    <td colspan="7" class="celda-de-clientes {{ $viaje->id }}">
                        <a href="{{ route('tourCustomers', ['tour'=>$viaje->id]) }}">
                            Clientes:
                        </a>
                        <ul>
                            @foreach ($viaje->customers as $customer)
                            <li>{{$customer->nombre}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script language="javascript">
        $('.icono-de-ver-clientes').on('click', function () {
            var viaje_id = $(this).attr('data-icon');
            var celda = $('td.' + viaje_id);
            if ($(this).html() == 'visibility') {
                $(this).html('visibility_off');
                $(this).removeClass('icono-verde');
                $(this).addClass('icono-rojo');
                celda.fadeIn(300);
            } else {
                $(this).html('visibility');
                $(this).addClass('icono-verde');
                $(this).removeClass('icono-rojo');
                celda.fadeOut(300);
            }

        });
    </script>
@endsection
