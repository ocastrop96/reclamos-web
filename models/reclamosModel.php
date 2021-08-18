<?php
require_once "conexion.php";

class ReclamosModel
{
	static public function mdlRegistrarReclamosUsuario($datos)
	{
		$stmt = Conexion::conectar()->prepare("CALL REGISTRAR_RECLAMO_USUARIO(:fechaReclamo,:idTipoDocUsuario,:nDocUsuario,:nombUsuario,:apePatUsuario,:apeMatUsuario,:idSexUsuario,:emailUsuario,:telUsuario,:idDepa,:idProv,:idDist,:domUsuario,:idTipUsuario,:fechaOcurrencia,:idcausaGeneral,:idcausaEspecifica,:detalleReclamo)");

		$stmt->bindParam(":idTipoDocUsuario", $datos["idTipoDocUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idSexUsuario", $datos["idSexUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idDepa", $datos["idDepa"], PDO::PARAM_INT);
		$stmt->bindParam(":idProv", $datos["idProv"], PDO::PARAM_INT);
		$stmt->bindParam(":idDist", $datos["idDist"], PDO::PARAM_INT);
		$stmt->bindParam(":idTipUsuario", $datos["idTipUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idcausaGeneral", $datos["idcausaGeneral"], PDO::PARAM_INT);
		$stmt->bindParam(":idcausaEspecifica", $datos["idcausaEspecifica"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaReclamo", $datos["fechaReclamo"], PDO::PARAM_STR);
		$stmt->bindParam(":nDocUsuario", $datos["nDocUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombUsuario", $datos["nombUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":apePatUsuario", $datos["apePatUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":apeMatUsuario", $datos["apeMatUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":emailUsuario", $datos["emailUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":telUsuario", $datos["telUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":domUsuario", $datos["domUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaOcurrencia", $datos["fechaOcurrencia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalleReclamo", $datos["detalleReclamo"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarReclamosRepresentante($datos)
	{
		$stmt = Conexion::conectar()->prepare("CALL REGISTRO_RECLAMO_REP(:fechaReclamo,:idTipoDocUsuario,:nDocUsuario,:nombUsuario,:apePatUsuario,:apeMatUsuario,:idSexUsuario,:emailUsuario,:telUsuario,:idDepa,:idProv,:idDist,:domUsuario,:idTipoDocRep,:nDocRep,:nombRep,:emailRep,:domRep,:telRep,:idTipUsuario,:fechaOcurrencia,:idcausaGeneral,:idcausaEspecifica,:detalleReclamo)");

		$stmt->bindParam(":idTipoDocUsuario", $datos["idTipoDocUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idSexUsuario", $datos["idSexUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idDepa", $datos["idDepa"], PDO::PARAM_INT);
		$stmt->bindParam(":idProv", $datos["idProv"], PDO::PARAM_INT);
		$stmt->bindParam(":idDist", $datos["idDist"], PDO::PARAM_INT);
		$stmt->bindParam(":idTipUsuario", $datos["idTipUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idcausaGeneral", $datos["idcausaGeneral"], PDO::PARAM_INT);
		$stmt->bindParam(":idcausaEspecifica", $datos["idcausaEspecifica"], PDO::PARAM_INT);
		$stmt->bindParam(":idTipoDocRep", $datos["idTipoDocRep"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaReclamo", $datos["fechaReclamo"], PDO::PARAM_STR);
		$stmt->bindParam(":nDocUsuario", $datos["nDocUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombUsuario", $datos["nombUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":apePatUsuario", $datos["apePatUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":apeMatUsuario", $datos["apeMatUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":emailUsuario", $datos["emailUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":telUsuario", $datos["telUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":domUsuario", $datos["domUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nDocRep", $datos["nDocRep"], PDO::PARAM_STR);
		$stmt->bindParam(":nombRep", $datos["nombRep"], PDO::PARAM_STR);
		$stmt->bindParam(":emailRep", $datos["emailRep"], PDO::PARAM_STR);
		$stmt->bindParam(":domRep", $datos["domRep"], PDO::PARAM_STR);
		$stmt->bindParam(":telRep", $datos["telRep"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaOcurrencia", $datos["fechaOcurrencia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalleReclamo", $datos["detalleReclamo"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
}
