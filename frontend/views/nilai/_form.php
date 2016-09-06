<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Nilai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nilai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_matakuliah')->textInput() ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_dhs')->textInput() ?>

    <?= $form->field($model, 'id_sp')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
