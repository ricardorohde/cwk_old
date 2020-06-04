<br>
<?php
    $senha_antiga = $_POST['senha_antiga'];
    $senha_nova_a = $_POST['senha_nova_a'];
	$senha_nova_b = $_POST['senha_nova_b'];

    switch ($_REQUEST['acao']) {
        case 'cadastrar':
            $sql = "INSERT INTO professor (nome_professor, sobrenome_professor)
			VALUES ('{$nome_professor}','{$sobrenome_professor}')";

            $result = $conn->query($sql);

            if ($result == true) {
                echo "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Não foi possível cadastrar</div>";
            }
        break;
        case 'editar':
			
			if($senha_nova_a==$senha_nova_b){
				$sql = "UPDATE usuario SET
							senha='{$senha_nova_a}'
							WHERE id=".$_SESSION['id'];

				$result = $conn->query($sql);

				if ($result == true) {
					echo "<div class='alert alert-success'>Senha alterada com sucesso!</div>";
					echo "<button class='btn btn-warning' onclick=\"location.href='index.php?page=editar-usuario';\"><i class='fa fa-edit'></i> Voltar</button>";
				} else {
					echo "<div class='alert alert-danger'>Não foi possível alterar sua senha. Contate a administração.</div>";
					echo "<button class='btn btn-warning' onclick=\"location.href='index.php?page=editar-usuario';\"><i class='fa fa-edit'></i> Voltar</button>";
				}
			} else {
				echo "<div class='alert alert-danger'>Senha digitada não confere. Tente novamente</div>";
				echo "<button class='btn btn-warning' onclick=\"location.href='index.php?page=editar-usuario';\"><i class='fa fa-edit'></i> Voltar</button>";
			}
        break;
        case 'excluir':
            $sql = 'DELETE FROM professor WHERE id_professor='.$_REQUEST['id_professor'];

            $result = $conn->query($sql);

            if ($result == true) {
                echo "<div class='alert alert-success'>Excluido com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Não foi possível excluir</div>";
            }
        break;
    }
?>






