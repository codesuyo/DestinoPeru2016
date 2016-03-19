<?php
	require_once('lib/nusoap.php');
	require_once('../dao/dao.php');
	$server = new soap_server();
	$server->configureWSDL("Dashboard", "urn:Dashboardwsdl");
	$server->wsdl->schemaTargetNamespace = "urn:Dashboardwsdl";
	
	$HTTP_RAW_POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';          
    
	function JsonDataLogin() {
		$usuario = new Dao();
		$json = $usuario->validLogin();
		return $json;
	}
	
	function JsonDataDashboardOption() {
		$usuario = new Dao();
		$json = $usuario->optionDashboard();
		return $json;
	}
	
	function JsonDataGuardarDashboard($nombre_dash) {
		$usuario = new Dao();
		$json = $usuario->guardarDashboard($nombre_dash);
		return $json;
	}
	
	$server->register('JsonDataLogin', // Nombre del m�todo
		array(), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:Dashboardwsdl', // Nombre del workspace
        'urn:Dashboardwsdl#JsonDataLogin', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Validacion de login'             // Documentaci�n
	);
	
	$server->register('JsonDataDashboardOption', // Nombre del m�todo
		array(), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:Dashboardwsdl', // Nombre del workspace
        'urn:Dashboardwsdl#JsonDataDashboardOption', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Option del select de dashboard'             // Documentaci�n
	);
	
	$server->register('JsonDataGuardarDashboard', // Nombre del m�todo
		array('nombre_dash' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:Dashboardwsdl', // Nombre del workspace
        'urn:Dashboardwsdl#JsonDataGuardarDashboard', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Guardar Dashboard'// Documentaci�n
	);
	
	$server->service($HTTP_RAW_POST_DATA);
?>