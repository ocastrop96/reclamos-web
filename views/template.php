<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Libro de Reclamaciones Virtual | HNSEB</title>
    <link rel="icon" href="views/dist/img/logo-libro.png" type="image/x-icon">
    <link rel="shortcut icon" href="views/dist/img/logo-libro.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="views/dist/img/logo-libro.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="views/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="views/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="views/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="views/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="views/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <!-- Toastr -->
    <link rel="stylesheet" href="views/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="views/dist/css/loader.css">
    <link rel="stylesheet" href="views/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="views/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="views/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="views/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="views/plugins/moment/moment.min.js"></script>
    <script src="views/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="views/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="views/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="views/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="views/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/es.js"></script>
    <script src="views/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="views/plugins/toastr/toastr.min.js"></script>
    <!-- jquery-validation -->
    <script src="views/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="views/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
    <script src="views/plugins/bbox/js/bootbox.min.js"></script>
    <script src="views/plugins/bbox/js/bootbox.locales.min.js"></script>
    <!-- Own Scripts -->
    <script src="views/dist/js/formulario.js"></script>
    <script src="views/dist/js/utilitario.js"></script>
    <script src="views/dist/js/regsrec.js"></script>
    <script src="views/dist/js/loader.js"></script>
</head>

<body class="hold-transition">
    <div class="contenedor_loader">
        <div class="loader">
        </div>
    </div>
    <?php
    echo '<div class="wrapper">';
    include "pages/cabecera.php";

    if (isset($_GET["ruta"])) {

        if ($_GET["ruta"] == "registro-reclamo") {

            include "pages/" . $_GET["ruta"] . ".php";
        } else {
            include "pages/404.php";
        }
    } else {
        include "pages/registro-reclamo.php";
    }
    include "pages/pie.php";
    echo '</div>';
    ?>
</body>

</html>