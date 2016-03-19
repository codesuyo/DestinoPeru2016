<?php
	include_once('../UTIL/globals.php');
	include_once('../UTIL/dbmanager.php');
	header("Access-Control-Allow-Origin: *");
	
	$sql = "SELECT * FROM plangdetalle WHERE id_partido=".$_POST["ID_PP"]." and id_plangob=".$_POST["ID_PG"].";";
	$db = new dbmanager();
	$result = $db->executeQuery($sql);
	
	//$result = $conn->query("SELECT * FROM persona_electoral ORDER BY persona_electoral.nombre ASC ");

	$miArray = array();
 
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
			$miArray[] = $rs;  
	}
	//$array = utf8_encode($miArray);
	 
	$salida = utf8_decode(json_encode($miArray));
	 
	//$conn->close();
	// print_r($miArray);
	echo($salida); 
?>