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


$maxRows_cli = 10;
$pageNum_cli = 0;
if (isset($_GET['pageNum_cli'])) {
  $pageNum_cli = $_GET['pageNum_cli'];
}
$startRow_cli = $pageNum_cli * $maxRows_cli;

mysql_select_db($database_conexao, $conexao);
$query_cli = "SELECT * FROM cliente Where autorizar= '1' ";
$query_limit_cli = sprintf("%s LIMIT %d, %d", $query_cli, $startRow_cli, $maxRows_cli);
$cli = mysql_query($query_limit_cli, $conexao) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);

if (isset($_GET['totalRows_cli'])) {
  $totalRows_cli = $_GET['totalRows_cli'];
} else {
  $all_cli = mysql_query($query_cli);
  $totalRows_cli = mysql_num_rows($all_cli);
}
$totalPages_cli = ceil($totalRows_cli/$maxRows_cli)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>gerenciador ímobiliario</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="WOW Slider, jquery sliders, html5 slideshow" />
	<meta name="description" content="WOWSlider created with WOW Slider, a free wizard program that helps you easily generate beautiful web slideshow" />
	<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->
</head>
<body style="background-color:#d7d7d7">
	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
    
  
      <?php do { ?>
        <li><img src="uploads/<?php echo $row_cli['capa']; ?>" title="<?php echo $row_cli['cpf_procu']; ?>" /></li>
        <?php } while ($row_cli = mysql_fetch_assoc($cli)); ?>
        
        
        </ul></div>
<div class="ws_bullets"><div>

</div></div>

	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
</body>
</html>
<?php
mysql_free_result($cli);
?>