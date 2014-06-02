<?php 
session_start();


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

$maxRows_ciclomotor = 10;
$pageNum_ciclomotor = 0;
if (isset($_GET['pageNum_ciclomotor'])) {
  $pageNum_ciclomotor = $_GET['pageNum_ciclomotor'];
}
$startRow_ciclomotor = $pageNum_ciclomotor * $maxRows_ciclomotor;

mysql_select_db($database_conexao, $conexao);
$query_ciclomotor = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='ciclomotor' GROUP BY 'vei.tipo'";
$query_limit_ciclomotor = sprintf("%s LIMIT %d, %d", $query_ciclomotor, $startRow_ciclomotor, $maxRows_ciclomotor);
$ciclomotor = mysql_query($query_limit_ciclomotor, $conexao) or die(mysql_error());
$row_ciclomotor = mysql_fetch_assoc($ciclomotor);

if (isset($_GET['totalRows_ciclomotor'])) {
  $totalRows_ciclomotor = $_GET['totalRows_ciclomotor'];
} else {
  $all_ciclomotor = mysql_query($query_ciclomotor);
  $totalRows_ciclomotor = mysql_num_rows($all_ciclomotor);
}
$totalPages_ciclomotor = ceil($totalRows_ciclomotor/$maxRows_ciclomotor)-1;

$maxRows_motoneta = 10;
$pageNum_motoneta = 0;
if (isset($_GET['pageNum_motoneta'])) {
  $pageNum_motoneta = $_GET['pageNum_motoneta'];
}
$startRow_motoneta = $pageNum_motoneta * $maxRows_motoneta;

mysql_select_db($database_conexao, $conexao);
$query_motoneta = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='motoneta' GROUP BY 'vei.tipo'";
$query_limit_motoneta = sprintf("%s LIMIT %d, %d", $query_motoneta, $startRow_motoneta, $maxRows_motoneta);
$motoneta = mysql_query($query_limit_motoneta, $conexao) or die(mysql_error());
$row_motoneta = mysql_fetch_assoc($motoneta);

if (isset($_GET['totalRows_motoneta'])) {
  $totalRows_motoneta = $_GET['totalRows_motoneta'];
} else {
  $all_motoneta = mysql_query($query_motoneta);
  $totalRows_motoneta = mysql_num_rows($all_motoneta);
}
$totalPages_motoneta = ceil($totalRows_motoneta/$maxRows_motoneta)-1;

$maxRows_motocicleta = 10;
$pageNum_motocicleta = 0;
if (isset($_GET['pageNum_motocicleta'])) {
  $pageNum_motocicleta = $_GET['pageNum_motocicleta'];
}
$startRow_motocicleta = $pageNum_motocicleta * $maxRows_motocicleta;

mysql_select_db($database_conexao, $conexao);
$query_motocicleta = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='motocicleta' GROUP BY 'vei.tipo'";
$query_limit_motocicleta = sprintf("%s LIMIT %d, %d", $query_motocicleta, $startRow_motocicleta, $maxRows_motocicleta);
$motocicleta = mysql_query($query_limit_motocicleta, $conexao) or die(mysql_error());
$row_motocicleta = mysql_fetch_assoc($motocicleta);

if (isset($_GET['totalRows_motocicleta'])) {
  $totalRows_motocicleta = $_GET['totalRows_motocicleta'];
} else {
  $all_motocicleta = mysql_query($query_motocicleta);
  $totalRows_motocicleta = mysql_num_rows($all_motocicleta);
}
$totalPages_motocicleta = ceil($totalRows_motocicleta/$maxRows_motocicleta)-1;

$maxRows_Automovel = 10;
$pageNum_Automovel = 0;
if (isset($_GET['pageNum_Automovel'])) {
  $pageNum_Automovel = $_GET['pageNum_Automovel'];
}
$startRow_Automovel = $pageNum_Automovel * $maxRows_Automovel;

mysql_select_db($database_conexao, $conexao);
$query_Automovel = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='automovel' GROUP BY 'vei.tipo'";
$query_limit_Automovel = sprintf("%s LIMIT %d, %d", $query_Automovel, $startRow_Automovel, $maxRows_Automovel);
$Automovel = mysql_query($query_limit_Automovel, $conexao) or die(mysql_error());
$row_Automovel = mysql_fetch_assoc($Automovel);

if (isset($_GET['totalRows_Automovel'])) {
  $totalRows_Automovel = $_GET['totalRows_Automovel'];
} else {
  $all_Automovel = mysql_query($query_Automovel);
  $totalRows_Automovel = mysql_num_rows($all_Automovel);
}
$totalPages_Automovel = ceil($totalRows_Automovel/$maxRows_Automovel)-1;

$maxRows_quadriciclo = 10;
$pageNum_quadriciclo = 0;
if (isset($_GET['pageNum_quadriciclo'])) {
  $pageNum_quadriciclo = $_GET['pageNum_quadriciclo'];
}
$startRow_quadriciclo = $pageNum_quadriciclo * $maxRows_quadriciclo;

mysql_select_db($database_conexao, $conexao);
$query_quadriciclo = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='quadriciculo' GROUP BY 'vei.tipo'";
$query_limit_quadriciclo = sprintf("%s LIMIT %d, %d", $query_quadriciclo, $startRow_quadriciclo, $maxRows_quadriciclo);
$quadriciclo = mysql_query($query_limit_quadriciclo, $conexao) or die(mysql_error());
$row_quadriciclo = mysql_fetch_assoc($quadriciclo);

if (isset($_GET['totalRows_quadriciclo'])) {
  $totalRows_quadriciclo = $_GET['totalRows_quadriciclo'];
} else {
  $all_quadriciclo = mysql_query($query_quadriciclo);
  $totalRows_quadriciclo = mysql_num_rows($all_quadriciclo);
}
$totalPages_quadriciclo = ceil($totalRows_quadriciclo/$maxRows_quadriciclo)-1;

$maxRows_caminhao = 10;
$pageNum_caminhao = 0;
if (isset($_GET['pageNum_caminhao'])) {
  $pageNum_caminhao = $_GET['pageNum_caminhao'];
}
$startRow_caminhao = $pageNum_caminhao * $maxRows_caminhao;

mysql_select_db($database_conexao, $conexao);
$query_caminhao = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='caminhao' GROUP BY 'vei.tipo'";
$query_limit_caminhao = sprintf("%s LIMIT %d, %d", $query_caminhao, $startRow_caminhao, $maxRows_caminhao);
$caminhao = mysql_query($query_limit_caminhao, $conexao) or die(mysql_error());
$row_caminhao = mysql_fetch_assoc($caminhao);

if (isset($_GET['totalRows_caminhao'])) {
  $totalRows_caminhao = $_GET['totalRows_caminhao'];
} else {
  $all_caminhao = mysql_query($query_caminhao);
  $totalRows_caminhao = mysql_num_rows($all_caminhao);
}
$totalPages_caminhao = ceil($totalRows_caminhao/$maxRows_caminhao)-1;

$maxRows_caminhaotrator = 10;
$pageNum_caminhaotrator = 0;
if (isset($_GET['pageNum_caminhaotrator'])) {
  $pageNum_caminhaotrator = $_GET['pageNum_caminhaotrator'];
}
$startRow_caminhaotrator = $pageNum_caminhaotrator * $maxRows_caminhaotrator;

mysql_select_db($database_conexao, $conexao);
$query_caminhaotrator = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo =' caminhão - trator' GROUP BY 'vei.tipo'";
$query_limit_caminhaotrator = sprintf("%s LIMIT %d, %d", $query_caminhaotrator, $startRow_caminhaotrator, $maxRows_caminhaotrator);
$caminhaotrator = mysql_query($query_limit_caminhaotrator, $conexao) or die(mysql_error());
$row_caminhaotrator = mysql_fetch_assoc($caminhaotrator);

if (isset($_GET['totalRows_caminhaotrator'])) {
  $totalRows_caminhaotrator = $_GET['totalRows_caminhaotrator'];
} else {
  $all_caminhaotrator = mysql_query($query_caminhaotrator);
  $totalRows_caminhaotrator = mysql_num_rows($all_caminhaotrator);
}
$totalPages_caminhaotrator = ceil($totalRows_caminhaotrator/$maxRows_caminhaotrator)-1;

$maxRows_trator = 10;
$pageNum_trator = 0;
if (isset($_GET['pageNum_trator'])) {
  $pageNum_trator = $_GET['pageNum_trator'];
}
$startRow_trator = $pageNum_trator * $maxRows_trator;

mysql_select_db($database_conexao, $conexao);
$query_trator = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='trator' GROUP BY 'vei.tipo'";
$query_limit_trator = sprintf("%s LIMIT %d, %d", $query_trator, $startRow_trator, $maxRows_trator);
$trator = mysql_query($query_limit_trator, $conexao) or die(mysql_error());
$row_trator = mysql_fetch_assoc($trator);

if (isset($_GET['totalRows_trator'])) {
  $totalRows_trator = $_GET['totalRows_trator'];
} else {
  $all_trator = mysql_query($query_trator);
  $totalRows_trator = mysql_num_rows($all_trator);
}
$totalPages_trator = ceil($totalRows_trator/$maxRows_trator)-1;

$maxRows_utilitario = 10;
$pageNum_utilitario = 0;
if (isset($_GET['pageNum_utilitario'])) {
  $pageNum_utilitario = $_GET['pageNum_utilitario'];
}
$startRow_utilitario = $pageNum_utilitario * $maxRows_utilitario;

mysql_select_db($database_conexao, $conexao);
$query_utilitario = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='utilitario' GROUP BY 'vei.tipo'";
$query_limit_utilitario = sprintf("%s LIMIT %d, %d", $query_utilitario, $startRow_utilitario, $maxRows_utilitario);
$utilitario = mysql_query($query_limit_utilitario, $conexao) or die(mysql_error());
$row_utilitario = mysql_fetch_assoc($utilitario);

if (isset($_GET['totalRows_utilitario'])) {
  $totalRows_utilitario = $_GET['totalRows_utilitario'];
} else {
  $all_utilitario = mysql_query($query_utilitario);
  $totalRows_utilitario = mysql_num_rows($all_utilitario);
}
$totalPages_utilitario = ceil($totalRows_utilitario/$maxRows_utilitario)-1;

$maxRows_reboque = 10;
$pageNum_reboque = 0;
if (isset($_GET['pageNum_reboque'])) {
  $pageNum_reboque = $_GET['pageNum_reboque'];
}
$startRow_reboque = $pageNum_reboque * $maxRows_reboque;

mysql_select_db($database_conexao, $conexao);
$query_reboque = "SELECT vei.tipo,  count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,    count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,    count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,   count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,   count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,    count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,   count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,   count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,   count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,   count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,   count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,   count(*) as Total FROM veiculos AS vei WHERE vei.tipo ='reboque / semi-reboque' GROUP BY 'vei.tipo'";
$query_limit_reboque = sprintf("%s LIMIT %d, %d", $query_reboque, $startRow_reboque, $maxRows_reboque);
$reboque = mysql_query($query_limit_reboque, $conexao) or die(mysql_error());
$row_reboque = mysql_fetch_assoc($reboque);

if (isset($_GET['totalRows_reboque'])) {
  $totalRows_reboque = $_GET['totalRows_reboque'];
} else {
  $all_reboque = mysql_query($query_reboque);
  $totalRows_reboque = mysql_num_rows($all_reboque);
}
$totalPages_reboque = ceil($totalRows_reboque/$maxRows_reboque)-1;

mysql_select_db($database_conexao, $conexao);
$query_total = "SELECT COUNT(*) as total FROM veiculos";
$total = mysql_query($query_total, $conexao) or die(mysql_error());
$row_total = mysql_fetch_assoc($total);
$totalRows_total = mysql_num_rows($total);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Gerenciador Despachante</title>
	<link rel="stylesheet" href="css/layout.css" type="text/css">
	<link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">

</head>

<body>



<table width="800" border="1" bordercolor="#e1e1e1" align="center" style="border-collapse:collapse;"><br />
<br />
<br />
	
  <tr>
    <td bgcolor="#3b5998"><span class="span">Especie</span></td>
    <td bgcolor="#3b5998"><span class="span">Janeiro</span></td>
    <td bgcolor="#3b5998"><span class="span">Fevereiro</span></td>
    <td bgcolor="#3b5998"><span class="span">Marco</span></td>
    <td bgcolor="#3b5998"><span class="span">Abril</span></td>
    <td bgcolor="#3b5998"><span class="span">Maio</span></td>
    <td bgcolor="#3b5998"><span class="span">Junho</span></td>
    <td bgcolor="#3b5998"><span class="span">Julho</span></td>
    <td bgcolor="#3b5998"><span class="span">Agosto</span></td>
    <td bgcolor="#3b5998"><span class="span">Setembro</span></td>
    <td bgcolor="#3b5998"><span class="span">Outubro</span></td>
    <td bgcolor="#3b5998"><span class="span">Novembro</span></td>
    <td bgcolor="#3b5998"><span class="span">Dezembro</span></td>
    <td bgcolor="#3b5998"><span class="span">Total</span></td>
  </tr>
  <?php do { ?>
      <tr>
        <td bgcolor="#F7F7F7"><span class="span4">Ciclomotor</span></td>
        <td><span class=""><?php echo $row_ciclomotor['Janeiro']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Fevereiro']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Marco']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Abril']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Maio']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Junho']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Julho']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Agosto']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Setembro']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Outubro']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Novembro']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Dezembro']; ?></div></td>
        <td><div align="center"><?php echo $row_ciclomotor['Total']; ?></div></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><span class="span4">Motoneta</span></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Janeiro']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Fevereiro']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Marco']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Abril']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Maio']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Junho']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Julho']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Agosto']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Setembro']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Outubro']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Novembro']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Dezembro']; ?></div></td>
        <td bordercolor="#E8F2FD" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motoneta['Total']; ?></div></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><span class="span4">Quadriciculo</span></td>
        <td><div align="center"><?php echo $row_quadriciclo['Janeiro']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Fevereiro']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Marco']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Abril']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Maio']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Junho']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Julho']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Agosto']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Setembro']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Outubro']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Novembro']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Dezembro']; ?></div></td>
        <td><div align="center"><?php echo $row_quadriciclo['Total']; ?></div></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><span class="span4">Motocicleta</span></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Janeiro']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Fevereiro']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Marco']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Abril']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Maio']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Junho']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Julho']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Agosto']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Setembro']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Outubro']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Novembro']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Dezembro']; ?></div></td>
        <td bordercolor="#C5EEFE" bgcolor="#C5EEFE"><div align="center"><?php echo $row_motocicleta['Total']; ?></div></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><span class="span4">Automovel</span></td>
        <td><div align="center"><?php echo $row_Automovel['Janeiro']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Fevereiro']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Marco']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Abril']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Maio']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Junho']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Julho']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Agosto']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Setembro']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Outubro']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Novembro']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Dezembro']; ?></div></td>
        <td><div align="center"><?php echo $row_Automovel['Total']; ?></div></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><span class="span4">Caminh&atilde;o</span></td></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Janeiro']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Fevereiro']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Marco']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Abril']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Maio']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Junho']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Julho']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Agosto']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Setembro']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Outubro']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Novembro']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Dezembro']; ?></div></td>
        <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_caminhao['Total']; ?></div></td>
      </tr>
    <tr>
      <td bgcolor="#F7F7F7"><span class="span4">Caminh&atilde;o - trator</span></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Janeiro']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Fevereiro']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Marco']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Abril']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Maio']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Junho']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Julho']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Agosto']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Setembro']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Outubro']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Novembro']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Dezembro']; ?></div></td>
      <td><div align="center"><?php echo $row_caminhaotrator['Total']; ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#F7F7F7"><span class="span4">Trator</span></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Janeiro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Fevereiro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Marco']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Abril']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Maio']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Junho']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Julho']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Agosto']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Setembro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Outubro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Novembro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Dezembro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_trator['Total']; ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#F7F7F7"><span class="span4">Ultilit&aacute;rio</span></td>
      <td><div align="center"><?php echo $row_utilitario['Janeiro']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Fevereiro']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Marco']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Abril']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Maio']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Junho']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Julho']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Agosto']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Setembro']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Outubro']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Novembro']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Dezembro']; ?></div></td>
      <td><div align="center"><?php echo $row_utilitario['Total']; ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#F7F7F7"><span class="span4">Reboque / Semi-reboque</span></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Janeiro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Fevereiro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Marco']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Abril']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Maio']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Junho']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Julho']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Agosto']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Setembro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Outubro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Novembro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Dezembro']; ?></div></td>
      <td bgcolor="#C5EEFE"><div align="center"><?php echo $row_reboque['Total']; ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#F7F7F7">&nbsp;</td>
      <td colspan="12">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#3b5998"><span class="span1"><strong>Total</strong></span></td>
      <td colspan="12" bgcolor="#3b5998"><div align="center"></div>        
      <div align="center"></div>        <div align="center"></div>        <div align="center"></div>        <div align="center"></div>        <div align="center"></div>        <div align="center"></div>        <div align="center"></div>        <div align="center"></div>        <div align="center"></div></td>
      <td bgcolor="#3b5998"><div align="center" class="span1"><?php echo $row_total['total']; ?></div></td>
    </tr>
    <?php } while ($row_ciclomotor = mysql_fetch_assoc($ciclomotor)); ?>
</table>



</body>
</html>
<?php
mysql_free_result($ciclomotor);

mysql_free_result($motoneta);

mysql_free_result($motocicleta);

mysql_free_result($Automovel);

mysql_free_result($quadriciclo);

mysql_free_result($caminhao);

mysql_free_result($caminhaotrator);

mysql_free_result($trator);

mysql_free_result($utilitario);

mysql_free_result($reboque);

mysql_free_result($total);
?>
