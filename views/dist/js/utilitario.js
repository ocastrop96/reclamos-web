$(document).ready(function() {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-left",
        preventDuplicates: true,
        onclick: null,
        showDuration: "100",
        hideDuration: "300",
        timeOut: "1500",
        extendedTimeOut: "100",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    // FORMATEO DE CAMPOS EN MAYUSCULAS
    $("#nomUsuario").keyup(function() {
        var nombUsuario = $(this).val();
        var mayusNU = nombUsuario.toUpperCase();
        $("#nomUsuario").val(mayusNU);
    });

    $("#nomRep").keyup(function() {
        var nombRep = $(this).val();
        var mayusNR = nombRep.toUpperCase();
        $("#nomRep").val(mayusNR);
    });

    $("#APUsuario").keyup(function() {
        var APUsuario = $(this).val();
        var mayusAP = APUsuario.toUpperCase();
        $("#APUsuario").val(mayusAP);
    });

    $("#AMUsuario").keyup(function() {
        var AMUsuario = $(this).val();
        var mayusAM = AMUsuario.toUpperCase();
        $("#AMUsuario").val(mayusAM);
    });

    $("#DomUsuario").keyup(function() {
        var domUsuario = $(this).val();
        var mayusDom = domUsuario.toUpperCase();
        $("#DomUsuario").val(mayusDom);
    });

    $("#DomRep").keyup(function() {
        var domRep = $(this).val();
        var mayusDomR = domRep.toUpperCase();
        $("#DomRep").val(mayusDomR);
    });

    // Filtro de campos
    $("#nDocUsuario,#telefUsuario,#telefRep,#nDocRep").keyup(function() {
        this.value = (this.value + "").replace(/[^0-9]/g, "");
    });

    $("#nomUsuario,#APUsuario,#AMUsuario,#nomRep").keyup(function() {
        this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
    });
    $("#nomRep").keyup(function() {
        this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
    });


    // Filtro Campos
    $("#nomUsuario").change(function() {
        if (
            validaTexto($("#nomUsuario").val()) === false &&
            $("#nomUsuario").val() !== ""
        ) {
            toastr.error(
                "Solo se permiten letras",
                "Nombre de Usuario"
            );
            $("#nomUsuario").focus();
        } else {
            $("#APUsuario").focus();
        }
    });

    $("#APUsuario").change(function() {
        if (
            validaTexto($("#APUsuario").val()) === false &&
            $("#APUsuario").val() !== ""
        ) {
            toastr.error(
                "Solo se permiten letras",
                "Apellido Paterno Usuario"
            );
            $("#APUsuario").focus();
        } else {
            $("#AMUsuario").focus();
        }
    });

    $("#AMUsuario").change(function() {
        if (
            validaTexto($("#AMUsuario").val()) === false &&
            $("#AMUsuario").val() !== ""
        ) {
            toastr.error(
                "Solo se permiten letras",
                "Apellido Materno Usuario"
            );
            $("#AMUsuario").focus();
        } else {
            $("#sexUsuario").focus();
        }
    });

    $("#nomRep").change(function() {
        if (
            validaTexto($("#nomRep").val()) === false &&
            $("#nomRep").val() !== ""
        ) {
            toastr.error(
                "Solo se permiten letras",
                "Nombres o Razón Social del Representante"
            );
            $("#nomRep").focus();
        } else {
            $("#emailRep").focus();
        }
    });

    function validaTexto(text) {
        var regex = /^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]+$/;
        if (regex.test(text)) {
            return true;
        } else {
            return false;
        }
    }

    $("#DepUsuario").on("change", function() {
        var DepartamentoId = $(this).val();
        if (DepartamentoId > 0) {
            if (DepartamentoId) {
                $.ajax({
                    type: "POST",
                    url: "libs/provinciasAjax.php",
                    data: "DepartamentoId=" + DepartamentoId,

                    success: function(html) {
                        $("#ProvUsuario").prop("disabled", false);
                        $("#ProvUsuario").html(html);
                        $("#DistUsuario").html(
                            '<option value="0">Seleccione provincia primero</option>'
                        );
                    },
                });
            }
        } else {
            $("#ProvUsuario").html(
                '<option value="0">Seleccione departamento primero</option>'
            );
            $("#DistUsuario").html(
                '<option value="0">Seleccione provincia primero</option>'
            );
            $("#ProvUsuario").prop("disabled", true);
            $("#DistUsuario").prop("disabled", true);
        }
    });

    $("#ProvUsuario").on("change", function() {
        var ProvinciaId = $(this).val();
        if (ProvinciaId > 0) {
            if (ProvinciaId) {
                $.ajax({
                    type: "POST",
                    url: "libs/distritosAjax.php",
                    data: "ProvinciaId=" + ProvinciaId,

                    success: function(html) {
                        $("#DistUsuario").prop("disabled", false);
                        $("#DistUsuario").html(html);
                    },
                });
            }
        } else {
            $("#DistUsuario").html(
                '<option value="0">Seleccione provincia primero</option>'
            );
            $("#DistUsuario").prop("disabled", true);
        }
    });

    // datos de causas especificas
    $("#recCG").on("change", function() {
        var CausaGeneralId = $(this).val();
        if (CausaGeneralId > 0) {
            if (CausaGeneralId) {
                $.ajax({
                    type: "POST",
                    url: "libs/causasEspecificasAjax.php",
                    data: "CausaGeneralId=" + CausaGeneralId,

                    success: function(html) {
                        $("#recCE").prop("disabled", false);
                        $("#recCE").html(html);
                    },
                });
            }
        } else {
            $("#recCE").html(
                '<option value="0">Seleccione primero causa General</option>'
            );
            $("#recCE").prop("disabled", true);
        }
    });
});