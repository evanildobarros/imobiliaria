<?php require_once('../Connections/conexao.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO calendar_events (tipo, dia, mes, ano, cat, cliente, descricao, valor, valor2, status, vencimento, fpagamento, m, fornecedor, nota, event_start) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['dia'], "text"),
                       GetSQLValueString($_POST['mes'], "date"),
                       GetSQLValueString($_POST['ano'], "text"),
                       GetSQLValueString($_POST['cat'], "text"),
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['valor'], "text"),
                       GetSQLValueString($_POST['valor2'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['vencimento'], "text"),
                       GetSQLValueString($_POST['fpagamento'], "text"),
                       GetSQLValueString($_POST['m'], "text"),
                       GetSQLValueString($_POST['fornecedor'], "text"),
                       GetSQLValueString($_POST['nota'], "text"),
                       GetSQLValueString($_POST['event_start'], "date"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

if ($_POST){
	$m = $_POST['m'];
	$d = $_POST['d'];
	$y = $_POST['y'];
	
	$event_date = $y."-".$m."-".$d." ".$_POST["event_time_hh"].":".$_POST["event_time_mm"].":00";
	
	} else {
	$m = $_GET['m'];
	$d = $_GET['d'];
	$y = $_GET['y'];
    $month = $_POST[''];
}



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Auto escola</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Tipo:</td>
      <td><input type="text" name="tipo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Dia:</td>
      <td><input type="text" name="dia" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Mes:</td>
      <td><input type="text" name="mes" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ano:</td>
      <td><input type="text" name="ano" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Cat:</td>
      <td><input type="text" name="cat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Cliente:</td>
      <td><input type="text" name="cliente" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Descricao:</td>
      <td><input type="text" name="descricao" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Valor:</td>
      <td><input type="text" name="valor" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Valor2:</td>
      <td><input type="text" name="valor2" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Status:</td>
      <td><input type="text" name="status" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Vencimento:</td>
      <td><input type="text" name="vencimento" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fpagamento:</td>
      <td><input type="text" name="fpagamento" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">M:</td>
      <td><input type="text" name="m" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fornecedor:</td>
      <td><input type="text" name="fornecedor" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nota:</td>
      <td><input type="text" name="nota" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Event_start:</td>
      <td><input type="text" name="event_start" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
  
  <input type="text" name="m" value="<?php echo $m; ?>">
<input  type="text" name="d" value="<?php echo $d; ?>">
<input type="text" name="y" value="<?php echo $y; ?>">
  
</form>
<p>&nbsp;</p>
</body>
</html>
