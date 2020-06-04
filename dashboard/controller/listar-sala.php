<h1>Listar Salas</h1>
<?php
include('../conexao.php');

    $sql = 'SELECT * FROM events WHERE id_usuario="'.$_SESSION[id].'" ORDER BY start DESC';

    $result = $conn->query($sql);

    $qtd = $result->num_rows;

    if ($qtd > 0) {
        echo "<p>Encontrou <b>$qtd</b> resultado(s)</p>";
        echo "<table class='table table-bordered table-hover'>";
        echo '<tr>';
        echo '<th>#</th>';
        echo '<th>Nome do Cliente</th>';
        echo '<th>Inicio</th>';
        echo '<th>Fim</th>';
		echo '<th>Status</th>';
		echo '<th>Hora do Checkout</th>';
		echo '<th>Qtd. horas</th>';
        echo '<th>Ações</th>';
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
			$id_reserva = $row['id'];
			echo '<tr>';
            echo '<td>'.$row['id_usuario'].'</td>';
            echo '<td>'.$_SESSION[nome].'</td>';
            echo '<td>'.$row['start'].'</td>';
            echo '<td>'.$row['end'].'</td>';
			echo '<td>'.$row['status'].'</td>';
			echo '<td>'.$row['hora_checkout'].'</td>';
			echo '<td>'.$row['qtd_horas'].'</td>';
			
			
				date_default_timezone_set('America/Sao_Paulo'); // IMPORTANTE! Faz o PHP pegar o timezone, caso não utilize isto, ele receberá o horário do meridiano
				$data_atual = date('Y-m-d');
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
				
								<button class='btn btn-warning' onclick=\"location.href='index.php?page=editar-sala&id_sala=".$row['id_sala']."';\"><i class='fa fa-edit'></i> Editar</button>

								<button class='btn btn-danger' onclick=\"location.href='index.php?page=salvar-sala&acao=excluir&id_sala=".$row['id_sala']."';\"><i class='fa fa-trash'></i> Excluir</button>

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