<h1>Listar Serviços Contratados</h1>
<?php
include('include/config.php');

    $sql = 'SELECT * FROM usuario as a inner join usu_serv as b ON a.id = b.id_usuario inner join servicos as c ON b.id_servico = c.id WHERE id_usuario ='.$_SESSION[id];

    $result = $conn->query($sql);

    $qtd = $result->num_rows;

	

    if ($qtd > 0) {
		echo "<p>Encontrou <b>$qtd</b> resultado(s)</p>";
        echo "<table class='table table-bordered table-hover'>";
        echo '<tr>';
        echo '<th>Nome do Plano/Serviço</th>';
        echo '<th>Data da Contratação</th>';
        echo '<th>Válido Até</th>';
		echo '<th>Qtd Contratada (h/mês)</th>';
		echo '<th>Qtd Disponível (h/mês)</th>';
		echo '<th>Periodo</th>';
		echo '<th>Convenio</th>';
		echo '<th>Valor</th>';
        echo '<th>Ações</th>';
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
			$id_usu_serv = $row['b.id'];
			
			echo '<tr>';
            echo '<td>'.$row['nome'].'</td>';
			echo '<td>'.$row['data_inicio'].'</td>';
			echo '<td>'.$row['data_fim'].'</td>';
			echo '<td>'.$row['qtd'].'</td>';
			echo '<td> - </td>';
			echo '<td>'.$row['periodo'].'</td>';
			echo '<td>'.$row['convenio'].'</td>';
			echo '<td> R$ '.$row['valor_final'].',00</td>';
			
			echo "<td>
				
								<button class='btn btn-primary'><i class='fa fa-edit'></i></button>
							   </td>";
			
				date_default_timezone_set('America/Sao_Paulo'); // IMPORTANTE! Faz o PHP pegar o timezone, caso não utilize isto, ele receberá o horário do meridiano
				$data_atual = date('d-m-Y');
				$hora_atual = date('H:i:s');

				$selw = mysqli_query($cn,"SELECT * FROM events WHERE id = '$id_reserva'") or die(mysql_error());
				while($res = mysqli_fetch_array($selw)){
					$start = $res['start'];

					$data_reserva = substr($start, 0, 10); 
					$hora_reserva = substr($start, 11, 8);


					$diferenca = strtotime($data_reserva) - strtotime($data_atual);
					$dias = floor($diferenca / (60 * 60 * 24));
					//echo "A diferença é de $dias entre as datas";

					$diferenca2 = strtotime($hora_reserva) - strtotime($hora_atual);
					$horas = floor($diferenca2 / (60 * 60));
					//echo "A diferença é de $horas entre as horas";

					echo $intervalo;
					if($dias < 1 && $horas < 3 ){
						 echo "<td>
				
								<!--<button class='btn btn-primary' onclick=\"location.href='index.php?page=editar-sala&id_sala=".$row['id_sala']."';\"><i class='fa fa-edit'></i></button>-->
							   </td>";
						
					}else{
						 echo "<td>
				
								<!--<button class='btn btn-warning' onclick=\"location.href='index.php?page=editar-agendamento&id_agendamento=".$row['id']."';\"><i class='fa fa-edit'></i> Editar</button>-->

								<button class='btn btn-danger' onclick=\"location.href='index.php?page=salvar-agendamento&acao=excluir&id_agendamento=".$row['id']."';\"><i class='fa fa-trash'></i> Excluir</button>

							   </td>";
					}
				}
           
			
			
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Não encontrou resultados';
    }


?>