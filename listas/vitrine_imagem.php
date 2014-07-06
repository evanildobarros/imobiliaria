<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>



<table width="100" border="1">
 <?php
	 $conect = mysql_connect("localhost","root","");
	 $bd = mysql_select_db("MI");
	 $sql = mysql_query("select c.id_cliente,c.capa,i.valor from cliente as c, imovel as i  Where c.id_cliente = i.id_cliente");
	 $loop = 3;
	 $i = 1;
	 while ($res = mysql_fetch_array($sql)){
	 $id     = $res['id_cliente'];
	 $foto   = $res['capa'];
	 $local  = $res['localidade'];
	 $valor  = $res['valor'];
	
	 
     ?>
<?php
 if ($i < $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first\">
        <a href=\"galeria_imovel.php?id_cliente=$id \" rel=\"lightbox[plants]\" title=\"Localiza&ccedil;&atilde;o: $local <br> Valor: R$ $valor ,00 \">
        <img width=\"150\" height=\"100\" src=\"../uploads/$foto\" /></a><br>
         $local<br>
         R$ $valor,00
        </div></td>";
	 }elseif($i = $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first\"><a href=\"galeria_imovel.php?id_cliente=$id\" rel=\"lightbox[plants]\" title=\"$local\">
        <img width=\"150\" height=\"100\" src=\"../uploads/$foto\" /></a><br>
        $local<br>
         R$ $valor,00</div></td></tr>";
		$i =0;
	 }
	 $i ++;
	 }
 ?>
   

</table>


</body>
</html>
