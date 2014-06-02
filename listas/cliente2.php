<?php require_once('../Connections/conexao.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_conexao = new KT_connection($conexao, $database_conexao);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("capa");
  $uploadObj->setDbFieldName("capa");
  $uploadObj->setFolder("../uploads/");
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_cliente = new tNG_insert($conn_conexao);
$tNGs->addTransaction($ins_cliente);
// Register triggers
$ins_cliente->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_cliente->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_cliente->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_cliente->setTable("cliente");
$ins_cliente->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_cliente->addColumn("login", "STRING_TYPE", "POST", "login");
$ins_cliente->addColumn("cliente", "STRING_TYPE", "POST", "cliente");
$ins_cliente->addColumn("apelido", "STRING_TYPE", "POST", "apelido");
$ins_cliente->addColumn("endereco", "STRING_TYPE", "POST", "endereco");
$ins_cliente->addColumn("bairro", "STRING_TYPE", "POST", "bairro");
$ins_cliente->addColumn("municipio", "STRING_TYPE", "POST", "municipio");
$ins_cliente->addColumn("local", "STRING_TYPE", "POST", "local");
$ins_cliente->addColumn("cpf_titular", "STRING_TYPE", "POST", "cpf_titular");
$ins_cliente->addColumn("cnpj", "STRING_TYPE", "POST", "cnpj");
$ins_cliente->addColumn("cpf_procu", "STRING_TYPE", "POST", "cpf_procu");
$ins_cliente->addColumn("procuracao", "STRING_TYPE", "POST", "procuracao");
$ins_cliente->addColumn("aniversario", "STRING_TYPE", "POST", "aniversario");
$ins_cliente->addColumn("telefone", "STRING_TYPE", "POST", "telefone");
$ins_cliente->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_cliente->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_cliente->addColumn("status2", "STRING_TYPE", "POST", "status2");
$ins_cliente->addColumn("capa", "FILE_TYPE", "FILES", "capa");
$ins_cliente->setPrimaryKey("id_cliente", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscliente = $tNGs->getRecordset("cliente");
$row_rscliente = mysql_fetch_assoc($rscliente);
$totalRows_rscliente = mysql_num_rows($rscliente);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador imobiliario</title>

<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/MaskedInput.js"></script>
<script>
			function alterna(tipo) {
			
			if (tipo == 1) {
			document.getElementById("tipo1").style.display = "block";
			document.getElementById("tipo2").style.display = "none";
			} else {
			document.getElementById("tipo1").style.display = "none";
			document.getElementById("tipo2").style.display = "block";
			}
			
			}
</script>


</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?><br />


<fieldset><legend>Novo Cliente</legend>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
  <table align="center" cellpadding="2" cellspacing="0" class="KT_tngtable"><tr><td><table align="center" cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td colspan="2" class="KT_th"><label for="data"></label>        <input type="hidden" name="data" id="data" value="<?php echo date("Y-m-d"); ?>" size="32" />
        <label for="login"></label>        <input type="hidden" name="login" id="login" value="<?php echo $_SESSION['MM_Username']; ?>" size="32" />
        <input type="hidden" name="status" id="status" value="Aguardando...." size="32" />
        <input type="hidden" name="status2" id="status2" value="Ligar para o cliente" size="32" /></td>
      </tr>
    
    <tr>
      <td class="KT_th"><label for="cliente">Cliente:</label></td>
      <td><input type="text" name="cliente" id="cliente" value="<?php echo KT_escapeAttribute($row_rscliente['cliente']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("cliente");?> <?php echo $tNGs->displayFieldError("cliente", "cliente"); ?> </td>
    </tr>
    
    <tr>
      <td class="KT_th"><label for="endereco">Endereco:</label></td>
      <td><input type="text" name="endereco" id="endereco" value="<?php echo KT_escapeAttribute($row_rscliente['endereco']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("endereco");?> <?php echo $tNGs->displayFieldError("cliente", "endereco"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="bairro">Bairro:</label></td>
      <td><input type="text" name="bairro" id="bairro" value="<?php echo KT_escapeAttribute($row_rscliente['bairro']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("bairro");?> <?php echo $tNGs->displayFieldError("cliente", "bairro"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="municipio">Municipio:</label></td>
      <td><input type="text" name="municipio" id="municipio" value="<?php echo KT_escapeAttribute($row_rscliente['municipio']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("municipio");?> <?php echo $tNGs->displayFieldError("cliente", "municipio"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="local">Local:</label></td>
      <td><input type="text" name="local" id="local" value="<?php echo KT_escapeAttribute($row_rscliente['local']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("local");?> <?php echo $tNGs->displayFieldError("cliente", "local"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="cpf_titular"></label></td>
      <td><div align="left">
        <span class="span5">CPF&nbsp;</span>
        <input type="radio" name="tipo" value="1" onclick="alterna(this.value);" />
        <span class="span5">CNPJ&nbsp;</span>
        <input type="radio" name="tipo" value="2" onclick="alterna(this.value);" />
        <br /><div id="tipo1" style="display:none;">
			  <input name="cpf_titular" id="cpf_titular"  value="" size="17" maxlength="14" wdg:subtype="MaskedInput" wdg:mask="999.999.999-99" wdg:restricttomask="no" wdg:type="widget">
			  </div>
        <div id="tipo2" style="display:none;">
			  <input name="cnpj" id="cnpj"  value="" size="25" maxlength="18" wdg:subtype="MaskedInput" wdg:mask="99.999.999/9999-99" wdg:restricttomask="no" wdg:type="widget"></td>
    </tr>
    <tr>
      <td colspan="2" class="KT_th"><label for="cnpj"></label>        <label for="cpf_procu"></label></td>
      </tr>
    
    
    <tr>
      <td class="KT_th"><label for="aniversario">Aniversario:</label></td>
      <td><input type="date" name="aniversario" id="aniversario" value="<?php echo KT_formatDate($row_rscliente['aniversario']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("aniversario");?> <?php echo $tNGs->displayFieldError("cliente", "aniversario"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="telefone">Telefone:</label></td>
      <td><input name="telefone" id="telefone" value="<?php echo KT_escapeAttribute($row_rscliente['telefone']); ?>" size="32" wdg:subtype="MaskedInput" wdg:mask="(99) 999 - 9999" wdg:restricttomask="no" wdg:type="widget" />
          <?php echo $tNGs->displayFieldHint("telefone");?> <?php echo $tNGs->displayFieldError("cliente", "telefone"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="email">Email:</label></td>
      <td><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rscliente['email']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("cliente", "email"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="KT_th">&nbsp;</td>
      <td>Somente se for cadastrar uma galeria de imagem</td>
    </tr>
    <tr>
      <td class="KT_th"><label for="capa">Capa da galeria:</label></td>
      <td><input type="file" name="capa" id="capa" size="32" />
          <?php echo $tNGs->displayFieldError("cliente", "capa"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" class="botao" name="KT_Insert1" id="KT_Insert1" value="Cadastrar" />      </td>
    </tr>
  </table></td>
    </tr>
</table>
</form>
</fieldset>

</body>
</html>
