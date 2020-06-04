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
	
	$sql_acesso = mysqli_query($cn,"SELECT * FROM usuario as a INNER JOIN permissoes as b ON a.id = b.id_usuario WHERE a.login = '$login' AND a.senha = '$senha'");
	while($res = mysqli_fetch_array($sql_acesso)){
	$id = $res['id'];
	$nivel = $res['nivel'];
	$nome = $res['nome'];
	$color = $res['color'];
	
	$escritorio_virtual = $res['escritorio_virtual'];
	$coworking = $res['coworking'];
	$sala_privativa = $res['sala_privativa'];
	$sala_atend_tpc = $res['sala_atend_tpc'];
	$sala_atend_exec = $res['sala_atend_exec'];
	$sala_atend_comp = $res['sala_atend_comp'];
	$sala_reuniao = $res['sala_reuniao'];
	$auditorio = $res['auditorio'];
	
	}
	if(mysqli_num_rows($sql_acesso) == 1){
	
		$_SESSION['loginSession'] = $login;
		$_SESSION['senhaSession'] = $senha;
		$_SESSION['id'] = $id;
		$_SESSION['nome'] = $nome;
		$_SESSION['nivel'] = $nivel;
		$_SESSION['color'] = $color;
		
		$_SESSION['escritorio_virtual'] = $escritorio_virtual;
		$_SESSION['coworking'] = $coworking;
		$_SESSION['sala_privativa'] = $sala_privativa;
		$_SESSION['sala_atend_tpc'] = $sala_atend_tpc;
		$_SESSION['sala_atend_exec'] = $sala_atend_exec;
		$_SESSION['sala_atend_comp'] = $sala_atend_comp;
		$_SESSION['sala_reuniao'] = $sala_reuniao;
		$_SESSION['auditorio'] = $auditorio;
		
		header("Location: dashboard/index.php");
	
	}else{
		
		unset($_SESSION['loginSession']);
		unset($_SESSION['senhaSession']);
		include "index.php";
		
	}

?>

</body>
</html>