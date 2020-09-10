$('#ranges-modal').modal({
    backdrop: 'static',
    keyboard: false,
    focus: true,
    show: false
});

$('.pagination').addClass('justify-content-center');

$('#selectorDeResultados').prop('value', $('#numeroDeResultados').prop('value'));

function checkSearch()
{
    // Campo búsqueda
    if ($('#campo-buscar').prop('value').trim() == '') {
        $('.search-link').addClass('disabled');
    } else {
        $('.search-link').removeClass('disabled');
    }
    //Campos selectores
    $('#selectorMinimo').prop('value', $('#rangoLimite1').prop('value'));
    $('#selectorMaximo').prop('value', $('#rangoLimite2').prop('value'));
}
checkSearch(); // Comprobar contenido de busqueda

// Buscar por ciudad o nombre
$('#campo-buscar').on('keyup', function() {
    checkSearch();
});
$('.search-link').on('click', function (e) {
    e.preventDefault();
    $('#busqueda').prop('value', $('#campo-buscar').prop('value').trim());
    $('#dondeBuscar').prop('value',(($(this).prop('id') == 'search-city')?'C':'N'));
    $('#selectionForm').submit();
});
$('#search-clear').on('click', function(e){
    e.preventDefault();
    $('#busqueda').prop('value','');
    $('#dondeBuscar').prop('value','');
    $('#selectionForm').submit();
});
// Fin de buscar por ciudad o nombre
// Botones de estado
$('.btn-estado').on('click', function() {
    var botonPulsado = $(this).prop('id');
    switch (botonPulsado)
    {
    case "btnElementoActivos":
        $('#estado').prop('value', 'A');
        break;
    case "btnElementoInactivos":
        $('#estado').prop('value', 'I');
        break;
    case "btnElementosTodos":
        $('#estado').prop('value', 'T');
        break;
    }
    $('#selectionForm').submit();
});
// Fin de botones de estado
// Rangos
$('#botonAcotar').on('click', function() {
    if ($('#selectorMinimo').prop('value') > $('#selectorMaximo').prop('value')) {
        $('#ranges-modal').modal('show');
    } else {
        $('#rangoLimite1').prop('value', $('#selectorMinimo').prop('value'));
        $('#rangoLimite2').prop('value', $('#selectorMaximo').prop('value'));
        $('#selectionForm').submit();
    }
});

$('#botonDesacotar').on('click', function() {
    $('#rangoLimite1').prop('value', '00');
    $('#rangoLimite2').prop('value', '10');
    $('#selectionForm').submit();
});

$('#ranges-modal').on('hide.bs.modal', function () {
    $('#selectorMinimo').prop('value', $('#rangoLimite1').prop('value'));
    $('#selectorMaximo').prop('value', $('#rangoLimite2').prop('value'));
});
// Fin de rangos

// Orden por nombre o ciudad, ascendente o descendente
$('#NameOrderChange, #CityOrderChange').on('click', function(e) {
    e.preventDefault();
    $('#criterioDeOrden').prop('value', ($(this).prop('id') == 'NameOrderChange')?'nombre':'ciudad');
    $('#sentidoDeOrden').prop('value', ($('#sentidoDeOrden').prop('value') == 'ASC')?'DESC':'ASC');
    $('#selectionForm').submit();
});
// Fin de orden por nombre o ciudad, ascendente o descendente

// El número de resultados
$('#selectorDeResultados').on('change', function() {
    $('#numeroDeResultados').prop('value', $('#selectorDeResultados').prop('value'));
    $('#selectionForm').submit();
});
// Fin del número de resultados

// Los enlaces de paginacion
$('.page-link').on('click', function(e){
    e.preventDefault();
    if ($(this)[0]['href']) {
        var corte = $(this)[0]['href'].indexOf('=') + 1;
        var pageNumber = $(this)[0]['href'].substr(corte);
        $('#pageNumber').prop('value', pageNumber);
        $('#selectionForm').submit();
    }
});
// Fin de la gestión de los enlaces de paginación

// Ver ficha de operador
$('.enlaceVerOperador').on('click', function(e) {
    e.preventDefault();
    $('#show_id').prop('value', $(this).prop('id').substr(4));
    $('#showForm').submit();
});
// Fin de ver ficha de operador

// Cambiar estado de operador
    $('.enlaceEstadoOperador').on('click', function(e) {
    e.preventDefault();
    $('#chst_id').prop('value', $(this).prop('id').substr(4));
    $('#chstForm').submit();
});
// Fin de cambiar estado de operador

// Ver los viajes de un operador
    $('.enlaceViajesOperador').on('click', function(e) {
    e.preventDefault();
    $('#trop_id').prop('value', $(this).prop('id').substr(4));
    $('#tourForm').submit();
});
// Fin de ver los viajes de un operador

