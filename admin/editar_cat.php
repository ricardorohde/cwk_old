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
  <h1 align="center">Editar idéias</h1></div>
<?php if(isset($_POST['cad'])){
	$id = $_GET['id'];
	$cat = $_POST['categoria'];
    $inserir = mysql_query("UPDATE categorias SET nome = '$cat' WHERE id = '$id')") or die(mysql_error());
	if($inserir = 0){
    echo "<div class=\"no\">Erro ao Editar</div>";	
    }else{
	echo "<div class=\"ok\">Editado com sucesso!</div>";
	}
}
?>

<?php
$id = $_GET['id'];
$sel = mysql_query("SELECT * FROM categorias WHERE id = '$id'") or die(mysql_error());
while($res = mysql_fetch_array($sel)){
	$n = $res['nome'];
?>
<form name="cad" action="" method="post" enctype="multipart/form-data">
<label>
<p align="center"><br />Categoria</p>
<div align="center"><input type="text" name="categoria" value="<?php echo $n;?>" /></div>
</label>
<br />
<div align="center"><input name="cad" type="submit" class="btn" value="Editar" /></div>
<br />
</form>
<?php
}
?>
</div><!--conteudo-->
</div><!--geral-->
</body>
</html>