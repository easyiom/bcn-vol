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
//mostrar



$(document).ready(function() {
    //poner con php el data-id en la etiqueta con la classe de abrir el popup
    $(".btn-abrirPop").each(function(index) {
        $(this).click(function() {
            $(".crear-inscri .id-event").val($(this).attr('data-id'))
            console.log($(this).attr('data-id'))
        });
    })
});