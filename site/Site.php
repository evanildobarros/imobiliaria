<?php require('Connections/conexao.php'); ?>
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
$query_imagens = "SELECT * FROM banner where autorizar='sim' limit 5";
$imagens = mysql_query($query_imagens, $conexao) or die(mysql_error());
$row_imagens = mysql_fetch_assoc($imagens);
$totalRows_imagens = mysql_num_rows($imagens);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/stylo.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Imobiliario</title>

</head>

<body>

<div id="box">
 <div id="content">
  <div id="topo">
 
  <div id="logo"><img width="200px" height="80px" src="img/LOGO_CARRO.png" /></div>
  <div id="slogan"><span class="span01">Seu jeito</span><span class="span0"> sua casa.</span></div>
  <div id="busca"><span class="span02">Endereço:00901 Pop center - Cohab<br />
                  Contato: (98) 8800-3167 | 8867-0989<br />
                  Email: marceloimoveis@hotamil.com</span><br />
    </div>
  </div>
  <div id="menu">
  <div class="span03"> Home | Empesa | Serviços | Parceiros | Corretor On-line | Cadastre seu Imóvel | Contato </div> 
  </div>
  <div id="meio">
  <div id="sidebar-left">
  <div id="c-busca"></div>
  </div>
  <div id="sidebar-left02">
  <div id="c-busca02">ok</div>
  </div>
  
  <div id="conteudo">
  <div id="banner">
   
  <div id="wowslider-container1">
	<div class="ws_images">
   <ul>
    <?php do { ?>
<li>
 <img width="760px" height="300px" src="fotos/<?php echo $row_imagens['banner']; ?>" title="<?php echo $row_imagens['titulo']; ?>" />
   
</li>
<?php } while ($row_imagens = mysql_fetch_assoc($imagens)); ?>
</ul></div>
<div class="ws_bullets"><div>

</div></div>

	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>   
      
  
  </div>
  <div id="listar_imovel">ook</div>
  </div>

  
  </div>
  <div id="clear"></div>
 
 </div>
 </div>

</body>
</html>
<?php
mysql_free_result($imagens);


?>
