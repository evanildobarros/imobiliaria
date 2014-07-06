<?php require_once('../Connections/conexao.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" href="../css/site.css" type="text/css" />

    <link rel="shortcut icon" type="image/ico" href="images/favicon.gifx" />	
	
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<title>Gerenciador Imobiliario</title>
	
	
	
</head>

<body onLoad="inicializar_gmaps(); mapsPesquisa(document.getElementById('irPara').value);" >
<div class="topo">

<div class="logo"><img class="img_logo" src="../img/LOGO_CARRO.png" /></div>
<div class="texto_banner">Para voc&ecirc; viver melhor</div>
<div class="menu_topo"><img src="../img/homme.png" /> &nbsp; Institucional &nbsp;&nbsp; Noticias &nbsp;&nbsp; Servi&ccedil;os &nbsp;&nbsp; Contatos</div>

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
<div class="box_menu">&bull; Terreno</div>

<div class="login"><br />&Aacute;rea do cliente<hr />

<form id="login-form" name="form2" method="POST" action="">
<label for="username">Usu&aacute;rio</label>
<input  type="text" name="usuario" id="usuario" placeholder="Username" value="" />
<label for="password">N&#176; do Processo</label>
<input type="password" name="senha" id="password" placeholder="Password" value="" /><br />
<br />
<input class="bts placeholder" type="submit" name="button" id="button" value="Enviar" />
</form>
</div><br />
<br />

<div class="login2">
<br />

&Aacute;rea Restrita
<hr />
<form id="login-form" name="form1" method="POST" action="../logon.php">
<label for="username">Usu&aacute;rio</label>
<input  type="text" name="usuario" id="usuario" placeholder="Username" value="" />
<label for="password">Senha</label>
<input type="password" name="senha" id="password" placeholder="Password" value="" /><br />
<br />
<input class="bts placeholder" type="submit" name="button" id="button" value="Enviar" />
</form>

</div>
<div class="gal_03">&rang; Galeria</div>
<div class="t_2">
<table width="359" border="0" align="center">
<?php
 

$id = $_GET['id_cliente'];
$sql = mysql_query("select cli.capa as capa,
                           cli.municipio as muni,
						   cli.cpf_procu as descri,
						   im.endereco as end,
						   im.perfil_imovel as perfil,
						   im.padrao_imovel as padrao,
						   im.a_construida as area,
						   im.valor_condominio as cond,
						   im.valor as vl,
						   im.financiamento as finan,
						   im.dormitorio as dor,
						   im.suites  as suite,
						   im.garagem as garagem
						   from cliente as cli,imovel as im WHERE  cli.id_cliente = im.id_cliente AND cli.id_cliente='$id'");

							while ($res = @mysql_fetch_array($sql)){
							
							$capa      = $res['capa'];
							$muni      = $res['muni'];
							$end       = $res['end'];
							$perfil    = $res['perfil'];
							$padrao    = $res['padrao'];
							$area      = $res['area'];
							$cond      = $res['cond'];
							$valor3    = number_format($cond,2,",",".");
							$vl        = $res['vl'];
							$valor     = number_format($vl,2,",",".");
							$finan     =  $res['finan'];
							$dor       =  $res['dor'];
							$suite     =  $res['suite'];
							$garagem   =  $res['garagem'];
							$desc      =  $res['descri'];
							
							?>


  <tr>
    <td width="178" bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Perfil do Im&oacute;vel :</span></td>
    <td width="306"><span style="font-size:13px; padding:5px;"><?php echo $perfil ?></span></td>
    </tr>
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Padr&atilde;o :</span></td>
    <td><span style="font-size:13px; padding:5px;"><?php echo $padrao ?></span></td>
    </tr>
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">&Aacute;rea Construida :</span></td>
    <td><span style="font-size:13px; padding:5px;"><?php echo $area ?> m&sup2;</span></td>
    </tr>
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Dormit&oacute;rio(s) :</span></td>
    <td><span style="font-size:13px; padding:5px;"><?php echo $dor ?></span></td>
    </tr>
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Suites :</span></td>
    <td><span style="font-size:13px; padding:5px;"><?php echo $suite ?></span></td>
    </tr>
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Garagem :</span></td>
    <td><span style="font-size:13px; padding:5px;"><?php echo $garagem ?></span></td>
    </tr>
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Condom&iacute;nio :</span></td>
    <td valign="top"><span style="font-size:13px; padding:5px;">R$ <?php echo $valor3  ?></span></td>
  </tr>
  
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Financiamento :</span></td>
    <td><span style="font-size:13px; padding:5px;"><?php echo $finan  ?></td>
  </tr>
  <tr>
    <td bgcolor="#f8f8f8"><span style="font-size:14px; padding:5px;">Valor do Im&oacute;vel :</span></td>
    <td><span style="font-size:16px; padding:5px; font-weight:bold; color:#FF0000;">R$ <?php echo $valor  ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  

</table>



</div>
<?php } ?>

<div class="gal_01">

<?php
$id = $_GET['id_cliente'];

?>

<div id="content">
<table width="800" border="0" align="center">
  <tr>
     <?php
	 $conect = mysql_connect("localhost","root","");
	 $bd = mysql_select_db("jedai2003");
	 $sql = mysql_query("select * from galeria WHERE id_cliente = $id ");
	 $loop = 4;
	 $i = 1;
	 while ($res = @mysql_fetch_array($sql)){
	 $foto = $res['img'];
	 $nome = $res['id_cliente'];
	 if ($i < $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first \">
        <a href=\"../uploads/$foto\" rel=\"lightbox[plants]\" title=\"$nome\">
        <img class=\"cont_foto\" width=\"150\" height=\"100\" src=\"../uploads/$foto\" /></a>
        </div></td>";
	 }elseif($i = $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first\"><a href=\"../uploads/$foto\" rel=\"lightbox[plants]\" title=\"$nome\">
        <img class=\"cont_foto\" width=\"150\" height=\"100\" src=\"../uploads/$foto\" /></a></div></td></tr>";
		$i =0;
	 }
	 $i ++;
	 }
	 ?>
  </tr>
</table>

	
</div>

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/jquery.smooth-scroll.min.js"></script>
<script src="js/lightbox.js"></script>

<script>
  jQuery(document).ready(function($) {
      $('a').smoothScroll({
        speed: 1000,
        easing: 'easeInOutCubic'
      });

      $('.showOlderChanges').on('click', function(e){
        $('.changelog .old').slideDown('slow');
        $(this).fadeOut();
        e.preventDefault();
      })
  });

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2196019-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



</div>
<div class="gal_02">&equiv; Detalhes do Im&oacute;vel</div>
<div class="t_3"><img style="padding:0px 0px 10px 0px;" width="425" height="250" src="../uploads/<?php echo $capa; ?>" /> 
<?php echo $desc ?></div>

<div class="map1">&plusmn; Localização</div>
<div class="map2">
<?php 
$con = mysql_connect("localhost","root","jedai2003");
$bd  = mysql_select_db("MI");

$sql = mysql_query("SELECT * FROM imovel Where id_cliente ='$id'");
$dados = @mysql_fetch_array($sql);

$endereco_imovel = $dados[endereco];
$bairro_imovel = $dados[bairro];
$cidade_imovel = $dados[municipio];
$estado_imovel = $dados[estado];
?>

<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAYdenHllTvDWKCKx5jJOyhhSPDx1qyUV_1BPLZnrsoH2M5fzhQhSp8l4oenxNGXsk5KAqyQBU4P2PKQ" type="text/javascript"></script>

<script type="text/javascript">

        var map;
        var gdir;
        var geocoder = null;
        var addressMarker;
        
        var minhaLocalizacao = "<?php echo $endereco_imovel; ?> ,<?php echo $bairro_imovel; ?>,<?php echo $cidade_imovel; ?>,<?php echo $estado_imovel; ?>" //Localização inicial passada como ponto de partida

        function inicializar_gmaps() {
          if (GBrowserIsCompatible()) {   
                map = new GMap2(document.getElementById("div_mapa")); //Local onde o mapa gerado deve ficar
                gdir = new GDirections(map, document.getElementById("direcoes")); //Local para ficar o "passo-a-passo" pra chegar ao destino
                GEvent.addListener(gdir, "error", gmaps_erros); //Define qual função vai manipular os erros retornados
          }
        }

        function gmaps_erros() {
        if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
                gdir.getStatus().code

        else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
                alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);

        else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
                alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);
        
        else if (gdir.getStatus().code == G_GEO_BAD_KEY)
        alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
        
        else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
        alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
        
        else alert("Um erro desconhecido aconteceu.");
           
        }
        
        function mapsPesquisa(irPara) {
        //Responsavel por iniciar o carregamento dos mapas nos locais especificos
        gdir.load("from: " + minhaLocalizacao + " to: " + irPara);
}

</script>
<body onLoad="inicializar_gmaps(); mapsPesquisa(document.getElementById('irPara').value);" >

<div id="tabela_maps">
<table class="directions">

<tr>
<td valign="top"><div id="div_mapa" style="width: 804px; height: 350px"></div></td>
</tr>
</table>


</div>
<div class="map3">
<table width="455" bordr="1">
<tr>
<td width="132" bgcolor="#ddd"><span style="color:#333; padding:10px; font-size:16px;">Endere&ccedil;o:</span></td>
<br /><input type="hidden" size="61" id="irPara" 
     value="<?php echo $endereco_imovel; ?>,<?php echo $bairro_imovel; ?>,<?php echo $cidade_imovel; ?>,<?php echo $estado_imovel; ?>" />

<td colspan="2"><span style="color:#333; padding:10px; font-size:16px; "><?php echo $endereco_imovel;  ?></span></td>
</tr>
<tr>
<td bgcolor="#ddd"><span style="color:#333; padding:10px; font-size:16px;">Bairro:</span></td>
<td colspan="2"><span style="color:#333; padding:10px; font-size:16px; "><?php echo $bairro_imovel;  ?></span></td>
</tr>

<tr>
<td bgcolor="#ddd"><span style="color:#333; padding:10px; font-size:16px;">Cidade:</span></td>
<td colspan="2"><span style="color:#333; padding:10px; font-size:16px; "><?php echo $cidade_imovel;  ?></span></td>
</tr>

<tr>
<td bgcolor="#ddd"><span style="color:#333; padding:10px; font-size:16px;">Estado:</span></td>
<td colspan="2"><span style="color:#333; padding:10px; font-size:16px; "><?php echo $estado_imovel;  ?></span></td>
</tr>
</table>

</div>
<div class="map4">
<table>
<tr>
  <td colspan="3">Contatos<hr /></td>
  </tr>
<tr>
  <td colspan="3">&nbsp;</td>
  </tr>
<tr>
  <td bgcolor="#ddd">Nome:</td>
  <td colspan="2"><label>
    <input name="textfield" type="text" id="textfield" size="50" />
  </label></td>
  </tr>
<tr>
  <td bgcolor="#ddd">Telefone:</td>
  <td colspan="2"><input name="textfield2" type="text" id="textfield2" size="50" /></td>
  </tr>
<tr>
  <td bgcolor="#ddd">Email</td>
  <td colspan="2"><input name="textfield3" type="text" id="textfield3" size="50" /></td>
  </tr>
<tr>
  <td valign="top" bgcolor="#ddd">Descri&ccedil;&atilde;o</td>
  <td colspan="2"><label>
    <textarea name="textarea" id="textarea" cols="50" rows="5"></textarea>
  </label></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2">
    <div align="right">
      <input type="submit" name="button2" id="button2" value="Enviar" />
      </div></td>
  </tr>
</table>

</div>



</div>
</body>
</html>
