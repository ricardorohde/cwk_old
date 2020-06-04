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
  <h1 align="center">Editar idéia</h1></div>
  
<?php if(isset($_POST['cad'])){
	$id = $_GET['id'];
	$ideia = $_POST['ideia'];
	$conteudo = $_POST['texto'];
	$imagem = $_FILES['thumb'];
	$nome_img  = $imagem['tmp_name'];
	$categoria = $_POST['categoria'];
    $data = date("Y-m-d H:i:s");
	$palavra = $_POST['palavra'];
	$classe = $_POST['classe'];

	if(file_exists($nome_img)){
	$sel_img = mysql_query("SELECT * FROM noticias WHERE id = '$id'");
    $resp = mysql_fetch_assoc($sel_img);
	$img = $resp['img_principal'];
	$pasta = '../uploads/noticias';
	$deletarimg = $pasta."/".$img;
	$deletar = unlink($deletarimg);
	
	$extencoes_aceitas = array('jpg','png','gif','pjpeg','jpeg');
	$extencao_capa = strtolower(end(explode(".", $imagem['name'])));
	$capa_name = "soopoxx_".date('dmYHi')."_".md5(uniqid(rand(), true)).".jpg";
	require_once("funcao_upload.php");
	upload($imagem['tmp_name'], $capa_name, 800, '../uploads/noticias');
	}

    if(!empty($ideia)){$update = "ideia = '$ideia', ";}
	if(!empty($conteudo)){$update .= "conteudo = '$conteudo', ";}
		if(!empty($palavra_chave)){$update = "palavra_chave = '$palavra_chave', ";}
	if(!empty($classe)){$update .= "classe = '$classe', ";}
	if(!empty($nome_img)){$update .= "img_principal = '$capa_name', ";}


$inserir = mysql_query("UPDATE noticias SET $update ativo=1 WHERE id = '$id'") or die(mysql_error());
if($inserir){
		    echo '<script type="text/javascript">
			window.alert("Atualizado com sucesso!");
		    window.location="lista_noticias.php";
	        </script>';
	}else{
	}

	
	$del = mysql_query("DELETE FROM noticia_categorias WHERE id_noticia = '$id'") or die(mysql_error());
	foreach($categoria as $opcoes){
    $insere = mysql_query("INSERT INTO noticia_categorias (id_noticia, id_cat) VALUES ('$id', '$opcoes')") or die(mysql_error());
	}
}
?>

<?php
$id = $_GET['id'];
$sel = mysql_query("SELECT * FROM noticias WHERE id = '$id'")or die(mysql_error());
while($ln = mysql_fetch_array($sel)){
	$ideia = $ln['ideia'];
	$conteudo = $ln['conteudo'];
	$palavra_chave = $ln['palavra_chave'];
	$clas = $ln['classe'];
?>


<form name="cad" action="" method="post" enctype="multipart/form-data">
<label>
<p align="center"><br />Idéia</p>
<div align="center"><input type="text" name="ideia" value="<?php echo $ideia;?>" /></div>
</label>
<label>
<p align="center"><br />Conteúdo</p>
<div align="center"><textarea name="texto"><?php echo $conteudo;?></textarea></div>
</label>
<label>
<p align="center"><br />Palavra chave</p>
<div align="center"><input type="text" name="palavra_chave" value="<?php echo $palavra_chave;?>" /></div>
</label>

<label>
<p align="center"><br />Classificação</p>
<div align="center">
<select name="classe">
<?php
$seq = mysql_query("SELECT * FROM classe ORDER BY id DESC") or die(mysql_error());
while($s = mysql_fetch_array($seq)){
	
	$id_c = $s['id'];
	$classe_n = $s['classe'];
?>
<option value="<?php echo $id_c;?>" <?php if($id_c == $clas){ print "selected";} ?>><?php echo $classe_n;?></option>

<?php
}
?>
</select>
</div>
</label>


<label>
<p align="center"><br />Categorias</p>
<div id="cats" align="center">
<?php

$sql = mysql_query("SELECT * FROM categorias ORDER BY nome ASC") or die(mysql_error());
while($result 	= mysql_fetch_array($sql)){

	$nomeCat 	= $result['nome'];
	$idCat 		= $result['id'];
	
                $sqlN = sprintf("SELECT * FROM noticia_categorias WHERE id_noticia = '%s' AND id_cat = '%s' ",
                mysql_real_escape_string($id),
				mysql_real_escape_string($idCat));
                $queryN = mysql_query($sqlN);			
                while ($resN = mysql_fetch_array($queryN)){
                $catID =	$resN['id_cat'];
                }  	
	?>
<input class="check" type="checkbox" name="categoria[]" value="<?php echo $idCat;?>" <?php if($idCat == $catID){ print "checked";}?> /><span><?php echo $nomeCat;?></span><br />
<?php	
	}//fechando o primeiro while
?>
</div>
</label> 
<label>
<br />
<br />
<p align="center"><br />Imagem principal (necessário apenas se quiser alterá-la.)</p>
<div align="center"><input type="file" name="thumb" /></div>
</label>
<br />
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