<?php
class ControladorUbigeo{
    static public function ctrListarDepartamentos($item,$valor){
        $tabla = "lr_tab_departamento";
        $respuesta = ModeloUbigeo::mdlListarDepartamentos($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrListarProvincias($item, $valor){
        $tabla = "lr_tab_provincia";
        $respuesta = ModeloUbigeo::mdlListarProvincia($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrListarDistrito($item, $valor){
        $tabla = "lr_tab_distrito";
        $respuesta = ModeloUbigeo::mdlListarDistrito($tabla, $item, $valor);
        return $respuesta;
    }
}