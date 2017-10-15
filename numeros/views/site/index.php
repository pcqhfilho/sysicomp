<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>

<!-- Alunos section -->
<section id="alunos">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3>Alunos Matriculados</h3>
        <hr class="hr-section">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <h3 class="graduate">Graduação</h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4 col-md-offset-2 text-center">
        <h4>Ciência da Computação</h4>
        <h3 class="qtd">
          <?php echo $qtdMatCc; ?>
        </h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Sistemas da Informação</h4>
        <h3 class="qtd">
          <?php echo $qtdMatSi; ?>
        </h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-right">
        <small>Fonte: SIE, 11/08/2015.</small>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12 text-center">
        <h3 class="graduate">Pós-Graduação</h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4 col-md-offset-2 text-center">
        <h4>Mestrado</h4>
        <h3 class="qtd"><?php echo $qtdMatMest; ?></h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Doutorado</h4>
        <h3 class="qtd"><?php echo $qtdMatDoc; ?></h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-right">
        <small>Fonte: Sistema PPGI, <?php echo date('d/m/Y'); ?>.</small>
      </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
      <div class="col-md-12 text-center">
        <h3>Alunos Egressos</h3>
        <hr class="hr-section">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm12 col-xs-12 text-center">
        <h3 class="graduate">Graduação</h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4 text-center">
        <h4>Processamento de Dados</h4>
        <h3 class="qtd"><a href="index.php?r=graduacao/alunos-pd"><?php echo $qtdEgrPd; ?>
          <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span></a></h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Ciência da Computação</h4>
        <h3 class="qtd"><a href="index.php?r=graduacao/alunos-cc"><?php echo $qtdEgrCc; ?>
          <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span></a></h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Sistemas da Informação</h4>
        <h3 class="qtd"><a href="index.php?r=graduacao/alunos-si"><?php echo $qtdEgrSi; ?>
          <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span></a></h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-right">
        <small>Fonte: SIE, 11/08/2015.</small>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12 text-center">
        <h3 class="graduate">Pós-Graduação</h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4 col-md-offset-2 text-center">
        <h4>Mestrado</h4>
        <h3 class="qtd">
          <a href="index.php?r=aluno/alunos-mestrado"><?php echo $qtdEgrMest; ?>
            <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span>
          </a>
        </h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Doutorado</h4>
        <h3 class="qtd">
          <a href="index.php?r=aluno/alunos-doutorado"><?php echo $qtdEgrDoc; ?>
            <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span>
          </a>
        </h3>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-right">
        <small>Fonte: Sistema PPGI, <?php echo date('d/m/Y'); ?>.</small>
      </div>
    </div>
  </div>
</section>

<!-- Docentes section -->
<section class="success" id="docentes">
  <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>Docentes</h3>
            <hr class="hr-section">
        </div>
        <?php
          echo GridView::widget([
            'dataProvider' => $professorDataProvider,
            'summary' => "",
            'columns' => [
              [
                'header' => 'Professor',
                'format' => 'raw',
                'attribute' => 'nome',
                'value' => function ($data){
                  return Html::a(Html::encode($data->nome), Url::to(['professor/index', 'id' => $data->id]));
                }
              ],

              [
                'header' => 'Formação',

              ],

              [
                'header' => 'Última atualização',
                'attribute' => 'updated_at',

                // This function changes the date format 'y-m-d' to 'd/m/y' because in the stored data have both those date formats
                'value' => function ($data){
                  if($data->updated_at)
                  if($data->updated_at[2] != '/'){
                    $date = date_create($data->updated_at);
                    return date_format($date, 'd/m/Y');
                  }
                  return $data->updated_at;
                }
              ],

            ],
          ]);
        ?>
    </div>
  </div>
</section>


<!-- Publicacoes Section -->
   <section id="publicacoes">
       <div class="container">
           <div class="row">
               <div class="col-md-12 text-center">
                   <h3>Publicações em Conferências e Periódicos</h3>
                   <p>Para conferir a lista de artigos de cada ano, clique nas colunas do gráfico.</p>
                   <hr class="hr-section">
               </div>
           </div>
           <div class="row">
               <div class="col-md-12 text-center">
                   <div id="grafico"></div>
               </div>
           </div>
           <br>
           <div class="row">
               <div class="col-md-12 text-right">
                   <small>Atualizado em <?php echo date('d/m/Y'); ?>.</small>
               </div>
           </div>
       </div>
   </section>
