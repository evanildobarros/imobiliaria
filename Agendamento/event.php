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
$query_fornecedor = "SELECT * FROM fornecedor";
$fornecedor = mysql_query($query_fornecedor, $conexao) or die(mysql_error());
$row_fornecedor = mysql_fetch_assoc($fornecedor);
$totalRows_fornecedor = mysql_num_rows($fornecedor);

mysql_select_db($database_conexao, $conexao);
$query_cate = "SELECT * FROM lc_cat";
$cate = mysql_query($query_cate, $conexao) or die(mysql_error());
$row_cate = mysql_fetch_assoc($cate);
$totalRows_cate = mysql_num_rows($cate);

mysql_select_db($database_conexao, $conexao);
$query_forma = "SELECT * FROM forma_pg";
$forma = mysql_query($query_forma, $conexao) or die(mysql_error());
$row_forma = mysql_fetch_assoc($forma);
$totalRows_forma = mysql_num_rows($forma);

session_start();

?>
<?php
$mysql = mysql_connect("localhost", "root", "jedai2003");
mysql_select_db("MI", $mysql) or die(mysql_error());

// Add our new events
if ($_POST){
	$m = $_POST['m'];
	$d = $_POST['d'];
	$y = $_POST['y'];

	// Formatting for SQL datetime (if this is edited, it will NOT work.)
	$event_date = $y."-".$m."-".$d ;

	$insEvent_sql = "INSERT INTO lc_movimento (tipo, 
												  event_start,
												  dia,
												  mes,
												  ano,
												  cat,
												  cliente,
												  descricao,
												  valor,
												  valor2,
												  status,
												  vencimento,
												  fpagamento,
												  m,
												  fornecedor,
												  nota
												  ) VALUES
												  ('".$_POST["tipo"]."',
			                                                         
																	 '$event_date',
																	 '".$_POST["dia"]."',
																	 '".$_POST["mes"]."',
																	 '".$_POST["ano"]."',
																	 '".$_POST["cat"]."',
																	 '".$_POST["cliente"]."',
																	 '".$_POST["descricao"]."',
																	 '".$_POST["valor"]."',
																	 '".$_POST["valor2"]."',
																	 '".$_POST["status"]."',
																	 '".$_POST["vencimento"]."',
																	 '".$_POST["fpagamento"]."',
																	 '".$_POST["m"]."',
																	 '".$_POST["fornecedor"]."',
																	 '".$_POST["nota"]."')";
	$insEvent_res = mysql_query($insEvent_sql, $mysql)
			or die(mysql_error($mysql));
} else {
	$m = $_GET['m'];
	$d = $_GET['d'];
	$y = $_GET['y'];
    $month = $_POST[''];
}
// Show the events for this day:
$getEvent_sql = "SELECT tipo, 
                 
		         date_format(event_start, '%l:%i %p') as fmt_date,
				 dia,
				 mes,
				 ano,
				 cat,
				 cliente,
				 descricao,
				 descricao,
				 valor,
				 valor2,
				 status,
				 vencimento,
				 fpagamento,
				 m,
				 fornecedor,
				 nota
				 
				 FROM
		         lc_movimento
				 WHERE 
				 month(event_start) = '".$m."'
		         AND dayofmonth(event_start) = '".$d."' 
				 AND year(event_start)= '".$y."' 
				 ORDER BY event_start";
$getEvent_res = mysql_query($getEvent_sql, $mysql)
		or die(mysql_error($mysql));



mysql_close($mysql);

	

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Agerenciador Imobiliaria</title>
<link rel="stylesheet" href="../css/menu.css" type="text/css" />
<link rel="stylesheet" href="../css/cadastros.css" type="text/css" />
<script>
			function alterna(tipo) {
			
			if (tipo == 2	) {
			document.getElementById("tipo1").style.display = "block";
			document.getElementById("tipo2").style.display = "none";
			} else {
			document.getElementById("tipo1").style.display = "none";
			document.getElementById("tipo2").style.display = "block";
			}
			
			}
</script>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body onUnload="window.opener.location.reload()">

<br>


<fieldset>
<legend>Reserva</legend><br>
<br>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table width="562" border="0" align="center" style="border-collapse:collapse;">
  
  
  <tr>
    <td width="152" valign="top" class="td2"><font color="#333">Forncedor</font></td>
    <td valign="top"></span>
      <label>
      <select name="fornecedor" id="fornecedor">
        <option value="">Selecione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_fornecedor['nome']?>"><?php echo $row_fornecedor['nome']?></option>
        <?php
} while ($row_fornecedor = mysql_fetch_assoc($fornecedor));
  $rows = mysql_num_rows($fornecedor);
  if($rows > 0) {
      mysql_data_seek($fornecedor, 0);
	  $row_fornecedor = mysql_fetch_assoc($fornecedor);
  }
?>
      </select>
      </label></td>
    <td valign="top"class="td2">Categoria</td>
    <td width="164" valign="top"class="td2"><label>
      <select name="cat" id="cat">
        <option value="">Selecione</option>
        <?php
do {  
?><option value="<?php echo $row_cate['id']?>"><?php echo $row_cate['nome']?></option>
        <?php
} while ($row_cate = mysql_fetch_assoc($cate));
  $rows = mysql_num_rows($cate);
  if($rows > 0) {
      mysql_data_seek($cate, 0);
	  $row_cate = mysql_fetch_assoc($cate);
  }
?>
      </select>
    </label></td>
    </tr>
  <tr>
   <td valign="top"class="td2"><font color="#333">Forma de pagamento</font></td>
    <td width="144" valign="top"><label>
      <select name="fpagamento" id="fpagamento">
        <option value="">Selecione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_forma['desc']?>"><?php echo $row_forma['desc']?></option>
        <?php
} while ($row_forma = mysql_fetch_assoc($forma));
  $rows = mysql_num_rows($forma);
  if($rows > 0) {
      mysql_data_seek($forma, 0);
	  $row_forma = mysql_fetch_assoc($forma);
  }
?>
      </select>
    </label></td>
    <td width="84" valign="top"class="td2">Nota fiscal</td>
    <td valign="top"><span class="td2">
      <input name="nota" type="text" id="nota" value="" size="10">
      </span><br></td>
  </tr>


  
  <tr>
    <td valign="top">Tipo </td>
    <td colspan="3" valign="top"><label for="tipo_receita" style="color:#0033CC">
    <input type="radio" name="tipo" value="1" id="tipo_receita" /> Receita</label>&nbsp; 
<label for="tipo_despesa" style="color:#C00"><input type="radio" name="tipo" value="0" id="tipo_despesa" /> Despesa</label>
<label for="tipo_Emberto" style="color:#009999"><input type="radio" name="status" value="2" onClick="alterna(this.value);" /> Em Abero

<div id="tipo1" style="display:none;">
			  <input name="valor2"  value="" class="placeholder" placeholder="Valor a ser Pago !" size="20">
			  </div>
</td>
  </tr>
  <tr>
    <td valign="top"><span class="td2">Data do Vencimento</span></td>
    <td colspan="3" valign="top"><span class="td2">
      <input name="vencimento" value="" type="date" id="vencimento">
      <span class="style1">*</span></span></td>
    </tr>
  <tr>
    <td valign="top">Valor</td>
    <td colspan="3" valign="top"><span class="td2">
      <input name="valor" type="text" id="valor" value="" size="5">
      <span class="span8">***(N&atilde;o digitar valor se estiver em aberto)***</span></span></td>
  </tr>
  <tr>
    <td valign="top">Descri&ccedil;&atilde;o</td>
    <td colspan="3" valign="top"><label>
      <textarea name="descricao" id="descricao" cols="45" rows="5"></textarea>
      </label></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td colspan="3" valign="top"><input name="submit" type="submit" class="botao" value="Reserva"></td>
  </tr>
</table>



<input type="hidden" name="mes" id="mes" value="<?php echo $m; ?>" >
<input type="hidden" name="d" value="<?php echo $d; ?>">
<input type="hidden" name="y" value="<?php echo $y ?>">

<input type="hidden" name="m" value="<?php echo $m; ?>">
<input type="hidden" name="dia" value="<?php echo $d; ?>">
<input type="hidden" name="ano" value="<?php echo $y; ?>">
</form>

</fieldset>
</body>
</html>
<?php
mysql_free_result($fornecedor);

mysql_free_result($cate);

mysql_free_result($forma);
?>