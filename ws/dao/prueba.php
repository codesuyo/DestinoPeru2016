<?php 

	require_once('dao.php');
		$usuario = new Dao();
		$json = $usuario->infoWidget(3);
		$prueba = '{"info":"Muestra el índice de asistencia en porcentaje por horas extras no autorizadas, horas por compensar e inasistencias."}';
		$myArray = json_decode($prueba, true);
		$info = $myArray['info'];
		echo "json:".$json."<br>";
		var_dump($myArray);
		echo "<br>";
		echo "el widget es:".$info;
		$json_de = json_decode($json);
		var_dump($json_de);
		echo "<br>";
?>