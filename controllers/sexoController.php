<?php
class ControladorSexo{
    static public function ctrListarSexo($item,$valor){
        $tabla = "lr_tab_sexo_usuario";
        $respuesta = ModeloSexo::mdlListarSexo($tabla, $item, $valor);
        return $respuesta;
    }
}