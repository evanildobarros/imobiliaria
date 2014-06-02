<?php require_once('../Connections/conexao.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Imobiliaria</title>
    <link rel="stylesheet" href="css/layout.css" type="text/css">
	<link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
</head>

            <body>
            <table  width="800" height="500" align="center">
            <form name="form2" method="post" action="vitrine.php">
			
			<input class="input"  type="text" name="filtro" id="filtro">
	
			<input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
		
			</form>
            <tr>
            <?php 
            

            $p = $_GET["p"];

            if(isset($p)) {
            $p = $p;
            } else {
            $p = 1;
            }
			
			
			
			$qnt = 9;
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
            $sql = "SELECT DISTINCT id, img from galeria WHERE img like '".$filtro."%' ORDER BY id DESC LIMIT $inicio, $qnt";
			$resultado = @mysql_num_rows($sql);
            $rg   = mysql_query($sql);
            
			$i = 1;

            while($result = @mysql_fetch_array($rg)){

            $img = $result['img'];
			$lc =  $result['id'];

            if ($i < $loop){
            echo "<td align=\"center\"><img width=\"100\" height=\"100\" src=\"../uploads/$img \" /><br /><span class=\"span\">$lc</span></td>";
            }elseif($i = $loop){
            echo "<td align=\"center\"><img width=\"100\" height=\"100\" src=\"../uploads/$img \" /><br /><span class=\"span\">$lc</span></td></tr><tr>";
            $i = 0;
            }
            $i ++;
            } ?>
            </tr>
            </table>
            <?php
			$sql_select_all = "SELECT * from galeria";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 5;
			?>
            
            <table  align="center" width="800">
            <tr>
            <td align="center">
            <?php
			
			echo "<a href='vitrine.php?p=1' target='_self'><span class=\"\">&laquo; Anterior</span></a> ";
			
			for($i = $p-$max_links; $i <= $p-1; $i++) {
			
			if($i <=0) {
			
			} else {
			
			echo "<a  href='vitrine.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo $p;
			
			for($i = $p+1; $i <= $p+$max_links; $i++) {
			
			if($i > $pags)
			{
			
			}
			
			else
			{
			
			echo "<a href='vitrine.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<a href='vitrine.php?p= " .$pags."' target='_self'><span class=\"\">Pr&oacute;xima &raquo;</span></a> ";
			
			?>
            </td>
            </tr>
            </table>
</body>
</html>
