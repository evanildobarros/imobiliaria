<?php
//MX Widgets3 include

 
session_start();

?>
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

$colname_exibir33 = "-1";
if (isset($_GET['id_doc'])) {
  $colname_exibir33 = $_GET['id_doc'];
}
mysql_select_db($database_conexao, $conexao);
$query_exibir33 = sprintf("SELECT * FROM documentacao WHERE id_doc = %s", GetSQLValueString($colname_exibir33, "int"));
$exibir33 = mysql_query($query_exibir33, $conexao) or die(mysql_error());
$row_exibir33 = mysql_fetch_assoc($exibir33);
$totalRows_exibir33 = mysql_num_rows($exibir33);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exibir</title>
<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body onload="ExibeImagem()" topmargin="0" leftmargin="0">
<div align="center"><img width="1000" height="1000"  src="../uploads/<?php echo $row_exibir33['img']; ?>" />
  <br />
  <br />
  <br />
  <form id="form1" name="form1" method="post" action="">
    <label>
      <input name="button2" type="submit" id="button2" onclick="MM_goToURL('parent','doc_imagem.php');return document.MM_returnValue" value="Voltar" />
      <input name="button" type="submit" id="button" onclick="MM_callJS('print();')" value="Imprimir" />
    </label>
  </form>
</div>
</body>
</html>
<?php
mysql_free_result($exibir33);
?>

