<?php require_once('../Connections/conexao.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

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
  $insertSQL = sprintf("INSERT INTO acesso (usuario, senha, endereco, bairro, nome, email, telefone, chave, nascimento, rg, cpf, titulo, admissao, pis, ctps, dependente, funcao, remuneracao, filiacao, filial) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['chave'], "int"),
                       GetSQLValueString($_POST['nascimento'], "text"),
                       GetSQLValueString($_POST['rg'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['admissao'], "text"),
                       GetSQLValueString($_POST['pis'], "text"),
                       GetSQLValueString($_POST['ctps'], "text"),
                       GetSQLValueString($_POST['dependente'], "text"),
                       GetSQLValueString($_POST['funcao'], "text"),
                       GetSQLValueString($_POST['remuneracao'], "text"),
                       GetSQLValueString($_POST['filiacao'], "text"),
                       GetSQLValueString($_POST['filial'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_conexao, $conexao);
$query_chv = "SELECT * FROM chave";
$chv = mysql_query($query_chv, $conexao) or die(mysql_error());
$row_chv = mysql_fetch_assoc($chv);
$totalRows_chv = mysql_num_rows($chv);

mysql_select_db($database_conexao, $conexao);
$query_fil = "SELECT * FROM filial";
$fil = mysql_query($query_fil, $conexao) or die(mysql_error());
$row_fil = mysql_fetch_assoc($fil);
$totalRows_fil = mysql_num_rows($fil);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Imobiliario</title>
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/MaskedInput.js"></script>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body><br />
<br />

<fieldset>
<legend>Funcion&aacute;rio</legend><br />

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nome:</td>
      <td><input type="text" name="nome" value="" size="32" /></td>
      <td>Endere&ccedil;o</td>
      <td><input type="text" name="endereco" value="" size="32" /></td>
      <td>Bairro</td>
      <td><input type="text" name="bairro" value="" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Usu&aacute;rio:</td>
      <td><input type="text" name="usuario" value="" size="15" /></td>
      <td>Senha</td>
      <td><input type="password" name="senha" value="" size="15" /></td>
      <td>Chave</td>
      <td><label>
        <select name="chave" id="chave">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_chv['id']?>"><?php echo $row_chv['desc']?></option>
          <?php
} while ($row_chv = mysql_fetch_assoc($chv));
  $rows = mysql_num_rows($chv);
  if($rows > 0) {
      mysql_data_seek($chv, 0);
	  $row_chv = mysql_fetch_assoc($chv);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="6" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefone</td>
      <td><input name="telefone" id="telefone" value="" size="17" wdg:subtype="MaskedInput" wdg:mask="(98) 9999-9999" wdg:restricttomask="no" wdg:type="widget" /></td>
      <td>Email</td>
      <td colspan="3"><input type="text" name="email" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">RG</td>
      <td><input type="text" name="rg" value="" size="17" /></td>
      <td>CPF</td>
      <td><input name="cpf" id="cpf" value="" size="17" wdg:subtype="MaskedInput" wdg:mask="999.999.999-99" wdg:restricttomask="no" wdg:type="widget" /></td>
      <td>Titulo</td>
      <td><input type="text" name="titulo" value="" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">PIS</td>
      <td><input type="text" name="pis" value="" size="17" /></td>
      <td>CTPS</td>
      <td><input type="text" name="ctps" value="" size="17" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Data de admiss&atilde;o</td>
      <td><input type="date" name="admissao" value="" size="17" /></td>
      <td>Dependente</td>
      <td colspan="3"><input type="text" name="dependente" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nascimento:</td>
      <td><input type="date" name="nascimento" value="" size="17" /></td>
      <td>Fun&ccedil;&atilde;o</td>
      <td><input type="text" name="funcao" value="" size="32" /></td>
      <td>Remunera&ccedil;&atilde;o</td>
      <td><input placeholder="R$" type="text" name="remuneracao" value="" size="5" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap">Filia&ccedil;&atilde;o</td>
      <td colspan="2" align="right" nowrap="nowrap"><label>
          <div align="left">
            <input name="filiacao" type="text" id="filiacao" size="40" />
          </div>
        </label></td>
      <td align="right" nowrap="nowrap"><div align="left"><br />
        Filial</div></td>
      <td colspan="2" align="right" nowrap="nowrap"><label>
          <div align="left">
            <select name="filial" id="filial">
              <?php
do {  
?>
              <option value="<?php echo $row_fil['desc']?>"><?php echo $row_fil['desc']?></option>
              <?php
} while ($row_fil = mysql_fetch_assoc($fil));
  $rows = mysql_num_rows($fil);
  if($rows > 0) {
      mysql_data_seek($fil, 0);
	  $row_fil = mysql_fetch_assoc($fil);
  }
?>
            </select>
          </div>
        </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td colspan="5"><input type="submit" value="Cadastrar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</fieldset>

<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($chv);

mysql_free_result($fil);
?>
