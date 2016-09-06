<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SemesterPendek */

$this->title = 'Update Semester Pendek: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Semester Pendeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="semester-pendek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,        'modelsNilai'=>  $modelsNilai,

    ]) ?>

</div>
