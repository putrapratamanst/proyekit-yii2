<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\SemesterPendek */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Semester Pendek', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-pendek-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('Cetak Pembayaran', ['cetak', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Batalkan', ['delete', 'id' => $model->id], [
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
            'npm',
        /*  [
            'label'=>'Harga',
            'attribute'=>'harga',
            'value'=>$model->harga + $model->id,

          ],
          */
            'waktu_daftar',
            'user_id',
        ],
    ]) ?>

    <?= GridView::widget([
           'dataProvider'=>new yii\data\ActiveDataProvider([
               'query'=>$model->getNilais(),
               'pagination'=>false
           ]),
           'columns'=>[
               'idDhs.idMatakuliah.matakuliah',
               'idDhs.idMatakuliah.jam',

            //   'product',
              // 'qty'
           ]
       ]) ?>

</div>
