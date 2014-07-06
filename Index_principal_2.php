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
$query_cli = "SELECT * FROM cliente WHERE autorizar = '1'";
$cli = mysql_query($query_cli, $conexao) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);
?>
<!DOCTYPE html>
<html>
  <head>
<title>Index</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>


<link rel="stylesheet" href="../css/site.css" type="text/css"  />


</head>
 <body style="background-color:#d7d7d7">
  
   <div class="container-fluid td">
        <div class="row-fluid">
        <div class="span12">
        <div align="center" class="span2"><img class="img" src="img/LOGO_CARRO.png"></div>
        <div align="center" class="span6 td">Seu futuro est&aacute; em nossos planos !</div>
        <div align="center" class="span4 td2"><i class="icon-home icon-white"></i> Home | Not&iacute;cias | Servi&ccedil;os | Contatos</div>
        </div>
        </div>
   </div>
   
   <div class="container-fluid td3">
        <div class="navbar navbar-inverse">
        <div class="navbar-inner">
        <div class="container">
 
     
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      
      <a class="brand" href="#">Empreendimentos</a>
 
     
      <div class="nav-collapse collapse"></div>
 
    </div>
    </div>
    </div>
</div>

<div class="container-fluid">
<div class="row-fluid">
    <div class="span3 td4">
    <ul class="nav nav-list">
  <li class="nav-header">O que procura ?</li>
  <li class="active"><a href="#">Menu</a></li>
  <li><a href="#">Apartamentos</a></li>
  <li><a href="#">Casas</a></li>
  <li><a href="#">Condominio</a></li>
  <li><a href="#">Ch&aacute;cara</a></li>
  <li><a href="#">Salas</a></li>
  <li><a href="#">Sitio</a></li>
  <li><a href="#">Terrenos</a></li>
  ...
</ul>
    </div>
    <div class="span9 td4">

<div id="wowslider-container1">
	<div class="ws_images"><ul>
    
 
      <?php do { ?>
        <li><img  src="uploads/<?php echo $row_cli['capa']; ?>" title="<?php echo $row_cli['cpf_procu']; ?>" /></li>
        <?php } while ($row_cli = mysql_fetch_assoc($cli)); ?>
        
        
        </ul>
        
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
        </div>
  </div>
</div>

<br>

<div class="row-fluid">
   
    <div class="span3 td4">
    <img src="img/1388779344_584162051_1-Financiamento-de-Imoveis-Caixa-Economica-Iguatemi.jpg" /><br />
<img src="img/Minha-Casa-Minha-Vida-Caixa-economica-federal.png" /></div>
    <div class="span9 td6">
    <?php require_once('listas/vitrine.php'); ?>
<?php
mysql_free_result($cli);
?>    
    </div>
   
</div>

</div> 


  
  </body>
</html>