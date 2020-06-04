<h1>Meu Perfil</h1>
<?php
    $sql = 'SELECT * FROM usuario
            WHERE id='.$_SESSION['id'];

    $result = $conn->query($sql);

	$qtd = $result->num_rows;

    if ($qtd > 0) {
        echo "<table class='table table-bordered table-hover'>";
        echo '<tr>';
        echo '<th>#</th>';
        echo '<th>Dados</th>';
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
			echo '<th>CPF/CNPJ</th>';
            echo '<td>'.$row['login'].'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<th>Nome</th>';
            echo '<td>'.$row['nome'].'</td>';
			echo '</tr>';
			echo '<th>Data de Nasc.</th>';
			echo '<td>'.$row['data_nasc'].'</td>';
            echo '</tr>';
			echo '<tr>';
			echo '<th>Empresa</th>';
            echo '<td>'.$row['empresa'].'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<th>Endereço</th>';
			echo '<td>'.$row['endereco'].'</td>';
            echo '</tr>';
			echo '<th>E-mail</th>';
			echo '<td>'.$row['email'].'</td>';
            echo '</tr>';
			echo '<th>Telefone</th>';
			echo '<td>'.$row['telefone'].'</td>';
            echo '</tr>';
			
			
        }
        echo '</table>';
    } else {
        echo 'Não encontrou resultados';
    }
?>