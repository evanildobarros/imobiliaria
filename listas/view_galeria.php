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
	
	$colname_doc = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_doc = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_doc = sprintf("SELECT * FROM galeria WHERE id_cliente = %s", GetSQLValueString($colname_doc, "int"));
$doc = mysql_query($query_doc, $conexao) or die(mysql_error());
$row_doc = mysql_fetch_assoc($doc);
$totalRows_doc = mysql_num_rows($doc);
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
    <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
    <link rel="stylesheet" href="../css/layout.css" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Gerenciador Imobiliario</title>
	</head>
	
	<body><br>
<br>

    <fieldset>
    <legend>Galeria</legend><br>
<br>

     <?php do { ?>
              <a href="exibir_gale.php?id_cliente=<?php echo $row_doc['id_cliente']; ?>"><img class="img" src="../uploads/<?php echo $row_doc['img']; ?>" 
              width="160px" height="100px" /></a>
            <?php } while ($row_doc = mysql_fetch_assoc($doc)); ?>
    
    </fieldset>
           
	
	</body>
	</html>
	<?php
	mysql_free_result($doc);
	?>
