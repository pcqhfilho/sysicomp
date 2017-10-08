<?php
/* @var $this yii\web\View */

$this->params['breadcrumbs'] = array('professor' => $professor, 'updatedAt' => $updatedAt);
?>

<div class="container theme-showcase" role="main">

    <div class="row">
        <?php 
            if (!empty($orientacoesAndamentoGraduacao)) {
        ?>
        <div class="col-md-12">
            <div id="visualization_wrap">
                <div id="andamento" ></div>
            </div>
        </div>
        <?php 
            }
            if (!empty($orientacoesConcluidasGraduacao)) {
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
        <?php if (!empty($orientacoesAndamentoGraduacao)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Orientações de Graduação em Andamento (<?= $countOrientacoesAndamentoGraduacao?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php 
                echo "<ol>";
                foreach ($orientacoesAndamentoGraduacao as $orientacao) {
                    echo "<li><strong>" . $orientacao['titulo'] . ".</strong> ";
                    echo $orientacao['aluno'] . ", ";
                    echo $orientacao['ano'] . ". ";
                    echo $orientacao['natureza'] . ".</li><br>";
                }	
                echo "</ol>";
            ?>    
            </div>
        </div>
        <?php 
            } 
        ?>

        <?php if (!empty($orientacoesConcluidasGraduacao)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Orientações de Graduação Concluídas (<?= $countOrientacoesConcluidasGraduacao?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php 
                echo "<ol>";
                foreach ($orientacoesConcluidasGraduacao as $orientacao) {
                    echo "<li><strong>" . $orientacao['titulo'] . ".</strong> ";
                    echo $orientacao['aluno'] . ", ";
                    echo $orientacao['ano'] . ". ";
                    echo $orientacao['natureza'] . ".</li><br>";
                }	
                echo "</ol>";
            ?>    
            </div>
        </div>
        <?php } ?>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/docs.min.js"></script>
<script src="../js/ie10-viewport-bug-workaround.js"></script>

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

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Ano', 'Orientações', { role: 'style' }],
        <?php 
            $orientacoesAndamentoGraduacaoPorAno;
            if (empty($orientacoesAndamentoGraduacaoPorAno)) {
                echo "['', 0, '']";
            }
            else{
                $contaOrientacao = array();
                
                for ($i=date("Y")-9; $i <= date("Y"); $i++)
                    $contaOrientacao[$i] = 0; 
                foreach ($orientacoesAndamentoGraduacaoPorAno as $orientacao)
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
        title: 'Orientações de Graduação em Andamento',
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
            $orientacoesConcluidasGraduacaoPorAno;
            if (empty($orientacoesConcluidasGraduacaoPorAno)) {
                echo "['', 0, '']";
            }
            else{
                $contaOrientacao = array();
                
                for ($i=date("Y")-9; $i <= date("Y"); $i++)
                    $contaOrientacao[$i] = 0; 
                foreach ($orientacoesConcluidasGraduacaoPorAno as $orientacao)
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
        title: 'Orientações de Graduação Concluídas',
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