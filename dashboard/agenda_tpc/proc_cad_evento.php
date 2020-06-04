<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//Incluir conexao com BD
include_once 'conexao.php';

$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$sala = filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_STRING);
$cli_cli = filter_input(INPUT_POST, 'cli_cli', FILTER_SANITIZE_STRING);

//var_dump($sala);

if (!empty($id_usuario) && !empty($title) && !empty($color) && !empty($start) && !empty($end) && !empty($sala) && !empty($cli_cli)) {
    //Converter a data e hora do formato brasileiro para o formato do Banco de Dados

    $data = explode(' ', $start);
    list($date, $hora) = $data;
    $data_sem_barra = array_reverse(explode('/', $date));
    $data_sem_barra = implode('-', $data_sem_barra);
    $start_sem_barra = $data_sem_barra.' '.$hora;

    $data = explode(' ', $end);
    list($date, $hora) = $data;
    $data_sem_barra = array_reverse(explode('/', $date));
    $data_sem_barra = implode('-', $data_sem_barra);
    $end_sem_barra = $data_sem_barra.' '.$hora;

	date_default_timezone_set('America/Sao_Paulo');
	$data_atual = date('d-m-Y H:i:s');

    $result_events = "INSERT INTO events (id_usuario, title, cli_cli, color, start, end, sala, status, data_cad) VALUES ('$id_usuario','$title','$cli_cli', '$color', '$start_sem_barra', '$end_sem_barra', '$sala', 'Agendado', '$data_atual')";

    $resultado_events = mysqli_query($conn, $result_events) or die();

    //Verificar se salvou no banco de dados através "mysqli_insert_id" o qual verifica se existe o ID do último dado inserido
    if (mysqli_insert_id($conn)) {
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento Cadastrado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        
		 switch (@$_REQUEST['sala']) {
			
			case 'atend_tpc':
				header('Location: index.php');
				break;
			case 'atend_comp':
				header('Location: sala_atend_comp.php');
				break;
			case 'auditorio':
				header('Location: auditorio.php');
				break;
			case 'reuniao':
				header('Location: reuniao.php');
				break;
			case 'multiuso':
				header('Location: multiuso.php');
				break;
			case 'mastercoach':
				header('Location: mastercoach.php');
				break;
		}
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        switch (@$_REQUEST['page']) {
			
			case 'atend_tpc':
				header('Location: index.php');
				break;
			case 'atend_comp':
				header('Location: sala_atend_comp.php');
				break;
			case 'auditorio':
				header('Location: auditorio.php');
				break;
			case 'reuniao':
				header('Location: reuniao.php');
				break;
			case 'multiuso':
				header('Location: multiuso.php');
				break;
			case 'mastercoach':
				header('Location: mastercoach.php');
				break;
		}
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    switch (@$_REQUEST['page']) {
			
			case 'atend_tpc':
				header('Location: index.php');
				break;
			case 'atend_comp':
				header('Location: sala_atend_comp.php');
				break;
			case 'auditorio':
				header('Location: auditorio.php');
				break;
			case 'reuniao':
				header('Location: reuniao.php');
				break;
			case 'multiuso':
				header('Location: multiuso.php');
				break;
			case 'mastercoach':
				header('Location: mastercoach.php');
				break;
		}
}
