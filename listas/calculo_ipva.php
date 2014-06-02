<?php

session_start();

?>
<?php require'../Connections/conexao.php';
  $data2 = date("d/m/Y");
 ?>

	<!DOCTYPE html>
	
	<head>
	<link rel="stylesheet" href="../css/licenciamento.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.css" type="text/css">
<link rel="stylesheet" href="../css/menu_horizontal.css" type="text/css">
	</head>

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
$query_Recordset1 = "SELECT * FROM ttiposv";
$Recordset1 = mysql_query($query_Recordset1, $conexao) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexao, $conexao);
$query_categoria = "SELECT * FROM tcategorias";
$categoria = mysql_query($query_categoria, $conexao) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);


?>
<?php
/* Arquivo que gera variáveis na página onde é incluso, com todas as parametros passados por post ou get		 */
 
while (list($key, $val) = each($_REQUEST)) {
  $$key = $val; 
// echo "$key:$val;<br/> ";
} 

?>



<body>
<div class="lic_box1">
<form name="frmCalculo" action="" method = "post">

<!--  INICIO DA TABELA DE ENTRADA DE DADOS (CÁLCULO DO EMPLACAMENTO) -->
<p class="descricao_campos"><span class="span12">Data Nota Fiscal</span></p>
<input class="input" type="date"  size="10" maxlength="10" align="right" name="datanf" value="<?php echo $datanf ?>"><span class="span4"> &nbsp;(Ex:25/05/2013)</span>

<p class="descricao_campos"><span class="span4">Valor da Nota Fiscal</span></p>
<input class="input" type name="valornf" size="15"  align='right' value="<?php echo $valornf ?>"><span class="span4">&nbsp;(Ex:21305.00)</span>

<p class="descricao_campos"><span class="span4">Tipo Veículo</span></p>
 <select class="input" name="tpveiculo" size = "1">
   <option value="">Select</option>
   <option value=""></option>
   <?php
do {  
?>
   <option value="<?php echo $row_Recordset1['tpvCodigo']?>"><?php echo $row_Recordset1['tpvDescricao']?></option>
   <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
 
	</select>
<p class="descricao_campos"><span class="span4">Categoria Veículo</span></p>
<select class="input" name="catveiculo" size = "1">
  <option value="">Select</option>
  <option value=""></option>
  <?php
do {  
?>
  <option value="<?php echo $row_categoria['catCodigo']?>"><?php echo $row_categoria['catDescricao']?></option>
  <?php
} while ($row_categoria = mysql_fetch_assoc($categoria));
  $rows = mysql_num_rows($categoria);
  if($rows > 0) {
      mysql_data_seek($categoria, 0);
	  $row_categoria = mysql_fetch_assoc($categoria);
  }
?>

  
  </select>

<p class="descricao_campos"><span class="span4">Veículo Financiado?</span></p>
<select class="input" name="veifin" size = "1"> 
      <option>Não</option>
      <option>Alienação Fiduciária</option>
      <option>LEASING</option>
      <option>Reserva de Domínio</option>
  </select>
      

<button type="submit"  class="botao" value="consultar">Enviar</button>
<button type="submit"  class="botao" value="Limpar" name="limpar" onClick="limpa()">Limpar</button>


  </font>
  <h3></h3>

<?php
// ATRIBUINDO VALORES PARA A TAXA
  if ($tpveiculo == 7 || $tpveiculo == 8 || $tpveiculo == 14 || $tpveiculo == 17) 
  {$valtaxa = 1;}
   else {
		if ($tpveiculo == 3 || $tpveiculo == 4 || $tpveiculo == 5 || $tpveiculo == 21)
		{$valtaxa = 2;}
		 else {$valtaxa = 2.5;}
         }  
// categoria particular
  if ($catveiculo == 1 ) { 
      if ($tpveiculo == 6 || $tpveiculo == 13) { //automóvel e camioneta antigo 93.87
	  	  $valseg = 105.65; 
	  } else {
	  		if ($tpveiculo == 7 || $tpveiculo == 8) { // ônibus e microonibus antigo 215.37
	  	  		$valseg = 247.42; 
			}
	  }
  } else {
// categoria aluguel ou aprendizagem
  	if ($tpveiculo == 6 || $tpveiculo == 13) { $valseg = 105.65; } // tipo 6 - automovel ou 13 - camioneta valor antito = 93.87
	else {
	  	  if ($tpveiculo == 7 || $tpveiculo == 8) {    // tipo  7 - microonibus ou 8 - onibus valor antigo 344.95
                if ($catveiculo == 2 || $catveiculo == 5) {
		     $valseg = 396.49;
	         } 
			  else {
			      $valseg = 247.42;
			  }
                }
	      }
 } 

// outros tipos de veiculos independente da categoria
  if ($tpveiculo == 2 || $tpveiculo == 3 ||  $tpveiculo == 4 || $tpveiculo == 5 || $tpveiculo == 21) 
  {$valseg = 292.01;} 
  else {
  		if ($tpveiculo == 14 || $tpveiculo == 17 ||  $tpveiculo == 18 || $tpveiculo == 19 || $tpveiculo == 20 || $tpveiculo == 22 || $tpveiculo == 23 ||  $tpveiculo == 25)
		{$valseg = 110.38;}
        } 
		
// tipos de veículos com valor de seguro = 0
      if ($tpveiculo == 10 || $tpveiculo == 11 || $tpveiculo == 24)
	  {$valseg = 0;}
	  
// calcular o IPVA
  $mes = substr($datanf,3,2);
  $mes = (12 - $mes + 1) / 12;
$valipva = $valornf * $valtaxa * $mes / 100;

// calcular o seguro
$valseguro = $valseg * $mes;
// calculo do financiamento    OBS: ////////////$valcart = $valfin * 0.007;////////// meados de 2009<- foi retirada a obrigatóriedade do registro de cartório que cobrava a taxa de 0,7% do valor do carro.
  if ( $veifin == "Alienação Fiduciária" ) {
       $valgrav = 28.33;
    
  }
  if ( $veifin == "LEASING" ) {
       $valgrav = 28.33;
       $valcart = 0.00;
  }
  if ( $veifin == "Reserva de Domínio" ) {
       $valgrav = 28.33;
       $valcart = 0.00;
  }

  // calculo da taxa das placas
  if ($tpveiculo == 2 || $tpveiculo == 3 || $tpveiculo == 4 || $tpveiculo == 5 || $tpveiculo == 10 || $tpveiculo == 11 || $tpveiculo == 17 || $tpveiculo == 18 || $tpveiculo == 19 || $tpveiculo == 20 || $tpveiculo == 21 || $tpveiculo == 24){
	 $txaplaca = 0;
	 
  } else {
      if ( $tpveiculo > 0 ) {  	
	      $txaplaca = 0;
      }
  }
  if ($tpveiculo > 0) {
      $txaregvei = 99.17; 
  }
// categoria oficial é insendo de taxa de IPVA
   if ($catveiculo == 3)
   {
        $valipva = 0;
	 $txaregvei = 0;
	 $valgrav = 0;
  }  

  $total = $valseguro + $valipva + $txaregvei + $txaplaca + $valcart + $valgrav;


?>
</form>

</div>

<div class="lic_box2">
<span class="span12">Resultado do Cálculo</span><br>
<br>

<?php
echo "<span class=\"span4\">Valor do IPVA &raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<span class=\"ipva2\">".number_format($valipva,2,chr(44),".")."</span>"."<br><br>";
echo "Valor do Seguro DPVAT &raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<span class=\"ipva2\">".number_format($valseguro,2,chr(44),".")."</span>". "<br><br>";
echo "Taxa de Registro de Gravame &raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<span class=\"ipva2\">".number_format($txaregvei,2,chr(44),".")."</span>"."<br><br>";
echo "Taxa de 1º Emplacamento &raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<span class=\"ipva2\">".number_format($valgrav,2,chr(44),".")."</span>"."<br><br>";
echo "<span class=\"span12\"><strong>TOTAL GERAL &raquo;&nbsp;&nbsp;</strong></span>"."<span class=\"span14\">".number_format($total,2,chr(44),".")."</span>"."<br><br>";
?>
<hr />
Será acrescido 10% (dez por cento) de multa + 1% (um por cento) de juros ao mês ou fração de mês, caso não seja pago até 30 dias a partir da data da Nota Fiscal.
- Corresponde à fabricação da(s) placa(s) junto ao estampador.<br>
OBS: Acrescentar o valor do tipo de placa escolhida ao TOTAL GERAL.<br>
Se desejar escolher a placa (placa especial) acrescentar <strong>R$117,81.</strong>)
</div>


<div class="lic_box3">

<table width="400px" border="0">
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><span class="span12"><strong>Tabela de Confec&ccedil;&otilde;es de Placas</strong></span></td>
  </tr>
  <tr>
    <td width="77%"><span class="span13">PAR DE PLACAS COM TARJETAS -CARRO/CAMINH&Atilde;O</span></td>
    <td width="23%"><strong><span class="span13">R$ 150,00</span></strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="span13">PAR DE TARJETAS - CARRO/CAMINH&Atilde;O</span></td>
    <td bgcolor="#FFFFFF"><span class="span13"><strong>R$ 55,00</strong></span></td>
  </tr>
  <tr>
    <td><span class="span13">PLACA AVULSA - CARRO/CAMINH&Atilde;O</span></td>
    <td><span class="span13"><strong>R$ 94,00</strong></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="span13">TARJETA AVULSA - CARRO/CAMINH&Atilde;O</span></td>
    <td bgcolor="#FFFFFF"><span class="span13"><strong>R$ 25,00</strong></span></td>
  </tr>
  <tr>
    <td><span class="span13">PLACA DE MOTOCICLETA COM TARJETA</span></td>
    <td><span class="span13"><strong>R$ 116,00</strong></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="span13">TARJETA AVULSA PARA MOTOCICLETA</span></td>
    <td bgcolor="#FFFFFF"><span class="span13"><strong>R$ 45,00</strong></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>


</div>

</div>


<script language="JavaScript">
function limpa(){
  frmCalculo.valornf.value = "";
  frmCalculo.datanf.value = "";
  frmCalculo.catveiculo.value = "";
  frmCalculo.tpveiculo.value = "";
  frmCalculo.valfin.value = "";
  frmCalculo.submit();
}
</script>
<!-- <img src="http://scripts.insite.com.br/mod_perl/incounter.cgi?tipo=b&pg=index.html"> -->
</body>
<?php
mysql_free_result($Recordset1);

mysql_free_result($categoria);
?>
<?php 

$op="Consultou licenciamento !";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
?>
