<section id="publicacoes">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3><?php echo $qtdTotalPublicacoesAno;?> Artigos Publicados em <?php echo $anoAtual;?></h3>
                <hr class="hr-section">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-left">
                <h4><?php echo $qtdConf;?> Em Conferências</h4>
            </div>
        </div>
        <br>

        <?php
        echo "<ul>";
        foreach ($queryPublicacoesConf as $pub){
          echo "<li class=\"text-justify\"><strong>" . $pub['titulo'] . ". </strong>";
          $aux = explode("; ", str_replace(",", "", rtrim($pub['autores'],"; ")));

          foreach($aux as $autor){
            echo $autor;
            echo "; ";
          }

          echo "<i>" . $pub['local'] . ", " . $pub['ano'] . ". </i>";

          if($pub['tipo'] == 1){
            echo $pub['natureza'];
          }
          echo "<br>";
          echo "Fonte(s): ";

          echo "</li><br>";
        }
        echo "</ul>";
        ?>


        <div class="row">
            <div class="col-md-12 text-left">
                <h4><?php echo $qtdPeriod;?> Em Periódicos</h4>
            </div>
        </div>
        <br>

        <?php
        echo "<ul>";
        foreach ($queryPublicacoesPeriod as $pub){
          echo "<li class=\"text-justify\"><strong>" . $pub['titulo'] . ". </strong>";
          $aux = explode("; ", str_replace(",", "", rtrim($pub['autores'],"; ")));

          foreach($aux as $autor){
            echo $autor;
            echo "; ";
          }

          echo "<i>" . $pub['local'] . ", " . $pub['ano'] . ". </i>";
          echo "<br>";
          echo "Fonte(s): ";

          echo "</li><br>";
        }
        echo "</ul>";
        ?>

    </div>
</section>
