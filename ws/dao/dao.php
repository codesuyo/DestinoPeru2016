<?php
	include_once('../UTIL/globals.php');
	include_once('../UTIL/dbmanager.php');

	Class Dao{
	
		public function validLogin($usuario,$password){
			$sql = "CALL sp_login('$usuario','$password')";
			$db = new dbmanager();
			$result = $db->executeQuery($sql);
			$row = mysqli_num_rows($result);
			mysqli_free_result($result);
			return $row; 
		}
		
		public function optionDashboard(){
			$sql = "CALL sp_infoDashb()";
			$db = new dbmanager();
			$result = $db->executeQuery($sql);
			$data.='[';
			$i=0;
			while ($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
				if($i==0){}else{$data.=',';}
				$data.= '{"id_dashboard":'.$row['id_dashboard'].',';
				$data.= '"nombre":"'.$row['nombre_dashboard'].'",';
				$data.= '"estado":"'.$row['estado'].'"}';
				$i++;
			}
			$data.=']';
			return $data; 
		}
		
		public function widget_Dash($id_dashboard){
			$sql = "CALL sp_widDash('$id_dashboard')";
			$db = new dbmanager();
			$result = $db->executeQuery($sql);
			$data.='{"widgets":[';
			$i=0;
			while ($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
				if($i==0){}else{$data.=',';}
				$data.= '{"id_widget":'.$row['id_reporte'].'}';
				$i++;
			}
			$data.=']}';
			return $data; 
		}
		
		public function change_select($id_dash){
			$sql = "CALL sp_chanSel($id_dash)";
			$db = new dbmanager();
			$db->executeQuery($sql);
			return 1; 
		}
		
		public function change_name($name_dash,$id_dash){
			$sql = "CALL sp_changeNameD('$name_dash',$id_dash)";
			$db = new dbmanager();
			$db->executeQuery($sql);
			return 1; 
		}
		
		public function infoWidget($id){
			$sql = "CALL sp_infoW('$id')";
			$db = new dbmanager();
			$result = $db->executeQuery($sql);
			$data.='{';
			$row=mysqli_fetch_array($result,MYSQL_ASSOC);
			$data.= '"info":"'.$row['desc_reporte'].'"}';
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