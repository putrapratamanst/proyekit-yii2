<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use frontend\models\SemesterPendek;

/* @var $this yii\web\View */
/* @var $model backend\models\SemesterPendek */

//$this->title = $model->npm;

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <p><b>SISTEM INFORMASI SEMESTER PENDEK D4 TEKNIK INFORMATIKA</b></p>
  <p>Politeknik Pos Indonesia</p>
  <p>Jl. Sariasih no. 54, Jawa Barat 40151, Indonesia</p>

<center><?= Html::img('image/logo.png');?></center><br>
  <p>Web: poltekpos.ac.id</p>
  <p></p>
  <p></p>
</body>
</html>

<div class="semester-pendek-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'npm',
            'npm0.nama',
            [
                'label' => 'Harga',
                'attribute' => 'harga',
                'value'=>$model->harga + $model->id,

            ],
            'waktu_daftar',
          //  'user_id',
        ],
    ]) ?>

        <?= GridView::widget([
               'dataProvider'=>new yii\data\ActiveDataProvider([

                  'pagination'=>false,
                   'query'=>$model->getNilais(),

               ]),
               'columns'=>[
                 ['class' => 'kartik\grid\SerialColumn'],

                   'idDhs.idMatakuliah.matakuliah',

                  [
                    'attribute'=>'idDhs.idMatakuliah.jam',
                        'pageSummary' => 'Total',
                      ],                      [
          'label' => 'Harga',
          //'attribute' => 'idDhs.idMatakuliah.jam',
          'pageSummary' => true,
        //  'pageSummary' => 'Total',
            'value' => function ($model) {
          if($model)
              return $model->idDhs->idMatakuliah->jam * 100000 + $model->idSp->id;
              return 0;
          }
      ],

                //      ['class' => 'kartik\grid\ActionColumn'],

                //   'product',
                  // 'qty'
               ],
               'showPageSummary' => true,

           ]) ?>

</div>
