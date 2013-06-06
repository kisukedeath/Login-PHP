<?php 
session_start();

if(isset($_SESSION['usuario'])){
	echo 'Bienvenido, ';
	echo '<strong>'.$_SESSION['usuario'].'</strong>';
	echo '<p><a href="../action/logout.php">Logout</a></p>';
}else{
	echo '<p>Por favor logueese</p><a href="../index.php">Login</a></p>';
}


?>