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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE banner SET autorizar=%s WHERE id_banner=%s",
                       GetSQLValueString($_POST['autorizar'], "text"),
                       GetSQLValueString($_POST['id_banner'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_banner = "-1";
if (isset($_GET['id_banner'])) {
  $colname_banner = $_GET['id_banner'];
}
mysql_select_db($database_conexao, $conexao);
$query_banner = sprintf("SELECT * FROM banner WHERE id_banner = %s", GetSQLValueString($colname_banner, "int"));
$banner = mysql_query($query_banner, $conexao) or die(mysql_error());
$row_banner = mysql_fetch_assoc($banner);
$totalRows_banner = mysql_num_rows($banner);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Imobiliario</title>
</head>

<body onUnload="window.opener.location.reload()"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">:</td>
      <td><input name="autorizar" type="radio" value="1" /> Autorizar<br />
        <input name="autorizar" type="radio" value="2" />
        Bloquear</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Enviar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_banner" value="<?php echo $row_banner['id_banner']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($banner);
?>
