<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MatakuliahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matakuliah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'matakuliah') ?>

    <?= $form->field($model, 'sks') ?>

    <?= $form->field($model, 'jam') ?>

    <?= $form->field($model, 'id_tahun_ajaran') ?>

    <?php // echo $form->field($model, 'semester') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
