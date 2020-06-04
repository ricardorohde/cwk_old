<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    else
    {
        session_destroy();
        session_start(); 
    }
?>

<!DOCTYPE html>
<html>
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
	
	$sql_acesso = mysqli_query($cn,"SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'");
	while($res = mysqli_fetch_array($sql_acesso)){
	$id = $res['id'];
	$nivel = $res['nivel'];
	$nome = $res['nome'];
	$color = $res['color'];
	}
	if(mysqli_num_rows($sql_acesso) == 1){
	
		$_SESSION['loginSession'] = $login;
		$_SESSION['senhaSession'] = $senha;
		$_SESSION['id'] = $id;
		$_SESSION['nome'] = $nome;
		$_SESSION['nivel'] = $nivel;
		$_SESSION['color'] = $color;
		
		header("Location: dashboard/index.php");
	
	}else{
		
		unset($_SESSION['loginSession']);
		unset($_SESSION['senhaSession']);
		include "index.php";
		
	}

?>

</body>
</html>