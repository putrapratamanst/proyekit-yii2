<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Dosen;
/* @var $this yii\web\View */
/* @var $model backend\models\Penjadwalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjadwalan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_dosen')->dropDownList(ArrayHelper::map(Dosen::find()->all(),'id_dosen','nama_dosen')) ?>

    <?= $form->field($model, 'id_matakuliah')->textInput() ?>

    <?= $form->field($model, 'jam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruang')->dropDownList(['111' => '111', '112' => '112', '113' => '113', '114' => '114', '115' => '115'
    , '116' => '116', '117' => '117', '211' => '211', '212' => '212','213' => '213','214' => '214','215' => '215','216' => '217',]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
