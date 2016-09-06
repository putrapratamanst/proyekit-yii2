<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DhsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dhs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_tahun_ajaran') ?>

    <?= $form->field($model, 'npm_mahasiswa') ?>

    <?= $form->field($model, 'semester') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'id_matakuliah') ?>

    <?php // echo $form->field($model, 'nilai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
