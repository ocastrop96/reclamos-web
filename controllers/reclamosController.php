<?php
class ControllerReclamo
{
    static public function ctrRegistrarReclamo()
    {
        if (isset($_POST["detReclamo"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["detReclamo"])) {
                echo 'OKEY';
            }
            else {
                echo "tmre";
            }
        }
        else{
           echo "ok ptm";
        }
    }
}


        // Parámetros Iniciales
        // error_reporting(0);
        //Usuario Afectado
        // $tDocUsuario = $_POST["tDocUsuario"];
        // $nDocUsuario = $_POST["nDocUsuario"];
        // $nomUsuario = $_POST["nomUsuario"];
        // $APUsuario = $_POST["APUsuario"];
        // $AMUsuario = $_POST["AMUsuario"];
        // $sexUsuario = $_POST["sexUsuario"];
        // $emailUsuario = $_POST["emailUsuario"];
        // $telefUsuario = $_POST["telefUsuario"];
        // $DepUsuario = $_POST["DepUsuario"];
        // $ProvUsuario = $_POST["ProvUsuario"];
        // $DistUsuario = $_POST["DistUsuario"];
        // $DomUsuario = $_POST["DomUsuario"];
        // //Representante
        // $repCon = $_POST["representante"];
        // $tDocRep = $_POST["tDocRep"];
        // $nDocRep = $_POST["nDocRep"];
        // $nomRep = $_POST["nomRep"];
        // $emailRep = $_POST["emailRep"];
        // $telefRep = $_POST["telefRep"];
        // $DomRep = $_POST["DomRep"];
        // //Reclamo
        // $tipoUsuario = $_POST["tipoUsuario"];
        // $cajaFecha = $_POST["cajaFecha"];
        // $recCG = $_POST["recCG"];
        // $recCE = $_POST["recCE"];
        // $detReclamo = $_POST["detReclamo"];

        // // REGISTRA USUARIO AFECTADO
        // if ($repCon == 2) {
        //     if (isset($tDocUsuario, $nDocUsuario, $nomUsuario, $APUsuario, $AMUsuario, $sexUsuario, $emailUsuario, $telefUsuario, $DepUsuario, $ProvUsuario, $DistUsuario, $DomUsuario)) {
        //         $fechaReclamo = date('Y-m-d');

        //         if (preg_match('/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]+$/', $nomUsuario)) {
        //             $datos = array(
        //                 "fechaReclamo" => $fechaReclamo,
        //                 "idTipoDocUsuario" => $tDocUsuario,
        //                 "nDocUsuario" => $nDocUsuario,
        //                 "nombUsuario" => $nomUsuario,
        //                 "apePatUsuario" => $APUsuario,
        //                 "apeMatUsuario" => $AMUsuario,
        //                 "idSexUsuario" => $sexUsuario,
        //                 "emailUsuario" => $emailUsuario,
        //                 "telUsuario" => $telefUsuario,
        //                 "idDepa" => $DepUsuario,
        //                 "idProv" => $ProvUsuario,
        //                 "idDist" => $DistUsuario,
        //                 "domUsuario" => $DomUsuario
        //             );

        //             $rptRegReclamo = ReclamosModel::mdlRegistrarReclamos($datos);

        //             if ($rptRegReclamo == "ok") {
        //                 echo '<script>
        //                   Swal.fire({
        //                     type: "success",
        //                     title: "Su reclamo ha sido registrado con éxito. Verifique en su correo electrónico el mensaje de confirmación.",
        //                     showConfirmButton: true,
        //                     confirmButtonText: "Cerrar",
        //                     closeOnConfirm: false
        //                   }).then((result)=>{
        //                     if(result.value){
        //                         window.location = "inicio";
        //                     }});
        //               </script>';
        //             }
        //         } else {
        //             echo '<script>
        //             Swal.fire({
        //               type: "error",
        //               title: "Ingrese sus datos correctamente"
        //             }).then((result)=>{
        //               if(result.value){
        //                   window.location = "inicio";
        //               }});
        //         </script>';
        //         }
        //     } else {
        //         echo '<script>
        //             Swal.fire({
        //               type: "error",
        //               title: "Ingrese los datos requeridos"
        //             }).then((result)=>{
        //               if(result.value){
        //                   window.location = "inicio";
        //               }});
        //         </script>';
        //     }
        // }


        // if (isset($_POST["newArea"])) {
        //     if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newArea"])) {
        //         $tabla = "st_areas";
        //         $datos = $_POST["newArea"];

        //         $respuestaRegistroArea = ModeloAreas::mdlRegistrarAreas($tabla, $datos);

        //         if ($respuestaRegistroArea == "ok") {
        //             echo '<script>
        //                       Swal.fire({
        //                         type: "success",
        //                         title: "El área ha sido registrada con éxito",
        //                         showConfirmButton: true,
        //                         confirmButtonText: "Cerrar",
        //                         closeOnConfirm: false
        //                       }).then((result)=>{
        //                         if(result.value){
        //                             window.location = "oficinas-departamentos";
        //                         }});
        //                   </script>';
        //         }
        //     } else {
        //         echo '<script>
        //             Swal.fire({
        //               type: "error",
        //               title: "Ingrese correctamente sus datos",
        //               showConfirmButton: true,
        //               confirmButtonText: "Cerrar",
        //               closeOnConfirm: false
        //             }).then((result)=>{
        //               if(result.value){
        //                   window.location = "oficinas-departamentos";
        //               }});
        //         </script>';
        //     }
        // }