<?php
/* @var $this yii\web\View */

$this->params['breadcrumbs'] = array ('professor' => $professor, 'updatedAt' => $updatedAt);
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
    li = document.getElementById("li-projetos");
    li.className = "active";
</script>

<div class="container theme-showcase" role="main">
    <div id="visualization_wrap">
        <div id="projetos" ></div>
    </div>  
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading clickable">
            <h4 class="panel-title">
                <a href="#">Projetos de Pesquisa (<?= $countProjetos ?>)</a>
            </h4>
        <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
        </div>
        <div class="panel-body">
            <?php 
                echo "<ol>";
                foreach ($queryProjetos as $projeto){
                    if($projeto['fim'] == 0)
                        echo "<li><strong>" . $projeto['inicio'] . " - Atual.</strong> ";
                    else
                        echo "<li><strong>" . $projeto['inicio'] . " - " . $projeto['fim'] . ".</strong> ";
                    
                    echo "<i>" . $projeto['titulo'] . ".</i> ".$projeto['papel']." <br><br>";
                    echo "<p class=\"text-justify\"><strong>Descrição: </strong>" . $projeto['descricao'] . "</p><strong>Integrantes(es):</strong> ".$projeto['integrantes']."<br><br><strong>Financiador(es):</strong> ".$projeto['financiadores']."</li><br>";
                }
                echo "</ol>";
            ?>    
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
            ['Ano', 'Projetos', { role: 'style' }],
            <?php 
                if (empty($queryProjetosPorAno))
                    echo "['', 0, '']";
                else{
                    $contaProjeto = array();
                    
                    for ($i=date("Y")-9; $i <= date("Y"); $i++)
                        $contaProjeto[$i] = 0; 

                    foreach ($queryProjetosPorAno as $projeto) {
                        foreach ($projeto as $inicio => $fim) {
                            if ($inicio < date("Y")-9)
                                $inicio = date("Y")-9;
        
                            if ($fim == 0) {
                                for ($i=$inicio; $i <= date("Y") ; $i++) { 
                                    $contaProjeto[$i]++;
                                }
                            }
                            else{
                                for ($i=$inicio; $i <= $fim ; $i++) { 
                                    $contaProjeto[$i]++;
                                }
                            }
                        }
                    }
        
                    $str = "";
                    for ($i=date("Y")-9; $i < date("Y"); $i++) { 
                        $str .= "['" . $i . "', " . $contaProjeto[$i] . ", 'color: #009688'], "; 
                    }
        
                    $str .= "['" . date("Y") . "', " . $contaProjeto[date("Y")] . ", 'color: #009688']"; 
                    
                    echo $str;
                }
            ?>
        ]);

        var options = {
            title: 'Projetos de Pesquisa',
            legend: 'none',
            hAxis: {title: 'Ano', titleTextStyle: {italic: false}},
            vAxis: {title: 'Projetos', titleTextStyle: {italic: false}, format: '#'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('projetos'));
        chart.draw(data, options);
    }

    $(window).resize(function(){
        drawChart();
    });
</script>