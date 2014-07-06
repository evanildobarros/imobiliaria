<?php require_once('../Connections/conexao.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  
<title>Index</title>
<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/style.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="../js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
</head>

<body>

<form name="form2" method="post" action="index.php">
			
			<div class="input-append">
  <input class="span2" id="appendedInputButton" name="filtro" type="text">
  <button class="btn" type="button">Pesquisar!</button>
</div></div>
		
			</form>
            
            <?php 
            

            $p = $_GET["p"];

            if(isset($p)) {
            $p = $p;
            } else {
            $p = 1;
            }
			
			
			
			$qnt = 6;
			$inicio = ($p*$qnt) - $qnt;
			
			if($_REQUEST['filtro'] == ' ' )
			$filtro = '';
			else
			$filtro = $_REQUEST['filtro'];
			
			if($_REQUEST['filtro1'] == ' ' )
			$filtro1 = '';
			else
			$filtro1 = $_REQUEST['filtro1'];
            $loop = 3;
            $sql = "SELECT * from cliente as cli, 
			imovel as im WHERE
			cli.id_cliente = im.id_cliente AND im.autorizar='1'  
			AND im.municipio like '".$filtro."%' ORDER BY cli.id_cliente DESC LIMIT $inicio, $qnt";
			$resultado = @mysql_num_rows($sql);
            $rg   = mysql_query($sql);
            
			$i = 1;

            while($result = @mysql_fetch_array($rg)){
			
			$img       = $result['capa'];
			$id        =  $result['id_cliente'];
			$municipio = $result['municipio'];
			$vl        = $result['valor'];
			$valor3 = number_format($vl,2,",",".");
			$perfil    = $result['perfil_imovel'];
			
            
			
		    ?>
            
             <div class="span3">
             <a href="listas/Caracteristica_imovel2.php?id_cliente=$id" ><img width="180" height="100" src="../uploads/$img" /></a>
             </div>
            <?php } ?>

 
</body>
</html>
