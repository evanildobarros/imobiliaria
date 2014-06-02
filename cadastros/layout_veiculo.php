<?php require ('../datahora.php'); ?>
<?php
 
 session_start();

	if ($_SESSION['autentica']<>'foifoifoifoi'){
		header('location:../aviso.php?id=1');
	}
	
    switch ($_SESSION['chave']){
	case 1:
		$grupo = "gerenciadores do sistema";
		break;
	case 2: 
		$grupo = "Administração";
		break;
	case 3:
		$grupo = "Instrutores e/ou utilizadores comum";
		break;
}


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<link rel="stylesheet" href="../css/menu_horizontal.css" type="text/css">

<title>Gerenciador Despachante</title>
</head>

<body>
<div class="banner">
     
     <div class="logo"><img width="400" height="60" src="../img/LOGO_CARRO.png"></div>
     <div class="titulo">
          <span class="span1">Hoje é <?php echo $_SESSION['data']; ?><br>
                              Usuário: <span class="span2"><?php echo $_SESSION['usuario']; ?></span><br>
                              Grupo:<span class="span3"> <?php echo $grupo; ?></span></span>     </div>
    

</div>
<div class="cont_menu">

<?php include('../menu.php'); ?>

</div>
<div class="conteudo">

<div class="box_veiculo"><?php require('veiculo.php'); ?></div>

</div>
<div class="rodape" align="center"><span class="span"> Mhs Soluções Web - Endereço: Rua 03 qd.05 Casa 36  Cohatrac IV<br>
                           Contato: (98) 8800 - 3198 | 8128-6928 Email: eneylton@hotmail.com<br>
                           todos os direitos reservados &copy; 2014 copyright</span></div>
</body>
</html>
