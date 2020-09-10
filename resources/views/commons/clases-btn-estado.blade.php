@php
    $claseBotonActivos = ($estado == 'A')?"btn btn-primary btn-sm":"btn btn-secondary btn-sm";
    $claseBotonInactivos = ($estado == 'I')?"btn btn-primary btn-sm":"btn btn-secondary btn-sm";
    $claseBotonTodos = ($estado == 'T')?"btn btn-primary btn-sm":"btn btn-secondary btn-sm";
@endphp
<button type="button" id="btnElementoActivos" class="btn-estado {{ $claseBotonActivos }}">Activos</button>
<button type="button" id="btnElementoInactivos" class="btn-estado {{ $claseBotonInactivos }}">Inactivos</button>
<button type="button" id="btnElementosTodos" class="btn-estado {{ $claseBotonTodos }}">Todos</button>

