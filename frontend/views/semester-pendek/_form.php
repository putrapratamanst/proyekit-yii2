<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\Nilai;
use yii\helpers\ArrayHelper;
use backend\models\Matakuliah;
use backend\models\Dhs;
/* @var $this yii\web\View */
/* @var $model backend\models\SemesterPendek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="semester-pendek-form">

  <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'npm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga')->textInput(['readonly' => true, 'value' => '100000']) ?>



    <?= $form->field($model, 'user_id')->textInput(['readonly'=>true]) ?>

    <div class="row">
      <div class="panel panel-default">
          <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Nilai</h4></div>
          <div class="panel-body">
               <?php DynamicFormWidget::begin([
                  'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                  'widgetBody' => '.container-items', // required: css class selector
                  'widgetItem' => '.item', // required: css class
                  'limit' => 8, // the maximum times, an element can be cloned (default 999)
                  'min' => 1, // 0 or 1 (default 1)
                  'insertButton' => '.add-item', // css class
                  'deleteButton' => '.remove-item', // css class
                  'model' => $modelsNilai[0],
                  'formId' => 'dynamic-form',
                  'formFields' => [
                      'id_matakuliah',
                      'nilai'


                  ],
              ]); ?>

              <div class="container-items"><!-- widgetContainer -->
              <?php foreach ($modelsNilai as $i => $modelNilai): ?>
                  <div class="item panel panel-default"><!-- widgetBody -->
                      <div class="panel-heading">
                          <h3 class="panel-title pull-left">Nilai</h3>
                          <div class="pull-right">
                              <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                              <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                      <div class="panel-body">

                           <div class="row">
                            <div class="col-sm-6">
                            <?= $form->field ($modelNilai,"[{$i}]id_dhs")->dropDownList(ArrayHelper::map(Dhs::find()->where(['npm_mahasiswa'=>$model])->all(),'id','idMatakuliah.matakuliah'),
      ['prompt'=>'Pilih Matakuliah',
    /*  'onchange'=>'
                  $.post("index.php?r=dhs/lists&id='.'"+$(this).val(),function(data)
                  { $("select#nilai-0-nilai" ).html(data), $("select#nilai-1-nilai" ).html(data);
              });' */]
    ); ?>
      </div>

      <div class="col-sm-2">
        <?= $form->field($modelNilai, "[{$i}]nilai")->textInput(['maxlength' => true]) ?>

                          </div><!-- .row -->

                  </div>
              <?php endforeach; ?>
              </div>
              <?php DynamicFormWidget::end(); ?>
          </div>
      </div>

      </div>



      <div class="form-group">
          <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>

      <?php ActiveForm::end(); ?>

  </div>
