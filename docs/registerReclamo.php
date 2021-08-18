<?php
require_once "../models/conexion21.php";
require_once "../controllers/causasController.php";
require_once "../controllers/tipoDocController.php";
require_once "../controllers/ubigeoController.php";
require_once "../controllers/tipoUsuarioController.php";
require_once "../models/causasModel.php";
require_once "../models/tipoDocModel.php";
require_once "../models/ubigeoModel.php";
require_once "../models/tipoUsuarioModel.php";
require "../phpmailer/Exception.php";
require "../phpmailer/PHPMailer.php";
require "../phpmailer/SMTP.php";
require "../utils/tcpdf/tcpdf.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Usuario afectado
$tDocUsuario = $_POST["tDocUsuario"];
$nDocUsuario = $_POST["nDocUsuario"];
$nomUsuario = $_POST["nomUsuario"];
$APUsuario = $_POST["APUsuario"];
$AMUsuario = $_POST["AMUsuario"];
$sexUsuario = $_POST["sexUsuario"];
$emailUsuario = $_POST["emailUsuario"];
$telefUsuario = $_POST["telefUsuario"];
$DepUsuario = $_POST["DepUsuario"];
$ProvUsuario = $_POST["ProvUsuario"];
$DistUsuario = $_POST["DistUsuario"];
$DomUsuario = $_POST["DomUsuario"];
//Representante
$representante = $_POST["representante"];
$tDocRep = $_POST["tDocRep"];
$nDocRep = $_POST["nDocRep"];
$nomRep = $_POST["nomRep"];
$emailRep = $_POST["emailRep"];
$telefRep = $_POST["telefRep"];
$DomRep = $_POST["DomRep"];
//Reclamo
$tipoUsuario = $_POST["tipoUsuario"];
$cajaFecha = $_POST["cajaFecha"];
$recCG = $_POST["recCG"];
$recCE = $_POST["recCE"];
$detReclamo = $_POST["detReclamo"];
$repAuto = $_POST["repAuto"];

// Inicializador de fecha actual
date_default_timezone_set('America/Lima');
$FechaActual = date('Y-m-d');
$FD = date('d');
$FM = date('m');
$FA = date('Y');
$FHora = date('H');
$FMin = date('i');
$FAM = date('A');


// Conversión de fecha de ocurrencia a formato yyyy/mm/dd
$base = $cajaFecha;
$convert = str_replace('/', '-', $base);
$fechaOcurrencia = date("Y-m-d", strtotime($convert));

if (isset($representante) && $representante == "2") {
    // Validación si todos los datos son diferentes a vacío
    if (
        !empty($tDocUsuario) &&
        !empty($nDocUsuario) &&
        !empty($nomUsuario) &&
        !empty($APUsuario) &&
        !empty($AMUsuario) &&
        !empty($sexUsuario) &&
        !empty($emailUsuario) &&
        !empty($telefUsuario) &&
        !empty($DepUsuario) &&
        !empty($ProvUsuario) &&
        !empty($DistUsuario) &&
        !empty($DomUsuario) &&
        !empty($tipoUsuario) &&
        !empty($cajaFecha) &&
        !empty($recCG) &&
        !empty($recCE) &&
        !empty($detReclamo)
    ) {
        if ($tDocUsuario > 0 && $sexUsuario > 0 && $DepUsuario > 0 && $ProvUsuario > 0 && $DistUsuario > 0 && $tipoUsuario > 0 && $recCG > 0 && $recCE > 0 && $fechaOcurrencia <= $FechaActual) {

            // Obtener y armar correlativo
            $counting = "SELECT fechaReclamo FROM lr_tab_reclamo WHERE YEAR(fechaReclamo) = YEAR(NOW())";
            $rec = mysqli_query($conexion, $counting);

            $row_cnt = mysqli_num_rows($rec) + 1;
            if ($row_cnt >= 1 && $row_cnt <= 9) {
                $corre = "LR-" . date("Y") . "-" . "0000" . $row_cnt;
            } elseif ($row_cnt >= 10 && $row_cnt <= 99) {
                $corre = "LR-" . date("Y") . "-" . "000" . $row_cnt;
            } elseif ($row_cnt >= 100 && $row_cnt <= 999) {
                $corre = "LR-" . date("Y") . "-" . "00" . $row_cnt;
            } elseif ($row_cnt >= 1000 && $row_cnt <= 9999) {
                $corre = "LR-" . date("Y") . "-" . "0" . $row_cnt;
            } elseif ($row_cnt >= 10000 && $row_cnt <= 99999) {
                $corre = "LR-" . date("Y") . "-" . $row_cnt;
            } else {
                $corre = "LR-" . date("Y") . "-" . $row_cnt;
            }
            // Obtener y armar correlativo
            // Tipo de Documento
            $itTDoc = "idtipoDoc";
            $vTDoc = $tDocUsuario;
            $rTDoc = ControladorTipoDoc::ctrListarTipoDocUsuario($itTDoc, $vTDoc);
            $mTDoc = $rTDoc["desctipoDoc"];
            // Tipo de Documento
            // Departamento
            $itDep = "idDepa";
            $vDep = $DepUsuario;
            $rDep = ControladorUbigeo::ctrListarDepartamentos($itDep, $vDep);
            $mDep = $rDep["descDepartamento"];
            // Departamento
            // Provincia
            $itProv = "idProv";
            $vProv = $ProvUsuario;
            $rProv = ControladorUbigeo::ctrListarProvincias($itProv, $vProv);
            $mProv = $rProv["descProvincia"];
            // Provincia
            // Distrito
            $itDist = "idDist";
            $vDist = $DistUsuario;
            $rDist = ControladorUbigeo::ctrListarDistrito($itDist, $vDist);
            $mDist = $rDist["descDistrito"];
            // Distrito
            // Tipo de Usuario
            $itTUs = "idtipoUsuario";
            $vTUs = $tipoUsuario;
            $rTUs = ControladorTipoUsuario::ctrListarTipoUsuario($itTUs, $vTUs);
            $mTUs = $rTUs["desctipoUsuario"];
            // Tipo de Usuario

            // Causa General
            $itCG = "id_causaGeneral";
            $vCG = $recCG;
            $rCG = ControladorCausas::ctrListarCausasGenerales($itCG, $vCG);
            $mCG = $rCG["desc_causaGeneral"];
            // Causa General
            // Causa Especifica
            $itCE = "id_causaEspecifica";
            $vCE = $recCE;
            $rCE = ControladorCausas::ctrListarCausasEspecificas($itCE, $vCE);
            $mCE = $rCE["desc_causaEspecifica"];

            if ($repAuto == "SI") {
                $rSi = "X";
                $rNo = "";
            } else {
                $rSi = "";
                $rNo = "X";
            }

            if ($mTDoc == "DNI") {
                $tDNI = "X";
                $tCE = "";
                $tPASS = "";
            } elseif ($mTDoc == "CE") {
                $tDNI = "";
                $tCE = "X";
                $tPASS = "";
            } else {
                $tDNI = "";
                $tCE = "";
                $tPASS = "X";
            }
            class MYPDF extends TCPDF
            {
                //Page header
                public function Header()
                {
                    // Logo HNSEB
                    $image_file = K_PATH_IMAGES . 'logo-hnseb.png';
                    $this->Image($image_file, 10, 10, 93, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                    // Logo HNSEB

                    // Set font
                    $this->SetFont('helvetica', '', 8);
                    // Información del HNSEB
                    $html = '<p>Av. Túpac Amaru N° 8000, Comas<br>Teléfono Central (51-1) 558-0186</p>';
                    $this->writeHTMLCell(0, 0, 105, 12, $html, 0, 1, 0, true, 'L', true);
                    // Información del HNSEB

                    // Title
                    // $this->Cell(0, 15, 'Av. Tupac Amaru N°8000 - Comas', 0, false, 'L', 0, '', 0, false, 'T', 'M');
                    // Logo SUSALUD
                    $image_file2 = K_PATH_IMAGES . 'susalud.png';
                    $this->Image($image_file2, 160, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                    // Logo SUSALUD
                }

                // Page footer
                public function Footer()
                {
                    // Position at 15 mm from bottom
                    $this->SetY(-15);
                    // Set font
                    $this->SetFont('helvetica', '', 6.5);
                    // Page number
                    // $this->Cell(0, 10, 'Av. Túpac Amaru N° 8000, Comas<br>Teléfono Central (51-1) 558-0186', 0, false, 'C', 0, '', 0, false, 'T', 'M');
                    $html = '<p style="text-align: justify;">Las IAFAS,IPRESS o UGIPRESS deben atender el reclamo en un plazo de 30 días hábiles.<br><strong>Estimado usuario</strong>: Usted puede presentar su queja ante SUSALUD ante hechos o actos que vulneren o pudieran vulnerar el derecho a la salud o cuando no le hayan brindado un servicio, prestación o coberturas solicitada o recibidas de las IAFAS o IPRESS, o que dependan de las UGIPRESS pública, privada o mixtas. También ante la negativa de atención de su reclamo, irregularidad en su tramitación o disconformidad con el resultado del mismo o hacer uso de los mecanismos alternativos de solución de controversias ante el Centro de Conciliación y Arbitraje - CECONAR de SUSALUD</p>';
                    $this->writeHTMLCell(0, 0, 10, 276, $html, 0, 1, 0, true, 'L', true);
                }
            }

            // create new PDF document
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('OFICINA DE GESTIÓN DE LA CALIDAD-HNSEB');
            $pdf->SetTitle('RECLAMO VIRTUAL EN SALUD - HNSEB');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

            // set header and footer fonts
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(10, 23, 10);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // ---------------------------------------------------------

            // set font
            $pdf->SetFont('helvetica', '', 9);

            // add a page
            $pdf->AddPage();
            $html =
                <<<EOF
                <table cellpadding="2" cellspacing="1.2" class="block-1" style="text-align:center;">
                <tr>
                    <td style="width:30px;background-color:white;
                    border-top:    1px solid  #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: center;"><b>DIA</b></p></td>

                    <td style="width:30px;background-color:white;
                    border-top:    1px solid  #000000;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: center;"><b>MES</b></p></td>

                    <td style="width:30px;background-color:white;
                    border-top:    1px solid  #000000;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    background-color: #E6E6E6;"><p style="text-align: center;"><b>AÑO</b></p></td>

                    <td style="text-align:left; width:10px;background-color:white;"></td>

                    <td style="width:94px;background-color:white;
                    border-right:   1px solid  #000000;
                    border-top:    1px solid  #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: center;"><b>HORA</b></p></td>

                    <td style="text-align:left; width:210px;background-color:white;"></td>
                    <td style="width:260px;background-color:white;
                    border-top:    1px solid  #000000;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: center;"><b>HOJA DE RECLAMACION EN SALUD VIRTUAL</b></p></td>
                </tr>
                <tr>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;">$FD</td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;">$FM</td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;">$FA</td>

                    <td style="text-align:left; width:10px;background-color:white;"></td>
                    
                    <td style="text-align:center; width:30px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;">$FHora</td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;">$FMin</td>
                    <td style="text-align:center; width:31.5px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;">$FAM</td>

                    <td style="text-align:center; width:210px;background-color:white;"></td>
                    <td style="width:260px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;"><p style="text-align: center;"><b>00007634 - N° </b>$corre</p></td>
                </tr>
                </table>

                <table cellpadding="1" cellspacing="1" style="text-align:left;" border="">
                <tr>
                    <td style="text-align:center; width:667px;background-color:white;"></td>
                </tr>
                </table>

                <table cellpadding="2" cellspacing="1.2" style="text-align:left;" border="">
                <tr>
                    <td style="width:671px;background-color:white;
                    border-top:    1px solid  #000000;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: left;"><b>1. IDENTICACIÓN DEL USUARIO O TERCERO LEGITIMADO (PACIENTE AFECTADO)</b></p></td>
                </tr>
                <tr>
                    <td style="text-align:left; width:149px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>NOMBRES Y APELLIDOS:</b></td>
                    <td style="text-align:left; width:520.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $nomUsuario $APUsuario $AMUsuario</td>
                </tr>
                <tr>
                    <td style="text-align:left; width:71px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
                    <td style="text-align:left; width:598.65px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $DomUsuario</td>
                </tr>
                <tr>
                    <td style="text-align:left; width:70px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DISTRITO:</b></td>
                    <td style="text-align:left; width:300px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $mDist</td>
                    <td style="text-align:left; width:83.5px;background-color:white;
                    border-bottom: 1px solid #000000;
                    background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
                    <td style="text-align:left; width:213.72px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $telefUsuario</td>
                </tr>
                <tr>
                    <td style="text-align:left; width:70px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>E-MAIL:</b></td>
                    <td style="text-align:left; width:599.71px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $emailUsuario</td>
                </tr>
                <tr>
                    <td style="text-align:left; width:168px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DOCUMENTO DE IDENTIDAD:</b></td>
                    <td style="text-align:left; width:501.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> DNI: ($tDNI) CE: ($tCE) PASAPORTE: ($tPASS) &nbsp; N° $nDocUsuario</td>
                </tr>
                <tr>
                    <td style="width:671px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: left;"><b>2. IDENTICACIÓN DE QUIEN PRESENTA EL RECLAMO (En caso de ser el usuario afectado no es necesario su llenado)</b></p></td>
                </tr>
                <tr>
                    <td style="text-align:left; width:162px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>NOMBRE O RAZÓN SOCIAL:</b></td>
                    <td style="text-align:left; width:507.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> </td>
                </tr>
                <tr>
                    <td style="text-align:left; width:71px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
                    <td style="text-align:left; width:598.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> </td>
                </tr>
                <tr>
                    <td style="text-align:left; width:70px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DISTRITO:</b></td>
                    <td style="text-align:left; width:300px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> </td>
                    <td style="text-align:left; width:80px;background-color:white;
                    border-bottom: 1px solid #000000;
                    background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
                    <td style="text-align:left; width:217.3px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> </td>
                </tr>
                <tr>
                    <td style="text-align:left; width:70px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>E-MAIL:</b></td>
                    <td style="text-align:left; width:599.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> </td>
                </tr>
                <tr>
                    <td style="text-align:left; width:168px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DOCUMENTO DE IDENTIDAD:</b></td>
                    <td style="text-align:left; width:501.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> DNI: () CE: () PASAPORTE: () &nbsp; N° </td>
                </tr>
                <tr>
                    <td style="width:671px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: left;"><b>3. DATOS DEL RECLAMO</b></p></td>
                </tr>
                <tr>
                    <td style="text-align:left; width:115px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>TIPO DE USUARIO:</b></td>
                    <td style="text-align:left; width:200px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $mTUs</td>
                    <td style="text-align:left; width:150px;background-color:white;
                    border-bottom: 1px solid #000000;
                    background-color: #E6E6E6;"> <b>FECHA DE OCURRENCIA:</b></td>
                    <td style="text-align:left; width:202.4px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $cajaFecha</td>
                </tr>
                <tr>
                    <td style="text-align:left; width:195px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DERECHO EN SALUD AFECTADO:</b></td>
                    <td style="text-align:left; width:474.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $mCG</td>
                </tr>
                <tr>
                    <td style="text-align:left; width:210px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>CAUSA ESPECIFICA DEL RECLAMO:</b></td>
                    <td style="text-align:left; width:459.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $mCE</td>
                </tr>
                <tr>
                    <td style="width:671px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><p style="text-align: left;"><b> DETALLE DEL RECLAMO</b></p></td>
                </tr>
                <tr>
                    <td style="width:671px;height:385px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;"><p style="text-align: justify;">$detReclamo</p></td>
                </tr>
                <tr>
                    <td style="width:370px;background-color:white;
                    border-left:   1px solid  #000000;"><p style="text-align: left;"><b>4. AUTORIZO NOTIFICACIÓN DEL RESULTADO DEL RECLAMO AL E-MAIL CONSIGNADO &nbsp; Si ($rSi)  No ($rNo)</b></p><br><p style="text-align: left;"><b>5. FIRMA DEL RECLAMANTE <br>(USUARIO / REPRESENTANTE O TERCERO LEGITIMADO)</b></p></td>
                    <td style="width:200px;background-color:white;
                    border-bottom: 1px solid #000000;"></td>
                    <td style="text-align:left; width:20px;background-color:white;"></td>
                    <td style="text-align:left; width:50px;background-color:white;
                    border-left:   1px solid  #000000;"></td>
                    <td style="text-align:left; width:26.2px;background-color:white;
                    border-right:   1px solid  #000000;"></td>
                    

                </tr>
                <tr>
                    <td style="text-align:left; width:350px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;"></td>
                    <td style="width:230px;background-color:white;
                    border-bottom: 1px solid #000000;"><p style="text-align: center;"><b>FIRMA</b></p></td>
                    <td style="text-align:left; width:10px;background-color:white;
                    border-bottom: 1px solid #000000;"></td>
                    <td style="width:77.5px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-right: 1px solid #000000;
                    border-left: 1px solid #000000;"><p style="text-align: center;font-size: 6px;"><b>(HUELLA DIGITAL)</b></p></td>
                </tr>
                </table>
            EOF;

            $pdf->writeHTML($html, true, false, true, false, '');

            $reclamoPDF = $pdf->Output('RECLAMO_VIRTUAL.pdf', 'S');

            // Bloque de Reclamo en PDF

            $query = "CALL REGISTRAR_RECLAMO_USUARIO('$corre','$FechaActual','$tDocUsuario','$nDocUsuario','$nomUsuario','$APUsuario','$AMUsuario','$sexUsuario','$emailUsuario','$telefUsuario','$DepUsuario','$ProvUsuario','$DistUsuario','$DomUsuario','$tipoUsuario','$fechaOcurrencia','$recCG','$recCE','$detReclamo')";
            echo mysqli_query($conexion, $query);


            $cuerpoUsuario = "";
            $destinoUsuario = $emailUsuario;
            $asuntoUsuario = "Registro de Reclamo en Salud Virtual-HNSEB";

            $cuerpoOficina = "";
            $destinoOficina = "libroreclamaciones@hnseb.gob.pe";
            $asuntoOficina = "Información de Registro de Reclamo en Salud Virtual-HNSEB";
            // Envío de Correo a Usuario Afectado
            $mailUsuario = new PHPMailer(true);
            $mailOficina1 = new PHPMailer(true);


            $destinatario = $nomUsuario . " " . $APUsuario . " " . $AMUsuario;
            $cuerpoUsuario = '<div style="margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:10px 0 30px 0">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                            <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Libro Reclamaciones" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                            <b><h4>Registro de Reclamo Virtual: </h4></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3>N° Reclamo: ' . $corre . '</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3>Estimado(a): ' . $destinatario . '</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:2px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            Su reclamo ha sido registrado con éxito. Nos estaremos comunicando con Ud. a través de los medios brindados.<br></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy;2021 Libro Virtual de Reclamaciones</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>';

            // Causa Especifica


            $fRegistro = date("d-m-Y", strtotime($FechaActual));
            $nyAusuario = $nomUsuario . " " . $APUsuario . " " . $AMUsuario;
            $cuerpoOficina = '<div style="margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:10px 0 30px 0">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                            <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Doctor Fast" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                            <b>
                                                                <h4><u>Reclamo Web Registrado : </u> </h4>
                                                            </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0px 0px 0px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h4>N° de Reclamo: ' . $corre . '</h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0px 0px 0px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h4>Fecha de Registro: ' . $fRegistro . '</h4>           
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Usuario Afectado</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>' . $mTDoc . ' :</b> ' . $nDocUsuario . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Nombres y Apellidos:</b> ' . $nyAusuario . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Correo Electrónico:</b>
                                                            <a href="mailto:' . $emailUsuario . '">' . $emailUsuario . '</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Teléfono o Celular:</b> ' . $telefUsuario . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Ubigeo:</b> ' . $mDep . '-' . $mProv . '-' . $mDist . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Domicilio:</b> ' . $DomUsuario . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Tipo de Usuario:</b> ' . $mTUs . '</td>
                                                    </tr>
                                                    <br><br>
                                                    <tr>
                                                        <td style="padding:15px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Datos del Reclamo</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Fecha del Incidente:</b> ' . $cajaFecha . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Causa General:</b> ' . $mCG . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Causa Específica:</b> ' . $mCE . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Detalle del Reclamo:</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <p>' . $detReclamo . '</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy;2021
                                                                Libro Virtual de Reclamaciones</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>';
            try {
                $mailUsuario->SMTPDebug = 0;
                $mailUsuario->isSMTP();
                $mailUsuario->Host = 'mail.olgercastropalacios.com';
                $mailUsuario->SMTPAuth = true;
                $mailUsuario->Username = 'reclamoshnseb@olgercastropalacios.com';
                $mailUsuario->Password = '.^P;mSX.{.}q';
                $mailUsuario->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mailUsuario->Port = 465;

                $mailOficina1->SMTPDebug = 0;
                $mailOficina1->isSMTP();
                $mailOficina1->Host = 'mail.olgercastropalacios.com';
                $mailOficina1->SMTPAuth = true;
                $mailOficina1->Username = 'reclamoshnseb@olgercastropalacios.com';
                $mailOficina1->Password = '.^P;mSX.{.}q';
                $mailOficina1->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mailOficina1->Port = 465;

                // Recipientes
                $mailUsuario->setFrom('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
                $mailOficina1->setFrom('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
                $mailUsuario->addAddress($destinoUsuario);
                $mailOficina1->addAddress($destinoOficina);
                $mailUsuario->addReplyTo('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
                $mailUsuario->Subject = $asuntoUsuario;
                $mailOficina1->Subject = $asuntoOficina;
                $mailUsuario->addStringAttachment($reclamoPDF, $corre . '.pdf');
                $mailOficina1->addStringAttachment($reclamoPDF, $corre . '.pdf');
                $mailUsuario->isHTML(true);
                $mailOficina1->isHTML(true);
                $mailUsuario->CharSet = "utf-8";
                $mailOficina1->CharSet = "utf-8";
                $mailUsuario->Body = $cuerpoUsuario;
                $mailOficina1->Body = $cuerpoOficina;
                $mailUsuario->send();
                $mailOficina1->send();
            } catch (Exception $e) {
                echo "Hubo un error al enviar: {$mailUsuario->ErrorInfo}";
                echo "Hubo un error al enviar: {$mailOficina1->ErrorInfo}";
            }
        }
    }
}

// Representante es el que presenta Reclamo
if (isset($representante) && $representante == "1") {
    if (
        !empty($tDocUsuario) &&
        !empty($nDocUsuario) &&
        !empty($nomUsuario) &&
        !empty($APUsuario) &&
        !empty($AMUsuario) &&
        !empty($sexUsuario) &&
        !empty($emailUsuario) &&
        !empty($telefUsuario) &&
        !empty($DepUsuario) &&
        !empty($ProvUsuario) &&
        !empty($DistUsuario) &&
        !empty($DomUsuario) &&
        !empty($tDocRep) &&
        !empty($nDocRep) &&
        !empty($nomRep) &&
        !empty($emailRep) &&
        !empty($telefRep) &&
        !empty($DomRep) &&
        !empty($tipoUsuario) &&
        !empty($cajaFecha) &&
        !empty($recCG) &&
        !empty($recCE) &&
        !empty($detReclamo)
    ) {
        if ($tDocUsuario > 0 && $sexUsuario > 0 && $DepUsuario > 0 && $ProvUsuario > 0 && $DistUsuario > 0 && $tDocRep > 0 && $tipoUsuario > 0 && $recCG > 0 && $recCE > 0 && $fechaOcurrencia <= $FechaActual) {

            // Obtener y armar correlativo
            $counting2 = "SELECT fechaReclamo FROM lr_tab_reclamo WHERE YEAR(fechaReclamo) = YEAR(NOW())";
            $rec2 = mysqli_query($conexion, $counting2);

            $row_cnt2 = mysqli_num_rows($rec2) + 1;
            if ($row_cnt2 >= 1 && $row_cnt2 <= 9) {
                $corre2 = "LR-" . date("Y") . "-" . "0000" . $row_cnt2;
            } elseif ($row_cnt2 >= 10 && $row_cnt2 <= 99) {
                $corre2 = "LR-" . date("Y") . "-" . "000" . $row_cnt2;
            } elseif ($row_cnt2 >= 100 && $row_cnt2 <= 999) {
                $corre2 = "LR-" . date("Y") . "-" . "00" . $row_cnt2;
            } elseif ($row_cnt2 >= 1000 && $row_cnt2 <= 9999) {
                $corre2 = "LR-" . date("Y") . "-" . "0" . $row_cnt2;
            } elseif ($row_cnt2 >= 10000 && $row_cnt2 <= 99999) {
                $corre2 = "LR-" . date("Y") . "-" . $row_cnt2;
            } else {
                $corre2 = "LR-" . date("Y") . "-" . $row_cnt2;
            }

            // Tipo de Documento
            $itTDoc2 = "idtipoDoc";
            $vTDoc2 = $tDocUsuario;
            $rTDoc2 = ControladorTipoDoc::ctrListarTipoDocUsuario($itTDoc2, $vTDoc2);
            $mTDoc2 = $rTDoc2["desctipoDoc"];
            // Tipo de Documento
            // Tipo de Documento
            $itTDocRep2 = "idtipoDoc";
            $vTDocRep2 = $tDocRep;
            $rTDocRep2 = ControladorTipoDoc::ctrListarTipoDocRep($itTDocRep2, $vTDocRep2);
            $mTDocRep2 = $rTDocRep2["desctipoDoc"];
            // Tipo de Documento
            // Departamento
            $itDep2 = "idDepa";
            $vDep2 = $DepUsuario;
            $rDep2 = ControladorUbigeo::ctrListarDepartamentos($itDep2, $vDep2);
            $mDep2 = $rDep2["descDepartamento"];
            // Departamento
            // Provincia
            $itProv2 = "idProv";
            $vProv2 = $ProvUsuario;
            $rProv2 = ControladorUbigeo::ctrListarProvincias($itProv2, $vProv2);
            $mProv2 = $rProv2["descProvincia"];
            // Provincia
            // Distrito
            $itDist2 = "idDist";
            $vDist2 = $DistUsuario;
            $rDist2 = ControladorUbigeo::ctrListarDistrito($itDist2, $vDist2);
            $mDist2 = $rDist2["descDistrito"];
            // Distrito
            // Tipo de Usuario
            $itTUs2 = "idtipoUsuario";
            $vTUs2 = $tipoUsuario;
            $rTUs2 = ControladorTipoUsuario::ctrListarTipoUsuario($itTUs2, $vTUs2);
            $mTUs2 = $rTUs2["desctipoUsuario"];
            // Tipo de Usuario

            // Causa General
            $itCG2 = "id_causaGeneral";
            $vCG2 = $recCG;
            $rCG2 = ControladorCausas::ctrListarCausasGenerales($itCG2, $vCG2);
            $mCG2 = $rCG2["desc_causaGeneral"];
            // Causa General
            // Causa Especifica
            $itCE2 = "id_causaEspecifica";
            $vCE2 = $recCE;
            $rCE2 = ControladorCausas::ctrListarCausasEspecificas($itCE2, $vCE2);
            $mCE2 = $rCE2["desc_causaEspecifica"];
            // Causa Especifica

            if ($repAuto == "SI") {
                $rSi2 = "X";
                $rNo2 = "";
            } else {
                $rSi2 = "";
                $rNo2 = "X";
            }

            if ($mTDoc2 == "DNI") {
                $tDNI2 = "X";
                $tCE2 = "";
                $tPASS2 = "";
            } elseif ($mTDoc2 == "CE") {
                $tDNI2 = "";
                $tCE2 = "X";
                $tPASS2 = "";
            } else {
                $tDNI2 = "";
                $tCE2 = "";
                $tPASS2 = "X";
            }

            if ($mTDocRep2 == "DNI") {
                $tDNIRep2 = "X";
                $tCERep2 = "";
                $tPASRep2 = "";
                $tRUCRep2 = "";
            } elseif ($mTDocRep2 == "CE") {
                $tDNIRep2 = "";
                $tCERep2 = "X";
                $tPASRep2 = "";
                $tRUCRep2 = "";
            } elseif ($mTDocRep2 == "PASAPORTE") {
                $tDNIRep2 = "";
                $tCERep2 = "";
                $tPASRep2 = "X";
                $tRUCRep2 = "";
            } else {
                $tDNIRep2 = "";
                $tCERep2 = "";
                $tPASRep2 = "";
                $tRUCRep2 = "X";
            }
            class MYPDF extends TCPDF
            {
                //Page header
                public function Header()
                {
                    // Logo HNSEB
                    $image_file = K_PATH_IMAGES . 'logo-hnseb.png';
                    $this->Image($image_file, 10, 10, 93, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                    // Logo HNSEB

                    // Set font
                    $this->SetFont('helvetica', '', 8);
                    // Información del HNSEB
                    $html = '<p>Av. Túpac Amaru N° 8000, Comas<br>Teléfono Central (51-1) 558-0186</p>';
                    $this->writeHTMLCell(0, 0, 105, 12, $html, 0, 1, 0, true, 'L', true);
                    // Información del HNSEB

                    // Title
                    // $this->Cell(0, 15, 'Av. Tupac Amaru N°8000 - Comas', 0, false, 'L', 0, '', 0, false, 'T', 'M');
                    // Logo SUSALUD
                    $image_file2 = K_PATH_IMAGES . 'susalud.png';
                    $this->Image($image_file2, 160, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                    // Logo SUSALUD
                }

                // Page footer
                public function Footer()
                {
                    // Position at 15 mm from bottom
                    $this->SetY(-15);
                    // Set font
                    $this->SetFont('helvetica', '', 6.5);
                    // Page number
                    // $this->Cell(0, 10, 'Av. Túpac Amaru N° 8000, Comas<br>Teléfono Central (51-1) 558-0186', 0, false, 'C', 0, '', 0, false, 'T', 'M');
                    $html = '<p style="text-align: justify;">Las IAFAS,IPRESS o UGIPRESS deben atender el reclamo en un plazo de 30 días hábiles.<br><strong>Estimado usuario</strong>: Usted puede presentar su queja ante SUSALUD ante hechos o actos que vulneren o pudieran vulnerar el derecho a la salud o cuando no le hayan brindado un servicio, prestación o coberturas solicitada o recibidas de las IAFAS o IPRESS, o que dependan de las UGIPRESS pública, privada o mixtas. También ante la negativa de atención de su reclamo, irregularidad en su tramitación o disconformidad con el resultado del mismo o hacer uso de los mecanismos alternativos de solución de controversias ante el Centro de Conciliación y Arbitraje - CECONAR de SUSALUD</p>';
                    $this->writeHTMLCell(0, 0, 10, 276, $html, 0, 1, 0, true, 'L', true);
                }
            }

            // create new PDF document
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('OFICINA DE GESTIÓN DE LA CALIDAD-HNSEB');
            $pdf->SetTitle('RECLAMO VIRTUAL EN SALUD - HNSEB');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

            // set header and footer fonts
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(10, 23, 10);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // ---------------------------------------------------------

            // set font
            $pdf->SetFont('helvetica', '', 9);

            // add a page
            $pdf->AddPage();
            $html2 =
                <<<EOF
                            <table cellpadding="2" cellspacing="1.2" class="block-1" style="text-align:center;">
                            <tr>
                                <td style="width:30px;background-color:white;
                                border-top:    1px solid  #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: center;"><b>DIA</b></p></td>
            
                                <td style="width:30px;background-color:white;
                                border-top:    1px solid  #000000;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: center;"><b>MES</b></p></td>
            
                                <td style="width:30px;background-color:white;
                                border-top:    1px solid  #000000;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                background-color: #E6E6E6;"><p style="text-align: center;"><b>AÑO</b></p></td>
            
                                <td style="text-align:left; width:10px;background-color:white;"></td>
            
                                <td style="width:94px;background-color:white;
                                border-right:   1px solid  #000000;
                                border-top:    1px solid  #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: center;"><b>HORA</b></p></td>
            
                                <td style="text-align:left; width:210px;background-color:white;"></td>
                                <td style="width:260px;background-color:white;
                                border-top:    1px solid  #000000;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: center;"><b>HOJA DE RECLAMACION EN SALUD VIRTUAL</b></p></td>
                            </tr>
                            <tr>
                                <td style="text-align:center; width:30px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;">$FD</td>
                                <td style="text-align:center; width:30px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;">$FM</td>
                                <td style="text-align:center; width:30px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;">$FA</td>
            
                                <td style="text-align:left; width:10px;background-color:white;"></td>
                                
                                <td style="text-align:center; width:30px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;">$FHora</td>
                                <td style="text-align:center; width:30px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;">$FMin</td>
                                <td style="text-align:center; width:31.5px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;">$FAM</td>
            
                                <td style="text-align:center; width:210px;background-color:white;"></td>
                                <td style="width:260px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;"><p style="text-align: center;"><b>00007634 - N° </b>$corre2</p></td>
                            </tr>
                            </table>
            
                            <table cellpadding="1" cellspacing="1" style="text-align:left;" border="">
                            <tr>
                                <td style="text-align:center; width:667px;background-color:white;"></td>
                            </tr>
                            </table>
            
                            <table cellpadding="2" cellspacing="1.2" style="text-align:left;" border="">
                            <tr>
                                <td style="width:671px;background-color:white;
                                border-top:    1px solid  #000000;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: left;"><b>1. IDENTICACIÓN DEL USUARIO O TERCERO LEGITIMADO (PACIENTE AFECTADO)</b></p></td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:149px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>NOMBRES Y APELLIDOS:</b></td>
                                <td style="text-align:left; width:520.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $nomUsuario $APUsuario $AMUsuario</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:71px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
                                <td style="text-align:left; width:598.65px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $DomUsuario</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:70px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>DISTRITO:</b></td>
                                <td style="text-align:left; width:300px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $mDist2</td>
                                <td style="text-align:left; width:83.5px;background-color:white;
                                border-bottom: 1px solid #000000;
                                background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
                                <td style="text-align:left; width:213.72px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $telefUsuario</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:70px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>E-MAIL:</b></td>
                                <td style="text-align:left; width:599.71px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $emailUsuario</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:168px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>DOCUMENTO DE IDENTIDAD:</b></td>
                                <td style="text-align:left; width:501.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> DNI: ($tDNI2) CE: ($tCE2) PASAPORTE: ($tPASS2) &nbsp; N° $nDocUsuario</td>
                            </tr>
                            <tr>
                                <td style="width:671px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: left;"><b>2. IDENTICACIÓN DE QUIEN PRESENTA EL RECLAMO (En caso de ser el usuario afectado no es necesario su llenado)</b></p></td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:162px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>NOMBRE O RAZÓN SOCIAL:</b></td>
                                <td style="text-align:left; width:507.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $nomRep</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:71px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
                                <td style="text-align:left; width:598.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $DomRep</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:70px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>DISTRITO:</b></td>
                                <td style="text-align:left; width:300px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $mDist2</td>
                                <td style="text-align:left; width:80px;background-color:white;
                                border-bottom: 1px solid #000000;
                                background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
                                <td style="text-align:left; width:217.3px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $telefRep</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:70px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>E-MAIL:</b></td>
                                <td style="text-align:left; width:599.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $emailRep</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:168px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>DOCUMENTO DE IDENTIDAD:</b></td>
                                <td style="text-align:left; width:501.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> DNI: ($tDNIRep2) CE: ($tCERep2) PASAPORTE: ($tPASRep2) RUC: ($tRUCRep2) &nbsp; N° $nDocRep</td>
                            </tr>
                            <tr>
                                <td style="width:671px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: left;"><b>3. DATOS DEL RECLAMO</b></p></td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:115px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>TIPO DE USUARIO:</b></td>
                                <td style="text-align:left; width:200px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $mTUs2</td>
                                <td style="text-align:left; width:150px;background-color:white;
                                border-bottom: 1px solid #000000;
                                background-color: #E6E6E6;"> <b>FECHA DE OCURRENCIA:</b></td>
                                <td style="text-align:left; width:202.4px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $cajaFecha</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:195px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>DERECHO EN SALUD AFECTADO:</b></td>
                                <td style="text-align:left; width:474.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $mCG2</td>
                            </tr>
                            <tr>
                                <td style="text-align:left; width:210px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"> <b>CAUSA ESPECIFICA DEL RECLAMO:</b></td>
                                <td style="text-align:left; width:459.7px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                border-right:   1px solid  #000000;
                                "> $mCE2</td>
                            </tr>
                            <tr>
                                <td style="width:671px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;
                                background-color: #E6E6E6;"><p style="text-align: left;"><b> DETALLE DEL RECLAMO</b></p></td>
                            </tr>
                            <tr>
                                <td style="width:671px;height:385px;background-color:white;
                                border-right:  1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;"><p style="text-align: justify;">$detReclamo</p></td>
                            </tr>
                            <tr>
                                <td style="width:370px;background-color:white;
                                border-left:   1px solid  #000000;"><p style="text-align: left;"><b>4. AUTORIZO NOTIFICACIÓN DEL RESULTADO DEL RECLAMO AL E-MAIL CONSIGNADO &nbsp; Si ($rSi2)  No ($rNo2)</b></p><br><p style="text-align: left;"><b>5. FIRMA DEL RECLAMANTE <br>(USUARIO / REPRESENTANTE O TERCERO LEGITIMADO)</b></p></td>
                                <td style="width:200px;background-color:white;
                                border-bottom: 1px solid #000000;"></td>
                                <td style="text-align:left; width:20px;background-color:white;"></td>
                                <td style="text-align:left; width:50px;background-color:white;
                                border-left:   1px solid  #000000;"></td>
                                <td style="text-align:left; width:26.2px;background-color:white;
                                border-right:   1px solid  #000000;"></td>
                                
            
                            </tr>
                            <tr>
                                <td style="text-align:left; width:350px;background-color:white;
                                border-bottom: 1px solid #000000;
                                border-left:   1px solid  #000000;"></td>
                                <td style="width:230px;background-color:white;
                                border-bottom: 1px solid #000000;"><p style="text-align: center;"><b>FIRMA</b></p></td>
                                <td style="text-align:left; width:10px;background-color:white;
                                border-bottom: 1px solid #000000;"></td>
                                <td style="width:77.5px;background-color:white;
                                border-top: 1px solid #000000;
                                border-bottom: 1px solid #000000;
                                border-right: 1px solid #000000;
                                border-left: 1px solid #000000;"><p style="text-align: center;font-size: 6px;"><b>(HUELLA DIGITAL)</b></p></td>
                            </tr>
                            </table>
                        EOF;

            $pdf->writeHTML($html2, true, false, true, false, '');

            $reclamoPDF2 = $pdf->Output('RECLAMO_VIRTUAL.pdf', 'S');



            $queryRep = "CALL REGISTRO_RECLAMO_REP('$corre2','$FechaActual','$tDocUsuario','$nDocUsuario','$nomUsuario','$APUsuario','$AMUsuario','$sexUsuario','$emailUsuario','$telefUsuario','$DepUsuario','$ProvUsuario','$DistUsuario','$DomUsuario','$tDocRep','$nDocRep','$nomRep','$emailRep','$DomRep','$telefRep','$tipoUsuario','$fechaOcurrencia','$recCG','$recCE','$detReclamo')";
            echo mysqli_query($conexion, $queryRep);

            $cuerpoUsuario2 = "";
            $destinoUsuario2 = $emailRep;
            $asuntoUsuario2 = "Registro de Reclamo en Salud Virtual-HNSEB";

            $cuerpoOficina2 = "";
            $destinoOficina2 = "libroreclamaciones@hnseb.gob.pe";
            $asuntoOficina2 = "Información de Registro de Reclamo en Salud Virtual-HNSEB";
            // Envío de Correo a Usuario Afectado
            $mailUsuario2 = new PHPMailer(true);
            $mailOficina2 = new PHPMailer(true);

            $nyAusuario2 = $nomUsuario . " " . $APUsuario . " " . $AMUsuario;
            $destinatario2 = $nomUsuario . " " . $APUsuario . " " . $AMUsuario;
            $cuerpoUsuario2 = '<div style="margin:0;padding:0">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td style="padding:10px 0 30px 0">
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                                            <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Libro Reclamaciones" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                                            <b><h4>Registro de Reclamo Virtual: </h4></b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                        <h3>N° Reclamo: ' . $corre2 . '</h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                            <h3>Estimado(a): ' . $nomRep . '</h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding:2px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                            El reclamo en representación de ' . $nyAusuario2 . ' ha sido registrado con éxito. Nos estaremos comunicando con Ud. a través de los medios brindados.<br></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy;2021 Libro Virtual de Reclamaciones</b></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>';


            $fRegistro2 = date("d-m-Y", strtotime($FechaActual));
            $cuerpoOficina2 = '<div style="margin:0;padding:0">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="padding:10px 0 30px 0">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                                    <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Doctor Fast" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                                    <b>
                                                                        <h4><u>Reclamo Web Registrado: </u></h4>
                                                                    </b></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0px 0 5px 0;margin-top: 5px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                <h4>N° de Reclamo: ' . $corre2 . '</h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0px 0px 0px 0px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <h4>Fecha de Registro: ' . $fRegistro2 . '</h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <h3><u>Representante del Usuario Afectado</u></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>' . $mTDocRep2 . ' :</b> ' . $nDocRep . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Nombres o Razón Social del Representante:</b> ' . $nomRep . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Correo Electrónico Representante:</b>
                                                                    <a href="mailto:' . $emailRep . '">' . $emailRep . '</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Teléfono o Celular Representante:</b> ' . $telefRep . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:10px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <h3><u>Usuario Afectado</u></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>' . $mTDoc2 . ' :</b> ' . $nDocUsuario . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Nombres y Apellidos:</b> ' . $nyAusuario2 . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Correo Electrónico:</b>
                                                                    <a href="mailto:' . $emailUsuario . '">' . $emailUsuario . '</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Teléfono o Celular:</b> ' . $telefUsuario . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Ubigeo:</b> ' . $mDep2 . '-' . $mProv2 . '-' . $mDist2 . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Domicilio:</b> ' . $DomUsuario . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Tipo de Usuario:</b> ' . $mTUs2 . '</td>
                                                            </tr>
                                                            <br><br>
                                                            <tr>
                                                                <td style="padding:15px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <h3><u>Datos del Reclamo</u></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Fecha del Incidente:</b> ' . $cajaFecha . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Causa General:</b> ' . $mCG2 . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Causa Específica:</b> ' . $mCE2 . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <b>Detalle del Reclamo:</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                                    <p>' . $detReclamo . '</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy;2021
                                                                        Libro Virtual de Reclamaciones</b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>';
            try {
                $mailUsuario2->SMTPDebug = 0;
                $mailUsuario2->isSMTP();
                $mailUsuario2->Host = 'mail.olgercastropalacios.com';
                $mailUsuario2->SMTPAuth = true;
                $mailUsuario2->Username = 'reclamoshnseb@olgercastropalacios.com';
                $mailUsuario2->Password = '.^P;mSX.{.}q';
                $mailUsuario2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mailUsuario2->Port = 465;

                $mailOficina2->SMTPDebug = 0;
                $mailOficina2->isSMTP();
                $mailOficina2->Host = 'mail.olgercastropalacios.com';
                $mailOficina2->SMTPAuth = true;
                $mailOficina2->Username = 'reclamoshnseb@olgercastropalacios.com';
                $mailOficina2->Password = '.^P;mSX.{.}q';
                $mailOficina2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mailOficina2->Port = 465;

                // Recipientes
                $mailUsuario2->setFrom('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
                $mailOficina2->setFrom('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
                $mailUsuario2->addAddress($destinoUsuario2);
                $mailOficina2->addAddress($destinoOficina2);
                $mailUsuario2->addReplyTo('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
                $mailUsuario2->Subject = $asuntoUsuario2;
                $mailOficina2->Subject = $asuntoOficina2;
                $mailUsuario2->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                $mailOficina2->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                $mailUsuario2->isHTML(true);
                $mailOficina2->isHTML(true);
                $mailUsuario2->CharSet = "utf-8";
                $mailOficina2->CharSet = "utf-8";
                $mailUsuario2->Body = $cuerpoUsuario2;
                $mailOficina2->Body = $cuerpoOficina2;
                $mailUsuario2->send();
                $mailOficina2->send();
            } catch (Exception $e) {
                echo "Hubo un error al enviar: {$mailUsuario2->ErrorInfo}";
                echo "Hubo un error al enviar: {$mailOficina2->ErrorInfo}";
            }
        }
    }
}
// Representante es el que presenta Reclamo
