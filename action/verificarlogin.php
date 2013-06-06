<?php  

session_start();

require('../bean/Usuario.class.php');

$login = new Usuario;

$usuario =$_POST["usuario"];
$password = $_POST["password"];

if(trim($usuario)!= "" && trim($password) !=""){

  $user = $login->verificar_login($usuario,$password);

  if($user!=''){
  	$_SESSION['usuario'] = $user;
  	header('Location: ../interfaces/bienvenido.php');
  }


}else{
	header('Location: ../index.php');
}





?>