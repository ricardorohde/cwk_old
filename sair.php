<?php

	session_start();
	
	unset($_SESSION['loginSession']);
	unset($_SESSION['senhaSession']);
	session_destroy();
	include "index.php";

?>