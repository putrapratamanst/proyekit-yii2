<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PembayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembayaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'file',
            'id_mahasiswa',
            'user_id',
            [
            'label' => 'Status',
            'attribute'=>'status',
            'value' => function ($model) {
            if($model->status==1)
                return 'Telah Di Approve';
            else
                return 'Belum Di Approve';
            }
        ],
          //  'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
