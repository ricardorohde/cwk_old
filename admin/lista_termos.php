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
<h1 align="center">Listagem Termos de Uso</h1></div>
<br />
<div align="center">
<table width="650" border="0" align="center">
  <tr class="tabela">
    <td align="center">Id</td>
    <td colspan="2" align="center">Ações</td>
    </tr>
    <?php
	if(isset($_GET['excluir'])){
		$var = $_GET['excluir'];
		$del = mysql_query("DELETE FROM termos WHERE id = '$var'") or die(mysql_error());
		if($del){
			echo '<script type="text/javascript">
			window.alert("Excluído com sucesso!");
		    window.location="lista_termos.php";
	        </script>';
	}else{
	}
	}
	?>
    <?php
	$sql = mysql_query("SELECT * FROM termos ORDER BY id DESC") or die(mysql_error());
	while($res = mysql_fetch_array($sql)){
		$id = $res['id'];
	?>
  <tr>
    <td align="center" class="bg"><?php echo $id;?></td>
    <td width="84" align="center"><a href="edita_termos.php?id=<?php echo $id;?>" class="edit">Editar</a></td>
    <td width="84" align="center"><a href="?excluir=<?php echo $id;?>" class="excluir">Excluir</a></td>
  </tr>
  <?php
	}
	?>
</table>
</div>
<br />
</div><!--conteudo-->
</div><!--geral-->
</body>
</html>