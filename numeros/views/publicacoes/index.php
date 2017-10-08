<?php
/* @var $this yii\web\View */
$this->params['breadcrumbs'] = array ('professor' => $professor, 'updatedAt' => $updatedAt);
?>

<div class="container theme-showcase" role="main">

    <div class="row">
        <?php 
            if(!empty($publicacoesEmConferencias)){ 
        ?>
        <div class="col-md-12">
            <div id="visualization_wrap">
                <div id="conferencias" ></div>
            </div>
        </div>
        <?php 
            } 
            if(!empty($publicacoesEmPeriodicos)){ 
        ?>
        <div class="col-md-12">
            <div id="visualization_wrap">
                <div id="periodicos" ></div>
            </div>
        </div>
        <?php } ?>
    </div>
    <hr>
    <div class="panel-group">

        <?php if (!empty($publicacoesEmConferencias)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Artigos Publicados em Conferências (<?= $countPublicacoesEmConferencias?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php 
            
                echo "<ol>";
                foreach ($publicacoesEmConferencias as $publicacao) {
                    echo "<li><strong>" . $publicacao['titulo'] . ". </strong>";
                    echo $publicacao['autores'];
                    echo "<i>" . $publicacao['local'] . ", ";
                    echo $publicacao['ano'] . ". </i>";
                    echo $publicacao['natureza'] . ".";
                    echo "</li><br>";
                }	
                echo "</ol>";
            ?>    
            </div>
        </div>
        <?php } ?>

        <?php if (!empty($publicacoesEmConferencias)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Artigos Publicados em Periódicos (<?= $countPublicacoesEmPeriodicos?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php 
                echo "<ol>";
                foreach ($publicacoesEmPeriodicos as $publicacao) {
                    echo "<li><strong>" . $publicacao['titulo'] . ". </strong>";
                    echo $publicacao['autores'];
                    echo "<i>" . $publicacao['local'] . ", ";
                    echo $publicacao['ano'] . ". </i>";
                    echo "</li><br>";
                }	
                echo "</ol>";
            ?>    
            </div>
        </div>
        <?php } ?>

        <?php if (!empty($publicacoesEmLivros)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Livros Publicados (<?= $countPublicacoesEmLivros?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php 
                echo "<ol>";
                foreach ($publicacoesEmLivros as $publicacao) {
                    echo "<li><strong>" . $publicacao['titulo'] . ". </strong>";
                    echo $publicacao['ano'] . ". </i>";
                    echo "</li><br>";
                }	
                echo "</ol>";
            ?>    
            </div>
        </div>
        <?php } ?>
        
        <?php if (!empty($publicacoesEmCapitulos)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading clickable">
                <h4 class="panel-title">
                    <a href="#">Capítulos de Livros Publicados (<?= $countPublicacoesEmCapitulos?>)</a>
                </h4>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
            <?php 
                echo "<ol>";
                foreach ($publicacoesEmCapitulos as $publicacao) {
                    echo "<li><strong>" . $publicacao['titulo'] . ". </strong>";
                    echo "<i>" . $publicacao['local'] . ", ";
                    echo $publicacao['ano'] . ". </i>";
                    echo "</li><br>";
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
        ['Ano', 'Artigos', { role: 'style' }],
        <?php 
            if (empty($publicacoesEmConferenciasPorAno)) {
                echo "['', 0, '']";
            }
            else{
                $contaPublicacao = array();
                
                for ($i=date("Y")-6; $i <= date("Y"); $i++)
                    $contaPublicacao[$i] = 0; 
                foreach ($publicacoesEmConferenciasPorAno as $publicacao)
                    if($publicacao['ano'] <= date("Y")-6)
                        $contaPublicacao[date("Y")-6] += $publicacao['total'];
                    else
                        $contaPublicacao[$publicacao['ano']] += $publicacao['total'];
                
                $str = "['Até " . (date("Y")-5) . "', " . $contaPublicacao[date("Y")-6] . ", 'color: #009688'], ";
                for ($i=date("Y")-5; $i < date("Y"); $i++){ 
                    $str .= "['" . $i . "', " . $contaPublicacao[$i] . ", 'color: #009688'], "; 
                }
                $str .= "['" . date("Y") . "', " . $contaPublicacao[date("Y")] . ", 'color: #009688']";    
                echo $str;
            }
        ?>
    ]);

    var options = {
        title: 'Artigos Publicados em Conferências',
        legend: 'none',
        hAxis: {title: 'Ano', titleTextStyle: {italic: false}},
        vAxis: {title: 'Artigos', titleTextStyle: {italic: false}, format: '#'}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('conferencias'));

    chart.draw(data, options);
    }

    $(window).resize(function(){
    drawChart();
    });

    google.setOnLoadCallback(drawChart2);
    function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ['Ano', 'Artigos', { role: 'style' }],
        <?php 
            if (empty($publicacoesEmPeriodicosPorAno)) {
                echo "['', 0, '']";
            }
            else{
                $contaPublicacao = array();
                
                for ($i=date("Y")-6; $i <= date("Y"); $i++)
                    $contaPublicacao[$i] = 0; 
                foreach ($publicacoesEmPeriodicosPorAno as $publicacao)
                    if($publicacao['ano'] <= date("Y")-6)
                        $contaPublicacao[date("Y")-6] += $publicacao['total'];
                    else
                        $contaPublicacao[$publicacao['ano']] += $publicacao['total'];
                
                $str = "['Até " . (date("Y")-5) . "', " . $contaPublicacao[date("Y")-6] . ", 'color: #009688'], ";
                for ($i=date("Y")-5; $i < date("Y"); $i++){ 
                    $str .= "['" . $i . "', " . $contaPublicacao[$i] . ", 'color: #009688'], "; 
                }
                $str .= "['" . date("Y") . "', " . $contaPublicacao[date("Y")] . ", 'color: #009688']";    
                echo $str;
            }
        ?>
    ]);

    var options = {
        title: 'Artigos Publicados em Periódicos',
        legend: 'none',
        hAxis: {title: 'Ano', titleTextStyle: {italic: false}},
        vAxis: {title: 'Artigos', titleTextStyle: {italic: false}, format: '#'}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('periodicos'));

    chart.draw(data, options);
    }

    $(window).resize(function(){
    drawChart2();
    });
</script>