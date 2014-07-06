
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/ico" href="images/favicon.gif" />	
	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<title>Galeria</title>
</head>

<body>
<?php
$id = $_GET['id_cliente'];

?>

<div id="content">
<table width="100" border="1">
  <tr>
     <?php
	 $conect = mysql_connect("localhost","root","");
	 $bd = mysql_select_db("mi");
	 $sql = mysql_query("select * from galeria WHERE id_cliente = $id ");
	 $loop = 3;
	 $i = 1;
	 while ($res = @mysql_fetch_array($sql)){
	 $foto = $res['img'];
	 $nome = $res['id_cliente'];
	 if ($i < $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first\">
        <a href=\"uploads/$foto\" rel=\"lightbox[plants]\" title=\"$nome\">
        <img width=\"150\" height=\"100\" src=\"uploads/$foto\" /></a>
        </div></td>";
	 }elseif($i = $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first\"><a href=\"uploads/$foto\" rel=\"lightbox[plants]\" title=\"$nome\">
        <img width=\"150\" height=\"100\" src=\"uploads/$foto\" /></a></div></td></tr>";
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

