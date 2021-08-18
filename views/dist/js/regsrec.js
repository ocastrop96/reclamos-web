$(document).ready(function () {
  // $("#fechaOcu").daterangepicker({});
  // // Bloque de Botón
  $("#btnEnviar").on("click", function () {
    if ($("#radiorep2").is(":checked")) {
      $("#formReclamo").validate({
        rules: {
          tDocUsuario: {
            valueNotEquals: "0",
          },
          nDocUsuario: {
            required: true,
          },
          nomUsuario: {
            required: true,
          },
          APUsuario: {
            required: true,
          },
          AMUsuario: {
            required: true,
          },
          sexUsuario: {
            valueNotEquals: "0",
          },
          emailUsuario: {
            required: true,
            email: true,
          },
          telefUsuario: {
            required: true,
          },
          DepUsuario: {
            valueNotEquals: "0",
          },
          ProvUsuario: {
            valueNotEquals: "0",
          },
          DistUsuario: {
            valueNotEquals: "0",
          },
          DomUsuario: {
            required: true,
          },
          tipoUsuario: {
            valueNotEquals: "0",
          },
          recCG: {
            valueNotEquals: "0",
          },
          recCE: {
            valueNotEquals: "0",
          },
          cajaFecha: {
            required: true,
          },
          detReclamo: {
            required: true,
          },
          repAuto: {
            required: true,
          },
        },
        messages: {
          tDocUsuario: {
            valueNotEquals: "Selecciona tipo de documento",
          },
          nDocUsuario: {
            required: "Ingresa tu N° de Documento",
          },
          nomUsuario: {
            required: "Ingresa tu nombre",
          },
          APUsuario: {
            required: "Ingresa tu Apellido Paterno",
          },
          AMUsuario: {
            required: "Ingresa tu Apellido Materno",
          },
          sexUsuario: {
            valueNotEquals: "Selecciona tu sexo",
          },
          emailUsuario: {
            required: "Ingresa tu e-mail",
            email: "Ingresa un e-mail válido",
          },
          telefUsuario: {
            required: "Ingresa tu teléfono o celular",
          },
          DepUsuario: {
            valueNotEquals: "Selecciona tu Departamento",
          },
          ProvUsuario: {
            valueNotEquals: "Selecciona tu Provincia",
          },
          DistUsuario: {
            valueNotEquals: "Selecciona tu Distrito",
          },
          DomUsuario: {
            required: "Ingresa tu domicilio",
          },
          tipoUsuario: {
            valueNotEquals: "Selecciona tipo de usuario",
          },
          cajaFecha: {
            required:
              "Ingresa fecha de ocurrencia, debe ser menor  igual que la fecha actual",
          },
          recCG: {
            valueNotEquals: "Selecciona causa general",
          },
          recCE: {
            valueNotEquals: "Selecciona causa específica",
          },
          detReclamo: {
            required:
              "Ingrese detalle de reclamo, no se admiten múltiples espaciados y caracteres especiales",
          },
          repAuto: {
            required: "Seleccione una opción a la autorización",
          },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
          error.addClass("invalid-feedback");
          element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass("is-invalid");
        },
      });
    } else if ($("#radiorep1").is(":checked")) {
      $("#formReclamo").validate({
        rules: {
          tDocUsuario: {
            valueNotEquals: "0",
          },
          nDocUsuario: {
            required: true,
          },
          nomUsuario: {
            required: true,
          },
          APUsuario: {
            required: true,
          },
          AMUsuario: {
            required: true,
          },
          sexUsuario: {
            valueNotEquals: "0",
          },
          emailUsuario: {
            required: true,
            email: true,
          },
          telefUsuario: {
            required: true,
            maxlength: 9,
            minlength: 7,
          },
          DepUsuario: {
            valueNotEquals: "0",
          },
          ProvUsuario: {
            valueNotEquals: "0",
          },
          DistUsuario: {
            valueNotEquals: "0",
          },
          DomUsuario: {
            required: true,
          },
          tDocRep: {
            valueNotEquals: "0",
          },
          nDocRep: {
            required: true,
          },
          nomRep: {
            required: true,
          },
          emailRep: {
            required: true,
            email: true,
          },
          telefRep: {
            required: true,
          },
          DomRep: {
            required: true,
          },
          tipoUsuario: {
            valueNotEquals: "0",
          },
          recCG: {
            valueNotEquals: "0",
          },
          recCE: {
            valueNotEquals: "0",
          },
          cajaFecha: {
            required: true,
          },
          detReclamo: {
            required: true,
            maxlength: 800,
          },
        },
        messages: {
          tDocUsuario: {
            valueNotEquals: "Selecciona tipo de documento",
          },
          nDocUsuario: {
            required: "Ingresa tu N° de Documento",
          },
          nomUsuario: {
            required: "Ingresa tu nombre",
          },
          APUsuario: {
            required: "Ingresa tu Apellido Paterno",
          },
          AMUsuario: {
            required: "Ingresa tu Apellido Materno",
          },
          sexUsuario: {
            valueNotEquals: "Selecciona tu sexo",
          },
          emailUsuario: {
            required: "Ingresa tu e-mail",
            email: "Ingresa un e-mail válido",
          },
          telefUsuario: {
            required: "Ingresa tu teléfono o celular",
            maxlength: "Máximo 9 digitos",
            minlength: "Mínimo 7 dígitos",
          },
          DepUsuario: {
            valueNotEquals: "Selecciona tu Departamento",
          },
          ProvUsuario: {
            valueNotEquals: "Selecciona tu Provincia",
          },
          DistUsuario: {
            valueNotEquals: "Selecciona tu Distrito",
          },
          DomUsuario: {
            required: "Ingresa tu domicilio",
          },
          tDocRep: {
            valueNotEquals: "Selecciona tipo de documento",
          },
          nDocRep: {
            required: "Ingresa tu N° de Documento",
          },
          nomRep: {
            required: "Ingresa tus nombres o razón social",
          },
          emailRep: {
            required: "Ingresa tu e-mail",
            email: "Ingresa un e-mail válido",
          },
          telefRep: {
            required: "Ingresa tu telefono o celular",
          },
          DomRep: {
            required: "Ingresa tu domicilio",
          },
          tipoUsuario: {
            valueNotEquals: "Selecciona tipo de usuario",
          },
          cajaFecha: {
            required:
              "Ingresa fecha de ocurrencia, debe ser menor  igual que la fecha actual",
          },
          recCG: {
            valueNotEquals: "Selecciona causa general",
          },
          recCE: {
            valueNotEquals: "Selecciona causa específica",
          },
          detReclamo: {
            required:
              "Ingrese detalle de reclamo, no se admiten múltiples espaciados y caracteres especiales",
            maxlength: "Solo se permiten ingresar un máximo de 800 caracteres",
          },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
          error.addClass("invalid-feedback");
          element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass("is-invalid");
        },
      });
    }
  });

  $("#btnEnviar").click(function (e) {
    e.preventDefault();
    var form = $("#formReclamo");
    validacion = form.valid();

    if (validacion == true) {
      let timerInterval;
      Swal.fire({
        title: "Estamos procesando su reclamo!",
        html:
          "Su registro culminará en unos segundos.No cierre o recargue su navegador. Espere por favor...",
        timer: 26000,
        timerProgressBar: true,
        onBeforeOpen: () => {
          Swal.showLoading();
          timerInterval = setInterval(() => {
            const content = Swal.getContent();
            if (content) {
              const b = content.querySelector("b");
              if (b) {
                b.textContent = Swal.getTimerLeft();
              }
            }
          }, 26000);
        },
        onClose: () => {
          clearInterval(timerInterval);
        },
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          //   console.log("I was closed by the timer");
        }
      });

      //   Bloque de AJAX
      var data = $("#formReclamo").serialize();
      $.ajax({
        method: "post",
        url: "docs/registerReclamo.php",
        data: data,
        success: function (e) {
          if (e == 1) {
            Swal.fire({
              type: "success",
              title:
                "Se ha registrado su reclamo con éxito. Verifique el mensaje de confirmación en su correo electrónico.",
              showConfirmButton: false,
              timer: 1500,
            });
            function redirect() {
              window.location = "registro-reclamo";
            }
            setTimeout(redirect, 1500);
            document.getElementById("formReclamo").reset();
            $("#radiorep2").prop("checked", true);
            $("#btnDNIUsuario").addClass("d-none");
            $("#btnDNIRepresentante").addClass("d-none");
            $("#btnRUCRepresentante").addClass("d-none");
            $("#bloqueRep1").addClass("d-none");
            $("#bloqueRep2").addClass("d-none");
            $("#bloqueRep3").addClass("d-none");
          } else {
            Swal.fire({
              type: "error",
              title:
                "Error al registrar, ingrese correctamente los datos de su reclamo. Aségurese de completar todos los campos requeridos",
              showConfirmButton: false,
              timer: 3000,
            });
          }
        },
      });
      return false;
    } else {
      Swal.fire({
        type: "error",
        title:
          "Error al registrar, ingrese correctamente los datos de su reclamo. Aségurese de completar todos los campos requeridos",
        showConfirmButton: false,
        timer: 1400,
      });
    }
  });
});
