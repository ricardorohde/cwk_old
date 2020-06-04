<h1>Editar Perfil</h1>
<?php
    $sql = 'SELECT * FROM usuario WHERE id = '.$_SESSION['id'];

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); ?>
<form action="index.php?page=salvar-usuario&acao=editar&id=<?php echo $_SESSION['id']; ?>" method="POST">
	<div class="form-group">
		<label>Usuário</label>
		<input type="text" name="login" class="form-control" value="<?php echo $row['login']; ?>" readonly="true">
	</div>
	<div class="form-group">
		<label>Senha Antiga</label>
		<input type="password" name="senha_antiga" class="form-control" >
	</div>
	<div class="form-group">
		<label>Nova Senha</label>
		<input type="password" name="senha_nova_a" class="form-control" >
	</div>
	<div class="form-group">
		<label>Nova Senha Novamente</label>
		<input type="password" name="senha_nova_b" class="form-control">
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Confirmar</button>
	</div>
</form>
<?php
    } //fim do if
?>