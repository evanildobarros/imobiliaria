		<?php require_once('../Connections/conexao.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');
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
if (isset($_GET['id_aluno'])) {
  $colname_cliente = $_GET['id_aluno'];
}
mysql_select_db($database_conexao, $conexao);
$query_cliente = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_cliente, "int"));
$cliente = mysql_query($query_cliente, $conexao) or die(mysql_error());
$row_cliente = mysql_fetch_assoc($cliente);
$totalRows_cliente = mysql_num_rows($cliente);

mysql_select_db($database_conexao, $conexao);
$query_negocio = "SELECT * FROM negocio ORDER BY `desc` ASC";
$negocio = mysql_query($query_negocio, $conexao) or die(mysql_error());
$row_negocio = mysql_fetch_assoc($negocio);
$totalRows_negocio = mysql_num_rows($negocio);

mysql_select_db($database_conexao, $conexao);
$query_Tipo_imovel = "SELECT * FROM tipo_imovel ORDER BY `desc` ASC";
$Tipo_imovel = mysql_query($query_Tipo_imovel, $conexao) or die(mysql_error());
$row_Tipo_imovel = mysql_fetch_assoc($Tipo_imovel);
$totalRows_Tipo_imovel = mysql_num_rows($Tipo_imovel);

mysql_select_db($database_conexao, $conexao);
$query_padrao = "SELECT * FROM padrao ORDER BY `desc` ASC";
$padrao = mysql_query($query_padrao, $conexao) or die(mysql_error());
$row_padrao = mysql_fetch_assoc($padrao);
$totalRows_padrao = mysql_num_rows($padrao);

mysql_select_db($database_conexao, $conexao);
$query_garagem = "SELECT * FROM garagem ORDER BY `desc` ASC";
$garagem = mysql_query($query_garagem, $conexao) or die(mysql_error());
$row_garagem = mysql_fetch_assoc($garagem);
$totalRows_garagem = mysql_num_rows($garagem);

mysql_select_db($database_conexao, $conexao);
$query_municipio = "SELECT * FROM municipio ORDER BY municipio ASC";
$municipio = mysql_query($query_municipio, $conexao) or die(mysql_error());
$row_municipio = mysql_fetch_assoc($municipio);
$totalRows_municipio = mysql_num_rows($municipio);
		
		

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
		
		
		
		<html xmlns:wdg="http://ns.adobe.com/addt">
		<head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
		<link rel="stylesheet" href="../css/layout.css" type="text/css">
		<title>Gerenciador Imobiliario</title>
		<script src="../includes/common/js/base.js" type="text/javascript"></script>
		<script src="../includes/common/js/utility.js" type="text/javascript"></script>
		<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
		<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
		<script type="text/javascript" src="../includes/wdg/classes/MaskedInput.js"></script>
		<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
		</head>
		<body><br>
		<br>
		
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method='POST'>
        
		<fieldset>
        <input name="id_cliente" type="hidden" id="" value="<?php $nome = $_GET['id_cliente']; echo $nome; ?>">
        <input name="autorizar" type="hidden" id="autorizar" value="2">
         <input name="estado" type="hidden" id="estado" value="Ma">
		<legend>Registrar im&oacute;vel</legend>
		
		<table width="950" border="0" align="center">
		
		
		<tr>
		<td colspan="9">&nbsp;    <input type="checkbox" name="id_servico[]2" value="8" />
          <span class="span5">AULA EXTRA CAT. A - <span class="span8">R$ 22,00</span></span>
          
          <br>
          <hr /></tr>
		<tr>
		<td width="91">	Neg&oacute;cio	  		
		<td width="156"><label>
		<select name="negocio" id="negocio">
		  <option value="">Selecione</option>
		  <?php
do {  
?>
		  <option value="<?php echo $row_negocio['desc']?>"><?php echo $row_negocio['desc']?></option>
		  <?php
} while ($row_negocio = mysql_fetch_assoc($negocio));
  $rows = mysql_num_rows($negocio);
  if($rows > 0) {
      mysql_data_seek($negocio, 0);
	  $row_negocio = mysql_fetch_assoc($negocio);
  }
?>
	    </select>
		</label>
<td width="82">Tipo do Im&oacute;vel<td width="154"><label>
<select name="perfil_imovel" id="perfil_imovel">
  <option value="">Selecione</option>
  <?php
do {  
?>
  <option value="<?php echo $row_Tipo_imovel['desc']?>"><?php echo $row_Tipo_imovel['desc']?></option>
  <?php
} while ($row_Tipo_imovel = mysql_fetch_assoc($Tipo_imovel));
  $rows = mysql_num_rows($Tipo_imovel);
  if($rows > 0) {
      mysql_data_seek($Tipo_imovel, 0);
	  $row_Tipo_imovel = mysql_fetch_assoc($Tipo_imovel);
  }
?>
</select>
</label>
<td width="117">Padr&atilde;o<td colspan="4"><label>
<select name="padrao_imovel" id="padrao_imovel">
  <option value="">Selecione</option>
  <?php
do {  
?>
  <option value="<?php echo $row_padrao['desc']?>"><?php echo $row_padrao['desc']?></option>
  <?php
} while ($row_padrao = mysql_fetch_assoc($padrao));
  $rows = mysql_num_rows($padrao);
  if($rows > 0) {
      mysql_data_seek($padrao, 0);
	  $row_padrao = mysql_fetch_assoc($padrao);
  }
?>
</select>
</label>
  <label></label>
</tr>
		
		
		<tr>
		  <td valign="top">&Aacute;rea construida        
		  <td valign="top"><h2>
	        <input name="a_construida" type="text" id="a_construida" size="5">
	        m&sup2;
		  </h2>
		  <td valign="top">Valor Alugu&eacute;l
		  <td valign="top"><input placeholder="R$" name="valor_condominio" type="text" id="valor_condominio" size="5">        
		  <td valign="top">Valor Im&oacute;vel
		  <td colspan="4" valign="top"><input placeholder="R$" name="valor" type="text" id="valor" size="5">	      </tr>
		<tr>
		  <td valign="top">Dormit&oacute;rios
		  <td valign="top"><input name="dormitorio" type="text" id="dormitorio" size="5">
		  <td valign="top">Suites
		  <td valign="top"><input name="suites" type="text" id="suite" size="5">
		  <td valign="top">Garagem
		  <td colspan="4" valign="top"><select name="garagem" id="garagem">
            <option value="">Selecione</option>
            <?php
do {  
?>
            <option value="<?php echo $row_garagem['desc']?>"><?php echo $row_garagem['desc']?></option>
            <?php
} while ($row_garagem = mysql_fetch_assoc($garagem));
  $rows = mysql_num_rows($garagem);
  if($rows > 0) {
      mysql_data_seek($garagem, 0);
	  $row_garagem = mysql_fetch_assoc($garagem);
  }
?>
          </select>		</tr>
		
		<tr>
		  <td valign="top">Financiamento
		  <td valign="top"><input type="radio" name="financiamento" id="radio" value="Sim">
Sim
  <input type="radio" name="financiamento" id="radio" value="N&atilde;o">
N&atilde;o
		  <td valign="top">Fim do anuncio
		  <td valign="top"><input name="data_fim" type="date" id="data_fim" size="17">
		  <td colspan="5" valign="top">
		    <label></label>          
	        <label></label>          </tr>
		<tr>
		  <td colspan="9" valign="top">		</tr>
		<tr>
		  <td valign="top">        
		  <td colspan="2" valign="top">        
		  <td valign="top">        
		  <td valign="top">        
		  <td valign="top">        
		  <td colspan="3" valign="top">		  </tr>
		<tr>
		  <td valign="top">Endere&ccedil;o
		  <td colspan="2" valign="top"><label></label>          
		    <input name="endereco" type="text" id="endereco" size="40">
	      <td valign="top">Bairro
		  <td valign="top"><input type="text" name="bairro" id="bairro">
		  <td width="108" valign="top">Munic&iacute;pio          
		  <td colspan="3" valign="top"><label>
		  <select name="municipio" id="municipio">
		    <option value="">Selecione</option>
		    <?php
do {  
?>
		    <option value="<?php echo $row_municipio['municipio']?>"><?php echo $row_municipio['municipio']?></option>
		    <?php
} while ($row_municipio = mysql_fetch_assoc($municipio));
  $rows = mysql_num_rows($municipio);
  if($rows > 0) {
      mysql_data_seek($municipio, 0);
	  $row_municipio = mysql_fetch_assoc($municipio);
  }
?>
	      </select>
		  </label>    		</tr>
		<tr>
		  <td valign="top">Telefone
		  <td valign="top"><input name="telefone" id="telefone" value="" wdg:subtype="MaskedInput" wdg:mask="(98) 9999-999" wdg:restricttomask="no" wdg:type="widget">          
		  <td valign="top">Email
		  <td colspan="3" valign="top"><input name="email" type="text" id="email" size="50">          
		  <td colspan="3" valign="top">
		</tr>
		<tr>
		  <td colspan="9" valign="top">		  </tr>
		<tr>
		  <td colspan="9" valign="top"><input class="botao" type='submit' value='Registrar' name='bt'>		  </tr>
		</table>
		</fieldset>
		
	
<br>

		<?php
		
		
		if(isset($_POST['bt'])){
		
		
		$id                = $_POST['int_id'];
		$id_cliente        = $_POST['id_cliente'];
		$telefone          = $_POST['telefone'];
		$email             = $_POST['email'];
		$municipio         = $_POST['municipio'];
		$estado            = $_POST['estado'];
		$endereco          = $_POST['endereco'];
		$bairro            = $_POST['bairro'];
		$negocio           = $_POST['negocio'];
		$perfil_imovel     = $_POST['perfil_imovel'];
		$padrao_imovel     = $_POST['padrao_imovel'];
		$a_construida      = $_POST['a_construida'];
		$valor_condominio  = $_POST['valor_condominio'];
		$financiamento     = $_POST['financiamento'];
		$dormitorio        = $_POST['dormitorio'];
		$suites            = $_POST['suites'];
		$garagem           = $_POST['garagem'];
		$val3              = $_POST['valor'];
		$data_fim          = $_POST['data_fim'];
		$autorizar         = $_POST['autorizar'];
		$servico           = $_POST['id_servico'];
		
		
		//Faz um foreach no array materias para percorrer os valores do array.. e os adiciona na tabela curso_professor
		foreach($servico as $indice => $valor){
		
		$sql = mysql_query("INSERT INTO imovel(int_id,
		                                       id_cliente,
											   telefone,
											   email,
											   municipio,
											   estado,
											   endereco,
											   bairro,
											   negocio,
											   perfil_imovel,
											   padrao_imovel,
											   a_construida,
											   valor_condominio,
											   financiamento,
											   dormitorio,
											   suites,
											   garagem,
											   valor,
											   data_fim,
											   autorizar,
											   id_servico) 
											   VALUES('$id',
											          '$id_cliente',
													  '$telefone',
													  '$email',
													  '$municipio',
													  '$estado',
													  '$endereco',
													  '$bairro',
													  '$negocio',
													  '$perfil_imovel',
													  '$padrao_imovel',
		                                              '$a_construida',
													  '$valor_condominio',
													  '$financiamento',
													  '$dormitorio',
													  '$suites',
													  '$garagem',
													  '$val3',
													  '$data_fim',
													  '$autorizar',
													  '$valor')");
		
		}
		
		
		}
		
		
		
		?>
		

		<br>
		<br>
		
		
		
		
		
		</p>
		<p>&nbsp;</p>
		</td>
		
		</form>
		
		
		
		</body>
		</html>
		<?php
		@mysql_free_result($cliente);

        @mysql_free_result($negocio);

        @mysql_free_result($Tipo_imovel);

       @mysql_free_result($padrao);

       @mysql_free_result($garagem);

       @mysql_free_result($municipio);
		
		
?>
