<?php 
use yii\helpers\Html;
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
        <h3 class="qtd"><a href="index.php?r=aluno"><?php echo $qtdEgrPd; ?>
          <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span></a></h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Ciência da Computação</h4>
        <h3 class="qtd"><a href="index.php?r=aluno/alunos-cc"><?php echo $qtdEgrCc; ?>
          <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span></a></h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Sistemas da Informação</h4>
        <h3 class="qtd"><a href="index.php?r=aluno/alunos-si"><?php echo $qtdEgrSi; ?>
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
          <a href="index.php?r=aluno"><?php echo $qtdEgrMest; ?>
            <span class="glyphicon glyphicon-search lupa" aria-hidden="true"></span>
          </a>
        </h3>
      </div>
      <div class="col-md-4 text-center">
        <h4>Doutorado</h4>
        <h3 class="qtd">
          <a href="index.php?r=aluno-mestrado"><?php echo $qtdEgrDoc; ?>
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
        <?= GridView::widget([
              'dataProvider' => $professorDataProvider,
              'columns' => [
                [
                  'header' => 'Nome',
                  'attribute' => 'nome',
                ],
                [
                  'header' => 'Ultima atualização',
                  'attribute' => 'updated_at',
                ]
              ],
            ]); 
        ?>
    </div>    
  </div>
</section>