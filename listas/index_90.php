<!doctype html>
<html lang="en-us">
<head>

	<meta charset="utf-8">
	<title>Lightbox 2</title>

	<meta name="description" lang="en" content="Lightbox 2 is a simple, unobtrusive script used to overlay images on the current page. It's a snap to setup and works on all modern browsers." />
  <meta name="author" content="Lokesh Dhakar">

  <meta name="viewport" content="width=device-width">

	<link rel="shortcut icon" type="image/ico" href="images/favicon.gif" />	
	<link rel="stylesheet" href="css2/screen.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css2/lightbox.css" type="text/css" media="screen" />

 

</head>
<body>
<div id="content">
<table width="100" border="1">
  <tr>
     <?php
	 $conect = mysql_connect("localhost","root","");
	 $bd = mysql_select_db("va");
	 $sql = mysql_query("select * from usuarios");
	 $loop = 3;
	 $i = 1;
	 while ($res = mysql_fetch_array($sql)){
	 $foto = $res['foto'];
	 $nome = $res['nome'];
	 if ($i < $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first\">
        <a href=\"imagens/$foto\" rel=\"lightbox[plants]\" title=\"$nome\">
        <img width=\"150\" height=\"100\" src=\"imagens/$foto\" /></a>
        </div></td>";
	 }elseif($i = $loop){
	 echo "<td><div class=\"imageRow\"><div class=\"single first\"><a href=\"imagens/$foto\" rel=\"lightbox[plants]\" title=\"$nome\">
        <img width=\"150\" height=\"100\" src=\"imagens/$foto\" /></a></div></td></tr>";
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
</body>
</html>