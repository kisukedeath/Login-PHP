<?php 

include_once('../model/bdconexion.class.php');

Class Ejemplo
{

private $con;

function Ejemplo()
{
	$this->con = new bdconexion;
	$this->con->mensaje_insertar(true, '1');
    $this->con->mensaje_insertar(false, '2');
    $this->con->mensaje_actualizar(true, '1');
    $this->con->mensaje_actualizar(false, '2');
    $this->con->mensaje_eliminar(true, '1');   
    $this->con->mensaje_eliminar(false, '2'); 
}

function ejemplo($cadena){

	return utf8_encode($this -> con ->listar("SELECT id from tb_ejemplo where nombre like '%$cadena%'")); 

}




}




?>