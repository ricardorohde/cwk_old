<?php

include_once 'conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
    $result_events = "DELETE FROM events WHERE id='$id'";
    $resultado_events = mysqli_query($conn, $result_events);
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "<p style='color:green;'>Evento apagado com sucesso</p>";
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
        $_SESSION['msg'] = "<p style='color:red;'>Erro o evento não foi apagado com sucesso</p>";
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
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um evento</p>";
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
}
