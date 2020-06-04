<?php
    $host = 'mysql.cwklinhares.com.br';
    $user = 'cwklinhares01';
    $pass = 'CwK2o0';
    $base = 'cwklinhares01';

    $conn = new mysqli($host, $user, $pass, $base);

if ($conn->connect_error) {
    die('Erro: '.$conn->connect_error);
}
