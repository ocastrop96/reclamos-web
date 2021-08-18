<?php
require_once "../models/conexion2.php";

if (isset($_POST["CausaGeneralId"]) && !empty($_POST["CausaGeneralId"])) {
    $query = $db->query("CALL LISTAR_CAUSA_ESPECIFICA(" . $_POST["CausaGeneralId"] . ")");
    $rowCount = $query->num_rows;

    if ($rowCount > 0) {
        echo '<option value="0">Seleccione Causa Específica</option>';

        while ($row = $query->fetch_assoc()) {
            echo '<option value="' . $row['id_causaEspecifica'] . '">' . $row['desc_causaEspecifica'] . '</option>';
        }
    } else {
        echo '<option value="0">No hay datos relacionadas</option>';
    }
}
