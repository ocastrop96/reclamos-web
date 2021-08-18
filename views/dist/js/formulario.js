$(document).ready(function () {
  // Inicializador de campos
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
  // Bloque de Usuario
  $("#nDocUsuario").prop("readonly", true);
  $("#nomUsuario").prop("readonly", true);
  $("#APUsuario").prop("readonly", true);
  $("#AMUsuario").prop("readonly", true);
  $("#sexUsuario").prop("disabled", true);
  $("#emailUsuario").prop("readonly", true);
  $("#telefUsuario").prop("readonly", true);
  $("#DepUsuario").prop("disabled", true);
  $("#ProvUsuario").prop("disabled", true);
  $("#DistUsuario").prop("disabled", true);
  $("#DomUsuario").prop("readonly", true);

  // Bloque de representante

  $("#radiorep2").prop("checked", true);
  $("#representante").val("2");

  $("#tDocRep").prop("disabled", true);
  $("#nDocRep").prop("readonly", true);
  $("#nomRep").prop("readonly", true);
  $("#emailRep").prop("readonly", true);
  $("#telefRep").prop("readonly", true);
  $("#DomRep").prop("readonly", true);

  // Bloque de reclamo
  $("#cajaFecha").prop("readonly", true);
  $("#recCG").prop("disabled", true);
  $("#recCE").prop("disabled", true);
  // Inicializador de campos
  $("#fechaOcu").datetimepicker({
    locale: "es",
    format: "DD/MM/YYYY",
    singleDatePicker: true,
    maxDate: new Date(),
    minYear: 1901,
    maxYear: parseInt(moment().format("YYYY"), 10),
  });
  $("#cajaFecha").inputmask("dd/mm/yyyy", { placeholder: "dd/mm/yyyy" });
  // Bloque de Usuario Afectado
  $("#tDocUsuario").on("change", function () {
    let comboDocUsuario = $(this).val();

    if (comboDocUsuario == 1) {
      // DNI
      $("#nDocUsuario").prop("readonly", false);
      $("#sexUsuario").prop("disabled", false);
      $("#emailUsuario").prop("readonly", false);
      $("#telefUsuario").prop("readonly", false);
      $("#DepUsuario").prop("disabled", false);
      $("#DomUsuario").prop("readonly", false);
      $("#tDocUsuario").prop("disabled", true);
      $("#btnDNIUsuario").removeClass("d-none");

      $("#nDocUsuario").change(function () {
        $("#sexUsuario").focus();
        let Max_Length = 8;
        let length = $("#nDocUsuario").val().length;
        if (length == Max_Length) {
          $("#nomUsuario").val("");
          $("#APUsuario").val("");
          $("#AMUsuario").val("");
        } else {
          toastr.error(
            "El DNI debe tener 8 dígitos",
            "N° Documento de Usuario"
          );
          $("#nomUsuario").val("");
          $("#APUsuario").val("");
          $("#AMUsuario").val("");
          $("#nomUsuario").prop("readonly", true);
          $("#APUsuario").prop("readonly", true);
          $("#AMUsuario").prop("readonly", true);
        }
      });
    } else if (comboDocUsuario == 2) {
      $("#tDocUsuario").prop("disabled", true);
      $("#nDocUsuario").prop("readonly", false);
      $("#nomUsuario").prop("readonly", false);
      $("#APUsuario").prop("readonly", false);
      $("#AMUsuario").prop("readonly", false);
      $("#sexUsuario").prop("disabled", false);
      $("#emailUsuario").prop("readonly", false);
      $("#telefUsuario").prop("readonly", false);
      $("#DepUsuario").prop("disabled", false);
      $("#DomUsuario").prop("readonly", false);
      $("#btnDNIUsuario").addClass("d-none");

      $("#nDocUsuario").val("");
      $("#nomUsuario").val("");
      $("#APUsuario").val("");
      $("#AMUsuario").val("");
      $("#sexUsuario").val(0);
      $("#emailUsuario").val("");
      $("#telefUsuario").val("");
      $("#DepUsuario").val(0);
      $("#ProvUsuario").val(0);
      $("#DistUsuario").val(0);
      $("#DomUsuario").val("");

      $("#nDocUsuario").change(function () {
        let Max_Length = 12;
        let length = $("#nDocUsuario").val().length;
        if (length == Max_Length) {
          $("#nomUsuario").focus();
        } else {
          toastr.error(
            "El CE debe tener 12 dígitos",
            "N° Documento de Usuario"
          );
          $("#nDocUsuario").focus();
        }
      });
    } else if (comboDocUsuario == 3) {
      $("#nDocUsuario").prop("readonly", false);
      $("#nomUsuario").prop("readonly", false);
      $("#APUsuario").prop("readonly", false);
      $("#AMUsuario").prop("readonly", false);
      $("#sexUsuario").prop("disabled", false);
      $("#emailUsuario").prop("readonly", false);
      $("#telefUsuario").prop("readonly", false);
      $("#DepUsuario").prop("disabled", false);
      $("#DomUsuario").prop("readonly", false);
      $("#tDocUsuario").prop("disabled", true);
      $("#btnDNIUsuario").addClass("d-none");
      $("#nDocUsuario").val("");
      $("#nomUsuario").val("");
      $("#APUsuario").val("");
      $("#AMUsuario").val("");
      $("#sexUsuario").val(0);
      $("#emailUsuario").val("");
      $("#telefUsuario").val("");
      $("#DepUsuario").val(0);
      $("#ProvUsuario").val(0);
      $("#DistUsuario").val(0);
      $("#DomUsuario").val("");

      $("#nDocUsuario").change(function () {
        let Max_Length = 12;
        let length = $("#nDocUsuario").val().length;
        if (length == Max_Length) {
          $("#nomUsuario").focus();
        } else {
          toastr.error(
            "El pasaporte debe tener 12 dígitos",
            "N° Documento de Usuario"
          );
          $("#nDocUsuario").focus();
        }
      });
    } else {
      $("#nDocUsuario").prop("readonly", true);
      $("#nomUsuario").prop("readonly", true);
      $("#APUsuario").prop("readonly", true);
      $("#AMUsuario").prop("readonly", true);
      $("#sexUsuario").prop("disabled", true);
      $("#emailUsuario").prop("readonly", true);
      $("#telefUsuario").prop("readonly", true);
      $("#DepUsuario").prop("disabled", true);
      $("#DomUsuario").prop("readonly", true);
      $("#btnDNIUsuario").addClass("d-none");
      $("#nDocUsuario").val("");
      $("#nomUsuario").val("");
      $("#APUsuario").val("");
      $("#AMUsuario").val("");
      $("#sexUsuario").val(0);
      $("#emailUsuario").val("");
      $("#telefUsuario").val("");
      $("#DepUsuario").val(0);
      $("#ProvUsuario").val(0);
      $("#DistUsuario").val(0);
      $("#DomUsuario").val("");
    }
  });

  $("#btnDNIU").on("click", function () {
    var dni = $("#nDocUsuario").val();
    $.ajax({
      type: "GET",
      url:
        "https://dniruc.apisperu.com/api/v1/dni/" +
        dni +
        "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (data) {
        $("#nomUsuario").val(data["nombres"]);
        $("#APUsuario").val(data["apellidoPaterno"]);
        $("#AMUsuario").val(data["apellidoMaterno"]);
        $("#sexUsuario").focus();
      },
      failure: function (data) {
        alert("Ha ocurrido un error en la conexión a la consulta de datos");
      },
      error: function (data) {
        $("#nomUsuario").prop("readonly", false);
        $("#APUsuario").prop("readonly", false);
        $("#AMUsuario").prop("readonly", false);
        $("#nomUsuario").focus();
        toastr.info("Ingresa tus nombres y apellidos", "Nombre de Usuario");
      },
    });
  });
  // Validar correo electrónico Usuario
  $("#emailUsuario").focusout(function () {
    if (
      validadorEmail($("#emailUsuario").val()) === false &&
      $("#emailUsuario").val() !== ""
    ) {
      toastr.error("Ingrese un correo válido", "E-mail de Usuario");
      $("#emailUsuario").val("");
      $("#emailUsuario").focus();
    }
  });

  function validadorEmail(email) {
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    if (regex.test(email)) {
      return true;
    } else {
      return false;
    }
  }

  // Validar número de telefono
  $("#telefUsuario").focusout(function () {
    let Max_Length = 9;
    let Min_Length = 7;
    let length = $("#telefUsuario").val().length;
    if (length == Max_Length || length == 7) {
      $("#DepUsuario").focus();
    } else {
      toastr.error(
        "Ingrese un teléfono(7 dígitos) o celular(9 dígitos) válido",
        "Teléfono de Usuario"
      );
      $("#telefUsuario").focus();
    }
  });
  // Validar domicilio de usuario
  $("#DomUsuario").focusout(function () {
    if (
      validaDomicilio($("#DomUsuario").val()) === false &&
      $("#DomUsuario").val() !== ""
    ) {
      toastr.error(
        "No se permite caracteres especiales",
        "Domicilio de Usuario"
      );
      $("#DomUsuario").focus();
    }
  });

  function validaDomicilio(domicilio) {
    var regex = /^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.,\-/]+$/;
    if (regex.test(domicilio)) {
      return true;
    } else {
      return false;
    }
  }
  // Bloque de Representante Si o NO
  $("#radiorep1").click(function () {
    if ($("#radiorep1").is(":checked")) {
      $("#representante").val("1");
      $("#bloqueRep1").removeClass("d-none");
      $("#bloqueRep2").removeClass("d-none");
      $("#bloqueRep3").removeClass("d-none");
      $("#tDocRep").prop("disabled", false);

      $("#nDocRep").prop("readonly", true);
      $("#nomRep").prop("readonly", true);
      $("#emailRep").prop("readonly", true);
      $("#telefRep").prop("readonly", true);
      $("#DomRep").prop("readonly", true);
    } else {
      $("#representante").val("2");
    }
  });
  $("#radiorep2").click(function () {
    if ($("#radiorep2").is(":checked")) {
      $("#representante").val("2");
      $("#bloqueRep1").addClass("d-none");
      $("#bloqueRep2").addClass("d-none");
      $("#bloqueRep3").addClass("d-none");
      $("#tDocRep").prop("disabled", true);

      $("#tDocRep").val(0);
      $("#nDocRep").val("");
      $("#nomRep").val("");
      $("#emailRep").val("");
      $("#telefRep").val("");
      $("#DomRep").val("");

      $("#tDocRep").prop("disabled", true);
      $("#nDocRep").prop("readonly", true);
      $("#nomRep").prop("readonly", true);
      $("#emailRep").prop("readonly", true);
      $("#telefRep").prop("readonly", true);
      $("#DomRep").prop("readonly", true);
    } else {
      $("#representante").val("1");
    }
  });
  // Bloque de Representante Si o NO

  // Bloque de Rep
  $("#tDocRep").on("change", function () {
    let comboDocRep = $(this).val();
    if (comboDocRep == 1) {
      $("#tDocRep").prop("disabled", true);
      $("#nDocRep").prop("readonly", false);
      $("#nomRep").prop("readonly", true);
      $("#emailRep").prop("readonly", true);
      $("#telefRep").prop("readonly", true);
      $("#DomRep").prop("readonly", true);
      $("#nDocRep").focus();
      $("#btnRUCRepresentante").addClass("d-none");
      $("#btnDNIRepresentante").removeClass("d-none");

      $("#nDocRep").change(function () {
        // $("#nDocRep").prop("true", false);
        let Max_Length = 8;
        let length = $("#nDocRep").val().length;
        if (length == Max_Length) {
          $("#nomRep").val("");
          $("#emailRep").val("");
          $("#telefRep").val("");
          $("#DomRep").val("");
        } else {
          toastr.error(
            "El DNI debe tener 8 dígitos",
            "N° Doc de Representante"
          );
          $("#nomRep").val("");
          $("#emailRep").val("");
          $("#telefRep").val("");
          $("#DomRep").val("");
          $("#telefRep").prop("readonly", true);
          $("#emailRep").prop("readonly", true);
          $("#nomRep").prop("readonly", true);
          $("#DomRep").prop("readonly", true);
          $("#nDocRep").focus();
        }
      });
    } else if (comboDocRep == 2) {
      $("#tDocRep").prop("disabled", true);
      $("#nDocRep").prop("readonly", false);
      $("#nomRep").prop("readonly", false);
      $("#emailRep").prop("readonly", false);
      $("#telefRep").prop("readonly", false);
      $("#DomRep").prop("readonly", false);
      $("#nDocRep").focus();
      $("#btnRUCRepresentante").addClass("d-none");
      $("#btnDNIRepresentante").addClass("d-none");

      $("#nDocRep").change(function () {
        let Max_Length = 12;
        let length = $("#nDocRep").val().length;
        if (length == Max_Length) {
          $("#nomRep").focus();
          $("#telefRep").prop("readonly", false);
          $("#emailRep").prop("readonly", false);
          $("#nomRep").prop("readonly", false);
          $("#DomRep").prop("readonly", false);
        } else {
          toastr.error(
            "El CE debe tener 12 dígitos",
            "N° Doc de Representante"
          );
          $("#nDocRep").focus();
          $("#nDocRep").val("");
          $("#nomRep").val("");
          $("#emailRep").val("");
          $("#telefRep").val("");
          $("#DomRep").val("");
          $("#telefRep").prop("readonly", true);
          $("#emailRep").prop("readonly", true);
          $("#nomRep").prop("readonly", true);
          $("#DomRep").prop("readonly", true);
        }
      });
    } else if (comboDocRep == 3) {
      $("#tDocRep").prop("disabled", true);
      $("#nDocRep").prop("readonly", false);
      $("#nomRep").prop("readonly", false);
      $("#emailRep").prop("readonly", false);
      $("#telefRep").prop("readonly", false);
      $("#DomRep").prop("readonly", false);
      $("#DomRep").prop("readonly", false);
      $("#nDocRep").focus();
      $("#btnRUCRepresentante").addClass("d-none");
      $("#btnDNIRepresentante").addClass("d-none");

      $("#nDocRep").change(function () {
        let Max_Length = 12;
        let length = $("#nDocRep").val().length;
        if (length == Max_Length) {
          $("#nomRep").focus();
          $("#telefRep").prop("readonly", false);
          $("#emailRep").prop("readonly", false);
          $("#nomRep").prop("readonly", false);
          $("#DomRep").prop("readonly", false);
        } else {
          toastr.error(
            "El Pasaporte debe tener 12 dígitos",
            "N° Doc de Representante"
          );
          $("#nDocRep").focus();
          $("#nDocRep").val("");
          $("#nomRep").val("");
          $("#emailRep").val("");
          $("#telefRep").val("");
          $("#DomRep").val("");
          $("#telefRep").prop("readonly", true);
          $("#emailRep").prop("readonly", true);
          $("#nomRep").prop("readonly", true);
          $("#DomRep").prop("readonly", true);
        }
      });
    } else if (comboDocRep == 4) {
      $("#tDocRep").prop("disabled", true);
      $("#nDocRep").prop("readonly", false);
      $("#nomRep").prop("readonly", true);
      $("#emailRep").prop("readonly", true);
      $("#telefRep").prop("readonly", true);
      $("#DomRep").prop("readonly", true);
      $("#nDocRep").focus();
      $("#btnRUCRepresentante").removeClass("d-none");
      $("#btnDNIRepresentante").addClass("d-none");

      $("#nDocRep").change(function () {
        let Max_Length = 11;
        let length = $("#nDocRep").val().length;
        if (length == Max_Length) {
          $("#nomRep").val("");
          $("#emailRep").val("");
          $("#telefRep").val("");
          $("#DomRep").val("");
        } else {
          toastr.error(
            "El RUC debe tener 11 dígitos",
            "N° Doc de Representante"
          );
          $("#nomRep").val("");
          $("#emailRep").val("");
          $("#telefRep").val("");
          $("#DomRep").val("");
          $("#telefRep").prop("readonly", true);
          $("#emailRep").prop("readonly", true);
          $("#nomRep").prop("readonly", true);
          $("#DomRep").prop("readonly", true);
          $("#nDocRep").focus();
        }
      });
    } else {
      $("#nDocRep").prop("readonly", true);
      $("#nomRep").prop("readonly", true);
      $("#emailRep").prop("readonly", true);
      $("#telefRep").prop("readonly", true);
      $("#DomRep").prop("readonly", true);
    }
  });
  // Bloque de Rep

  $("#btnDNIRep").on("click", function () {
    var dni_rep = $("#nDocRep").val();
    $("#nDocRep").prop("readonly", true);
    $.ajax({
      type: "GET",
      url:
        "https://dniruc.apisperu.com/api/v1/dni/" +
        dni_rep +
        "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (data) {
        $("#nomRep").val(
          data["nombres"] +
            " " +
            data["apellidoPaterno"] +
            " " +
            data["apellidoMaterno"]
        );
        $("#emailRep").focus();
        $("#emailRep").prop("readonly", false);
        $("#telefRep").prop("readonly", false);
        $("#DomRep").prop("readonly", false);
      },
      failure: function (data) {
        alert("Ha ocurrido un error en la conexión a la consulta de datos");
      },
      error: function (data) {
        $("#nomRep").prop("readonly", false);
        $("#emailRep").prop("readonly", false);
        $("#telefRep").prop("readonly", false);
        $("#DomRep").prop("readonly", false);
        $("#nomRep").focus();
        toastr.info(
          "Ingresa tu nombre o razón social manualmente",
          "Nombre de Representante"
        );
      },
    });
  });

  $("#btnRUCRep").on("click", function () {
    let ruc_rep = $("#nDocRep").val();
    $("#nDocRep").prop("readonly", true);
    $.ajax({
      type: "GET",
      url:
        "https://dniruc.apisperu.com/api/v1/ruc/" +
        ruc_rep +
        "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (data) {
        $("#nomRep").val(data["razonSocial"]);
        $("#emailRep").prop("readonly", false);
        $("#telefRep").prop("readonly", false);
        $("#DomRep").prop("readonly", false);
        $("#emailRep").focus();
      },
      failure: function (data) {
        alert("Ha ocurrido un error en la conexión a la consulta de datos");
      },
      error: function (data) {
        $("#nomRep").prop("readonly", false);
        $("#emailRep").prop("readonly", false);
        $("#telefRep").prop("readonly", false);
        $("#DomRep").prop("readonly", false);
        $("#nomRep").focus();
        toastr.info(
          "Ingresa tu nombre o razón social manualmente",
          "Nombre de Representante"
        );
      },
    });
  });

  // Validar correo electrónico de representante
  $("#emailRep").focusout(function () {
    if (
      validadorEmailRep($("#emailRep").val()) === false &&
      $("#emailRep").val() !== ""
    ) {
      toastr.error(
        "Ingrese un correo electrónico válido",
        "E-mail Representante:"
      );
      $("#emailRep").val("");
      $("#emailRep").focus();
    } else {
      $("#telefRep").focus();
    }
  });

  function validadorEmailRep(email2) {
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    if (regex.test(email2)) {
      return true;
    } else {
      return false;
    }
  }
  // Validar número de telefono de representante
  $("#telefRep").focusout(function () {
    let Max_Length = 9;
    let Min_Length = 7;
    let length = $("#telefRep").val().length;
    if (length == Max_Length || length == 7) {
      $("#DomRep").focus();
    } else {
      toastr.error(
        "Ingrese un teléfono(7 dígitos) o celular(9 dígitos) válido",
        "Teléfono de Representante"
      );
      $("#telefRep").focus();
    }
  });
  // Validar domicilio de representante
  $("#DomRep").focusout(function () {
    if (
      validaDomicilioRep($("#DomRep").val()) === false &&
      $("#DomRep").val() !== ""
    ) {
      toastr.error(
        "No se permiten caracteres especiales",
        "Domicilio Representante:"
      );
      $("#DomRep").focus();
    }
  });

  function validaDomicilioRep(domicilio2) {
    var regex = /^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.,\-/]+$/;
    if (regex.test(domicilio2)) {
      return true;
    } else {
      return false;
    }
  }

  // Bloque de Reclamo
  $("#tipoUsuario").on("change", function () {
    var comboTipoUsuario = $(this).val();

    if (comboTipoUsuario == 1) {
      $("#cajaFecha").prop("readonly", false);
      $("#recCG").prop("disabled", false);
    } else if (comboTipoUsuario == 2) {
      $("#cajaFecha").prop("readonly", false);
      $("#recCG").prop("disabled", false);
    } else if (comboTipoUsuario == 3) {
      $("#cajaFecha").prop("readonly", false);
      $("#recCG").prop("disabled", false);
      $("#detReclamo").prop("disabled", false);
    } else {
      $("#cajaFecha").prop("readonly", true);
      $("#recCG").prop("disabled", true);
      $("#recCE").prop("disabled", true);
      $("#recCG").val(0);
      $("#recCE").val(0);
      $("#detReclamo").val("");
    }
  });
  // Bloque de Reclamo

  $("#recCE").on("change", function () {
    $("#btnEnviar").prop("disabled", false);
    $("#tDocUsuario").prop("disabled", false);
    $("#tDocRep").prop("disabled", false);
  });
  // Validar campo de detalle de reclamo
  $("#detReclamo").on("focusout", function () {
    if (
      validaDetalleReclamo($("#detReclamo").val()) === false &&
      $("#detReclamo").val() !== ""
    ) {
      toastr.error(
        "No se permiten caracteres especiales",
        "Detalle de Reclamo:"
      );
      $("#detReclamo").focus();
    } else {
      // $("#btnEnviar").prop("disabled", false);
      $("#btnEnviar").focus();
    }
  });

  function validaDetalleReclamo(detalle) {
    var regex = /^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.:,\-/]+$/;
    if (regex.test(detalle)) {
      return true;
    } else {
      return false;
    }
  }
  // Validar campo de detalle de reclamo
  $.validator.addMethod(
    "valueNotEquals",
    function (value, element, arg) {
      return arg !== value;
    },
    "Value must not equal arg."
  );
});
