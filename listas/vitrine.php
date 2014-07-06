<?php require_once('Connections/conexao.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Imobiliario</title>
    <link rel="stylesheet" href="../css/site.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/paginacao.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
       
    <div class="cont">
    
     <div class="conteiner-fluid">
            <div align="center" class="consulta"><form name="form2" method="post" action="index.php">
			
			<div class="input-append">
  <input class="span2" id="appendedInputButton" type="text">
  <button class="btn" type="button">Pesquisar!</button>
</div></div>
		
			</form>
           <div class="row-fluid">
            
            <?php 
            

            $p = $_GET["p"];

            if(isset($p)) {
            $p = $p;
            } else {
            $p = 1;
            }
			
			
			
			$qnt = 12;
			$inicio = ($p*$qnt) - $qnt;
			
			if($_REQUEST['filtro'] == ' ' )
			$filtro = '';
			else
			$filtro = $_REQUEST['filtro'];
			
			if($_REQUEST['filtro1'] == ' ' )
			$filtro1 = '';
			else
			$filtro1 = $_REQUEST['filtro1'];
            $loop = 6;
            $sql = "SELECT * from cliente as cli, imovel as im WHERE cli.id_cliente = im.id_cliente AND im.autorizar='1'  AND im.municipio like '".$filtro."%' ORDER BY cli.id_cliente DESC LIMIT $inicio, $qnt";
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

            if ($i < $loop){
            echo "<div class=\"span2\" align=\"center\">
			      <a href=\"listas/Caracteristica_imovel2.php?id_cliente=$id\" >
			      
				  <div class=\"td_img\">
			      <img class=\"foto\"  width=\"220\" height=\"100\" src=\"uploads/$img \" /><br />
					  
					  <span class=\"infor2\"><i class=\"icon-map-marker\"></i> $municipio</span><br />
					  <span class=\"infor4\"> $perfil</span><br />
                      <span class=\"infor3\"> R$ $valor3 </span></a>
					  
			     </div></div>";
			 
			 
            }elseif($i = $loop){
            echo "<div class=\"span2\" align=\"center\"><a href=\"listas/Caracteristica_imovel2.php?id_cliente=$id\" >
			     
				  <div class=\"td_img\">
			         <img class=\"foto\" width=\"220\" height=\"100\" src=\"uploads/$img \" /><br />
		         
				 <span class=\"infor2\"><i class=\"icon-map-marker\"></i> $municipio</span><br />
		         <span class=\"infor4\"> $perfil</span><br />
                 <span class=\"infor3\">R$ $valor3</span></a>
			
			
			</div>
			</div>
			
			</div>
			<div>";
			
            $i = 0;
            }
            $i ++;
            } ?>
            </div>
            </div>
            <?php
			$sql_select_all = "SELECT * from cliente";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 5;
			?>
            
           
            <?php
			
			echo "<a class=\"pagination\" href='index.php?p=1' target='_self'><span class=\"pagination\">&laquo; Anterior</span></a> ";
			
			for($i = $p-$max_links; $i <= $p-1; $i++) {
			
			if($i <=0) {
			
			} else {
			
			echo "<a class=\"pagination\" href='index.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<span class=\"pagination\"> " .$p." ". "</span>";
			
			for($i = $p+1; $i <= $p+$max_links; $i++) {
			
			if($i > $pags)
			{
			
			}
			
			else
			{
			
			echo "<a class=\"pagination\" href='index.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<a href='index.php?p= " .$pags."' target='_self'><span class=\"pagination\">Pr&oacute;xima &raquo;</span></a> ";
			
			?>
        
    
    </div>
           
</body>
</html>
