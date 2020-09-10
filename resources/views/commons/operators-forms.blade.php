<form id="selectionForm" action="{{ route('operatorsList') }}" method="post">
    @csrf
    <input type="hidden" id="estado" name="estado" value="{{$estado}}">
    <input type="hidden" id="rangoLimite1" name="rangoLimite1" value="{{$rangoLimite1}}">
    <input type="hidden" id="rangoLimite2" name="rangoLimite2" value="{{$rangoLimite2}}">
    <input type="hidden" id="busqueda" name="busqueda" value="{{$busqueda}}">
    <input type="hidden" id="dondeBuscar" name="dondeBuscar" value="{{$dondeBuscar}}">
    <input type="hidden" id="criterioDeOrden" name="criterioDeOrden" value="{{$criterioDeOrden}}">
    <input type="hidden" id="sentidoDeOrden" name="sentidoDeOrden" value="{{$sentidoDeOrden}}">
    <input type="hidden" id="pageNumber" name="pageNumber" value="{{$pageNumber}}">
    <input type="hidden" id="numeroDeResultados" name="numeroDeResultados" value="{{$numeroDeResultados}}">
</form>

<form id="showForm" action="{{ route('operatorShow') }}" method="post">
    @csrf
    <input type="hidden" id="show_id" name="show_id" value="">
</form>

<form id="chstForm" action="{{ route('operatorChangeState') }}" method="post">
    @csrf
    <input type="hidden" id="chst_id" name="chst_id" value="">
</form>

<form id="tourForm" action="{{ route('toursList') }}" method="post">
    @csrf
    <input type="hidden" id="trop_id" name="trop_id" value="">
</form>
