<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Painel Administrativo</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

	include "conexao.php";
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$sql_acesso = mysql_query("SELECT * FROM login_session WHERE login = '$login' AND senha = '$senha'");
	
	if(mysql_num_rows($sql_acesso) == 1){
	
		$_SESSION['loginSession'] = $login;
		$_SESSION['senhaSession'] = $senha;
		include "painel.php";
	
	}else{
		
		unset($_SESSION['loginSession']);
		unset($_SESSION['senhaSession']);
		include "index.php";
		
	}

?>

</body>
</html>