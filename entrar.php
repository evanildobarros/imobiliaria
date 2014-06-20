<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="css/site.css" type="text/css"  />
<head>

<title>Marcelo imovel</title>
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
</head>

<body style="background-color:#d7d7d7">
<div class="topo">
  
  <div class="logo"><img class="img_logo" src="img/LOGO_CARRO.png" /></div>
  <div class="texto_banner">Para vo&ccedil;&ecirc; viver melhor</div>
  <div class="menu_topo"><img src="img/homme.png" /> &nbsp; Institucional &nbsp;&nbsp; Noticias &nbsp;&nbsp; Servi&ccedil;os &nbsp;&nbsp; Contatos</div>

</div>
<div class="faixa"></div>

<div class="menu"></div>
<div class="conteudo">
<div class="text_menu">Menu</div>
<div class="box_menu">&bull; Apartamento</div>
<div class="box_menu">&bull; Casa</div>
<div class="box_menu">&bull; Ch&aacute;cara</div>
<div class="box_menu">&bull; Kitnet</div>
<div class="box_menu">&bull; Loja</div>
<div class="box_menu">&bull; Pr&eacute;dio</div>
<div class="box_menu">&bull; Sala</div>
<div class="box_menu">&bull; Sitio</div>
<div class="box_menu">&bull; terreno</div>

<div class="login"><br />

&Agrave;rea Restrita
<hr />
<form id="login-form" name="form1" method="POST" action="logon.php">
					
						
							<label for="username">Usu&agrave;rio</label>
							<input type="text" name="usuario" id="usuario" placeholder="Username" value="" />
						
					
							<label for="password">Senha</label>
							<input type="password" name="senha" id="password" placeholder="Password" value="" /><br />
<br />



						
							<input type="submit" name="button" id="button" value="Enviar" />
						
					
				</form>
</div>

<div class="banner_anuncio"><span style="color:#FFFFFF;"> &times;  &times; Lan&ccedil;amentos</span></div>
<div class="banner_anuncio2">
<div id="wowslider-container1">
	<div class="ws_images"><ul>
    
 <?php 
 require'../Connections/conexao.php';
 $sql = mysql_query("Select * from cliente Where autorizar = '1'");
 while($res = mysql_fetch_array($sql)){
 
 ?>   
<li><img width="1000" height="382" src="uploads/<?php echo $res['capa'] ?>" title="<?php echo $res['cpf_procu']; ?>"  /></li>
<?php } ?>
</ul></div>


</div>

</div>


<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
</body>
</html>
