<?php
session_start();
include_once '../controller/include/config.php';
$result_events = "SELECT id, id_usuario, title, cli_cli, color, start, end, sala FROM events WHERE sala ='atend_tpc'";
$resultado_events = mysqli_query($conn, $result_events);
$permissoes = 'SELECT * FROM permissoes WHERE id_usuario ='.$_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset='utf-8' />
		<title>Agendamento de Salas </title>
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<link href='css/fullcalendar.min.css' rel='stylesheet' />
		<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
		<link href='css/personalizado.css' rel='stylesheet' />
        <script src='js/personalizado.js'></script>
        <script src='js/jquery.min.js'></script>
		<script src='js/bootstrap.min.js'></script>
		<script src='js/moment.min.js'></script>
		<script src='js/fullcalendar.min.js'></script>
		<script src='locale/pt-br.js'></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
        <script src="js/popper.min.js"></script>
		
						<?php
							
							if($_SESSION['nivel']==0){
						
								$navLinks = "true";// can click day/week names to navigate views
								$editable = "true";
								$eventLimit = "true"; // allow "more" link when too many events
						
							}else{
						
								$navLinks = "false"; // can click day/week names to navigate views
								$editable = "false";
								$eventLimit = "false"; // allow "more" link when too many events

						
							}
		
						?>
		
		
		<script>
			var data = new Date(); 
			$(document).ready(function() {
				$('#calendar').fullCalendar({
					//Limite hour
				    minTime: "09:00:00",
				    maxTime: "22:00:00",
					
					//restricting available dates to 1 moths in future
					viewRender: function(view,element) {
						var now = new Date();
						var end = new Date();
						end.setMonth(now.getMonth()+1); //Adjust as needed ( now.getMonth()+2 )

						if ( end < view.end) {
							$("#calendar .fc-next-button").hide();
							return false;
						}
						else {
							$("#calendar .fc-next-button").show();
						}

						if ( view.start < now) {
							$("#calendar .fc-prev-button").hide();
							return false;
						}
						else {
							$("#calendar .fc-prev-button").show();
						}
					},
					
					header: {
						left: 'prev,next,today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay,listWeek'
						
					},
				
					defaultDate: data,
						
					navLinks: '<?php echo $navLinks; ?>', // can click day/week names to navigate views
					editable: '<?php echo $editable; ?>',
					eventLimit: '<?php echo $eventLimit; ?>', // allow "more" link when too many events
					
					defaultView: 'agendaWeek',
					
					eventClick: function(event) {
						
						$('#visualizar #id').text(event.id);
						$('#visualizar #id').val(event.id);
						$('#visualizar #id_usuario').text(event.id_usuario);
						$('#visualizar #id_usuario').val(event.id_usuario);
						$('#visualizar #title').text(event.cli_cli);
						$('#visualizar #cli_cli').val(event.cli_cli);
						$('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
						$('#visualizar #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
						$('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
						$('#visualizar #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
						$('#visualizar #color').val(event.color);
						$('#visualizar').modal('show');
						return false;

					},
					
					overlap: false,
					selectable: true,
					selectHelper: true,
					select: function(start, end){
						$('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
						$('#cadastrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
						$('#cadastrar').modal('show');						
					},
					events: [
						<?php
                            while ($row_events = mysqli_fetch_array($resultado_events)) {
                                ?>
								{
								id: '<?php echo $row_events['id']; ?>',
								id_usuario: '<?php echo $row_events['id_usuario']; ?>',
								id_u: '<?php $row_events['id_usuario']; ?>',
								title: '<?php echo $row_events['cli_cli'] . " (" .$row_events['title'] . ")"; ?>',
								cli_cli: '<?php echo $row_events['cli_cli']; ?>',
								start: '<?php echo $row_events['start']; ?>',
								end: '<?php echo $row_events['end']; ?>',
								color: '<?php echo $row_events['color']; ?>',
								
								},
						
//							console.log("acesso");
						<?php
                            }
						?>

					],
				});
				
				
				
			});
			
			//Mascara para o campo data e hora
			function DataHora(evento, objeto){
				var keypress=(window.event)?event.keyCode:evento.which;
				campo = eval (objeto);
				if (campo.value == '00/00/0000 00:00:00'){
					campo.value=""
				}
			 
				caracteres = '0123456789';
				separacao1 = '/';
				separacao2 = ' ';
				separacao3 = ':';
				conjunto1 = 2;
				conjunto2 = 5;
				conjunto3 = 10;
				conjunto4 = 13;
				conjunto5 = 16;
				if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
					if (campo.value.length == conjunto1 )
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto2)
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto3)
					campo.value = campo.value + separacao2;
					else if (campo.value.length == conjunto4)
					campo.value = campo.value + separacao3;
					else if (campo.value.length == conjunto5)
					campo.value = campo.value + separacao3;
				}else{
					event.returnValue = false;
				}
			}
		</script>
	</head>
	<body>
		<!--<div class="container">
			<div class="page-header">
				<h3 style='text-align:center;'>Agende sua consulta selecionando uma data</h3>
			</div>-->
			<?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
		
			
				<?php

						
						if($_SESSION['sala_atend_tpc']){
							$calendar = 'calendar';
						}

		
				
			?>
			<div id='<?php echo $calendar ?>'></div>

		<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Dados do Agendamento</h4>
					</div>
					<div class="modal-body">
						<div class="visualizar">
							<dl class="dl-horizontal">
								<dt>ID do Agendamento</dt>
								<dd id="id"></dd>
								<dt>ID do Usuario</dt>
								<dd id="id_usuario"></dd>
								<dt>Descrição</dt>
								<dd id="title"></dd>
								<dt>Inicio</dt>
								<dd id="start"></dd>
								<dt>Fim</dt>
								<dd id="end"></dd>
							</dl>
							
							<?php
							if($_SESSION['nivel']==0){
							?>
							
							<button class="btn btn-canc-vis btn-warning">Editar</button>
							<button class="btn btn-data-confirm btn-danger">Apagar</button>
							
							<?php
							}
							?>
							
							
						</div>
						<div class="form">
							<form class="form-horizontal" method="POST" action="proc_edit_evento.php">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="cli_cli" id="cli_cli" placeholder="Cliente" required>
										<input type="hidden" name="color" value="#FF00FF">
										<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id'];?>">
									</div>
								</div>
<!--
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
											<option value="">Selecione</option>			
											<option style="color:#FFD700;" value="#FFD700">Amarelo</option>
											<option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
											<option style="color:#FF4500;" value="#FF4500">Laranja</option>
											<option style="color:#8B4513;" value="#8B4513">Marrom</option>	
											<option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
											<option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
											<option style="color:#A020F0;" value="#A020F0">Roxo</option>
											<option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
											<option style="color:#228B22;" value="#228B22">Verde</option>
											<option style="color:#8B0000;" value="#8B0000">Vermelho</option>
										</select>
									</div>
								</div>
-->
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
									</div>
								</div>
								<input type="hidden" class="form-control" name="id" id="id">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="button" class="btn btn-canc-edit btn-primary">Cancelar</button>
										<button type="submit" class="btn btn-warning">Salvar Alterações</button>
									</div>
								</div>
								<input type="hidden" name="sala" id="sala" value="atend_tpc">
							</form>
							
						
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Cadastrar Agendamento</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="POST" action="proc_cad_evento.php">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Coworker</label>
								<div class="col-sm-10">
									<?php echo $_SESSION['nome'];?>
										<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id'];?>">
										<input type="hidden" name="title" value="<?php echo $_SESSION['nome'];?>">
										<input type="hidden" name="color" value="#FF00FF">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="cli_cli" id="cli_cli" value=" ">
								</div>
							</div>
<!--
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
								<div class="col-sm-10">
									<select name="color" class="form-control" id="color">
										<option value="lime">Selecione</option>			
										<option style="color:#FFD700;" value="#FFD700">Amarelo</option>
										<option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
										<option style="color:#FF4500;" value="#FF4500">Laranja</option>
										<option style="color:#8B4513;" value="#8B4513">Marrom</option>	
										<option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
										<option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
										<option style="color:#A020F0;" value="#A020F0">Roxo</option>
										<option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>										
										<option style="color:#228B22;" value="#228B22">Verde</option>
										<option style="color:#8B0000;" value="#8B0000">Vermelho</option>
									</select>
								</div>
							</div>
-->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)" readonly="true">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)"readonly="true">
									<input type="hidden" name="sala" id="sala" value="atend_tpc">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success">Cadastrar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<script>
			$('.btn-canc-vis').on("click", function() {
				$('.form').slideToggle();
				$('.visualizar').slideToggle();
			});
			$('.btn-canc-edit').on("click", function() {
				$('.visualizar').slideToggle();
				$('.form').slideToggle();
			});
            //ainda em construção - opção 1
            $(document).ready(function(){
                $('.btn-data-confirm').click(function(ev){
                    var href = $(this).attr('href');
                    if(!$('#confirm-delete').length){
                        $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK" href="proc_apagar_evento.php?id='+$("#id").val()+'&sala='+$("#sala").val()+'">Apagar</a></div></div></div></div>');
                    }
                    $('#dataComfirmOK').attr('href', href);
                    $('#confirm-delete').modal({show: true});
                    return false;

                });
            });
		</script>
	</body>
</html>