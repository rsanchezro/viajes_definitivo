var fechaInicio, fechaFinal;
moment.locale('es');
function determinarFechas()
{
    fechaInicio = moment($('#inicio-fecha').prop('value')).format('YYYY-MM-DD');
    fechaFinal = moment($('#final-fecha').prop('value')).format('YYYY-MM-DD');
}

$('#duracion').on('click keyup', function(e) {
    e.preventDefault();
    var duracion = $('#duracion').prop('value');
    if (duracion < 1)
    {
        duracion = 1;
        $('#duracion').prop('value', 1);
    }
    $('#final-fecha').prop('value', moment($('#inicio-fecha').prop('value')).add(duracion, 'days').format('YYYY-MM-DD'));
});

$('#inicio-fecha, #final-fecha, #inicio-hora, #final-hora').on('keydown keyup', function(e) {
    e.preventDefault();
});

$('#inicio-fecha, #final-fecha').on('click change', function(e) {
    determinarFechas();
    if (fechaInicio >= fechaFinal) {
        $('#duracion').prop('value', 1);
        $('#final-fecha').prop('value', moment($('#inicio-fecha').prop('value')).add(1, 'days').format('YYYY-MM-DD'));
    } else {
        var duracion = moment(fechaFinal).diff(fechaInicio, 'days');
        $('#duracion').prop('value', duracion);
    }
});

$('#inicio-hora, #final-hora').on('click change', function(e) {
    if ($('#inicio-hora').prop('value') == '') {
        $('#inicio-hora').prop('value', moment().format('H:m'));
    }
    if ($('#final-hora').prop('value') == '') {
        $('#final-hora').prop('value', moment().add(1, 'hour').format('H:m'));
    }
});
