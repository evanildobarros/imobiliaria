<?php require'../Connections/conexao.php'; ?>
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
  $insertSQL = sprintf("INSERT INTO cliente (`data`, login, cliente, apelido, endereco, bairro, municipio, `local`, cpf_titular, cnpj, cpf_procu, procuracao, aniversario, telefone, email, status, status2) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['status2'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

header('location:../listas/layout_cliente.php');

?>
