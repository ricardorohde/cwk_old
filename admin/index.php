<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login de Usuário</title>
<link href="estilo_index.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div id="formulario_cadastro">
	
    	<form name="form1" id="form1" action="logar.php" method="post">
        
        	<fieldset>
            
			<legend>Login de Usuários</legend>
			<span id="spryLogin">
			<label> <h5>Login:</h5>
			  <input type="text" name="login" id="login" />
		    </label>
			<span class="textfieldRequiredMsg">Campo Obrigatório!</span></span><span id="sprySenha">
			<label> <h5>Senha:</h5>
			  <input type="password" name="senha" id="senha" />
			  </label>
			<span class="passwordRequiredMsg">Campo Obrigatório!</span></span>
			<input type="submit" name="logar" id="logar" value="Logar" class="btn" />
            
            </fieldset>
        
        </form>
    
	</div><!--CADASTRO-->

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("spryLogin", "none", {validateOn:["change"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprySenha", {validateOn:["change"]});
//-->
</script>
</body>
</html>