$(document).ready(function() {
    $(".btn-cerrarPop").click(function() {
        $("#overlay").removeClass('active');
        $("#popup").removeClass('active');
        $(".contenedor-popup.cont-1").hide();
        $(".contenedor-popup .ejercicio-body").html('')
    });
    $(".btn-abrirPop").click(function() {
        $("#overlay").addClass('active');
        $("#popup").addClass('active');
    });
    $(".btn-abrirPop1").click(function() {
        $(".contenedor-popup.cont-1").show();
    });
    $(".btn-abrirPop2").click(function() {
        $(".contenedor-popup.cont-2").show();
    });
    $(".btn-abrirPop3").click(function() {
        $(".contenedor-popup.cont-3").show();
    });
    var botCheck = false
    $(".menu-open").click(function() {
        if (botCheck == false) {
            $("#bottomMenu").css('bottom', "0px")
            $("#burger-menu").css('bottom', "175px")

            botCheck = true
        } else {
            $("#bottomMenu").css('bottom', "-175px")
            $("#burger-menu").css('bottom', "0px")
            botCheck = false
        }
    });
});


$(document).ready(function() {
    //poner con php el data-id en la etiqueta con la classe de abrir el popup
    $(".btn-abrirPop").each(function(index) {
        $(this).click(function() {
            $(".crear-inscri .id-event").val($(this).attr('data-id'))
        });
    })
    $(".contrasenha").click(function() {
        $(".content-password").toggle();
    });


});