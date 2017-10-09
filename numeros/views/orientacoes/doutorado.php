<?php
/* @var $this yii\web\View */

$this->params['breadcrumbs'] = array('professor' => $professor, 'updatedAt' => $updatedAt);
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
    li = document.getElementById("li-orientacoes");
    li.className = "dropdown active";
</script>

<div class="container theme-showcase" role="main">

    <div class="row">
        <?php 
            if (!empty($orientacoesAndamentoDoutorado)) {
        ?>
        <div class="col-md-12">
            <div id="visualization_wrap">
                <div id="andamento" ></div>
            </div>
        </div>
        <?php 
            }
            if (!empty($orientacoesConcluidasDoutorado)) {
        ?>
        <div class="col-md-12">
            <div id="visualization_wrap">
                <div id="concluida" ></div>
            </div>
        </div>
        <?php 
            }
        ?>
    </div>
    <hr>
    <div class="panel-group">
        <?php if (!empty($orientacoesAndamentoDoutorado)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Orientações de Doutorado em Andamento (<?= $countOrientacoesAndamentoDoutorado?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php

                //Chamando a função povoaPainel
                //usando a query $orientacoesAndamentoDoutorado como parametro

                povoaPainel($orientacoesAndamentoDoutorado);
            ?>    
            </div>
        </div>
        <?php 
            } 
        ?>

        <?php if (!empty($orientacoesConcluidasDoutorado)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Orientações de Doutorado Concluídas (<?= $countOrientacoesConcluidasDoutorado?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php

                //Chamando a função povoaPainel
                //usando a query $orientacoesConcluidasDoutorado como parametro

                povoaPainel($orientacoesConcluidasDoutorado);
            ?>    
            </div>
        </div>
        <?php } ?>
    </div>

    <?php

        //Função que povoa o painel referente ao Doutorado
        //usando os parametros titulo, aluno, ano e natureza.

        function povoaPainel($arrayOrientacoes){
            echo "<ol>";
            foreach ($arrayOrientacoes as $orientacao) {
                echo "<li><strong>" . $orientacao['titulo'] . ".</strong> ";
                echo $orientacao['aluno'] . ", ";
                echo $orientacao['ano'] . ". ";
                echo $orientacao['natureza'] . ".</li><br>";
            }	
            echo "</ol>";
        }
    ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/docs.min.js"></script>
<script src="../js/ie10-viewport-bug-workaround.js"></script>

<script type="text/javascript">

    //JavaScript referente a interação com os paineis

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

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">

    //JavaScript referente a criação dos gráficos

    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Ano', 'Orientações', { role: 'style' }],
        <?php 
            $orientacoesAndamentoDoutoradoPorAno;
            if (empty($orientacoesAndamentoDoutoradoPorAno)) {
                echo "['', 0, '']";
            }
            else{
                $contaOrientacao = array();
                
                for ($i=date("Y")-9; $i <= date("Y"); $i++)
                    $contaOrientacao[$i] = 0; 
                foreach ($orientacoesAndamentoDoutoradoPorAno as $orientacao)
                    if($orientacao['ano'] <= date("Y")-9)
                        $contaOrientacao[date("Y")-9] += $orientacao['total'];
                    else
                        $contaOrientacao[$orientacao['ano']] += $orientacao['total'];
                
                $str = "['Até " . (date("Y")-8) . "', " . $contaOrientacao[date("Y")-9] . ", 'color: #009688'], ";
                for ($i=date("Y")-8; $i < date("Y"); $i++){ 
                    $str .= "['" . $i . "', " . $contaOrientacao[$i] . ", 'color: #009688'], "; 
                }
                $str .= "['" . date("Y") . "', " . $contaOrientacao[date("Y")] . ", 'color: #009688']";    
                echo $str;
            }
        ?>
    ]);

    var options = {
        title: 'Orientações de Doutorado em Andamento',
        legend: 'none',
        hAxis: {title: 'Ano', titleTextStyle: {italic: false}},
        vAxis: {title: 'Orientações', titleTextStyle: {italic: false}, format: '#'}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('andamento'));

    chart.draw(data, options);
    }

    $(window).resize(function(){
    drawChart();
    });

    google.setOnLoadCallback(drawChart2);
    function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ['Ano', 'Orientações', { role: 'style' }],
        <?php
            $orientacoesConcluidasDoutoradoPorAno;
            if (empty($orientacoesConcluidasDoutoradoPorAno)) {
                echo "['', 0, '']";
            }
            else{
                $contaOrientacao = array();
                
                for ($i=date("Y")-9; $i <= date("Y"); $i++)
                    $contaOrientacao[$i] = 0; 
                foreach ($orientacoesConcluidasDoutoradoPorAno as $orientacao)
                    if($orientacao['ano'] <= date("Y")-9)
                        $contaOrientacao[date("Y")-9] += $orientacao['total'];
                    else
                        $contaOrientacao[$orientacao['ano']] += $orientacao['total'];
                
                $str = "['Até " . (date("Y")-8) . "', " . $contaOrientacao[date("Y")-9] . ", 'color: #009688'], ";
                for ($i=date("Y")-8; $i < date("Y"); $i++){ 
                    $str .= "['" . $i . "', " . $contaOrientacao[$i] . ", 'color: #009688'], "; 
                }
                $str .= "['" . date("Y") . "', " . $contaOrientacao[date("Y")] . ", 'color: #009688']";    
                echo $str;
            }
        ?>
    ]);

    var options = {
        title: 'Orientações de Doutorado Concluídas',
        legend: 'none',
        hAxis: {title: 'Ano', titleTextStyle: {italic: false}},
        vAxis: {title: 'Orientações', titleTextStyle: {italic: false}, format: '#'}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('concluida'));

    chart.draw(data, options);
    }

    $(window).resize(function(){
    drawChart2();
    });
</script>