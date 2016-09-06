<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PenjadwalanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penjadwalan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadwalan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Penjadwalan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'idDosen.nama_dosen',
            'idMatakuliah.matakuliah',
            'jam',
            'ruang',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
