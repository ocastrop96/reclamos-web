<?php
class ControladorTipoUsuario
{
    static public function ctrListarTipoUsuario($item, $valor)
    {
        $tabla = "lr_tab_tipo_usuario";
        $respuesta = ModeloTipoUsuario::mdlListarTipoUsuario($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrListarContador()
    {
        $tabla = "lr_tab_reclamo";
        $rpt = ModeloTipoUsuario::mdlListarContador($tabla);
        return $rpt;
    }
}
