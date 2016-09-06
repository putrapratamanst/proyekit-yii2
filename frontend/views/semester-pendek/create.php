<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SemesterPendek */

$this->title = 'Daftar Semester Pendek';
$this->params['breadcrumbs'][] = ['label' => 'Semester Pendek', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-pendek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsNilai'=>  $modelsNilai,

    ]) ?>

</div>
