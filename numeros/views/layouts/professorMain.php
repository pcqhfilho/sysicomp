<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use numeros\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= Html::csrfMetaTags() ?>
    <title>IComp Números</title>
    <?php $this->head() ?>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/theme.css" rel="stylesheet">

    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body role="document">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Início</a></li>
                    <li><a href="publicacoes.php">Publicações</a></li>
                    <li><a href="projetos.php">Projetos de Pesquisa</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orientações <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="graduacao.php">Graduação</a></li>
                            <li><a href="mestrado.php">Mestrado</a></li>
                            <li><a href="doutorado.php">Doutorado</a></li>
                        </ul>
                    </li>
                    <li><a href="premios.php">Prêmios</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-2">
                    <a href="#">
                        <img class="media-object img-rounded" style="width: 140px; height: 140px;" src="img/altigran.jpg" alt="140x140">
                    </a>
                </div>
            <div class="col-md-5">
                <h2 class="media-heading">Nome do professor</h2>
                <p>
                    Formação: <br>
                    Local: <br>
                    Ano: <br>
                    Lattes: <a class=\"lattes\" href=\"http://lattes.cnpq.br/lattes\" target=\"_blank\">http://lattes.cnpq.br/Lattes</a><br>
                    E-mail: <a id="endereco" class="envelope lattes"><span class="glyphicon glyphicon glyphicon-envelope" aria-hidden="true"></span></a><img src="img/email-altigran.png">
                    <?php
                        $image = imagecreatetruecolor(250, 25);
                        $background_color = imagecolorallocate($image, 224, 242, 241);  
                        imagefilledrectangle($image,0,0,250,25,$background_color);
                        $textcolor = imagecolorallocate($image, 0, 0, 0);
                        $font = "font-awesome/css/helveticaneue-light.ttf";
                        imagettftext($image, 13, 0, 5, 16, $textcolor, $font, 'alti@icomp.ufam.edu.br');
                        imagepng($image, "img/emailaltigran.png");
                        
                        $email = explode("@", 'alti@icomp.ufam.edu.br');
                    ?>
                </p>
            </div>
            <div class="col-xs-6 col-md-3">
                <a href="http://icomp.ufam.edu.br">
                    <img class="img-responsive" style="width: 250px; height: 140px;" src="img/icomp.png" alt="250x140">
                </a>
            </div>
            <div class="col-xs-4 col-md-2">
                <a href="http://www.ufam.edu.br">
                    <img class="img-responsive" style="width: 120px; height: 140px;" src="img/ufam.png" alt="120x140">
                </a>
            </div>
        </div>
        <hr>
        <p class="text-justify">Descrição</p>
        <!-- </div> -->
    </div> 
    
    <!-- VIEWS AQUI! -->
    <?= $content ?>

    <!-- footer -->
    <div class="container">
        <hr>
        <footer>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p class="text-left">&copy; <a href="http://icomp.ufam.edu.br" target="_blank">IComp 2015</a></p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p class="text-right">Atualizado em: xx/xx/xxx </p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript">
        $(document).on('click', '.panel-heading span.clickable', function (e) {
            var $this = $(this);
            if (!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
        });
        $(document).on('click', '.panel div.clickable', function (e) {
            var $this = $(this);
            if (!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
        });
        $(document).ready(function () {
            $('.panel-heading span.clickable').click();
            $('.panel div.clickable').click();
        });
    </script>

    <script type="text/javascript">
        dominio = "alti@icomp.ufam.edu.br";
        arroba = "@";
        mt = "mailto:";
        endereco = document.getElementById("endereco");
        endereco.setAttribute("href", mt + "<?= $email[0]?>" + arroba + dominio);
    </script>

<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
</html>