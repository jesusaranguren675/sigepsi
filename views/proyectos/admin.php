<?php 
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\helpers\Url;

?>

<div class="conten-crud">
  <div class="cintillo">
      <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
  </div>

  <ol style="display: block;" class="breadcrumb">
    <li><a href="<?= Url::to(['proyectos/admin']); ?>">Inicio</a></li>
    <li><a href="#">proyectos</a></li>
  </ol>

  <h1 class="title-crud">Administrar Proyectos</h1>
    <a class="btn btn-success" href="<?= Url::toRoute('proyectos/create');?>" style="margin-bottom: 10px;">
      <i class="fas fa-plus"></i> Registrar Proyecto
    </a> 


<?php
if(Yii::$app->user->can('coordinador') || Yii::$app->user->can('administrador') || Yii::$app->user->can('profesor') || Yii::$app->user->can('director'))
{
  ?>

  <div class="status">
    <button class="alert alert-dark" id="btn-1" class="status-btn btn btn-success btn-sigepsi">
      Por validar <strong>(<?= $Porvalidar ?>)</strong>
    </button>
    <button class="alert alert-dark" id="btn-2" class="status-btn btn btn-success btn-sigepsi">
      En Desarrollo <strong>(<?= $Endesarrollo ?>)</strong>
    </button>
    <button class="alert alert-warning" id="btn-5" class="status-btn btn btn-success btn-sigepsi">
      En Corrección <strong>(<?= $Correccion + $Correccion2 ?>)</strong>
    </button>
    <button class="alert alert-dark" id="btn-3" class="status-btn btn btn-success btn-sigepsi">Socializados 
      <strong>(<?= $Socializados ?>)</strong>
    </button>
    <button class="alert alert-success" id="btn-4" class="status-btn btn btn-success btn-sigepsi">
      Culminados <strong>(<?= $Culminados ?>)</strong>
    </button>
    <button class="alert alert-danger" id="btn-6" class="status-btn btn btn-success btn-sigepsi">
      Rechazados <strong>(<?= $Rechazados ?>)</strong>
    </button>
    <button class="alert alert-danger" id="btn-7" class="status-btn btn btn-success btn-sigepsi">
      Cancelados <strong>(<?= $Cancelados ?>)</strong>
    </button>
    <button class="alert alert-dark" id="btn-8" class="status-btn btn btn-success btn-sigepsi">
      Todos <strong>(<?= $Todos ?>)</strong>
    </button>
  </div>
  <div class="cont-proyectos validar">
    <?php \yii\widgets\Pjax::begin() ?>
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos por Validar</h3>

    <table id="validar" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info">ID. proyecto</th>
        <th class="alert alert-info">Titulo</th>
        <th class="alert alert-info">Problema</th>
        <th class="alert alert-info">Especialidad</th>
        <th class="alert alert-info">Linea de investigación</th>
        <th class="alert alert-info">Estatus</th>
        <th class="alert alert-info">Tutor Académico</th>
        <th class="alert alert-info">Acciones</th>
      </tr>
      <?php foreach ($proyectos1 as $Proyectos1): ?>

        <tr class="letra">
          <td><?= Html::encode("{$Proyectos1->id_proyecto}") ?></td>
          <td><?= Html::encode("{$Proyectos1->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos1->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos1->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos1->linea_investigacion}") ?></td>
          <td>
            <span style="background-color: #343a40;" class="badge badge-dark"><?= Html::encode("{$Proyectos1->estatus}") ?></span>    
          </td>
          <td><?= Html::encode("{$Proyectos1->primer_nombre} {$Proyectos1->primer_apellido}") ?></td>
          <td class="acciones">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos1->id_proyecto]) ?>">
                  <i class="fas fa-eye"></i> Ver
                </a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos1->id_proyecto]) ?>"><i class="fas fa-edit"></i> Modificar</a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['proyectos/validarproyecto', 'id' => $Proyectos1->id_proyecto]); ?>"><i class="fas fa-check-square"></i> Validar Proyecto</a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos1->id_proyecto)){

    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination1]) ?>
    <?php \yii\widgets\Pjax::end() ?>
  </div>


  <div class="cont-proyectos desarrollo">
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos en Desarrollo</h3>
    <table id="desarrollo" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info alert alert-info">ID. proyecto</th>
        <th class="alert alert-info alert alert-info">Titulo</th>
        <th class="alert alert-info alert alert-info">Problema</th>
        <th class="alert alert-info alert alert-info">Especialidad</th>
        <th class="alert alert-info alert alert-info">Linea de investigación</th>
        <th class="alert alert-info alert alert-info">Estatus</th>
        <th class="alert alert-info alert alert-info">Tutor Académico</th>
        <th class="alert alert-info alert alert-info">Acciones</th>
      </tr>  
      <?php foreach ($proyectos2 as $Proyectos2): ?>
        <tr class="letra">
          <td><?= Html::encode("{$Proyectos2->id_proyecto}") ?></td>
          <td><?= Html::encode("{$Proyectos2->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos2->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos2->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos2->linea_investigacion}") ?></td>
          <td><span class="badge badge-secondary"><?= Html::encode("{$Proyectos2->estatus}") ?></span></td>
          <td><?= Html::encode("{$Proyectos2->primer_nombre} {$Proyectos2->primer_apellido}") ?></td>
          <td class="acciones">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos2->id_proyecto]) ?>">
                  <i class="fas fa-eye"></i> Ver
                </a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos2->id_proyecto]) ?>"><i class="fas fa-edit"></i> Modificar</a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['socializar', 'id' => $Proyectos2->id_proyecto]) ?>"><i class="fas fa-check-square"></i> Marcar Proyecto como Socializado</a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos2->id_proyecto]) ?>">
                  <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i> Cancelar Proyecto</p>
                </a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos2->id_proyecto)){
      
    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination2]) ?>
  </div>

  <div class="cont-proyectos socializados">
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos socializados</h3>
    <table id="socializados" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info">ID. proyecto</th>
        <th class="alert alert-info">Titulo</th>
        <th class="alert alert-info">Problema</th>
        <th class="alert alert-info">Especialidad</th>
        <th class="alert alert-info">Linea de investigación</th>
        <th class="alert alert-info">Estatus</th>
        <th class="alert alert-info">Tutor Académico</th>
        <th class="alert alert-info">Acciones</th>
      </tr>  
      <?php foreach ($proyectos3 as $Proyectos3): ?>
        <tr class="letra">
          <td><?= Html::encode("{$Proyectos3->id_proyecto}") ?></td>
          <td><?= Html::encode("{$Proyectos3->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos3->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos3->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos3->linea_investigacion}") ?></td>
          <td>
            <span style="background: #17a2b8;" class="badge badge-pill badge-info"><?= Html::encode("{$Proyectos3->estatus}") ?></span>
          </td>
          <td><?= Html::encode("{$Proyectos3->primer_nombre} {$Proyectos3->primer_apellido}") ?></td>
          <td class="acciones">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos3->id_proyecto]) ?>">
                  <i class="fas fa-eye"></i> Ver
                </a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos3->id_proyecto]) ?>"><i class="fas fa-edit"></i> Modificar</a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['culminar', 'id' => $Proyectos3->id_proyecto]) ?>"><i class="fas fa-check-square"></i> Culminar Proyecto</a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos3->id_proyecto]) ?>">
                  <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i> Cancelar Proyecto</p>
                </a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos3->id_proyecto)){

    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination3]) ?>
  </div>

  <div class="cont-proyectos culminados">
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos Culminados</h3>
    <table id="culminados" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info">ID. proyecto</th>
        <th class="alert alert-info">Titulo</th>
        <th class="alert alert-info">Problema</th>
        <th class="alert alert-info">Especialidad</th>
        <th class="alert alert-info">Linea de investigación</th>
        <th class="alert alert-info">Estatus</th>
        <th class="alert alert-info">Tutor Académico</th>
        <th class="alert alert-info">Acciones</th>
      </tr>  
      <?php foreach ($proyectos4 as $Proyectos4): ?>
        <tr class="letra">
           <td><?= Html::encode("{$Proyectos4->id_proyecto}") ?></td>
          <td><?= Html::encode("{$Proyectos4->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos4->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos4->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos4->linea_investigacion}") ?></td>
          <td>
            <span class="badge badge-success verde">
              <?= Html::encode("{$Proyectos4->estatus}") ?>    
            </span>    
          </td>
          <td><?= Html::encode("{$Proyectos4->primer_nombre} {$Proyectos4->primer_apellido}") ?></td>
          <td class="acciones">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos4->id_proyecto]) ?>">
                  <i class="fas fa-eye"></i> Ver
                </a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos4->id_proyecto]) ?>"><i class="fas fa-edit"></i> Modificar</a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos4->id_proyecto)){
      
    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination4]) ?>
  </div>

  <div class="cont-proyectos correccion">
    <h4 class="titulo-proyecto alert alert-success">Corrección realizada para poder validar una propuesta</h4>

    <p style="text-align: center;">
      <a class="alert alert-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Mostrar
      </a>
    </p><br>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <table id="correccion" class="table table-bordered table-hover table-striped">
          <tr class="letra">
            <th class="alert alert-info">ID. proyecto</th>
            <th class="alert alert-info">Titulo</th>
            <th class="alert alert-info">Problema</th>
            <th class="alert alert-info">Especialidad</th>
            <th class="alert alert-info">Linea de investigación</th>
            <th class="alert alert-info">Estatus</th>
            <th class="alert alert-info">Tutor Académico</th>
            <th class="alert alert-info">Acciones</th>
          </tr>  
          <?php foreach ($proyectos5 as $Proyectos5): ?>
            <tr class="letra">
              <td><?= Html::encode("{$Proyectos5->id_proyecto}") ?></td>
              <td><?= Html::encode("{$Proyectos5->titulo}") ?></td>
              <td class="problema"><?= Html::encode("{$Proyectos5->problema}") ?></td>
              <td><?= Html::encode("{$Proyectos5->especialidad}") ?></td>
              <td><?= Html::encode("{$Proyectos5->linea_investigacion}") ?></td>
              <td>
                <span class="badge badge-warning amarillo"><?= Html::encode("{$Proyectos5->estatus}") ?></span>    
              </td>
              <td><?= Html::encode("{$Proyectos5->primer_nombre} {$Proyectos5->primer_apellido}") ?></td>
              <td class="acciones">
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos5->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos5->id_proyecto]) ?>"><i class="fas fa-edit"></i> Modificar</a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['corregirpropuesta', 'id' => $Proyectos5->id_proyecto]) ?>"><i class="fas fa-check-square"></i> Corregir Propuesta</a>
                  </div>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
        <?php
        if(isset($Proyectos5->id_proyecto)){

        }else{
           ?>

          <p style="width: 100%; display: flex; justify-content: center;">
              <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
          </p>
          <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
          <?php
        }
        ?>
        <?= LinkPager::widget(['pagination' => $pagination5]) ?>
      </div>
    </div>


    <h4 class="titulo-proyecto alert alert-success">Corrección realizada antes de culminar un proyecto</h4>

    <p style="text-align: center;">
      <a class="alert alert-success" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
        Mostrar
      </a>
    </p><br>
    <div class="collapse" id="collapseExample2">
      <div class="card card-body">
       <table id="correccion" class="table table-bordered table-hover table-striped">
        <tr class="letra">
          <th class="alert alert-info">ID. proyecto</th>
          <th class="alert alert-info">Titulo</th>
          <th class="alert alert-info">Problema</th>
          <th class="alert alert-info">Especialidad</th>
          <th class="alert alert-info">Linea de investigación</th>
          <th class="alert alert-info">Estatus</th>
          <th class="alert alert-info">Tutor Académico</th>
          <th class="alert alert-info">Acciones</th>
        </tr>  
        <?php foreach ($proyectos55 as $Proyectos55): ?>
          <tr class="letra">
            <td><?= Html::encode("{$Proyectos55->id_proyecto}") ?></td>
            <td><?= Html::encode("{$Proyectos55->titulo}") ?></td>
            <td class="problema"><?= Html::encode("{$Proyectos55->problema}") ?></td>
            <td><?= Html::encode("{$Proyectos55->especialidad}") ?></td>
            <td><?= Html::encode("{$Proyectos55->linea_investigacion}") ?></td>
            <td>
              <span class="badge badge-warning amarillo"><?= Html::encode("{$Proyectos55->estatus}") ?></span>    
            </td>
            <td><?= Html::encode("{$Proyectos55->primer_nombre} {$Proyectos55->primer_apellido}") ?></td>
            <td class="acciones">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-cogs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos55->id_proyecto]) ?>">
                    <i class="fas fa-eye"></i> Ver
                  </a>
                  <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos55->id_proyecto]) ?>"><i class="fas fa-edit"></i> Modificar</a>
                  <a class="dropdown-item dropdown2" href="<?= Url::to(['socializar', 'id' => $Proyectos55->id_proyecto]) ?>"><i class="fas fa-check-square"></i> Marcar Proyecto como Socializado</a>
                  <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos55->id_proyecto]) ?>">
                  <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i> Cancelar Proyecto</p>
                </a>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php
      if(isset($Proyectos55->id_proyecto)){

      }else{
        ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
      }
      ?>
      <?= LinkPager::widget(['pagination' => $pagination55]) ?>
      </div>
    </div>
  </div>

  <div class="cont-proyectos rechazados">
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos Rechazados</h3>
    <table id="rechazados" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info">ID. proyecto</th>
        <th class="alert alert-info">Titulo</th>
        <th class="alert alert-info">Problema</th>
        <th class="alert alert-info">Especialidad</th>
        <th class="alert alert-info">Linea de investigación</th>
        <th class="alert alert-info">Estatus</th>
        <th class="alert alert-info">Tutor Académico</th>
        <th class="alert alert-info">Acciones</th>
      </tr>  
      <?php foreach ($proyectos6 as $Proyectos6): ?>
        <tr class="letra">
          <td><?= Html::encode("{$Proyectos6->id_proyecto}") ?></td>
          <td><?= Html::encode("{$Proyectos6->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos6->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos6->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos6->linea_investigacion}") ?></td>
          <td>
            <span class="badge badge-danger rojo">
              <?= Html::encode("{$Proyectos6->estatus}") ?> 
            </span>               
          </td>
          <td><?= Html::encode("{$Proyectos6->primer_nombre} {$Proyectos6->primer_apellido}") ?></td>
          <td class="acciones">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos6->id_proyecto]) ?>">
                  <i class="fas fa-eye"></i> Ver
                </a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos6->id_proyecto)){
      
    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination6]) ?>
  </div>

  <div class="cont-proyectos cancelados">
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos Cancelados</h3>
    <table id="cancelados" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info">ID. proyecto</th>
        <th class="alert alert-info">Titulo</th>
        <th class="alert alert-info">Problema</th>
        <th class="alert alert-info">Especialidad</th>
        <th class="alert alert-info">Linea de investigación</th>
        <th class="alert alert-info">Estatus</th>
        <th class="alert alert-info">Tutor Académico</th>
        <th class="alert alert-info">Acciones</th>
      </tr>  
      <?php foreach ($proyectos7 as $Proyectos7): ?>
        <tr class="letra">
          <td><?= Html::encode("{$Proyectos7->id_proyecto}") ?></td>
          <td><?= Html::encode("{$Proyectos7->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos7->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos7->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos7->linea_investigacion}") ?></td>
          <td>
            <span style="background: #6f0610;" class="badge badge-pill badge-info"><?= Html::encode("{$Proyectos7->estatus}") ?></span>    
          </td>
          <td><?= Html::encode("{$Proyectos7->primer_nombre} {$Proyectos7->primer_apellido}") ?></td>
          <td class="acciones">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos7->id_proyecto]) ?>">
                  <i class="fas fa-eye"></i> Ver
                </a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos7->id_proyecto)){
      
    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination7]) ?>
  </div>
  <?php \yii\widgets\Pjax::begin() ?>
  <div class="cont-proyectos todos">
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos</h3>
    <?php \yii\widgets\Pjax::begin() ?>
    <table id="todos" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info">ID. proyecto</th>
        <th class="alert alert-info">Titulo</th>
        <th class="alert alert-info">Problema</th>
        <th class="alert alert-info">Especialidad</th>
        <th class="alert alert-info">Linea de investigación</th>
        <th class="alert alert-info">Estatus</th>
        <th class="alert alert-info">Tutor Académico</th>
        <th class="alert alert-info">Acciones</th>
      </tr>  
      <?php foreach ($proyectos8 as $Proyectos8): ?>
        <tr class="letra">
          <td><?= Html::encode("{$Proyectos8->id_proyecto}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos8->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos8->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos8->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos8->linea_investigacion}") ?></td>
          <td>
            <?php
            $estatus = $Proyectos8->id_estatus;
            if($Proyectos8->id_estatus == 99)
            {
              ?>
              <span class="badge badge-danger rojo">
              Rechazado
              </span>
              <?php
            }else{
              if($estatus == 98)
              {
                 ?>
                <span class="badge badge-warning amarillo">
                En Corrección
                </span>
                <?php
              }
              else
              {
                if($estatus == 4)
                {
                   ?>
                  <span class="badge badge-danger verde">
                  Culminado
                  </span>
                  <?php
                }
                else
                {
                  if($estatus == 2)
                  {
                     ?>
                    <span class="badge badge-secondary">
                    En Desarrollo 
                    </span>
                    <?php
                  }
                  if($estatus == 1)
                  {
                     ?>
                    <span style="background-color: #343a40;" class="badge badge-dark"">
                    Por validar
                    </span>
                    <?php
                  }
                  if($estatus == 999)
                  {
                    ?>
                    <span style="background: #6f0610;" class="badge badge-pill badge-info">
                    Cancelado  
                    </span>
                    <?php
                  }
                  if($estatus == 3)
                  {
                    ?>
                    <span style="background: #17a2b8;" class="badge badge-pill badge-info">
                      Socializado
                    </span>
                    <?php
                  }
                }
              }
            }
            ?>    
          </td>
          <td><?= Html::encode("{$Proyectos8->primer_nombre} {$Proyectos8->primer_apellido}") ?></td>
          <td class="acciones">
            <?php
              if($estatus == 999)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 4)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-edit"></i> Modificar
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 98)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-edit"></i> Modificar
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['corregirpropuesta', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-check-square"></i> Corregir Propuesta
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 99)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 2)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-edit"></i> Modificar
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['socializar', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-check-square"></i> Marcar Proyecto como Socializado
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i>  Cancelar Proyecto</p>
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 3)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-edit"></i> Modificar
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['culminar', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-check-square"></i> Culminar Proyecto
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i>  Cancelar Proyecto</p>
                    </a>
                  </div>
                </div>
                <?php
              }

              if($estatus == 1)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-edit"></i> Modificar
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['validarproyecto', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-check-square"></i> Validar Proyecto
                    </a>
                  </div>
                </div>
                <?php
              }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos8->id_proyecto)){
      
    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination8]) ?>
    <?php \yii\widgets\Pjax::end() ?>
  </div>
</div>

<?php

}


?>
  

<?php

//Si ingresa un estudiantes se ejecuta el siguiente fragmento de código
//---------------------------------------------------------------------
//---------------------------------------------------------------------

if(Yii::$app->user->can('estudiante'))
{
  ?>
  <?php \yii\widgets\Pjax::begin() ?>
  <div class="cont-proyectos todos">
    <h3 class="titulo-proyecto alert alert-info">Listado de Proyectos</h3>
    <?php \yii\widgets\Pjax::begin() ?>
    <table id="todos" class="table table-bordered table-hover table-striped">
      <tr class="letra">
        <th class="alert alert-info">ID. proyecto</th>
        <th class="alert alert-info">Titulo</th>
        <th class="alert alert-info">Problema</th>
        <th class="alert alert-info">Especialidad</th>
        <th class="alert alert-info">Linea de investigación</th>
        <th class="alert alert-info">Estatus</th>
        <th class="alert alert-info">Tutor Académico</th>
        <th class="alert alert-info">Acciones</th>
      </tr>  
      <?php foreach ($proyectos8 as $Proyectos8): ?>
        <tr class="letra">
          <td><?= Html::encode("{$Proyectos8->id_proyecto}") ?></td>
          <td><?= Html::encode("{$Proyectos8->titulo}") ?></td>
          <td class="problema"><?= Html::encode("{$Proyectos8->problema}") ?></td>
          <td><?= Html::encode("{$Proyectos8->especialidad}") ?></td>
          <td><?= Html::encode("{$Proyectos8->linea_investigacion}") ?></td>
          <td>
            <?php
            $estatus = $Proyectos8->id_estatus;
            if($Proyectos8->id_estatus == 99)
            {
              ?>
              <span class="badge badge-danger rojo">
              Rechazado
              </span>
              <?php
            }else{
              if($estatus == 98)
              {
                 ?>
                <span class="badge badge-warning amarillo">
                En Corrección
                </span>
                <?php
              }
              else
              {
                if($estatus == 4)
                {
                   ?>
                  <span class="badge badge-danger verde">
                  Culminado
                  </span>
                  <?php
                }
                else
                {
                  if($estatus == 2)
                  {
                     ?>
                    <span class="badge badge-secondary">
                    En Desarrollo 
                    </span>
                    <?php
                  }
                  if($estatus == 1)
                  {
                     ?>
                    <span style="background-color: #343a40;" class="badge badge-dark"">
                    Por validar
                    </span>
                    <?php
                  }
                  if($estatus == 999)
                  {
                    ?>
                    <span style="background: #6f0610;" class="badge badge-pill badge-info">
                    Cancelado  
                    </span>
                    <?php
                  }
                  if($estatus == 3)
                  {
                    ?>
                    <span style="background: #17a2b8;" class="badge badge-pill badge-info">
                      Socializado
                    </span>
                    <?php
                  }
                  if($estatus == 97)
                  {
                    ?>
                      <span class="badge badge-warning amarillo">
                      En Corrección
                      </span>
                    <?php
                  }
                }
              }
            }
            ?>    
          </td>
          <td><?= Html::encode("{$Proyectos8->primer_nombre} {$Proyectos8->primer_apellido}") ?></td>
          <td class="acciones">
            <?php
              if($estatus == 999)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 4)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <?php
                    if(!Yii::$app->user->can('estudiante'))
                    {
                      ?>
                      <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-edit"></i> Modificar
                      </a>
                      <?php
                    }
                    ?>
                  </div>
                </div>
                <?php
              }
              if($estatus == 98)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <?php

                      if(!Yii::$app->user->can('estudiante'))
                      {
                        ?>
                        <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                          <i class="fas fa-edit"></i> Modificar
                        </a>
                        <?php
                      }

                    ?>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['corregirpropuesta', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-check-square"></i> Corregir Propuesta
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 97)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                   
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                      </a>

                      <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>"><i class="fas fa-edit"></i> Modificar</a>

                    <a class="dropdown-item dropdown2" href="<?= Url::to(['socializar', 'id' => $Proyectos8->id_proyecto]) ?>"><i class="fas fa-check-square"></i> Marcar Proyecto como Socializado</a>



                    <?php
                      if(!Yii::$app->user->can('estudiante'))
                      {
                        ?>
                        <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos8->id_proyecto]) ?>">
                          <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i> Cancelar Proyecto</p>
                        </a>
                        <?php
                      }
                    ?>
                    
                  </div>
                </div>
                <?php
              }
              if($estatus == 99)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                  </div>
                </div>
                <?php
              }
              if($estatus == 2)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <?php
                    if(!Yii::$app->user->can('estudiante'))
                    {
                      ?>
                      <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                        <i class="fas fa-eye"></i> Ver
                      </a>
                      <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                        <i class="fas fa-edit"></i> Modificar
                      </a>
                      <?php
                    }
                    ?>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['socializar', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-check-square"></i> Marcar Proyecto como Socializado
                    </a>
                    
                    <?php
                     if(!Yii::$app->user->can('estudiante'))
                     {
                      ?>
                      <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i>  Cancelar Proyecto</p>
                      </a>
                     <?php
                     }
                     
                    ?>
                    
                  </div>
                </div>
                <?php
              }
              if($estatus == 3)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <?php
                      if(!Yii::$app->user->can('estudiante'))
                      {
                        ?>
                        <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                          <i class="fas fa-edit"></i> Modificar
                        </a>
                        <a class="dropdown-item dropdown2" href="<?= Url::to(['culminar', 'id' => $Proyectos8->id_proyecto]) ?>">
                          <i class="fas fa-check-square"></i> Culminar Proyecto
                        </a>
                        <a class="dropdown-item dropdown2" href="<?= Url::to(['cancelar', 'id' => $Proyectos8->id_proyecto]) ?>">
                          <p style="color: red;" ><i style="color: red;" class="fas fa-times-circle"></i>  Cancelar Proyecto</p>
                        </a>
                        <?php
                      }
                    ?>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                  </div>
                </div>
                <?php
              }

              if($estatus == 1)
              {
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['view', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a class="dropdown-item dropdown2" href="<?= Url::to(['update', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-edit"></i> Modificar
                    </a>
                    <?php
                    if(!Yii::$app->user->can('estudiante'))
                    {
                      ?>
                      <a class="dropdown-item dropdown2" href="<?= Url::to(['validarproyecto', 'id' => $Proyectos8->id_proyecto]) ?>">
                      <i class="fas fa-check-square"></i> Validar Proyecto
                      </a>
                      <?php
                    }
                    ?>
                  </div>
                </div>
                <?php
              }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
    if(isset($Proyectos8->id_proyecto)){
      
    }else{
      ?>

        <p style="width: 100%; display: flex; justify-content: center;">
            <?php echo Html::img('@web/imagenes/informe-de-archivo.png', ['style' => 'width:10%;']); ?>
        </p>
        <h3 style="text-align: center;">Este estatus no posee ningún proyecto registrado</h3>
        <h4 style="text-align: center;">Debes esperar que se registre un proyecto</h4>
        <?php
    }
    ?>
    <?= LinkPager::widget(['pagination' => $pagination8]) ?>
    <?php \yii\widgets\Pjax::end() ?>
  </div>
  <?php
}

// Fin Si ingresa un estudiantes se ejecuta el siguiente fragmento de código
//---------------------------------------------------------------------
//---------------------------------------------------------------------


?>



<?php
$script = <<< JS

$('#collapseExample').collapse('show');


JS;
$this->registerJs($script);
?>



