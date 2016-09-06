<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\TahunAjaran;
use backend\models\Mahasiswa;
use backend\models\Matakuliah;
/* @var $this yii\web\View */
/* @var $model backend\models\Dhs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dhs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tahun_ajaran')->dropDownList(ArrayHelper::map(TahunAjaran::find()->all(),'id','tahun_ajaran')) ?>

    <?= $form->field($model, 'npm_mahasiswa')->dropDownList(ArrayHelper::map(Mahasiswa::find()->all(),'id','nama')) ?>

    <?= $form->field($model, 'semester')->dropDownList(['1' => '1', '2' => '2', '3' => '3', '4' => '4' , '5' => '5',]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'id_matakuliah')->dropDownList(ArrayHelper::map(Matakuliah::find()->all(),'id','matakuliah')) ?>

    <?= $form->field($model, 'nilai')->dropDownList(['A' => 'A','B'=>'B','C' => 'C','D'=>'D','E' => 'E',]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
