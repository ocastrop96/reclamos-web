<?php
class ControladorCausas{
    static public function ctrListarCausasGenerales($item, $valor)
    {
        $tabla = "lr_tab_causa_general";
        $respuesta = ModeloCausas::mdlListaCausasGenerales($tabla, $item, $valor);
        return $respuesta;
    }
    static public function ctrListarCausasEspecificas($item, $valor)
    {
        $tabla = "lr_tab_causa_especifica";
        $respuesta = ModeloCausas::mdlListaCausasEspecificas($tabla, $item, $valor);
        return $respuesta;
    }
}