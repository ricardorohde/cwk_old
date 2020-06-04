<?php include 'conexao.php';?>
<?php include 'restrito.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: Painel Administrativo ::.</title>
<link rel="stylesheet" href="estilo.css" />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/sanfona.js"></script>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
pagebreak_separator: "<!--more-->",
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

</head>

<body>
<div id="topo"></div><!--topo-->
<div id="geral">
<?php include 'menu.php';?>
<div id="conteudo">
<div class="texto">
<h1 align="center">RESPOSTAS DESAFIO SOOPOXX</h1></div>
<br />
<div align="center">
<table width="713" border="0" align="center">
  <tr class="tabela">
    <td width="255" align="center">Rspostas</td>
    <td width="200" align="center">Idéias</td>
    <td colspan="3" align="center">Ações</td>
    </tr>
    
    <?php
	if(isset($_GET['liberar'])){
		$up = $_GET['liberar'];
        $lib = mysql_query("UPDATE responder SET status = '1' WHERE id = '$up'") or die(mysql_error());	
			if($lib){
			echo '<script type="text/javascript">
			window.alert("Comentário liberado com sucesso!");
		    window.location="lista_recados.php";
	        </script>';
	}else{
	}
	}

	?>
    
    <?php
	if(isset($_GET['excluir'])){
		$var = $_GET['excluir'];
		$del = mysql_query("DELETE FROM responder WHERE id = '$var'") or die(mysql_error());
		if($del){
			echo '<script type="text/javascript">
			window.alert("Excluído com sucesso!");
		    window.location="lista_recados.php";
	        </script>';
	}else{
	}
	}
	?>
    <?php
	$sql = mysql_query("SELECT * FROM responder WHERE status = '0' ORDER BY id DESC") or die(mysql_error());
	while($res = mysql_fetch_array($sql)){
		$id = $res['id'];
		$recado = $res['dica'];
		$id_noticia = $res['id_noticia'];
	?>
    <?php
	$sqll = mysql_query("SELECT * FROM noticias WHERE id = '$id_noticia'") or die(mysql_error());
	while($sq = mysql_fetch_array($sqll)){
		$ideia = $sq['ideia'];
	?>
  <tr>
    <td align="center" class="bg"><?php echo $recado;?></td>
    <td align="center" class="bg"><?php echo $ideia;?></td>
    <td width="72" align="center"><a href="?liberar=<?php echo $id;?>" class="edit">Liberar</a></td>
    <td width="89" align="center"><a href="edita_recado.php?id=<?php echo $id;?>" class="edit">Moderar</a></td>
    <td width="75" align="center"><a href="?excluir=<?php echo $id;?>" class="excluir">Excluir</a></td>
  </tr>
  <?php
	}
	}
	?>
</table>
<p>&nbsp;</p>
<p>___________________________________________________________________</p>
<p>&nbsp;</p>
<table width="713" border="0" align="center">
  <tr class="tabela">
    <td width="255" align="center">Respostas</td>
    <td width="200" align="center">Idéias</td>
    <td colspan="3" align="center">Ações</td>
  </tr>
  <?php
	if(isset($_GET['liberar'])){
		$up = $_GET['liberar'];
        $lib = mysql_query("UPDATE comentarios SET status = '1' WHERE id = '$up'") or die(mysql_error());	
			if($lib){
			echo '<script type="text/javascript">
			window.alert("Comentário liberado com sucesso!");
		    window.location="lista_recados.php";
	        </script>';
	}else{
	}
	}

	?>
  <?php
	if(isset($_GET['excluir'])){
		$var = $_GET['excluir'];
		$del = mysql_query("DELETE FROM comentarios WHERE id = '$var'") or die(mysql_error());
		if($del){
			echo '<script type="text/javascript">
			window.alert("Excluído com sucesso!");
		    window.location="lista_recados.php";
	        </script>';
	}else{
	}
	}
	?>
  <?php
	$sql = mysql_query("SELECT * FROM responder WHERE status = '1' ORDER BY id DESC") or die(mysql_error());
	while($res = mysql_fetch_array($sql)){
		$id = $res['id'];
		$recado = $res['dica'];
		$id_noticia = $res['id_noticia'];
	?>
  <?php
	$sqll = mysql_query("SELECT * FROM noticias WHERE id = '$id_noticia'") or die(mysql_error());
	while($sq = mysql_fetch_array($sqll)){
		$ideia = $sq['ideia'];
	?>
  <tr>
    <td align="center" class="bg"><?php echo $recado;?></td>
    <td align="center" class="bg"><?php echo $ideia;?></td>
    <td width="84" align="center"><a href="ver_comentario.php?id=<?php echo $id;?>" class="edit">Visualizar</a></td>
    <td width="89" align="center"><a href="edita_recado.php?id=<?php echo $id;?>" class="edit">Editar</a></td>
    <td width="75" align="center"><a href="?excluir=<?php echo $id;?>" class="excluir">Excluir</a></td>
  </tr>
  <?php
	}
	}
	?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
<br />
</div><!--conteudo-->
</div><!--geral-->
</body>
</html>