<?php
//Inicio la sesi�n 
session_start(); 

if (!isset($_SESSION["autentificado"])) {
	header("Location: index.php");
	exit();
} else {
	if ($_SESSION["autentificado"] != "SI") { 
   		header("Location: index.php"); 
   		exit(); 
   	}
}

?>