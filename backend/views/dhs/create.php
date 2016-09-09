<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Dhs */

$this->title = 'Daftar Hasil Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Dhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dhs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
