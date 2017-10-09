<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use numeros\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>

<?php
    $professor = $this->params['breadcrumbs']['professor'];
    $updatedAt = $this->params['breadcrumbs']['updatedAt'];
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
                    <li><a href="index.php">Início</a></li>
                    <li id="li-index"><?=Html::a('Descrição', Url::to(['professor/index', 'id' => $professor['id']]));?>
                    <li id="li-publicacoes"><?=Html::a('Publicações', Url::to(['publicacoes/index', 'id' => $professor['id']]));?></li>
                    <li id="li-projetos"><?=Html::a('Projetos de pesquisa', Url::to(['projetos/index', 'id' => $professor['id']]));?></li>
                    <li id="li-orientacoes" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orientações <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?=Html::a('Graduação', Url::to(['orientacoes/graduacao', 'id' => $professor['id']]));?></li>
                            <li><?=Html::a('Mestrado', Url::to(['orientacoes/mestrado', 'id' => $professor['id']]));?></li>
                            <li><?=Html::a('Doutorado', Url::to(['orientacoes/doutorado', 'id' => $professor['id']]));?></li>
                        </ul>
                    </li>
                    <li id="li-premios"><?=Html::a('Prêmios', Url::to(['premios/index', 'id' => $professor['id']]));?></li>
                </ul>
            </div>
        </div>
    </nav>

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
                    <p class="text-right">
                        Atualizado em: <?= $updatedAt?>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>

<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
</html>
