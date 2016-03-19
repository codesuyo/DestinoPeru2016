<?php

	Class Dao{
	
		public function validLogin(){
			$file = fopen("../JSON/user.json", "r") or
                die("No se pudo abrir el archivo");
			while(!feof($file)) {
				$data = fgets($file);
			}
			fclose($file);
			return $data;
		}
		
		public function optionDashboard(){
			$file = fopen("../JSON/select_dashboard.json", "r") or
                die("No se pudo abrir el archivo");
			while(!feof($file)) {
				$data = fgets($file);
			}
			fclose($file);
			return $data;
		}
		
		public function guardarDashboard($nombre_dashboard){
			$archivo = "../JSON/select_dashboard.json";
			if(file_exists($archivo) == true ){
				$file = fopen($archivo, "r") or die("No se pudo abrir el archivo");
				while(!feof($file)) {
					$data = fgets($file);
				}
				$json_array = json_decode($data,true);
				print_r($json_array);
				echo '<br>';
				$cantidad_dash = count($json_array);
				$id = $cantidad_dash + 1;
				$nuevo_dash = ',{"id": '.$id.',"nombre": "'.$nombre_dashboard.'"}]';
				$json_actual = substr($data, 0, -1);
				$json_guardar = $json_actual.$nuevo_dash;
				fclose($file);
				echo $json_actual.'<br>'.$json_guardar.'<br>';
				$file_2 = fopen($archivo, "w") or die("No se pudo abrir el archivo");
				fwrite($file_2, $json_guardar);
				fclose($file_2);
				$file_nuevo = fopen($archivo, "r") or
					die("No se pudo abrir el archivo");
				while(!feof($file_nuevo)) {
					$data_actual = fgets($file_nuevo);
				}
				fclose($file_nuevo);
			}else{
				$file_2 = fopen($archivo, "w") or die("No se pudo abrir el archivo");
				$nuevo_dash = '[{"id": 1,"nombre": "'.$nombre_dashboard.'"}]';
				fwrite($file_2, $nuevo_dash);
				fclose($file_2);
				$file_nuevo = fopen($archivo, "r") or
					die("No se pudo abrir el archivo");
				while(!feof($file_nuevo)) {
					$data_actual = fgets($file_nuevo);
				}
				fclose($file_nuevo);
			}
			
			return $data_actual;
		}
		
		public function selectLote(){
			$file = fopen("../JSON/select_lote.json", "r") or
                die("No se pudo abrir el archivo");
			while(!feof($file)) {
				$data = fgets($file);
			}
			fclose($file);
			return $data;
		}
		
		public function obtenerWidget($id_widget){
			$file = fopen("../JSON/widget_".$id_widget.".json", "r") or
                die("No se pudo abrir el archivo");
			while(!feof($file)) {
				$data = fgets($file);
			}
			fclose($file);
			return $data;
		}
	}

?>