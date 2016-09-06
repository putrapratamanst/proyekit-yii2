<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DaftarHadirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Hadir';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-hadir-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Daftar Hadir', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_penjadwalan',
            'npm_mahasiswa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
