<?php
session_start();
?>

<?php require'../Connections/conexao.php'; ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_proc = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_proc = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_proc = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_proc, "int"));
$proc = mysql_query($query_proc, $conexao) or die(mysql_error());
$row_proc = mysql_fetch_assoc($proc);
$totalRows_proc = mysql_num_rows($proc);

$conexao = mysql_connect('localhost','root','');
$db = mysql_select_db('mi');
?>
<!DOCTYPE html>
<html>
<head>
  <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="../scripts/jquery.js" /></script>
    <script type="text/javascript" src="../scripts/jquery.MultiFile.js" /></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		
       

<title>Cadastro de Imagens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
 <form name="upload_files" action="" enctype="multipart/form-data" method="post">
    <table width="420" border="1" align="center" bordercolor="#CCCCCC" style="border-collapse:collapse">
   <tr>
     <td colspan="2" valign="top" bgcolor="#ededed"><?php if(isset($_POST['upload'])){
          $pasta = '../uploads/';
          foreach($_FILES["img"]["error"] as $key => $error){

 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod = date('dmy') . '-' . $_FILES["img"]["name"][$key];
 $nome = $_FILES["img"]["name"][$key];
 
 $id_pro     = $_POST['id_cliente'];
 
 $uploadfile = $pasta . basename($cod);

 if(move_uploaded_file($tmp_name, $uploadfile)){
 echo "O Arquivo " . $nome . " foi enviado com sucesso!<br />";
 $inserir = mysql_query("INSERT INTO documentacao (img,id_cliente) VALUES ('$cod','$id_pro')");
 }else{
 echo "Erro ao enviar o arquivo " . $nome . "! Por favor tente outra vez!";
 } } } } ?>
       <input name="id_cliente" type="hidden" id="id_cliente" value="<?php echo $row_proc['id_cliente']; ?>">
       </label></td>
     </tr>
   

   <tr>
     <td valign="top" bgcolor="#ededed"><span class="style5">Documenta&ccedil;&otilde;es</span></td>
     <td bgcolor="#ededed"><input type="file"  multiple="multiple" name="img[]" class="multi" maxlength="5" accept="jpeg|jpg|png|gif|pdf" /></td>
   </tr>
   <tr>
     <td valign="top" bgcolor="#ededed">&nbsp;</td>
     <td bgcolor="#ededed"><input class="bt" type="submit" name="upload" value="Upload" /></td>
   </tr>
 </table>
</form>
 
 <br />
</body>
</html>
<?php
mysql_free_result($proc);
?>