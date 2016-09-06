<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DaftarHadir */

$this->title = 'Create Daftar Hadir';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Hadirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-hadir-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
