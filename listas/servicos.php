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
	
	$colname_cliente = "-1";
	if (isset($_GET['id_cliente'])) {
	$colname_cliente = $_GET['id_cliente'];
	}
	mysql_select_db($database_conexao, $conexao);
	$query_cliente = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_cliente, "int"));
	$cliente = mysql_query($query_cliente, $conexao) or die(mysql_error());
	$row_cliente = mysql_fetch_assoc($cliente);
	$totalRows_cliente = mysql_num_rows($cliente);

mysql_select_db($database_conexao, $conexao);
$query_categoria = "SELECT * FROM categoria_financeiro";
$categoria = mysql_query($query_categoria, $conexao) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);
	
	@session_start();

	$data2 = date("Y-m-d");
	?>
	   <?php
$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Mar�o", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$diasdasemana = array (1 => "Segunda-Feira",2 => "Ter�a-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "S�bado",0 => "Domingo");
$hoje = getdate();
$dia = $hoje["mday"];
$mes = $hoje["mon"];
$nomemes = $meses[$mes];
$ano = $hoje["year"];
$diadasemana = $hoje["wday"];
$nomediadasemana = $diasdasemana[$diadasemana];

?>
	
	
	
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css" type="text/css">
	
    <script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
    </script>
<title>Gerenciador despachante</title></head>
<body><br>
<br>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method='POST'>
  <fieldset>
  <legend>Registrar Servi�os</legend>
  
  <table width="800" border="0" align="center">
    <tr>
      <td colspan="5">&nbsp;</td>
      <td><input name='id_cliente' type="hidden" size="50" id="id_cliente" value="<?php echo $row_cliente['id_cliente']; ?>" >
          <input name='cliente' type="hidden" size="50" id="cliente" value="<?php echo $row_cliente['cliente']; ?>" >
          <input name='data' type="hidden" size="50" id="data" value="<?php echo $data2; ?>" >
         
      <input type="hidden" name="mes" value="<?php echo $nomemes; ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><input type="checkbox" name="id_servico[]" value="Avalia&ccedil;&atilde;o de Imovel" />
          <label for="checkbox"><span class="span5">Avalia&ccedil;&atilde;o de Imovel</span></label>
          <br />
          <input type="checkbox" name="id_servico[]" value="Comiss�es " />
          <label for="checkbox2"><span class="span5">Comiss�es</span></label>
          <br />
          <input type="checkbox" name="id_servico[]" value="Conta Pouban�a" />
          <label for="checkbox3"><span class="span5">Conta Poupan�a</span></label>
          <br />
          <input type="checkbox" name="id_servico[]" value="Conta Corrente"  />
          <label for="checkbox4"><span class="span5">Conta Corrente</span></label>
          <input type='hidden' name='int_id' value='<?php echo $id?>'>
          <br>
          <input type="checkbox" name="id_servico[]" value="CROT Automatizado" />
        <span class="span5">CROT Automatizada</span><br>
        <input type="checkbox" name="id_servico[]" value="Consignado" />
    <span class="span5">Consignado</span>          
      <td colspan="3" valign="top">
      <input type="checkbox" name="id_servico[]" value="Cart�o de cr�dito" />
        <span class="span5">Cart�o de cr�dito</span><br> 
        <input type="checkbox" name="id_servico[]" value="CDC" />
        <span class="span5">CDC</span><br>  
        <input type="checkbox" name="id_servico[]" value="CCSBPE Automatizado" />
        <span class="span5">CCSBPE Automatizado</span><br> 
         <input type="checkbox" name="id_servico[]" value="CCFGTS Automatizado" />
        <span class="span5">CCFGTS Automatizado</span><br> 
        <input type="checkbox" name="id_servico[]" value="Pesquisas cadastrais" />
        <span class="span5">Pesquisas cadastrais</span><br> 
        <input type="checkbox" name="id_servico[]" value="Outros servi�os" />
        <span class="span5">Outros servi�os</span><br>   
               
    <td>          </tr>
    <tr>
      <td colspan="8">&nbsp;    </tr>
    <tr>
      <td width="144"><span class="span5">Valor a ser pago</span>   
      <td width="107"><input class="input radius" name='valor' type='text' size="15" id="valor" placeholder="R$" >
          <td width="144"><span class="span5">Valor parcelado </span>     
          <td width="90"><input class="input" name='valor2' type='text' size="15" id="valor2" placeholder="R$" >
          <td width="90"><span class="span5">Vencimento</span>             
          <td width="185"><input name="venci" type="date" class="span5" id="venci" value="" size="15">          </tr>
    <tr>
      <td>&nbsp;    
      <td colspan="2"><input type="hidden" name="cat" value="5">      
      <td>      
      <td>      
    <td>    </tr>
    <tr>
      <td><span class="span5">Forma de Pagamento </span>   
      <td colspan="2"><select name="f_pagamento">

<option>Selecione</option>
<?php
$qr1=mysql_query("SELECT * FROM forma_pg");
while ($row5=@mysql_fetch_array($qr1)){
$en = $row5['desc'];

?>
<option value="<?php echo $en; ?>"><?php echo $en; ?></option>
<?php }?>
</select>
              <a href="#" onClick="MM_openBrWindow('../listas/cat_financeiro.php','','scrollbars=yes,resizable=yes,width=450,height=160')"><img src="../img/check_green.jpg" width="30" height="30"></a>
      <td colspan="3"><input checked type="radio" name="tipo" id="tipo" value="1">
        <span class="span5">Receita</span>
        <input type="radio" name="tipo" id="tipo2" value="0">
        <span class="span5">Aguardando pagamento da parcela</span></td>
    </tr>
    <tr>
      <td>&nbsp;
      <td>      
      <td>      
      <td>      
      <td>      
    <td>    </tr>
    <tr>
      <td><span class="span5">Situa&ccedil;&atilde;o</span>  
      <td colspan="7"><input class="input radius" checked type="radio" name="status" id="status" value="1">
        <span class="span5">Pago</span>
        <input class="input radius" type="radio" name="status" id="status" value="2">
       <span class="span5"> Em aberto </span></td>
    </tr>
    <tr>
      <td>  
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><span class="span5">Observa&ccedil;&atilde;o </span>   
      <td colspan="7" valign="top"><textarea class="span6" name="descricao" id="descricao" cols="50" rows="5"></textarea></td>
    </tr>
    <tr>
      <td valign="top">  
      <td colspan="7" rowspan="2" valign="top"><div align="right">
          <input class="botao" type='submit' value='Registrar' name='bt'>
      </div></td>
    </tr>
    <tr>
      <td valign="top">    </tr>
  </table>
  </fieldset>
  
  <br>
  <br>
  <br>
	<?php
	
	//Verifica se o botao foi apertado pra entrar no bloco if
	if(isset($_POST['bt'])){
	
	//Recebe o id do professor
	$id = $_POST['int_id'];
	$id_cliente = $_POST['id_cliente'];
	//Recebe o array materias
	$data        = $_POST['data'];
	$tipo        = $_POST['tipo'];
	$categoria   = $_POST['cat'];
	$pago        = $_POST['f_pagamento'];
	$descricao   = $_POST['descricao'];
	$val         = $_POST['valor'];
	$val2        = $_POST['valor2'];
	$status      = $_POST['status'];
	$mes         = $_POST['mes'];
	$cliente     = $_POST['cliente'];
	$vencimento  = $_POST['venci'];
	
	$local = "Escritorio";
	$desc = "Nenhuma descri&ccedil;&atilde;o no momento";
	$st   = "1";
	$mv   = "Aquardando...";
	$hr   = date("H:i");
	$servico = $_POST['id_servico'];
	$cod = date("d");
	
	//Faz um foreach no array materias para percorrer os valores do array.. e os adiciona na tabela curso_professor
	foreach($servico as $indice => $valor){
	
	$sql = mysql_query("INSERT INTO serv(int_id,id_cliente,data,tipo,cat,f_pagamento,descricao,valor,valor2,status,mes,cliente,venci,id_servico) VALUES('$id','$id_cliente','$data','$tipo','$categoria','$pago','$descricao','$val','$val2','$status','$mes','$cliente','$vencimento','$valor')");
	
	$sql7 = "INSERT INTO processo (id_processo, cliente, codigo, local,descricao,status, entrada,movimentacao,hora) 
	VALUES ('', '$cliente','$id_cliente-$cod','$local','$desc','$st', '$data','$mv','$hr')";
	mysql_query($sql7);
	
	   
	

	
	}
	
$sql6 = "INSERT INTO movimento (id_mov, data, cliente, tipo,cat,descricao, valor,valor2,status, mes) 
	VALUES ('', '$vencimento','$cliente','$tipo','$categoria','$descricao', '$val','$val2','$status', '$mes')";
	mysql_query($sql6);
	
	$d = date("d");
	$m = date("m");
	$a = date("Y");
	
	
	
	
	}
	$sql9 = "INSERT INTO lc_movimento (id,tipo,dia,mes,ano,cat,cliente,descricao,valor,valor2,status,vencimento,fpagamento,m) 
	VALUES ('',$tipo,'$d','$m','$a','$categoria','$cliente','$descricao','$val','$val2','$status','$vencimento','$pago','$mes')";
	mysql_query($sql9);
	?>
        
        <?php 
        
        $op="Cadastro Um Novo Servi�o !";
        $sql5 = "INSERT INTO log 
		(cod, usuario, nome, data, hora, op, ip) VALUES ('', '$tipo', 
		'$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
        mysql_query($sql5);
        ?>
        
    
    
  
    
    
  </p>
	  <p>&nbsp;</p>
	  </td>
	
</form>
	
	
	
	</body>
</html>
	<?php
	@mysql_free_result($cliente);

mysql_free_result($categoria);
	?>
