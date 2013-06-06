<?php 

include_once('../model/bdconexion.class.php');

Class Usuario
{

 private $con;

 function Usuario()
 {
 	$this->con = new bdconexion;
	$this->con->mensaje_insertar(true, '1');
    $this->con->mensaje_insertar(false, '2');
    $this->con->mensaje_actualizar(true, '1');
    $this->con->mensaje_actualizar(false, '2');
    $this->con->mensaje_eliminar(true, '1');   
    $this->con->mensaje_eliminar(false, '2'); 
 }

 function verificar_login($usuario,$password){

 	return utf8_encode($this -> con -> comprobar("SELECT password,usuario from usuarios where usuario = '$usuario'",$password));

 }



}





?>