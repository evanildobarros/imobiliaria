			<?php
			@session_start();
			
			?>
			
			<?php
			
			?>
			
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
			<head>
            
           <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
             
			
			<script language="JavaScript">
			function onDelete()
			{
			if(confirm('Deseja Realmente Excluir esses Arquivos ?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
			}
			</script>
			
			<script language=javascript>
			function CheckAll() { 
			for (var i=0;i<document.frmMain.elements.length;i++) {
			var x = document.frmMain.elements[i];
			if (x.name == 'chkDel[]') { 
			x.checked = document.frmMain.selall.checked;
			} 
			} 
			}
			function MM_openBrWindow(theURL,winName,features) { //v2.0
			window.open(theURL,winName,features);
			}
			</script>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<title>Gerenciador Auto Escola</title>
			
			</head>
			
			<?php
			require'../Connections/conexao.php';
			
			for($i=0;$i<count($_POST["chkDel"]);$i++)
			{
			if($_POST["chkDel"][$i] != "")
			{
			$strSQL = "DELETE FROM alunos";
			$strSQL .="WHERE id_aluno = '".$_POST["chkDel"][$i]."' ";
			$objQuery = mysql_query($strSQL);
			}
			}

			
			?>
			
			<body>
			<br />
			<br />
			<br />
			<table width="1000" border="0" align="center" style="border-collapse:collapse;">
			<tr>
			<td bgcolor="#FFFFFF" class="">
			<form name="form2" method="post" action="layout_devedor.php">
			<label>
			<input class="input"  type="text" name="filtro" id="filtro">
			</label>
			<label>
			<input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
			</label>
			&nbsp; &nbsp; &nbsp;<span class="span7">&nbsp; &nbsp; &nbsp;cliente devedor
</span>
			<div style="margin:30px 0px 0px 0px; font-family: verdana, arial black;font-size:18px;
color:#999999;">M&ecirc;s  de Origem: <?php echo $mes; ?></div></form>
			</td>
			</tr>
			</table>
			
			
			<form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1000" border="0" align="center" bordercolor="#666" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			<td width="128" valign="baseline">
			 
			<input name="selall" id="check" type="checkbox" value="" onclick="CheckAll()" />
		
			<input class="bt" type="submit" name="button2" id="button2" value="Deletar" />			</td>
			<td width="124" valign="top" class="td" ><br /></td>
			<td width="90"  valign="top" class="td" ><div align="left"><br />
			  hor&aacute;rio</div></td>
			<td width="149"  valign="top" class="td"><div align="left"><br />
			  Descri&ccedil;&atilde;o</div></td>
			<td width="135" valign="top" class="td"><div align="left"><br />			  
			  Situa&ccedil;&atilde;o<br />
			</div></td>
			<td width="81" valign="top" class="td"><div align="left"><br />
			  valor</div></td>
			<td width="263" valign="top" class="td"><div align="center"><br />
			  Exame</div></td>
			</tr>
			<?php
			$mes = $_POST['mes'];
			
			require'../Connections/conexao.php';
			
		$p = $_GET["p"];	
	    if(isset($p)) {
        $p = $p;
        } else {
        $p = 1;
        }
        
        $qnt = 5;
        $inicio = ($p*$qnt) - $qnt;
        
        if($_REQUEST['filtro'] == ' ' )
        $filtro = '';
        else
        $filtro = $_REQUEST['filtro'];
        
        if($_REQUEST['filtro1'] == ' ' )
        $filtro1 = '';
        else
        $filtro1 = $_REQUEST['filtro1'];
			
			$sql = "SELECT *
FROM movimento
WHERE mes = '$mes'
AND tipo = '1'
AND STATUS = '2' AND mes = '$mes'";
			
			 $rs  = mysql_query($sql);
        
        function geraTimestamp($data) {
        $partes = explode('/', $data);
        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
        }
        $cont = 0;
        while ($resultado = @mysql_fetch_array($rs))
        {
         $data_inicial = date("Y-m-d");
         $data_final = $resultado['data'];
	     $time_inicial = strtotime($data_inicial);
         $time_final = strtotime($data_final);
         $diferenca = $time_final - $time_inicial;
         $dias = (int)floor( $diferenca / (60 * 60 * 24));
        
        $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
        ?>
        <tr bgcolor="<?php echo $cor ; ?>">
        <td colspan="2" valign="top" class="td"><label>
        <div align="left">
          <input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id"];?>">
          <?php echo $resultado['cliente']; ?></div>
        </label>          <font color="#666666"></td>
        <td valign="top"  class="td"><div align="left">
          <?php 
	   $date = $resultado['venci'];
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?>
        </div>          </td>
        
        <td valign="top"  class="td"><font color="#666666">
          <div align="left"><?php echo $resultado['categoria']; ?></div></td>
        <td valign="top"  class="td"><?php if ($resultado['status'] == 2){
               echo "<span class=\"span22\">Em Aberto</span>"; 
               }    ?></td>
        
        <td valign="top"  class="td"><div align="left">R$&nbsp;
          <?php $total10 = $resultado['valor2']; echo number_format( $total10  , 2 , ',' , '.' ); ?>
        </div></td>
        <td valign="top"  class="td" align="left"><font color="#666666">
	      <div align="left">
	        <?php
		    if ($dias >= 10){
            echo "<img src=\"../img/01.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 10){
            echo "<img src=\"../img/01.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 9){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 8){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 7){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 6){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    } else if ($dias == 5){
            echo "<img src=\"img/04.png\" />&nbsp; Faltam ".$dias." Dias para o  Pagamento!</span>"."</br>";
			 } else if ($dias == 4){
            echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
            }
			else if ($dias == 3){
             echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
             }
			else if ($dias == 2){
             echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
			 }
			else if ($dias == 1){
             echo "<img src=\"../img/04.png\" />&nbsp; Falta ".$dias." Dia para o Pagamento!</span>"."</br>";
			
            } else if ($dias == 0){
            echo "<img src=\"../img/03.png\" />&nbsp; Dia do Pagamento!"."</br>";
            }
			else if ($dias <= 0){
            echo "<img src=\"../img/06.gif\" />&nbsp;&nbsp;passou o dia do Pagamento!"."</br>";
			}
			
            ?>
          </div></td>
        </tr>
        <tr><?php $cont ++; }?>
        <?php
        $sql_select_all = "SELECT DISTINCT cliente,venci,categoria,status,valor2,mes
FROM movimento
WHERE mes = 'JUNHO'
AND tipo = '1'
AND STATUS = '2' AND mes = '$mes'";
        
        $sql_query_all = @mysql_query($sql_select_all);
        
        $total_registros = @mysql_num_rows($sql_query_all);
        
        $pags = ceil($total_registros/$qnt);
        
        $max_links = 3;
        ?>
        <td colspan="7" align="center" valign="top"><br />
        
        <?php
        
        echo "<a class=\"pag\" href='layout_devedor.php?p=1' target='_self'>&laquo; Anterior</a> ";
        
        for($i = $p-$max_links; $i <= $p-1; $i++) {
        
        if($i <=0) {
        
        } else {
        
        echo "<a class=\"pag\" href='layout_devedor.php?p=".$i."' target='_self'>".$i."</a> ";
        }
        }
        
        echo "<span class=\"pag2\"> " .$p." ". "</span>";
        
        for($i = $p+1; $i <= $p+$max_links; $i++) {
        
        if($i > $pags)
        {
        
        }
        
        else
        {
        
        echo "<a class=\"pag\"  href='layout_devedor.php?p=".$i."' target='_self'>".$i."</a> ";
        }
        }
        
        echo "<a class=\"pag\" href='layout_devedor.php?p= " .$pags."' target='_self'>Pr&oacute;xima &raquo;</a> ";
        
        ?><br />
			<br /></td>
			</tr>
			</table>
			</form>
			
			
			
			</div>
		
			</body>
			<?php 
			
			$op="Cadastrou um novo Servico !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
			</html>