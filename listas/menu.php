
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Gerenciador Despachante</title>
        <meta http-equiv="description" content="" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/jmenu.css" type="text/css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jMenu.jquery.js"></script>
    </head>
    <body>
       

<ul id="jMenu">
            <li>
                <a>Home</a>
              

            <li>
                <a>Cadastros</a>
                <ul>
                    <li><a href="layout_cliente.php">Clientes</a></li>
                    <li><a href="layout_imovel_lista.php">Im&oacute;vel</a></li>
                    <li><a href="layout_galeria.php">Galeria</a></li>
                  
                    
              </ul>
            </li>
             <li>
                <a>Documenta&ccedil;&otilde;es</a>
                <ul>
                    <li><a href="layout_documentacao.php">Anexar Documentos</a></li>
                    <li><a href="layout_entrega.php">Entrega de Documentos</a></li>
                    <li><a href="layout_processo.php">Movimentar Processo</a></li>
                  
                    
              </ul>
            </li>
            

            <li>
                <a>Financeiro</a>
                <ul>
                    <li><a href="layout_servico.php">Registrar Servi&ccedil;os</a></li>
                    <li><a href="layout_despesas.php">Registrar Despesas</a></li>
                 
                  <li><a href="layout_balanco.php">Contas Pagas</a></li>
                  <li><a href="layout_balanco_despesas.php">Lista de Despesas</a></li>
                  <li><a href="layout_conta_receber.php">Contas a Receber</a></li>
                  <li><a href="layout_conta_devedor.php">Cliente Devedor</a></li>
                  <li><a href="layout_fluxo.php">Fluxo de Caixa</a></li>
              </ul>
            </li>
            
             <li><a>Estat&iacute;stica</a>
            <ul>
                    <li><a href="layout_estatistica.php">Estat&iacute;stica</a></li>
                    <li><a href="layout_grafico.php">Gr&aacute;fico</a></li>
                   
                    
                </ul>
            
            </li>
            

            <li><a>Administra&ccedil;&atilde;o</a>
            <ul>
                    <li><a href="layout_admin.php">Consultar Opera&ccedil;&otilde;es</a></li>
                    <li><a href="layout_niver_dia.php">Aniversariantes do dia</a></li>
                    <li><a href="layout_niver_mes.php">Aniversariantes do M&ecirc;s</a></li>
                    
                    
                </ul>
            
            </li>

           
        </ul>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#jMenu").jMenu({
                    openClick : false,
                    ulWidth :'auto',
                     TimeBeforeOpening : 100,
                    TimeBeforeClosing : 11,
                    animatedText : false,
                    paddingLeft: 1,
                    effects : {
                        effectSpeedOpen : 150,
                        effectSpeedClose : 150,
                        effectTypeOpen : 'slide',
                        effectTypeClose : 'slide',
                        effectOpen : 'swing',
                        effectClose : 'swing'
                    }

                });
            });
        </script>
    </body>
</html>

