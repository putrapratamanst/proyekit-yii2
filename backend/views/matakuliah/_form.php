<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Matakuliah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matakuliah-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matakuliah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sks')->textInput() ?>

    <?= $form->field($model, 'jam')->textInput() ?>

    <?= $form->field($model, 'id_tahun_ajaran')->textInput() ?>

    <?= $form->field($model, 'semester')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
