<?php
require_once "../models/conexion2.php";

if(isset($_POST["ProvinciaId"]) && !empty($_POST["ProvinciaId"])){
    $query = $db->query("CALL LISTAR_DISTRITO(".$_POST["ProvinciaId"].")");
    $rowCount = $query->num_rows;

    if ($rowCount > 0) {
        echo '<option value="0">Seleccione Distrito</option>';

        while ($row = $query->fetch_assoc()) {
            echo '<option value="'.$row['idDist'].'">'.$row['descDistrito'].'</option>';
        }
    }
    else{
        echo '<option value="0">No hay distritos relacionados</option>';
    }
}
