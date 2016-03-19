<?php
include_once('globals.php');

class dbmanager{
 
 public function executeQuery($sql){
  $con = mysqli_connect(config::getBBDDServer(), config::getBBDDUser(), config::getBBDDPwd(),config::getBBDDName());
  if (!$con)
    {
     echo 'No se pudo conectar';
    }
  
  $result = mysqli_query($con,$sql);
  mysqli_close($con);
  return $result;
 }
}
?>