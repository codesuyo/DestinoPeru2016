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
	
	$server->register('JsonDataLogin', // Nombre del método
		array(), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:Dashboardwsdl', // Nombre del workspace
        'urn:Dashboardwsdl#JsonDataLogin', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Validacion de login'             // Documentación
	);
	
	$server->register('JsonDataDashboardOption', // Nombre del método
		array(), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:Dashboardwsdl', // Nombre del workspace
        'urn:Dashboardwsdl#JsonDataDashboardOption', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Option del select de dashboard'             // Documentación
	);
	
	$server->register('JsonDataGuardarDashboard', // Nombre del método
		array('nombre_dash' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:Dashboardwsdl', // Nombre del workspace
        'urn:Dashboardwsdl#JsonDataGuardarDashboard', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Guardar Dashboard'// Documentación
	);
	
	$server->service($HTTP_RAW_POST_DATA);
?>