<?php
include 'restrito.php';
include '../conexao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="view/img/favicon.ico" />
	<link rel="icon" type="image/png" href="view/img/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sistema de Agendamento Coworking Linhares</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />


    <meta name="description" content="Sistema de Agendamento de Salas - UDF">

	<!-- Bootstrap CSS     -->
	<link href="view/css/bootstrap.min.css" rel="stylesheet" />

	<!--  Dashboard CSS  -->
	<link href="view/css/material-dashboard.css" rel="stylesheet" />

	<!--  CSS Demo  -->
	<link href="view/css/demo.css" rel="stylesheet" />

	<!--  Fonts e icons  -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="../../../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
	<?php
$id = $_SESSION['id'];
$sel = mysqli_query($cn,"SELECT * FROM usuario as a inner join permissoes as b ON a.id = b.id_usuario WHERE a.id = '$id'") or die(mysql_error());
while($res = mysqli_fetch_array($sel)){
	$n = $res['nome'];
	$escritorio_virtual = $res['escritorio_virtual'];
	$coworking = $res['coworking'];
	$sala_privativa = $res['sala_privativa'];
	$sala_atend_tpc = $res['sala_atend_tpc'];
	$sala_atend_exec = $res['sala_atend_exec'];
	$sala_atend_comp = $res['sala_atend_comp'];
	$sala_reuniao = $res['sala_reuniao'];
	$auditorio = $res['auditorio'];
	$multiuso = $res['multiuso'];
	$mastercoach = $res['mastercoach'];
?>
	<div class="wrapper">
	    <div class="sidebar" data-active-color="blue" data-background-color="white" data-image="view/img/sidebar-2.jpg">

		    <div class="logo">

		        <a href="index.php" class="simple-text">
                    <img src="view/img/logo_cwk.png">
		        </a>
		    </div>

		    <div class="logo logo-mini">
				<a href="index.php" class="simple-text">
                    <img src="view/img/favicon.ico" width="36" height="36">
				</a>
			</div>


		    <div class="sidebar-wrapper">
		        <div class="user">
							<?php
								if($_SESSION['nivel']==0){
							?>
		                   <div class="info">
								<a data-toggle="collapse" href="#dados" class="collapsed">
									<?php echo $n;?> (Admin)
									<b class="caret"></b>
								</a>
							   <div class="collapse" id="dados">
									<ul class="nav">
										<li><a href="#">CRM</a></li>
										<li><a href="#">Gerenciar Clientes</a></li>
										<li><a href="#">Gerenciar Permissões</a></li>
										<li><a href="../sair.php">Sair</a></li>
									</ul>
								</div>
							</div>
							<?php
								}else{
							?>
		                     <div class="photo">
		               			 <img src="view/img/avatar.jpg" />
		           			 </div>
								
							<div class="info">
								<a data-toggle="collapse" href="#dados" class="collapsed">
									<?php echo $n;?>
									<b class="caret"></b>
								</a>
							   <div class="collapse" id="dados">
									<ul class="nav">
										<li><a href="index.php?page=listar-usuario">Meu Perfil</a></li>
										<li><a href="index.php?page=editar-usuario">Trocar Senha</a></li>
										<li><a href="index.php?page=listar-servicos">Serviços Contratados</a></li>
										<li><a href="../sair.php">Sair</a></li>
									</ul>
								</div>
							</div>
							<?php
								}
							?>
		           
		            
		        </div>
		        <ul class="nav">
					<!--<li class="active">
		                <a href="evento/index.php" target="_blank">
		                    <i class="material-icons">date_range</i>
		                    <p>Planos e Serviços</p>
		                </a>
		            </li>-->
					

				   <?php
						if($_SESSION['nivel']==0){
					?>
					<!--<li><p style="margin: 20px auto 20px 65px">Serviços:</p></li>-->
					<?php
						}else{
					?>
					<li style="text-align: center"><p>Serviços Contratados:</p></li>
					<li style="text-align: center"  class="active"><a href="index.php?page=listar-agendamentos">Histórico de Agendamentos</a></li>
					<?php
						}
	
						if($escritorio_virtual){
					?>
		            <li>
		                <a data-toggle="collapse" href="#escr_virt">
		                    <i class="material-icons">content_paste</i>
		                    <p>Escritório Virtual
		                       <b class="caret"></b>
		                    </p>
		                </a>

		                <div class="collapse" id="escr_virt">
		                    <ul class="nav">
		                        <li class="active">
		                            <a href="evento/index.php">Agenda</a>
		                        </li>
		                        <li>
		                            <a href="index.php?page=">Histórico</a>
		                        </li>
		                    </ul>
		                </div>
		            </li>
					<?php
						}
						if($coworking){
					?>
		            <li>
		                <a data-toggle="collapse" href="#cwk">
		                    <i class="material-icons">content_paste</i>
		                    <p>Coworking
		                       <b class="caret"></b>
		                    </p>
		                </a>

		                <div class="collapse" id="cwk">
		                    <ul class="nav">
		                        <li class="active">
		                            <a href="index.php?page=agenda_tpc">Agenda</a>
		                        </li>
		                        <li>
		                            <a href="index.php?page=list-sala">Lista</a>
		                        </li>
		                    </ul>
		                </div>
		            </li>
					<?php
						}
						if($sala_privativa){
					?>
		            <li>
		                <a data-toggle="collapse" href="#cwk_fixo">
		                    <i class="material-icons">content_paste</i>
		                    <p>Coworking Fixo
		                       <b class="caret"></b>
		                    </p>
		                </a>

		                <div class="collapse" id="cwk_fixo">
		                    <ul class="nav">
		                        <li class="active">
		                            <a href="index.php?page=cad-sala">Cadastrar</a>
		                        </li>
		                        <li>
		                            <a href="index.php?page=list-sala">Listar</a>
		                        </li>
		                    </ul>
		                </div>
		            </li>
					<?php
						}
						if($sala_atend_tpc){
					?>
					<li>
		                <a data-toggle="collapse" href="#tpc">
		                    <i class="material-icons">apps</i>
		                    <p>Sala de Atend. TPC
		                       <b class="caret"></b>
		                    </p>
		                </a>

		                <div class="collapse" id="tpc">
		                    <ul class="nav">
		                        <li class="active">
		                            <a href="index.php?page=agenda_tpc">Agenda</a>
		                        </li>
<!--
		                        <li>
		                            <a href="index.php?page=listar-agendamentos">Histórico</a>
		                        </li>
-->
		                    </ul>
		                </div>
		            </li>
					<?php
						}
						if($sala_atend_exec){
					?>
					<li>
		                <a data-toggle="collapse" href="#exec">
		                    <i class="material-icons">apps</i>
		                    <p>Sala Aten. Executivo
		                       <b class="caret"></b>
		                    </p>
		                </a>

		                <div class="collapse" id="exec">
		                    <ul class="nav">
		                        <li class="active">
		                            <a href="index.php?page=cad-sala">Cadastrar</a>
		                        </li>
		                        <li>
		                            <a href="index.php?page=list-sala">Listar</a>
		                        </li>
		                    </ul>
		                </div>
		            </li>
					<?php
						}
						if($sala_atend_comp){
					?>
					<li>
		                <a data-toggle="collapse" href="#comp">
		                    <i class="material-icons">apps</i>
		                    <p>Sala de Atendimento
		                       <b class="caret"></b>
		                    </p>
		                </a>

		                <div class="collapse" id="comp">
		                    <ul class="nav">
		                        <li class="active">
		                            <a href="index.php?page=agenda_comp">Agendar</a>
		                        </li>
<!--
		                        <li>
		                            <a href="index.php?page=listar-agendamentos">Histórico</a>
		                        </li>
-->
		                    </ul>
		                </div>
		            </li>
					<?php
						}
						if($sala_reuniao){
					?>
					<li>
		                <a data-toggle="collapse" href="#reuniao">
		                    <i class="material-icons">apps</i>
		                    <p>Sala de Reunião
		                       <b class="caret"></b>
		                    </p>
		                </a>

		                <div class="collapse" id="reuniao">
		                    <ul class="nav">
                                <li class="active">
                                    <a href="index.php?page=agenda_reuniao">Agendar</a>
                                </li>
		                        <li>
		                            <a href="index.php?page=cad-sala">Cadastrar</a>
		                        </li>
		                        <li>
		                            <a href="index.php?page=list-sala">Listar</a>
		                        </li>
		                    </ul>
		                </div>
		            </li>
					<?php
						}
						if($auditorio){
					?>
                    <li>
                        <a data-toggle="collapse" href="#auditorio">
                            <i class="material-icons">widgets</i>
                            <p>Auditório 
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse" id="auditorio">
                            <ul class="nav">
                                <li class="active">
                                    <a href="index.php?page=auditorio">Agendar</a>
                                </li>
                            </ul>
                        </div>
                    </li>
					<?php
						}
						// if($multiuso){
					?>
<!--                     <li>
                        <a data-toggle="collapse" href="#multiuso">
                            <i class="material-icons">widgets</i>
                            <p>Multiuso 
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse" id="multiuso">
                            <ul class="nav">
                                <li class="active">
                                    <a href="index.php?page=multiuso">Agendar</a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
					<?php
						// }
						// if($mastercoach){
					?>
<!--                     <li>
                        <a data-toggle="collapse" href="#mastercoach">
                            <i class="material-icons">widgets</i>
                            <p>Master Coach 
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse" id="mastercoach">
                            <ul class="nav">
                                <li class="active">
                                    <a href="index.php?page=mastercoach">Agendar</a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
					<?php
						// }
					?>
		        </ul>
		    </div>
		</div>
<?php
}
?>
	    <div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
			    <div class="container-fluid">
			        <div class="navbar-minimize">
			            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
			                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
			                <i class="material-icons visible-on-sidebar-mini">view_list</i>
			            </button>
			        </div>
			        <div class="navbar-header">
			            <button type="button" class="navbar-toggle" data-toggle="collapse">
			                <span class="sr-only">Alternar Navegação</span>
			                <span class="icon-bar"></span>
			                <span class="icon-bar"></span>
			                <span class="icon-bar"></span>
			            </button>
			            <a class="navbar-brand" href="#"> Painel Administrativo </a>
			        </div>
			        <div class="collapse navbar-collapse">
			            <ul class="nav navbar-nav navbar-right">
			                
			                <li class="dropdown">
			                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			                        <i class="material-icons">notifications</i>
			                        <span class="notification">1</span>
			                        <p class="hidden-lg hidden-md">
			                            Notificação
			                            <b class="caret"></b>
			                        </p>
			                    </a>
			                    <ul class="dropdown-menu">
			                        <li><a href="#">Novos Eventos Agendados</a></li>
			                    </ul>
			                </li>
			                <li>
			                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
			                       <i class="material-icons">person</i>
			                       <p class="hidden-lg hidden-md">Perfil</p>
			                    </a>
			                </li>

			                <li class="separator hidden-lg hidden-md"></li>
			            </ul>

			            <form class="navbar-form navbar-right" role="search">
			                <div class="form-group form-search is-empty">
			                    <input type="text" class="form-control" placeholder="Pesquisar">
			                    <span class="material-input"></span>
			                </div>
			                <button type="submit" class="btn btn-white btn-round btn-just-icon">
			                    <i class="material-icons">search</i><div class="ripple-container"></div>
			                </button>
			            </form>
			        </div>
			    </div>
			</nav>

			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card" style="margin: -15px 10px">
								<div class="card-header card-header-icon" data-background-color="green">
									<i class="material-icons">date_range</i>
								</div>
								<div class="card-content">
									<h4 class="card-title">Agendamento de Salas - Coworking Linhares</h4>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <?php
                                                
                                                switch (@$_REQUEST['page']) {
                                                    case 'cad-professor':
                                                        include 'controller/cadastrar-professor.php';
                                                        break;
                                                    case 'listar-usuario':
                                                        include 'controller/listar-usuario.php';
                                                        break;
													case 'agenda_tpc':
														echo '<iframe src="agenda_tpc/index.php" class="col-md-11" style="height:600px" frameborder="0"></iframe>';
														break;
													case 'agenda_comp':
														echo '<iframe src="agenda_tpc/sala_atendimento.php" class="col-md-11" style="height:600px" frameborder="0"></iframe>';
														break;
													case 'agenda_reuniao':
														echo '<iframe src="agenda_tpc/reuniao.php" class="col-md-11" style="height:600px" frameborder="0"></iframe>';
														break;
													case 'multiuso':
														echo '<iframe src="agenda_tpc/multiuso.php" class="col-md-11" style="height:600px" frameborder="0"></iframe>';
														break;
													case 'mastercoach':
														echo '<iframe src="agenda_tpc/mastercoach.php" class="col-md-11" style="height:600px" frameborder="0"></iframe>';
														break;
                                                    case 'salvar-usuario':
                                                        include 'controller/salvar-usuario.php';
                                                        break;
                                                    case 'editar-usuario':
                                                        include 'controller/editar-usuario.php';
                                                        break;
                                                    case 'cad-sala':
                                                        include 'controller/cadastrar-sala.php';
                                                        break;
                                                    case 'listar-agendamentos':
                                                        include 'controller/listar-agendamentos.php';
                                                        break;
                                                    case 'salvar-agendamento':
                                                        include 'controller/salvar-agendamento.php';
                                                        break;
                                                    case 'editar-agendamento':
                                                        include 'controller/editar-agendamento.php';
                                                        break;
                                                    case 'listar-servicos':
                                                        include 'controller/listar-servicos.php';
                                                        break;
                                                    case 'list-disciplina':
                                                        include 'controller/listar-disciplina.php';
                                                        break;
                                                    case 'salvar-disciplina':
                                                        include 'controller/salvar-disciplina.php';
                                                        break;
                                                    case 'editar-disciplina':
                                                        include 'controller/editar-disciplina.php';
                                                        break;
													case 'auditorio':
                                                        echo '<iframe src="agenda_tpc/auditorio.php" class="col-md-11" style="height:600px" frameborder="0"></iframe>';
                                                        break;
                                                    case 'cad-evento':
                                                        include 'evento.php';
                                                        break;
                                                    default:
                                                        echo '<iframe src="agenda_tpc/home.php" class="col-md-11" style="height:600px" frameborder="0"></iframe>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

								</div>
							</div>
						</div>
					</div>

			<footer class="footer">
			    <div class="container-fluid">
			        <p class="copyright pull-right">
			            Agendamento de Salas - Coworking Linhares &copy; <script>document.write(new Date().getFullYear())</script>
                        Desenvolvido por Uellington Damazio
			        </p>
			    </div>
			</footer>
		</div>
	</div>

	<div class="fixed-plugin">
	    <div class="dropdown show-dropdown">
	        <a href="#" data-toggle="dropdown">
			<i class="fa fa-cog fa-3x fa-fw" aria-hidden="true"></i>
			<span class="sr-only">Ajustes</span>
	        </a>
	        <ul class="dropdown-menu">
				<li class="header-title"> Cor do Menu </li>
	            <li class="adjustments-line">
	                <a href="javascript:void(0)" class="switch-trigger active-color">
	                    <div class="badge-colors text-center">
							<span class="badge filter badge-purple" data-color="purple"></span>
	                        <span class="badge filter badge-blue active" data-color="blue"></span>
	                        <span class="badge filter badge-green" data-color="green"></span>
	                        <span class="badge filter badge-orange" data-color="orange"></span>
	                        <span class="badge filter badge-red" data-color="red"></span>
	                        <span class="badge filter badge-rose" data-color="rose"></span>
	                    </div>
	                    <div class="clearfix"></div>
	                </a>
	            </li>
	            <li class="header-title">Cor de Fundo</li>
	            <li class="adjustments-line">
	                <a href="javascript:void(0)" class="switch-trigger background-color">
	                    <div class="text-center">
							<span class="badge filter badge-white active" data-color="white"></span>
	                        <span class="badge filter badge-black" data-color="black"></span>
	                    </div>
	                    <div class="clearfix"></div>
	                </a>
	            </li>

	            <li class="adjustments-line">
	                <a href="javascript:void(0)" class="switch-trigger">
	                    <p>Minimizar Menu</p>
	                    <div class="togglebutton switch-sidebar-mini">
	                    	<label>
	                        	<input type="checkbox" unchecked="">
	                    	</label>
	                    </div>
	                    <div class="clearfix"></div>
	                </a>
	            </li>

	            <li class="adjustments-line">
	                <a href="javascript:void(0)" class="switch-trigger">
	                    <p>Menu com Imagens</p>
	                    <div class="togglebutton switch-sidebar-image">
	                    	<label>
	                        	<input type="checkbox" checked="">
	                    	</label>
	                    </div>
	                    <div class="clearfix"></div>
	                </a>
	            </li>

	            <li class="header-title">Imagens</li>
	            <li>
	                <a class="img-holder switch-trigger" href="javascript:void(0)">
	                    <img src="view/img/sidebar-1.jpg" alt="" />
	                </a>
	            </li>
	            <li class="active">
	                <a class="img-holder switch-trigger" href="javascript:void(0)">
	                    <img src="view/img/sidebar-2.jpg" alt="" />
	                </a>
	            </li>
	            <li>
	                <a class="img-holder switch-trigger" href="javascript:void(0)">
	                    <img src="view/img/sidebar-3.jpg" alt="" />
	                </a>
	            </li>
	            <li>
	                <a class="img-holder switch-trigger" href="javascript:void(0)">
	                    <img src="view/img/sidebar-4.jpg" alt="" />
	                </a>
	            </li>
	        </ul>
	    </div>
	</div>
</body>

	<!--   Core JS Files   -->
	<script src="view/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="view/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="view/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="view/js/material.min.js" type="text/javascript"></script>
	<script src="view/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>

	<!-- Forms Validations Plugin -->
	<script src="view/js/jquery.validate.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="view/js/moment.min.js"></script>

	<!--  Charts Plugin -->
	<script src="view/js/chartist.min.js"></script>

	<!--   Sharrre Library    -->
	<script src="view/js/jquery.sharrre.js"></script>

	<!--  Plugin for the Wizard -->
	<script src="view/js/jquery.bootstrap-wizard.js"></script>

	<!--  Notifications Plugin    -->
	<script src="view/js/bootstrap-notify.js"></script>

	<!-- DateTimePicker Plugin -->
	<script src="view/js/bootstrap-datetimepicker.js"></script>

	<!-- Vector Map plugin -->
	<script src="view/js/jquery-jvectormap.js"></script>

	<!-- Sliders Plugin -->
	<script src="view/js/nouislider.min.js"></script>

	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- Select Plugin -->
	<script src="view/js/jquery.dropdown.js"></script>

	<!--  DataTables.net Plugin    -->
	<script src="view/js/jquery.datatables.js"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="view/js/sweetalert2.js"></script>

	<!--  Full Calendar Plugin    -->
	<script src="view/js/fullcalendar.min.js"></script>

	<!-- TagsInput Plugin -->
	<script src="view/js/jquery.tagsinput.js"></script>

	<!-- Dashboard javascript methods -->
	<script src="view/js/material-dashboard.js"></script>

	<!-- Dashboard methods -->
	<script src="view/js/demo.js"></script>
</html>