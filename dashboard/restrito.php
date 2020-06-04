<?php
	session_start();
	
	if(!isset($_SESSION['loginSession']) AND !isset($_SESSION['senhaSession'])){
		header("Location: ../index.php");
		exit;
	}
	
?>
