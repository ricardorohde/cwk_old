<?php
    $id_agendamento = @$_REQUEST['id_agendamento'];
    $novo_inicio = @$_REQUEST['novo_inicio'];
    $novo_termino = @$_REQUEST['novo_termino'];
    $data = @$_REQUEST['data'];


    switch ($_REQUEST['acao']) {
        case 'cadastrar':
            $sql = "INSERT INTO sala (nome_sala, capacidade, pcd, tipo) 
                    VALUES ('{$nome_sala}', '{$capacidade}', '{$pcd}', '{$tipo}')";

            $result = $conn->query($sql);

            if ($result == true) {
                echo "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Não foi possível cadastrar</div>";
            }
        break;
        case 'editar':
			
			date_default_timezone_set('America/Sao_Paulo');
			$data_atual = date('Y-m-d H:i:s');
			$join_start = $data." ".$novo_inicio;
			$join_end = $data." ".$novo_termino;
			
			$sqll = "SELECT * FROM events 
            WHERE start='".$join_start."' OR end='".$join_end."'";

			$execute = mysqli_query($cnn,$sqll);
			
			$qtd = mysqli_num_rows($execute);

	

    		if ($qtd > 0 or $novo_inicio = 'x') {
                echo "<div class='alert alert-danger'>Erro. Verifique se já existe um agendamento nesse horario!</div>";
				echo "<td>
				
								<button class='btn btn-info' onclick=\"location.href='index.php?page=editar-agendamento&id_agendamento=".$id_agendamento."';\">Voltar</button>
								
							   </td>";
            } else {
                //echo "<div class='alert alert-danger'>Não foi possível cadastrar</div>";
				$sql = "UPDATE events SET
						start='$join_start',
						end='$join_end',
						status='Agendamento</br>(Alterado)',
						data_alterada='$data_atual'
						
					WHERE
						id=".$id_agendamento;

				$result = $conn->query($sql);

				if ($result == true) {
					echo "<div class='alert alert-success'>Agendamento editado com sucesso!</div>";
				} else {
					echo "<div class='alert alert-danger'>Não foi possível editar o agendamento. Entre em contato para realizar a alteração.</div>";
				}
            }

        break;
        case 'excluir':
            $sql = 'DELETE FROM events WHERE id='.$id_agendamento;

            $result = $conn->query($sql);

            if ($result == true) {
                echo "<div class='alert alert-success'>Excluido com sucesso!</div>";
				echo "<button class='btn btn-warning' onclick=\"location.href='index.php?page=listar-agendamentos';\"><i class='fa fa-edit'></i>Voltar</button>";
            } else {
                echo "<div class='alert alert-danger'>Não foi possível excluir</div>";
				
            }
        break;
    }
