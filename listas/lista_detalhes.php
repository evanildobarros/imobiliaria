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

$colname_proces = "-1";
if (isset($_GET['cliente'])) {
  $colname_proces = $_GET['cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_proces = sprintf("SELECT *  FROM processo WHERE cliente = %s", GetSQLValueString($colname_proces, "text"));
$proces = mysql_query($query_proces, $conexao) or die(mysql_error());
$row_proces = mysql_fetch_assoc($proces);
$totalRows_proces = mysql_num_rows($proces);

$cliente = $row_proces['cliente'];
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/layout.css" type="text/css">
	<link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
<title>Gereciador Imobiliaria</title>
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
<form name="frmMain" action="lista_detalhes.php" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1000" border="0" align="center" style="border-collapse:collapse;">
              <tr>
                <td width="585" bgcolor="#FFFFFF"><img src="../img/LOGO_CARRO2.jpg" alt="" width="300" height="80" /></td>
                <td width="405" valign="top" bgcolor="#FFFFFF"><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Av. Jer&ocirc;nimo de Albuquerque Pop Center Bloco C, Sala 08, , Cohab Anil III<br />
S&atilde;o Lu&iacute;s, Maranh&atilde;o <br />
CNPJ:9999.9999.0001-00</span></td>
              </tr>
            </table>
<table width="1000" border="0" align="center" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			  <td colspan="6" valign="baseline" bgcolor="#FFFFFF">&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="6" valign="baseline" bgcolor="#FFFFFF"><HR /></td>
			  </tr>
			<tr>
			  <td colspan="2" valign="baseline" bgcolor="#FFFFFF"><p>&nbsp;</p>
		      <p align="left"><span class="span14">Nº DO PROCESSO</span>: <span class="span26"><?php echo $row_proces['codigo']; ?></span><br />
		        <br />
		        <span class="span12">CLIENTE:</span> <span class="span7"><?php echo $row_proces['cliente']; ?></span><br />
		      <br />
		      <span class="span6">INICIO DO PROCESSO: <?php 
	   $date = $row_proces['entrada'];  
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?></span></p></td>
			  <td valign="baseline" bgcolor="#FFFFFF"><div align="center" class="span7">
			    <div align="right"><strong>LISTA DETALHADA</strong></div>
			  </div></td>
			  <td colspan="3" valign="baseline" bgcolor="#FFFFFF">&nbsp;</td>
			  </tr>
			<tr>
			<td width="49" valign="baseline" bgcolor="#FFFFFF" class="span10"><div align="left"></div></td>
			<td width="262" valign="top" bgcolor="#FFFFFF" class="span10" ><div align="left"><br />
			  Local de Origem<br />
			</div></td>
			<td width="274"  valign="top" bgcolor="#FFFFFF" class="span10" ><div align="left"><br />
			  Descrição do processo</div></td>
			<td width="227"  valign="top" bgcolor="#FFFFFF" class="span10"><div align="left"><br />
			  Data da movimentação</div></td>
			<td width="88"  valign="top" bgcolor="#FFFFFF" class="span10"><div align="left"><br />
			  Hora</div></td>
			<td width="74" align="center" valign="top" bgcolor="#FFFFFF" class="span10"><div align="left"><br />			
			  Status<br />
			</div></td>
			</tr>
			<?php
			
			
			require_once('../Connections/conexao.php');
			
			$p = $_GET["p"];
			
			if(isset($p)) {
			$p = $p;
			} else {
			$p = 1;
			}
			
			$qnt = 8;
			$inicio = ($p*$qnt) - $qnt;
			
			if($_REQUEST['filtro'] == ' ' )
			$filtro = '';
			else
			$filtro = $_REQUEST['filtro'];
			
			if($_REQUEST['filtro1'] == ' ' )
			$filtro1 = '';
			else
			$filtro1 = $_REQUEST['filtro1'];
			
			$sql = "SELECT * from processo WHERE cliente = '".$cliente."' AND cliente like '".$filtro."%' ORDER BY id_processo DESC LIMIT $inicio, $qnt ";
			
			$rs  = mysql_query($sql);
			
			function geraTimestamp($data) {
			$partes = explode('/', $data);
			return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
			}
			$cont = 0;
			while ($resultado = @mysql_fetch_array($rs))
			{
			
			
			$cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
			?>
		<tr bgcolor="<?php echo $cor ; ?>">
			<td valign="top"><label>
			<input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id_processo"];?>">
			</label></td>
			<td valign="top" class="td3"><span class="span6"><?php echo $resultado['local']; ?></span></td>
			
			<td valign="top" class="td3"><span class="span6"><?php echo $resultado['descricao']; ?></span></td>
			<td valign="top" class="td3"><div align="center"><span class="span6">
		    <?php 
	   $date = $resultado['movimentacao']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?>
		    </span></div></td>
			<td valign="top" class="td3"><div align="left" class="span6"><?php echo $resultado['hora']; ?></div>
		    <div align="center"></div><div align="center"></div><div align="center"></div></td>
			<td valign="top" class="td3"><div align="left" class="span6"><?php if ($resultado['status'] == 1)
		{
		echo "<img src=\"../img/001.jpg\">";
		} else if ($resultado['status'] == 2){
		echo "<img src=\"../img/002.jpg\">";
		}
		else if ($resultado['status'] == 3){
		echo "<img src=\"../img/003.jpg\">";
		}
		else if ($resultado['status'] == 4){
		echo "<img src=\"../img/004.jpg\">";
		}
		
		
		
		
		 ?></div></td>
			</tr>
			<tr><?php $cont ++; }?>
			<?php
			$sql_select_all = "SELECT * from processo WHERE cliente = '".$cliente."'";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 3;
			?>
			<td colspan="6" align="center" valign="top" bgcolor="#FFFFFF"><br />
			  <label>
			  <input name="button2" type="submit" class="botao" id="button2" onclick="MM_goToURL('parent','layout_processo.php');return document.MM_returnValue" value="Voltar" />
			  <input name="button" type="submit" class="botao" id="button" onclick="MM_callJS('print();')" value="IMPRIMIR" />
			  </label>
			  <br />
			<br /></td>
			</tr>
			</table>
</form>
</body>
</html>
<?php
mysql_free_result($proces);
?>
