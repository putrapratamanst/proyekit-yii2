<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Dhs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dhs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_tahun_ajaran',
            'npm_mahasiswa',
            'semester',
            'user_id',
            'id_matakuliah',
            'nilai',
        ],
    ]) ?>

</div>
