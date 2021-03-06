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




$maxRows_total = 10;
$pageNum_total = 0;
if (isset($_GET['pageNum_total'])) {
  $pageNum_total = $_GET['pageNum_total'];
}
$startRow_total = $pageNum_total * $maxRows_total;

mysql_select_db($database_conexao, $conexao);
$query_total = "SELECT ac.filial AS LOTACAO,   
   count(case when MONTH(vencimento) =   '1' then '01-Janeiro'   end)   as  Janeiro,  
   count(case when MONTH(vencimento) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   
   count(case when MONTH(vencimento) =   '3' then '03-Marco'     end)   as  Marco,     
   count(case when MONTH(vencimento) =   '4' then '04-Abril'     end)   as  Abril,    
   count(case when MONTH(vencimento) =   '5' then '05-Maio'      end)   as  Maio,    
   count(case when MONTH(vencimento) =   '6' then '06-Junho'     end)   as  Junho,     
   count(case when MONTH(vencimento) =   '7' then '07-Julho'     end)   as  Julho,    
   count(case when MONTH(vencimento) =   '8' then '08-Agosto'    end)   as  Agosto,    
   count(case when MONTH(vencimento) =   '9' then '09-Setembro'  end)   as  Setembro,    
   count(case when MONTH(vencimento) =   '10' then '10-Outubro'   end)  as  Outubro,    
   count(case when MONTH(vencimento) =   '11' then '11-Novembro'  end)  as  Novembro,    
   count(case when MONTH(vencimento) =   '12' then '12-Dezembro'  end)  as  Dezembro,  
   SUM(valor) as Total FROM acesso AS ac, lc_movimento AS mov WHERE ac.usuario = mov.id_cliente AND mov.tipo='1' GROUP BY ac.filial";
$query_limit_total = sprintf("%s LIMIT %d, %d", $query_total, $startRow_total, $maxRows_total);
$total = mysql_query($query_limit_total, $conexao) or die(mysql_error());
$row_total = mysql_fetch_assoc($total);

if (isset($_GET['totalRows_total'])) {
  $totalRows_total = $_GET['totalRows_total'];
} else {
  $all_total = mysql_query($query_total);
  $totalRows_total = mysql_num_rows($all_total);
}
$totalPages_total = ceil($totalRows_total/$maxRows_total)-1;

mysql_select_db($database_conexao, $conexao);
$query_total2 = "SELECT SUM(valor) FROM lc_movimento where tipo='1'";
$total2 = mysql_query($query_total2, $conexao) or die(mysql_error());
$row_total2 = mysql_fetch_assoc($total2);
$totalRows_total2 = mysql_num_rows($total2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/estatistica.css" type="text/css" />
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador imobiliaria</title>
<style type="text/css">
<!--
.style2 {color: #666666}
-->
</style>
</head>

<body><br />
<br />


<fieldset><legend>Quantidade de Atendimento por M&ecirc;s</legend><br />
<br />
<br />


<table width="1200" border="0" align="center" style="border-collapse:collapse;">
  
  <tr>
    <td bgcolor="#333"><span style="color:#FFF; padding:5px;">Escrit&oacute;rio </span></td>
    <td bgcolor="#003366"><span style="color:#FFF; padding:5px;">Janeiro</span></font></td>
    <td bgcolor="#0C4892"><span style="color:#FFF; padding:5px;">Fevereiro</span></font></td>
    <td bgcolor="#003366"><span style="color:#FFF; padding:5px;">Mar&ccedil;o</span></font></td>
    <td bgcolor="#0C4892"><span style="color:#FFF; padding:5px;">Abril</span></font></td>
    <td bgcolor="#003366"><span style="color:#FFF; padding:5px;">Maio</span></font></td>
    <td bgcolor="#0C4892"><span style="color:#FFF; padding:5px;">Junho</span></font></td>
    <td bgcolor="#003366"><span style="color:#FFF; padding:5px;">Julho</span></font></td>
    <td bgcolor="#0C4892"><span style="color:#FFF; padding:5px;">Agosto</span></font></td>
    <td bgcolor="#003366"><span style="color:#FFF; padding:5px;">Setembro</span></font></td>
    <td bgcolor="#0C4892"><span style="color:#FFF; padding:5px;">Outubro</span></font></td>
    <td bgcolor="#003366"><span style="color:#FFF; padding:5px;">Novembro</span></font></td>
    <td bgcolor="#0C4892"><span style="color:#FFF; padding:5px;">Dezembro</span></font></td>
    <td bgcolor="#003366" ><span style="color:#FFF; padding:5px;">Total</span></font></td>
  </tr>
  <?php 
  $cont = 0;
  do { 
   $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
  ?>
      <tr bgcolor="<?php echo $cor ; ?>">
        <td bgcolor="#333"><span style="color:#33FFFF; padding:5px;"><?php echo $row_total['LOTACAO']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Janeiro']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Fevereiro']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Marco']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Abril']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Maio']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Junho']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Julho']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Agosto']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Setembro']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Outubro']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Novembro']; ?></span></td>
        <td><span style="margin:0px 0px 0px 25px;"><?php echo $row_total['Dezembro']; ?></span></td>
        <td >R$ <?php $vl1 = $row_total['Total']; $vl1 = $row_total['Total']; 
	  echo number_format( $vl1  , 2 , ',' , '.' );
	  ?></td>
      </tr>
       <?php $cont ++; } while ($row_total = mysql_fetch_assoc($total)); ?>
    <tr>
      <td colspan="13"  bgcolor="#003366" class="td3">&nbsp;</td>
      <td   bgcolor="#003366"><span style="color:#FFFFFF;">R$ <?php $vl = $row_total2['SUM(valor)']; $vl = $row_total2['SUM(valor)']; 
	  echo number_format( $vl  , 2 , ',' , '.' );
	  ?></span></td>
    </tr>
</table><br />
<br />


</fieldset>


</body>
</html>
<?php
mysql_free_result($total);

mysql_free_result($total2);
?>

	<?php 
			
			$op="Consultou Quantida de alunos por mês !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>