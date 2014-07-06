<?php require_once('../Connections/conexao.php'); ?>		

<?php




@session_start();
        include '../listas/functions.php';

mysql_select_db($database_conexao, $conexao);
$query_totall = "SELECT SUM(valor2) as total FROM lc_movimento where tipo ='0'";
$totall = mysql_query($query_totall, $conexao) or die(mysql_error());
$row_totall = mysql_fetch_assoc($totall);
$totalRows_totall = mysql_num_rows($totall);

$total = $row_totall['total'];

mysql_select_db($database_conexao, $conexao);
$query_total2 = "SELECT SUM(valor2) as total2 FROM lc_movimento WHERE tipo ='1'";
$total2 = mysql_query($query_total2, $conexao) or die(mysql_error());
$row_total2 = mysql_fetch_assoc($total2);
$totalRows_total2 = mysql_num_rows($total2);

$total2 = $row_total2['total2'];

        
        ?>
        <?php
        // At line 2 of our calendar.php script, add the MySQL connection information:
        $mysql = mysql_connect("localhost", "root", "jedai2003");
        mysql_select_db("MI", $mysql) or die(mysql_error());
        
        // Now we need to define "A DAY", which will be used later in the script:
        define("ADAY", (60*60*24));
        
        // The rest of the script will stay the same until about line 82
        
        if ((!isset($_POST['month'])) || (!isset($_POST['year']))) {
        $nowArray = getdate();
        $month = $nowArray['mon'];
        $year = $nowArray['year'];
        } else {
        $month = $_POST['month'];
        $year = $_POST['year'];
        }
        $start = mktime(12,0,0,$month,1,$year);
        $firstDayArray = getdate($start);
        ?>
        <html>
        <head>
        <title><?php echo "Calendar: ".$firstDayArray['month']."" . $firstDayArray['year']; ?></title>
        <script language="JavaScript">
        function abrir(URL) {
        
        var width = 600;
        var height = 900;
        
        var left = 250;
        var top = 250;
        
        window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
        
        }
        </script>
        
       
        <script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
        
        <head>
      
        
        
        
        <title>Gerenciador Imobiliaria</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <style type="text/css">
        <!--
        .style1 {
        font-size: 24px;
        color: #FFFFFF;
        }
        -->
        </style>
      
        
        </head>
        <body>
        <br>
        
        
        <table width="90%" border="0" style="border-collapse:collapse;" align="center">
        
        
        <tr>
        <td bgcolor="#FFFFFF">
       
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
        <select name="month" class="input2">
        <?php
        $months = Array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Otubro", "Novembro", "Dezembro");
        
        for ($x=1; $x<=count($months); $x++){
        echo "<option value=\"$x\"";
        if ($x == $month){
        echo " selected";
        }
        echo ">".$months[$x-1]."</option>";
        }
        ?>
        </select>
        
        <select name="year" class="input2">
        <?php
        for ($x=2010; $x<=2020; $x++){
        echo "<option";
        if ($x == $year){
        echo " selected";
        }
        echo ">$x</option>";
        }
        ?>
        </select>
        <input name="submit" type="submit" class="botao" value="Agendar">
        
        <br>
        <br>
        </form>
        </div>
        
        <div class="grid11">
        
        
        
        
        <?php
        $days = Array("Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado");
        echo "<table bordercolor=\"#e1e1e1\" cellpadding=\"15\" width=\"100%\" style=\"border-collapse:collapse;\" border=\"1\" cellpadding=\"20\" align=\"center\"><tr>\n";
        foreach ($days as $day) {
        echo "<td style=\"background-color: #3b5998; text-align: center; \">
        <font color=\"#fff\" face=\"Arial, Helvetica, sans-serif\"> <strong>$day</strong></font></td>\n";
        }
        
        for ($count=0; $count < (6*7); $count++) {
        $dayArray = getdate($start);
        if (($count % 7) == 0) {
        if ($dayArray["mon"] != $month) {
        break;
        } else {
        echo "</tr><tr>\n";
        }
        }
        if ($count < $firstDayArray["wday"] || $dayArray["mon"] != $month) {
        echo "<td> </td>\n";
        } else {
		
		$dia = $_POST['dia'];
		echo $dia;
		
        $chkEvent_sql = "SELECT sum(m.valor2) as total,m.id,m.tipo,t.desc,m.dia,m.mes,m.ano,m.cat,m.cliente,m.descricao,m.valor,m.valor2,m.status,m.vencimento,m.fpagamento,m,fornecedor,m.nota,m.event_start FROM lc_movimento as m,tipo as t WHERE  m.tipo = t.id AND month(event_start) = '".$month."' AND dayofmonth(event_start) = '".$dayArray["mday"]."' AND year(event_start) = '".$year."' GROUP BY m.valor2 ORDER BY event_start";
		
		
		
		
        $chkEvent_res = mysql_query($chkEvent_sql, $mysql) or die(mysql_error($mysql));
        
        $id = $ev["id"];
		$desc = $ev['t.desc'];
        
        if (mysql_num_rows($chkEvent_res) > 0) {
        $event_title = "<br/>";
        while ($ev = mysql_fetch_array($chkEvent_res)) {
        
        $event_title .= stripslashes("<a  href=\"javascript:abrir('?id=".$ev["id"]."');\">".$ev["cliente"]."</a>")."<br/> ";
        
        $event_title .= stripslashes("<span style=\"color:#00CC66; font-weight:bold; padding:5px;\">&radic;</span>".
		                             "<span style=\"font-family:Arial, Helvetica, sans-serif; 
									   font-size:12px; color:#00CCFF; padding:5px;\">".$ev["fornecedor"]."</span>"."<br>");
									   
									   
									   
		
		$val  = $ev["valor"];
		$val2 = $ev["valor2"];
		$status = $ev["tipo"];
		
		
		
		
		
		$event_title .= stripslashes("<span style=\"font-family:Arial, Helvetica, sans-serif; 
									   font-size:12px; color:#FF0000; padding:5px; margin: 0 20px; \"> R$ ".$valor = number_format($val2,2,",","."))."</span>";
									   
      
	    $event_title .= stripslashes("<span style=\"font-family:Arial, Helvetica, sans-serif; 
									   font-size:12px; color:#666; padding:5px; margin: 0 20px; \"> &bull; ".$ev["desc"])."</span>"."<hr />";
		
		
		
        }
		
		
			$event_title .= stripslashes("<span style=\"font-family:Arial, Helvetica, sans-serif; 
									   font-size:12px; color:#009999; padding:5px; margin: 0 20px; \">Receita &raquo; R$ ".$valor2 = number_format($total2,2,",","."))."</span>"."<br>";	
        
		$event_title .= stripslashes("<span style=\"font-family:Arial, Helvetica, sans-serif; 
									   font-size:12px; color:red; padding:5px; margin: 0 20px; \">Despesas &raquo; R$ ".$valor2 = number_format($total,2,",","."))."</span>";
									   
									   
							   
        
        mysql_free_result($chkEvent_res);
        } else {
        $event_title = "";
        }
		
		
        
        echo "<td valign=\"top\"><a style=\"text-decoration:none;\"  href=\"#\" onclick=\"MM_openBrWindow('../Agendamento/event.php?m=".$month."&d=".$dayArray["mday"]."&y=$year;','','scrollbars=yes,resizable=yes,width=750,height=500')\">"."<span style=\"color:blue; text-decoration:none; font-size:30px; font-family:Arial, Helvetica, sans-serif;\">&nbsp; &nbsp;".$dayArray["mday"]."</span>"."<span style=\"font-family:Arial, Helvetica, sans-serif; color:#0099CC; padding:0px 0px 0px -25px\"> Movimentar</span> "."</a><br/></br>"."<span class=\"nome\"><font color\"Red\">".$event_title."</td>\n"."</font></span>";
        
        unset($event_title);
        
        $start += ADAY;
        }
        }
        echo "</tr></table>";
        mysql_close($mysql);
        
        ?>
        
        
        </div>
        </td>
        </tr>
        <tr>
        <td bgcolor="#3b5998" align="center"><span style="color:#fff;">Mhs Solucões Web Contato: (98) 8800-3198 | 3288046 <br>
                   email:mhssloucoesweb@hotmail.com &copy;coyright</span></td>
        </tr>
        </table>
        </body>
        </html>
        <?php
@mysql_free_result($totall);

@mysql_free_result($total2);
?>
