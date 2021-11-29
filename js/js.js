$(document).ready(function() {
    $(".btn-cerrarPop").click(function() {
        $("#overlay").removeClass('active');
        $("#popup").removeClass('active');
        $(".contenedor-popup .ejercicio-body").html('')
    });
    $(".btn-abrirPop").click(function() {
        $("#overlay").addClass('active');
        $("#popup").addClass('active');
    });
});