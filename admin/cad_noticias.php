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
<script type="text/javascript" src="scripts/jquery.MultiFile.js" /></script> 
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
  <h1 align="center">Cadastrar idéias</h1></div>
<?php if(isset($_POST['cad'])){
	$ideia = $_POST['ideia'];
	$conteudo = $_POST['texto'];
	$imagem = $_FILES['thumb'];
	$categoria = $_POST['categoria'];
    $data = date("Y-m-d H:i:s");
	$palavra = $_POST['palavra'];	
	$extencoes_aceitas = array('jpg','png','gif','pjpeg','jpeg');
    $extencao_capa = strtolower(end(explode(".", $imagem['name'])));
    $capa_name = "soopoxx_".date('dmYHi')."_".md5(uniqid(rand(), true)).".jpg";

	// requisição para a função do upload juntamente com o redimensionamento //
	require_once("funcao_upload.php");
	// enviando imagem para a pasta e redimensionando //
	upload($imagem['tmp_name'], $capa_name, 800, '../uploads/noticias');
	
    $inserir = mysql_query("INSERT INTO noticias(ideia, conteudo, img_principal, data, palavra_chave, cliques,classe) VALUES ('$ideia', '$conteudo', '$capa_name', '$data', '$palavra', '1', '$classe')") or die(mysql_error());
	
	//RECEBE ULTIMO ID
	$ultimo_id_n = mysql_insert_id($cn); 
	
	 if($inserir = 0){
     echo "<div class=\"no\">Erro ao Cadastrar</div>";	
     }else{
	 echo "<div class=\"ok\">Cadastrado com sucesso!</div>";
	 }
    $id_not = mysql_insert_id();
	 $pasta = '../uploads/noticias/';
	 foreach($_FILES["imagem"]["error"] as $key => $error){

	 if($error == UPLOAD_ERR_OK){
	 $tmp_name = $_FILES["imagem"]["tmp_name"][$key];
	 $cod = date('dmy') . '-' . $_FILES["imagem"]["name"][$key];
	 $nome = $_FILES["imagem"]["name"][$key];
	 $uploadfile = $pasta . basename($cod);
	 if(move_uploaded_file($tmp_name, $uploadfile)){
	 $inse = mysql_query("INSERT INTO img_noticias (id_noticia, img_nome) VALUES ('$id_not', '$cod')");
	 }
	 }
	 }
	//foreach($categoria as $opcoes){
    $insere = mysql_query("INSERT INTO noticia_categorias(id_noticia, id_cat) VALUES ('$ultimo_id_n', '$categoria')") or die(mysql_error());
//	}
	 }
?>

<form name="cad" action="" method="post" enctype="multipart/form-data">
<label>
<p align="center"><br />Idéia</p>
<div align="center"><input type="text" name="ideia" /></div>
</label>
<label>
<p align="center"><br />Conteúdo</p>
<div align="center"><textarea name="texto"></textarea></div>
</label>
<label>
<p align="center"><br />Palavra chave</p>
<div align="center"><input type="text" name="palavra" /></div>
</label>

<label>
<p align="center"><br />Classificação</p>
<div align="center">
<select name="classe">
<option value="-1">Selecione...</option>
<?php
$sel = mysql_query("SELECT * FROM classe ORDER BY id DESC") or die(mysql_error());
while($s = mysql_fetch_array($sel)){
	
	$id_c = $s['id'];
	$classe_n = $s['classe'];
?>
<option value="<?php echo $id_c;?>"><?php echo $classe_n;?></option>
<?php
}
?>
</select>
</div>
</label>


<label>
<p align="center"><br />Categorias</p>
<div id="cats" align="left">
<?php
$sql = mysql_query("SELECT * FROM categorias ORDER BY nome ASC") or die(mysql_error());
while($res = mysql_fetch_array($sql)){
	$nome = $res['nome'];
	$id = $res['id'];
?>
<input class="check" type="checkbox" name="categoria" value="<?php echo $id;?>" /><span><?php echo $nome;?></span><br />
<?php echo ("$var \n");
}
?>
</div>
</label>
<label>
<br />
<br />
<br />
<p align="center"><br />Imagem principal</p>
<div align="center"><input type="file" name="thumb" /></div>
</label>
<br />
<label>
<p align="center"><br />Outras imagens (limite: 10 imagens)</p>
<div align="center"><input type="file" name="imagem[]" class="multi" maxlength="10" accept="jpeg|jpg|png|gif" />   
</div>
</label>
<br />
<div align="center"><input name="cad" type="submit" class="btn" value="Cadastrar" /></div>
<br />
</form>
</div><!--conteudo-->
</div><!--geral-->
</body>
</html>