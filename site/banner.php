<?php require_once('../Connections/conexao.php'); ?>
<?php
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
  $uploadObj->setFormFieldName("img");
  $uploadObj->setDbFieldName("img");
  $uploadObj->setFolder("uploads/");
  $uploadObj->setMaxSize(5000);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_banner = new tNG_insert($conn_conexao);
$tNGs->addTransaction($ins_banner);
// Register triggers
$ins_banner->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_banner->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_banner->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_banner->setTable("banner");
$ins_banner->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$ins_banner->addColumn("descricao", "STRING_TYPE", "POST", "descricao");
$ins_banner->addColumn("img", "FILE_TYPE", "FILES", "img");
$ins_banner->addColumn("autorizar", "STRING_TYPE", "POST", "autorizar");
$ins_banner->setPrimaryKey("id_banner", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsbanner = $tNGs->getRecordset("banner");
$row_rsbanner = mysql_fetch_assoc($rsbanner);
$totalRows_rsbanner = mysql_num_rows($rsbanner);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
</head>

<body>

<?php
	echo $tNGs->getErrorMsg();
?>
<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td class="KT_th"><label for="titulo">Titulo:</label></td>
      <td><input type="text" name="titulo" id="titulo" value="<?php echo KT_escapeAttribute($row_rsbanner['titulo']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("titulo");?> <?php echo $tNGs->displayFieldError("banner", "titulo"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="descricao">Descricao:</label></td>
      <td><textarea name="descricao" id="descricao" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsbanner['descricao']); ?></textarea>
          <?php echo $tNGs->displayFieldHint("descricao");?> <?php echo $tNGs->displayFieldError("banner", "descricao"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="img">Img:</label></td>
      <td><input type="file" name="img" id="img" size="32" />
          <?php echo $tNGs->displayFieldError("banner", "img"); ?> </td>
    </tr>
    <input type="hidden" name="autorizar" id="autorizar" value="<?php echo KT_escapeAttribute($row_rsbanner['autorizar']); ?> 2" size="32" />
          <?php echo $tNGs->displayFieldHint("autorizar");?> <?php echo $tNGs->displayFieldError("banner", "autorizar"); ?> 
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Insert record" />
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
