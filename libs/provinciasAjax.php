<?php
require_once "../models/conexion2.php";

if(isset($_POST["DepartamentoId"]) && !empty($_POST["DepartamentoId"])){
    $query = $db->query("CALL LISTAR_PROVINCIA(".$_POST["DepartamentoId"].")");
    $rowCount = $query->num_rows;

    if ($rowCount > 0) {
        echo '<option value="0">Seleccione Provincia</option>';

        while ($row = $query->fetch_assoc()) {
            echo '<option value="'.$row['idProv'].'">'.$row['descProvincia'].'</option>';
        }
    }
    else{
        echo '<option value="0">No hay provincias relacionadas</option>';
    }
}
