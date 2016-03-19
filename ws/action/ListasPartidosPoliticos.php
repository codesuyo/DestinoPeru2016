<?php
	include_once('../UTIL/globals.php');
	include_once('../UTIL/dbmanager.php');
	header("Access-Control-Allow-Origin: *");
	
	$sql = "SELECT * FROM partido_politico INNER JOIN candidato_presidencial ON candidato_presidencial.id_partido = partido_politico.id_partido ";
	$db = new dbmanager();
	$result = $db->executeQuery($sql);
	
	//$result = $conn->query("SELECT * FROM persona_electoral ORDER BY persona_electoral.nombre ASC ");
	
	$miArray = array();
 
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
			$miArray[] = array_map('utf8_encode', $rs);  
	}
	//$array = utf8_encode($miArray);
	 
	$salida = json_encode($miArray);
	 
	//$conn->close();
	// print_r($miArray);
	echo($salida); 
?>