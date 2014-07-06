	<?php
	
	
	
	@session_start();
	
	?>
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
	$query_mese = "SELECT * FROM meses";
	$mese = mysql_query($query_mese, $conexao) or die(mysql_error());
	$row_mese = mysql_fetch_assoc($mese);
	$totalRows_mese = mysql_num_rows($mese);
	
	
	
	?>
	
	
	
	
	<?php
	
	
	//MX Widgets3 include
	
	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
	<head>
	<link rel="stylesheet" href="../css/layout.css" type="text/css">
	<link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
	
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Gerenciador Despachante</title>
	
	</head>
	
	
	
	
	<body>
    
	
	<table width="800" border="0" align="center" style="border-collapse:collapse;">
	
	
	
	<tr>
	<td bgcolor="#FFFFFF">
	
	
	<div id="topo">
	
	<br />
	<br />
	</div>
	</div>
	<div id="canvas">

	<fieldset><legend>Consultas por M&ecirc;s</legend><br />

	
	<form id="form1" name="form1" method="post" action="consulta_resultado.php">
	Selecione o M&ecirc;s de Origem:
	
	<select class="input" name="mes" id="mes">
	<option value="">Slecione</option>
	<?php
	do {  
	?>
	<option value="<?php echo $row_mese['descricao']?>"><?php echo $row_mese['descricao']?></option>
	<?php
	} while ($row_mese = mysql_fetch_assoc($mese));
	$rows = mysql_num_rows($mese);
	if($rows > 0) {
	mysql_data_seek($mese, 0);
	$row_mese = mysql_fetch_assoc($mese);
	}
	?>
	</select>
	</label>
	<br />
	<label>
	<input type="radio" name="tipo" value="0" id="tipo_0" />
	Receita</label>
	<br />
	<label>
	<input type="radio" name="tipo" value="1" id="tipo_1" />
	<span >Despesas</span></label>
	<br />
	<br />
	<input name="button" type="submit" class="botao" id="button" value="CONSULTAR" />
	</form>
	
	
	</fieldset>
	

	</td>
	</tr>
	
	
	
	</body>
	<?php
	@mysql_free_result($MESES);
	?>
	<?php 
	
	$op="Cosultou balanço mensal !";
	$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
	@mysql_query($sql5);
	?>
	</html>
	<?php
	mysql_free_result($mese);
	?>