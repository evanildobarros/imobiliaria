<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');
require'../Connections/conexao.php';
 
session_start();

?>


<?php
//MX Widgets3 include


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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE veiculos SET placa=%s, renavam=%s WHERE id_veiculo=%s",
                       GetSQLValueString($_POST['placa'], "text"),
                       GetSQLValueString($_POST['renavam'], "text"),
                       GetSQLValueString($_POST['id_veiculo'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_plcads = "-1";
if (isset($_GET['id_veiculo'])) {
  $colname_plcads = $_GET['id_veiculo'];
}
mysql_select_db($database_conexao, $conexao);
$query_plcads = sprintf("SELECT * FROM veiculos WHERE id_veiculo = %s ORDER BY id_veiculo DESC", GetSQLValueString($colname_plcads, "int"));
$plcads = mysql_query($query_plcads, $conexao) or die(mysql_error());
$row_plcads = mysql_fetch_assoc($plcads);
$totalRows_plcads = mysql_num_rows($plcads);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Despachante</title>
<link rel="stylesheet" type="text/css" href="css/venci.css" />
<link rel="stylesheet" type="text/css" href="classes.css" />
<style type="text/css">
<!--
.style15 {color: #FFFFFF}
body {
	background-image: url(img/pat_03.png);
}
-->
</style>
<script src="includes/common/js/base.js" type="text/javascript"></script>
<script src="includes/common/js/utility.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="includes/wdg/classes/MaskedInput.js"></script>
<link href="includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/MaskedInput.js"></script>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body onUnload="window.opener.location.reload()">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#0033CC"><div align="left" class="style15">Nova placa</div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">Placa:</div></td>
      <td><input name="placa" class="input" id="placa" value="<?php echo htmlentities($row_plcads['placa'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" wdg:subtype="MaskedInput" wdg:mask="AAA - 9999" wdg:restricttomask="yes" wdg:type="widget"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">Renavam:</div></td>
      <td><input name="renavam" type="text" class="input" value="<?php echo htmlentities($row_plcads['renavam'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left"></div></td>
      <td><input class="bt" type="submit" value="Cadastrar"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_veiculo" value="<?php echo $row_plcads['id_veiculo']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($plcads);
?>

<?php 

$op="Adicionou nova placa !";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
?>
