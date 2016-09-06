<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Mahasiswa;
use yii\base\Model;
use yii\db\ActiveRecord;
use backend\models\Dhs;
/* @var $this yii\web\View */
/* @var $model backend\models\Krs */

?>
<div class="dhs-view">

  <?= DetailView::widget([
      'model' => $nim,
      'attributes' => [
        //'id_semester',


[
  'attribute'=>'npm_mahasiswa',
  'format'=>'raw',
  'header'=>'Id Mahasiswa',
    'value'=>$nim['npm_mahasiswa'],

],
[
  'attribute'=>'nama_mahasiswa',
  'format'=>'raw',
  'header'=>'Nama Mahasiswa',
  'value'=>Mahasiswa::findOne($nim['npm_mahasiswa'])->nama,
],


[
  'attribute'=>'jurusan',
  'format'=>'raw',
  'header'=>'Nama Mahasiswa',
  'value'=>Mahasiswa::findOne($nim['npm_mahasiswa'])->jurusan,
]










      ],
  ]) ?>
</div>
