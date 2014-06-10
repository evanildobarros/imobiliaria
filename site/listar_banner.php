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

mysql_select_db($database_conexao, $conexao);
$query_banner = "SELECT * FROM banner ORDER BY id_banner DESC";
$banner = mysql_query($query_banner, $conexao) or die(mysql_error());
$row_banner = mysql_fetch_assoc($banner);
$totalRows_banner = mysql_num_rows($banner);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body>
<table width="885" border="0" align="center">
  <tr>
    <td width="106">Foto</td>
    <td width="144">Titulo</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td valign="top"><img src="uploads/<?php echo $row_banner['img']; ?>" width="100" height="80" /></td>
      <td valign="top"><?php echo $row_banner['titulo']; ?></td>
      <td width="503" valign="top"><?php echo $row_banner['descricao']; ?></td>
      <td width="114" valign="top"><a href="#" onclick="MM_openBrWindow('autorizar.php?id_banner=<?php echo $row_banner['id_banner']; ?>','','scrollbars=yes,resizable=yes,width=300,height=300')">Autorizar</a></td>
    </tr>
    <?php } while ($row_banner = mysql_fetch_assoc($banner)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($banner);
?>
