<?php

session_start();

//Incluir conexao com BD
include_once 'conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$cli_cli = filter_input(INPUT_POST, 'cli_cli', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$sala = filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_STRING);

if (!empty($id) && !empty($cli_cli) && !empty($color) && !empty($start) && !empty($end)) {
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

    $result_events = "UPDATE events SET cli_cli='$cli_cli', color='$color', start='$start_sem_barra', end='$end_sem_barra', sala='$sala' WHERE id='$id'";
    $resultado_events = mysqli_query($conn, $result_events);

    //Verificar se alterou no banco de dados através "mysqli_affected_rows"
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento editado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                switch (@$_REQUEST['sala']) {
            
            case 'atend_tpc':
                header('Location: index.php');
                break;
            case 'atend_comp':
                header('Location: sala_atendimento.php');
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
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao editar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                switch (@$_REQUEST['sala']) {
            
            case 'atend_tpc':
                header('Location: index.php');
                break;
            case 'atend_comp':
                header('Location: sala_atendimento.php');
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
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao editar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            switch (@$_REQUEST['sala']) {
            
            case 'atend_tpc':
                header('Location: index.php');
                break;
            case 'atend_comp':
                header('Location: sala_atendimento.php');
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
