<?php require_once('Connections/conexao.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



mysql_select_db($database_conexao, $conexao);
$query_cli = "SELECT * FROM cliente WHERE autorizar ='1' ";
$cli = mysql_query($query_cli, $conexao) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="css/site.css" type="text/css"  />
<head>

<title>Marcelo Imovel</title>
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
</head>

<body style="background-color:#d7d7d7">
<div class="topo">
  
  <div class="logo"><img class="img_logo" src="img/LOGO_CARRO.png" /></div>
  <div class="texto_banner">Para vo&ccedil;&ecirc; viver melhor</div>
  <div class="menu_topo"><img src="img/homme.png" /> &nbsp; Institucional &nbsp;&nbsp; Noticias &nbsp;&nbsp; Servi&ccedil;os &nbsp;&nbsp; Contatos</div>

</div>
<div class="faixa"></div>

<div class="menu"></div>
<div class="conteudo">
<div class="text_menu">Menu</div>
<div class="box_menu">&bull; Apartamento</div>
<div class="box_menu">&bull; Casa</div>
<div class="box_menu">&bull; Ch&aacute;cara</div>
<div class="box_menu">&bull; Kitnet</div>
<div class="box_menu">&bull; Loja</div>
<div class="box_menu">&bull; Pr&eacute;dio</div>
<div class="box_menu">&bull; Sala</div>
<div class="box_menu">&bull; Sitio</div>
<div class="box_menu">&bull; terreno</div>

<div class="login"><br />

&Agrave;rea Restrita
<hr />
<form id="login-form" name="form1" method="POST" action="logon.php">
					
						
							<label for="username">Usu&agrave;rio</label>
							<input type="text" name="usuario" id="usuario" placeholder="Username" value="" />
						
					
							<label for="password">Senha</label>
							<input type="password" name="senha" id="password" placeholder="Password" value="" /><br />
<br />


						
							<input type="submit" name="button" id="button" value="Enviar" />
						
					
  </form>
</div>

<div class="banner_anuncio"><span style="color:#FFFFFF;"> &times;  &times; Lan&ccedil;amentos</span></div>
<div class="banner_anuncio2">
<div id="wowslider-container1">
	<div class="ws_images"><ul>
    
 
      <?php do { ?>
        <li><img width="860" height="382" src="uploads/<?php echo $row_cli['capa']; ?>" title="<?php echo $row_cli['cpf_procu']; ?>" /></li>
        <?php } while ($row_cli = mysql_fetch_assoc($cli)); ?>
        
        
        </ul></div>


</div>

</div>


<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
</body>
</html>
<?php
mysql_free_result($cli);
?>
