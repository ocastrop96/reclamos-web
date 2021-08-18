<?php
require_once "controllers/templateController.php";
require_once "controllers/causasController.php";
require_once "controllers/tipoDocController.php";
require_once "controllers/sexoController.php";
require_once "controllers/ubigeoController.php";
require_once "controllers/tipoUsuarioController.php";
require_once "controllers/reclamosController.php";

require_once "models/causasModel.php";
require_once "models/tipoDocModel.php";
require_once "models/sexoModel.php";
require_once "models/ubigeoModel.php";
require_once "models/tipoUsuarioModel.php";
require_once "models/reclamosModel.php";

$template =  new ControladorPlantilla();
$template->ctrPlantilla();
