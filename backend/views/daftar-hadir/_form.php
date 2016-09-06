<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Penjadwalan;
/* @var $this yii\web\View */
/* @var $model backend\models\DaftarHadir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daftar-hadir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_penjadwalan')->dropDownList(ArrayHelper::map(Penjadwalan::find()->all(),'id','idMatakuliah.matakuliah')) ?>

    <?= $form->field($model, 'npm_mahasiswa')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
