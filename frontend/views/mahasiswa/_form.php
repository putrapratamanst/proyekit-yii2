<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mahasiswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahasiswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelas')->dropDownList(['D4 TI 1A' => 'D4 TI 1A', 'D4 TI 1B' => 'D4 TI 1B', 'D4 TI 1C' => 'D4 TI 1C', 'D4 TI 1D' => 'D4 TI 1D', 'D4 TI 2A' => 'D4 TI 2A'
    , 'D4 TI 2B' => 'D4 TI 2B', 'D4 TI 2C' => 'D4 TI 2C', 'D4 TI 2D' => 'D4 TI 2D', 'D4 TI 3A' => 'D4 TI 3A','D4 TI 3B' => 'D4 TI 3B','D4 TI 4A' => 'D4 TI 4A','D4 TI 4B' => 'D4 TI 4B']); ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(
       DatePicker::className(),[
           'inline' => true,
          'template' => '<div class="well well-sm" style="background-color:#fff;width:250px">{input}</div>',
           'clientOptions' => [
               'autoclose' => true,
               'format' => 'yyyy-m-d'
           ]
       ]
   ) ?>
   <?= $form->field($model, 'jenis_kelamin')->dropDownList(['Laki-Laki' => 'Laki-Laki','Perempuan'=>'Perempuan']) ?>

   <?= $form->field($model, 'agama')->dropDownList(['Kristen' => 'Kristen','Islam'=>'Islam','Katolik' => 'Katolik','Budha'=>'Budha','Hindu' => 'Hindu',]) ?>

   <?= $form->field($model, 'jurusan')->textInput(['readonly' => true, 'value' => 'D4 Teknik Informatika']) ?>

  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
