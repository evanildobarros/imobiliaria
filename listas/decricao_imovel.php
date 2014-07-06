<?php 
$con = mysql_connect("localhost","root","");
$bd  = mysql_select_db("mi");

$sql = mysql_query("SELECT * FROM imovel Where int_id ='67'");
$dados = @mysql_fetch_array($sql);

$endereco_imovel = $dados[endereco];
$bairro_imovel = $dados[bairro];
$cidade_imovel = $dados[cidade];
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
<td valign="top"><div id="div_mapa" style="width: 800px; height: 350px"></div></td>
</tr>
</table>

<table>
<tr>
<td><input type="text" size="61" id="irPara" value="<?php echo $endereco_imovel; ?>,<?php echo $bairro_imovel; ?>,<?php echo $cidade_imovel; ?>,<?php echo $estado_imovel; ?>" /></td>
</tr>
</table>

</div>

</body>
</html>