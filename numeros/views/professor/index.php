<style>
    .col-md-5{
        text-align: left;
    }
</style>

<?php
/* @var $this yii\web\View */

$this->params['breadcrumbs'] = array ('professor' => $professor, 'updatedAt' => $updatedAt);
$email = explode("@", $professor['email']);
$formacao = explode(";", $professor['formacao']);
?>

 <!-- Este script troca a classe da aba do menu correspondente à página acessada -->
<script>
    var li =document.getElementsByTagName("li");
    for(var i=0;i<li.length;i++) {
        if(li[i].className == "dropdown" || li[i].className == "dropdown active")
            li[i].className = "dropdown";
        else
            li[i].className = "";
    }
    li = document.getElementById("li-index");
    li.className = "active";
</script>

<div class="container theme-showcase" role="main">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-2">
                <a href="#">
                    <img class="media-object img-rounded" style="width: 140px; height: 140px;" src=<?= "img/professores/".$email[0].".jpg"?> alt="140x140">
                </a>
            </div>
            <div class="col-md-5">
                <h2 class="media-heading"><?= $professor['nome'];?></h2>
                <p>
                    <?php
                        if($formacao[0]){ 
                            if ($formacao[0] == 3)
                                echo "Formação: Doutorado em " .$formacao[1]. "<br>";
                            else if ($formacao[0] == 2)
                                echo "Formação: Mestrado em " .$formacao[1]. "<br>";
                            else if ($formacao[0] == 1)
                                echo "Formação: Graduação em " .$formacao[1]. "<br>";
                            echo "Local: " . $formacao[2] . "<br>";
                            echo "Ano: " . $formacao[3] . "<br>";
                        }
                        echo "Lattes: <a class=\"lattes\" href=\"http://lattes.cnpq.br/".$professor['idLattes']."\" target=\"_blank\">http://lattes.cnpq.br/".$professor['idLattes']."</a><br>";
                    ?>
                    E-mail: <?=$professor['email']?>
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
        <p class="text-justify"><?=$professor['resumo']?></p>
    </div>
</div>