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
  $insertSQL = sprintf("INSERT INTO veiculos (cliente, `data`, data_nota, vencimento, placa, renavam, chassi, cor, tipo, categoria, Marca_Modelo, ano_fab_modelo, combustivel, aviso) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['data_nota'], "text"),
                       GetSQLValueString($_POST['vencimento'], "text"),
                       GetSQLValueString($_POST['placa'], "text"),
                       GetSQLValueString($_POST['renavam'], "text"),
                       GetSQLValueString($_POST['chassi'], "text"),
                       GetSQLValueString($_POST['cor'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['categoria'], "text"),
                       GetSQLValueString($_POST['Marca_Modelo'], "text"),
                       GetSQLValueString($_POST['ano_fab_modelo'], "text"),
                       GetSQLValueString($_POST['combustivel'], "text"),
                       GetSQLValueString($_POST['aviso'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
  
  
}
header('location:../listas/layout_veiculo.php');
?>