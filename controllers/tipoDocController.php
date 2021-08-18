<?php
class ControladorTipoDoc{
    static public function ctrListarTipoDocUsuario($item, $valor)
    {
        $tabla = "lr_tab_tipo_doc";
        $respuesta = ModeloTipoDoc::mdlListarTipoDocUsuario($tabla, $item, $valor);
        return $respuesta;
    }
    static public function ctrListarTipoDocRep($item, $valor)
    {
        $tabla = "lr_tab_tipo_doc";
        $respuesta = ModeloTipoDoc::mdlListarTipoDocRep($tabla, $item, $valor);
        return $respuesta;
    }
}