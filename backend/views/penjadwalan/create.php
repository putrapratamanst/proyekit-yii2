<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Penjadwalan */

$this->title = 'Create Penjadwalan';
$this->params['breadcrumbs'][] = ['label' => 'Penjadwalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadwalan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
