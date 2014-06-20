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
  $updateSQL = sprintf("UPDATE cliente SET cliente=%s, endereco=%s, bairro=%s, municipio=%s, `local`=%s, cpf_titular=%s, cnpj=%s, aniversario=%s, telefone=%s, email=%s WHERE id_cliente=%s",
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['local'], "text"),
                       GetSQLValueString($_POST['cpf_titular'], "text"),
                       GetSQLValueString($_POST['cnpj'], "text"),
                       GetSQLValueString($_POST['aniversario'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['id_cliente'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_cli = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_cli = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_cli = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_cli, "int"));
$cli = mysql_query($query_cli, $conexao) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Gerenciador Imobiliario</title>

            <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
</head>

<body onUnload="window.opener.location.reload()">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Cliente:</div></td>
      <td><input type="text" name="cliente" value="<?php echo htmlentities($row_cli['cliente'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Endereco:</div></td>
      <td><input type="text" name="endereco" value="<?php echo htmlentities($row_cli['endereco'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Bairro:</div></td>
      <td><input type="text" name="bairro" value="<?php echo htmlentities($row_cli['bairro'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Municipio:</div></td>
      <td><input type="text" name="municipio" value="<?php echo htmlentities($row_cli['municipio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Local:</div></td>
      <td><input type="text" name="local" value="<?php echo htmlentities($row_cli['local'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Cpf_titular:</div></td>
      <td><input type="text" name="cpf_titular" value="<?php echo htmlentities($row_cli['cpf_titular'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Cnpj:</div></td>
      <td><input type="text" name="cnpj" value="<?php echo htmlentities($row_cli['cnpj'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Aniversario:</div></td>
      <td><input type="text" name="aniversario" value="<?php echo htmlentities($row_cli['aniversario'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Telefone:</div></td>
      <td><input type="text" name="telefone" value="<?php echo htmlentities($row_cli['telefone'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Email:</div></td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_cli['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="botao" value="Atualisar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_cliente" value="<?php echo $row_cli['id_cliente']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($cli);
?>
