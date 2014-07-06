<?php
session_start();
set_time_limit(0);

include 'config.php';
include 'functions.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'apagar') {
    $id = $_GET['id'];

    mysql_query("DELETE FROM lc_movimento WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&ok=2");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 'editar_cat') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    mysql_query("UPDATE lc_cat SET nome='$nome' WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_ok=3");
    exit();
}

if (isset($_GET['acao']) && $_GET['acao'] == 'apagar_cat') {
    $id = $_GET['id'];

    $qr=mysql_query("SELECT c.id FROM lc_movimento m, lc_cat c WHERE c.id=m.cat && c.id=$id");
    if (mysql_num_rows($qr)>0){
        header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_err=1");
        exit();
    }
    
    mysql_query("DELETE FROM lc_cat WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_ok=2");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 'editar_mov') {
    $id = $_POST['id'];
    $dia = $_POST['dia'];
    $tipo = $_POST['tipo'];
    $cat = $_POST['cat'];
    $descricao = $_POST['descricao'];
    $valor = str_replace(",", ".", $_POST['valor']);

    mysql_query("UPDATE lc_movimento SET dia='$dia', tipo='$tipo', cat='$cat', descricao='$descricao', valor='$valor' WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&ok=3");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 2) {

    $nome = $_POST['nome'];

    mysql_query("INSERT INTO lc_cat (nome) values ('$nome')");

    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_ok=1");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 1) {

    $data = $_POST['data'];
    $tipo = $_POST['tipo'];
    $cat = $_POST['cat'];
    $descricao = $_POST['descricao'];
    $valor = str_replace(",", ".", $_POST['valor']);

    $t = explode("/", $data);
    $dia = $t[0];
    $mes = $t[1];
    $ano = $t[2];

    mysql_query("INSERT INTO lc_movimento (dia,mes,ano,tipo,descricao,valor,cat) values ('$dia','$mes','$ano','$tipo','$descricao','$valor','$cat')");

    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&ok=1");
    exit();
}

if (isset($_GET['mes']))
    $mes_hoje = $_GET['mes'];
else
    $mes_hoje = date('m');

if (isset($_GET['ano']))
    $ano_hoje = $_GET['ano'];
else
    $ano_hoje = date('Y');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title id='titulo'>Livro caixa <?php echo $lc_titulo?></title>
<meta name="LANGUAGE" content="Portuguese" />
<meta name="AUDIENCE" content="all" />
<meta name="RATING" content="GENERAL" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts.js"></script>
</head>
<body style="padding:10px">


<table cellpadding="1" cellspacing="10"  width="900" align="center" style="background-color:#033">

<tr>

<td width="70">
<select onchange="location.replace('?mes=<?php echo $mes_hoje?>&ano='+this.value)">
<?php
for ($i=2008;$i<=2020;$i++){
?>
<option value="<?php echo $i?>" <?php if ($i==$ano_hoje) echo "selected=selected"?> ><?php echo $i?></option>
<?php }?>
</select>
</td>


<?php
for ($i=1;$i<=12;$i++){
	?>
    <td align="center" style="<?php if ($i!=12) echo "border-right:1px solid #FFF;"?> padding-right:5px">
    <a href="?mes=<?php echo $i?>&ano=<?php echo $ano_hoje?>" style="
    <?php if($mes_hoje==$i){?>    
    color:#033; font-size:16px; font-weight:bold; background-color:#FFF; padding:5px
    <?php }else{?>
    color:#FFF; font-size:16px;
    <?php }?>
    ">
    <?php echo mostraMes($i);?>
    </a>
    </td>
<?php
}
?>
</tr>

<tr>
<td>



</td>
</tr>
</table>

<?php
$qr11=mysql_query("SELECT * FROM lc_movimento where mes='$mes_hoje'");
while ($row6=@mysql_fetch_array($qr11)){
$ene = $row6['valor'];
$ene2 = $row6['descricao'];

?>
<?php echo "<font color=\"#000\">".$ene."</font><br>"; ?>
<?php echo "<font color=\"#000\">".$ene2."</font><br>"; ?>
<?php }?>
