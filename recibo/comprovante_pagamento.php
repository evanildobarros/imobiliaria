<?php
            if (!isset($_SESSION)) {
            @session_start();
            }
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

$colname_mov = "-1";
if (isset($_GET['id_mov'])) {
  $colname_mov = $_GET['id_mov'];
}
mysql_select_db($database_conexao, $conexao);
$query_mov = sprintf("SELECT * FROM movimento WHERE id_mov = %s", GetSQLValueString($colname_mov, "int"));
$mov = mysql_query($query_mov, $conexao) or die(mysql_error());
$row_mov = mysql_fetch_assoc($mov);
$totalRows_mov = mysql_num_rows($mov);

$val = $row_mov['valor'];

 
/**
 * Retorna uma string do numero
 * 
 * @param string $n - Valor a ser traduzido,  apenas numeros inteiros
 * @example numeroEscrito('500');
 * @return string 
 */
function numeroEscrito($n) {
 
    $numeros[1][0] = '';
    $numeros[1][1] = 'um';
    $numeros[1][2] = 'dois';
    $numeros[1][3] = 'três';
    $numeros[1][4] = 'quatro';
    $numeros[1][5] = 'cinco';
    $numeros[1][6] = 'seis';
    $numeros[1][7] = 'sete';
    $numeros[1][8] = 'oito';
    $numeros[1][9] = 'nove';
 
    $numeros[2][0] = '';
    $numeros[2][10] = 'dez';
    $numeros[2][11] = 'onze';
    $numeros[2][12] = 'doze';
    $numeros[2][13] = 'treze';
    $numeros[2][14] = 'quatorze';
    $numeros[2][15] = 'quinze';
    $numeros[2][16] = 'dezesseis';
    $numeros[2][17] = 'dezesete';
    $numeros[2][18] = 'dezoito';
    $numeros[2][19] = 'dezenove';
    $numeros[2][2] = 'vinte';
    $numeros[2][3] = 'trinta';
    $numeros[2][4] = 'quarenta';
    $numeros[2][5] = 'cinquenta';
    $numeros[2][6] = 'sessenta';
    $numeros[2][7] = 'setenta';
    $numeros[2][8] = 'oitenta';
    $numeros[2][9] = 'noventa';
 
    $numeros[3][0] = '';
    $numeros[3][1] = 'cem';
    $numeros[3][2] = 'duzentos';
    $numeros[3][3] = 'trezentos';
    $numeros[3][4] = 'quatrocentos';
    $numeros[3][5] = 'quinhentos';
    $numeros[3][6] = 'seiscentos';
    $numeros[3][7] = 'setecentos';
    $numeros[3][8] = 'oitocentos';
    $numeros[3][9] = 'novecentos';
 
    $qtd = strlen($n);
 
    $compl[0] = ' mil ';
    $compl[1] = ' milhão ';
    $compl[2] = ' milhões ';
    $numero = "";
    $casa = $qtd;
    $pulaum = false;
    $x = 0;
    for ($y = 0; $y < $qtd; $y++) {
 
        if ($casa == 5) {
 
            if ($n[$x] == '1') {
 
                $indice = '1' . $n[$x + 1];
                $pulaum = true;
            } else {
 
                $indice = $n[$x];
            }
 
            if ($n[$x] != '0') {
 
                if (isset($n[$x - 1])) {
 
                    $numero .= ' e ';
                }
 
                $numero .= $numeros[2][$indice];
 
                if ($pulaum) {
 
                    $numero .= ' ' . $compl[0];
                }
            }
        }
 
        if ($casa == 4) {
 
            if (!$pulaum) {
 
                if ($n[$x] != '0') {
 
                    if (isset($n[$x - 1])) {
 
                        $numero .= ' e ';
                    }
                }
            }
 
            $numero .= $numeros[1][$n[$x]] . ' ' . $compl[0];
        }
 
        if ($casa == 3) {
 
            if ($n[$x] == '1' && $n[$x + 1] != '0') {
 
                $numero .= 'cento ';
            } else {
 
                if ($n[$x] != '0') {
 
                    if (isset($n[$x - 1])) {
 
                        $numero .= ' e ';
                    }
 
                    $numero .= $numeros[3][$n[$x]];
                }
            }
        }
 
        if ($casa == 2) {
 
            if ($n[$x] == '1') {
 
                $indice = '1' . $n[$x + 1];
                $casa = 0;
            } else {
 
                $indice = $n[$x];
            }
 
            if ($n[$x] != '0') {
 
                if (isset($n[$x - 1])) {
 
                    $numero .= ' e ';
                }
 
                $numero .= $numeros[2][$indice];
            }
        }
 
        if ($casa == 1) {
 
            if ($n[$x] != '0') {
                if ($numeros[1][$n[$x]] <= 10)
                    $numero .= ' ' . $numeros[1][$n[$x]];
                else
                    $numero .= ' e ' . $numeros[1][$n[$x]];
            } else {
 
                $numero .= '';
            }
        }
 
        if ($pulaum) {
 
            $casa--;
            $x++;
            $pulaum = false;
        }
 
        $casa--;
        $x++;
    }
 
    return $numero;
}
?>

<?php
/**
 * Retorna uma string do valor 
 *  
 * @param string $n - Valor a ser traduzido, pode ser no formato americano ou brasileiro
 * @example escreverValorMoeda('1.530,64');
 * @example escreverValorMoeda('1530.64');
 * @return string 
 */
function escreverValorMoeda($n){
    //Converte para o formato float 
    if(strpos($n, ',') !== FALSE){
        $n = str_replace('.','',$n); 
        $n = str_replace(',','.',$n);
    }
 
    //Separa o valor "reais" dos "centavos"; 
    $n = explode('.',$n);
 
    return ucfirst(numeroEscrito($n[0])). ' reais' . ((isset($n[1]) && $n[1] > 0)?' e '.numeroEscrito($n[1]).' centavos.':'');
 
}

$cpf = $row_cliente['cpf_titular'];
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Auto Escola</title>
</head>

<body>
<?php echo $_SESSION['MM_Username']; ?><br>

      <?php
//Agora um exemplo prático
     $valor = number_format($val,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$valor."</font>"; 
	
?></div>
      <div class="box1">
    
      <br>
Recebi do(a) Sr.(a) <?php echo $row_mov['cliente']; ?> </strong>&nbsp;a quantia supra <strong>R$</strong>&nbsp;<strong><?php
//Agora um exemplo prático
     $valor = number_format($val,2,",",".");
    
    echo $valor.' ('.escreverValorMoeda($valor); echo ')'; 
	
?></strong>

pelos servi&ccedil;os 
<?php echo $row_mov['servico']; ?>
</body>
</html>
<?php
mysql_free_result($mov);

?>
