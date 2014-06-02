<?php
 
session_start();
require'../Connections/conexao.php';
?>

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
  $updateSQL = sprintf("UPDATE cliente SET `data`=%s, login=%s, cliente=%s, apelido=%s, endereco=%s, bairro=%s, municipio=%s, local=%s, cpf_titular=%s, cnpj=%s, cpf_procu=%s, procuracao=%s, aniversario=%s, telefone=%s, email=%s,status=%s WHERE id_cliente=%s",
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['apelido'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['local'], "text"),
                       GetSQLValueString($_POST['cpf_titular'], "text"),
                       GetSQLValueString($_POST['cnpj'], "text"),
                       GetSQLValueString($_POST['cpf_procu'], "text"),
                       GetSQLValueString($_POST['procuracao'], "text"),
                       GetSQLValueString($_POST['aniversario'], "date"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['id_cliente'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_clien = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_clien = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_clien = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexao) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerenciador Despachante</title>
<style type="text/css">
<!--
body {
	background-image: url(img/pat_03.png);
}
-->
</style>
<link rel="stylesheet" type="text/css" href="css/venci.css" />
<link rel="stylesheet" type="text/css" href="classes.css" />
</head>

<body onUnload="window.opener.location.reload()">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Situa&ccedil;&atilde;o: </td>
      <td> <input type="radio" name="status" id="status" value="Avisado" />
        </label>
        Avisado
        </div>
        <br />
        <input type="radio" name="status" id="status" value="Não Atende" />
        </label>
        N&atilde;o atende <br />
        <input type="radio" name="status" id="status" value="Fora de Área" />
        </label>
        Fora de &Aacute;rea
        </div>
        <br />
        <input type="radio" name="status" id="status" value="Ausente" />
        </label>
Ausente
</div>
<br />
<input type="radio" name="status" id="status" value="Caixa postal" />
</label>
Caixa Postal
</div>
<br />
<input type="radio" name="status" id="status" value="Enviou email/sms" />
</label>
Enviou eamil/sms
</div>
<br />
<input type="radio" name="status" id="status" value="Viajando" />
</label>
Viajando
</div>
</div>
<br />
<br /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="bt2" value="Atualisar" /></td>
    </tr>
  </table>
  <input type="hidden" name="data" value="<?php echo htmlentities($row_clien['data'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="login" value="<?php echo htmlentities($row_clien['login'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="cliente" value="<?php echo htmlentities($row_clien['cliente'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="apelido" value="<?php echo htmlentities($row_clien['apelido'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="endereco" value="<?php echo htmlentities($row_clien['endereco'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="bairro" value="<?php echo htmlentities($row_clien['bairro'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="municipio" value="<?php echo htmlentities($row_clien['municipio'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="local" value="<?php echo htmlentities($row_clien['local'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="cpf_titular" value="<?php echo htmlentities($row_clien['cpf_titular'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="cnpj" value="<?php echo htmlentities($row_clien['cnpj'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="cpf_procu" value="<?php echo htmlentities($row_clien['cpf_procu'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="procuracao" value="<?php echo htmlentities($row_clien['procuracao'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="aniversario" value="<?php echo htmlentities($row_clien['aniversario'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="telefone" value="<?php echo htmlentities($row_clien['telefone'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="email" value="<?php echo htmlentities($row_clien['email'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_cliente" value="<?php echo $row_clien['id_cliente']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($clien);
?>


<?php 

$op="Atualição situação de cliente !";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
?>
