<?php 
session_start();

?>
<?php require'../Connections/conexao.php';  ?>
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

$colname_cliente = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_cliente = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_cliente = sprintf("SELECT * FROM cliente WHERE id_cliente = %s ORDER BY id_cliente DESC", GetSQLValueString($colname_cliente, "int"));
$cliente = mysql_query($query_cliente, $conexao) or die(mysql_error());
$row_cliente = mysql_fetch_assoc($cliente);
$totalRows_cliente = mysql_num_rows($cliente);
$data2 = date("md");
$data3 = date("d/m/Y");
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="classes2.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FICHA DE VISTORIA</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style20 {
	font-size: 24px
}
.style22 {
	font-size: 14px
}
-->
</style>

<style media="print">
.botao {
display: none;
}

</style>
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

<body>
<table width="101%" border="0" align="center" style="border-collapse:collapse;">
  <tr>
    <td colspan="2" valign="top" bgcolor="#fff">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#fff">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#fff"><img src="../img/LOGO_CARRO2.jpg" width="500" height="80" /></td>
    <td width="81%" valign="top" bgcolor="#fff"><label class="style19">
      <div align="left" class="style22">MARCELODESPACHANTE.TZ@HOTMAIL.COM<br />
        rUA TEREZA CRISTINA N&ordm; 228<br />
        (ESQ.COM A GET&Uacute;LIO VARGAS) CENTRO -IMPERATRIZ<br />
      FONE:(99) 99049882 |8123-4009| 3526-4102</div>
    </label></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td valign="top" bgcolor="#FFFFFF"><span class="style20">N&ordm; da Vistoria <?php echo $data2; ?><?php echo $row_cliente['id_cliente']; ?></span></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;</td>
  </tr>
</table>
<table width="100%" border="0" style="border-collapse:collapse;" align="center">
  <tr>
    <td colspan="5" valign="top" bgcolor="#EDEDED">DADOS DO PROPRIET&Aacute;RIO</td>
  </tr>
  <tr>
    <td colspan="5" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td width="23%" valign="top" bgcolor="#FFFFFF">Data de Emiss&atilde;o:</td>
    <td colspan="4" valign="top" bgcolor="#FFFFFF"><?php echo $data3; ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">Nome do Cliente:</td>
    <td width="25%" valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['cliente']; ?></td>
    <td width="29%" valign="top" bgcolor="#FFFFFF">Endere&ccedil;o:</td>
    <td width="23%" colspan="2" valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['endereco']; ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">Bairro:</td>
    <td valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['bairro']; ?></td>
    <td valign="top" bgcolor="#FFFFFF">Municipio:</td>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['municipio']; ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">Telefone:</td>
    <td valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['telefone']; ?></td>
    <td valign="top" bgcolor="#FFFFFF">Email:</td>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['email']; ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">CPF / CNPJ:</td>
    <td valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['cpf_titular']; ?></td>
    <td valign="top" bgcolor="#FFFFFF">Procura&ccedil;&atilde;o</td>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"><?php echo $row_cliente['procuracao']; ?></td>
  </tr>
  <tr>
    <td colspan="5" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" valign="top" bgcolor="#EDEDED">DADOS DO VEICULO
      <?php $clientes = $row_cliente['cliente']; 

$tabela = mysql_query("select * from veiculos order by id_veiculo DESC limit 1");
	
	while ($r= mysql_fetch_array($tabela)){
	$idcli= $r['id_cliente'];
	$placa= $r['placa'];
	$renavam= $r['renavam'];
	$chassi= $r['chassi'];
	$cor= $r['cor'];
	$tipo= $r['tipo'];
	$especie= $r['especie'];
	$categoria= $r['categoria'];
	$marca= $r['Marca_Modelo'];
	$combustivel= $r['combustivel'];
	
	

?>
      <?php 

	$op="Imprimiu ficha de vistoria !";
	$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]',   '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
	mysql_query($sql5);
	?></td>
  </tr>
</table>

<table width="100%" border="0" bordercolor="#FFFFFF" align="center" style="border-collapse:collapse;">
  <tr>
    <td colspan="6"></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">Chassi<br />
    <br /></td>
    <td colspan="5" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Placa<br />
    <br /></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Renavam</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Cor<br />
    <br /></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Especie</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Categoria<br />
    <br /></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Marca/Modelo</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><br />
      Combustivel<br />
    <br /></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">DECALQUE</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td width="17%" bgcolor="#FFFFFF">&nbsp;</td>
   
    <td width="19%" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="28%" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">N&ordm; CHASSI</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td width="1%" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="8%" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="27%" bgcolor="#FFFFFF">N&ordm; DO MOTOR</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF"><form action="" method="get">
      <div align="center">
        <input class="botao" type="button" onclick="MM_callJS('print();')" value="imprimir" />
        <label>
        <input class="botao" name="button" type="submit" id="button" onclick="MM_goToURL('parent','home/index.php');return document.MM_returnValue" value="Voltar" />
        </label>
</div>
    </form>    </td>
  </tr>
</table>
<br />
<br />
<?php
require_once("datahora.php");
$op="Emitiu ficha de vistoria!";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
?>


<?php } ?>
</body>
</html>
<?php
mysql_free_result($cliente);
?>
