<h3>Editar Agendamento #<?php echo $_REQUEST['id_agendamento'] ?></h3>
<?php
    $sql = 'SELECT * FROM usuario a 
            INNER JOIN events b
            ON a.id = b.id_usuario
            WHERE b.id='.$_REQUEST['id_agendamento'];

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
		
		$start = date('Y-m-d H:i', strtotime($row['start']));
		$start_data_reserva = substr($start, 0, 10); 
		$start_hora_reserva = substr($start, 11, 5);
		
		
		$end=$row['end'];
		$end_hora_reserva = substr($end, 11, 5);
?>
<form action="index.php?page=salvar-agendamento&acao=editar&id_agendamento=<?php echo $_REQUEST['id_agendamento']; ?>" method="POST">
	<div class="form-group">
		<label>Nome do Cliente</br><span class="card-title" style="font-size: 18pt"><?php echo $_SESSION['nome']?></span></label>
	</div>
	<div class="form-group">
		<label>Agendamento Atual</br><span class="card-title" style="font-size: 18pt">Data: <?php echo $start_data_reserva; ?> </br>Inicio: <?php echo $start_hora_reserva; ?></br> Término: <?php echo $end_hora_reserva; ?></span></label>
	</div>
	<div class="form-group">
		<label>Novo Agendamento: (Verifique dísponibilidade na agenda <a href="agenda_tpc/index.php?page=agenda_tpc" target="_blank">Clique aqui</a>)</br></br><span class="card-title" style="font-size: 18pt">Inicio:</span></label>
	<input type="hidden" name="data" value="<?php echo $start_data_reserva; ?>">
		<SELECT name="novo_inicio" class="form-control" required>
			<OPTION value="x" selected>Selecione um novo horario</OPTION>
			<OPTION value="09:00:00">09:00</OPTION>
            <OPTION value="09:30:00">09:30</OPTION>
			<OPTION value="10:00:00">10:00</OPTION>
            <OPTION value="10:30:00">10:30</OPTION>
			<OPTION value="11:00:00">11:00</OPTION>
            <OPTION value="11:30:00">11:30</OPTION>
			<OPTION value="12:00:00">12:00</OPTION>
            <OPTION value="12:30:00">12:30</OPTION>
			<OPTION value="13:00:00">13:00</OPTION>
            <OPTION value="13:30:00">13:30</OPTION>
			<OPTION value="14:00:00">14:00</OPTION>
            <OPTION value="14:30:00">14:30</OPTION>
			<OPTION value="15:00:00">15:00</OPTION>
            <OPTION value="15:30:00">15:30</OPTION>
			<OPTION value="16:00:00">16:00</OPTION>
            <OPTION value="16:30:00">16:30</OPTION>
			<OPTION value="17:00:00">17:00</OPTION>
            <OPTION value="17:30:00">17:30</OPTION>
			<OPTION value="18:00:00">18:00</OPTION>
            <OPTION value="18:30:00">18:30</OPTION>
			<OPTION value="19:00:00">19:00</OPTION>
            <OPTION value="19:30:00">19:30</OPTION>
			<OPTION value="20:00:00">20:00</OPTION>
            <OPTION value="20:30:00">20:30</OPTION>
			<OPTION value="21:00:00">21:00</OPTION>
            <OPTION value="21:30:00">21:30</OPTION>
			<OPTION value="22:00:00">22:00</OPTION>
        </SELECT>
	</div>
	<div class="form-group">
		<label><span class="card-title" style="font-size: 18pt">Término:</span></label>
		<SELECT name="novo_termino" class="form-control" required>
			<OPTION value="x" selected>Selecione um novo horario</OPTION>
			<OPTION value="09:00:00">09:00</OPTION>
            <OPTION value="09:30:00">09:30</OPTION>
			<OPTION value="10:00:00">10:00</OPTION>
            <OPTION value="10:30:00">10:30</OPTION>
			<OPTION value="11:00:00">11:00</OPTION>
            <OPTION value="11:30:00">11:30</OPTION>
			<OPTION value="12:00:00">12:00</OPTION>
            <OPTION value="12:30:00">12:30</OPTION>
			<OPTION value="13:00:00">13:00</OPTION>
            <OPTION value="13:30:00">13:30</OPTION>
			<OPTION value="14:00:00">14:00</OPTION>
            <OPTION value="14:30:00">14:30</OPTION>
			<OPTION value="15:00:00">15:00</OPTION>
            <OPTION value="15:30:00">15:30</OPTION>
			<OPTION value="16:00:00">16:00</OPTION>
            <OPTION value="16:30:00">16:30</OPTION>
			<OPTION value="17:00:00">17:00</OPTION>
            <OPTION value="17:30:00">17:30</OPTION>
			<OPTION value="18:00:00">18:00</OPTION>
            <OPTION value="18:30:00">18:30</OPTION>
			<OPTION value="19:00:00">19:00</OPTION>
            <OPTION value="19:30:00">19:30</OPTION>
			<OPTION value="20:00:00">20:00</OPTION>
            <OPTION value="20:30:00">20:30</OPTION>
			<OPTION value="21:00:00">21:00</OPTION>
            <OPTION value="21:30:00">21:30</OPTION>
			<OPTION value="22:00:00">22:00</OPTION>
        </SELECT>
	
	<div class="form-group">
		<button type="submit" class="btn btn-success">Salvar</button>
		<a class="btn btn-info" href="index.php?page=listar-agendamentos">Voltar</a>
	</div>
</form>
<?php
    } //final do if
?>