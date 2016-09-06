<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\web\View;
use backend\models\Dhs;
use backend\models\Matakuliah;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Krs */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Krs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krs-view">

  <h1><center>Data Nilai Mahasiswa</h1></center>

    <h1><?= Html::encode($this->title) ?></h1>
      <?php    echo $this->render('_kopmhs',['nim'=>$model]); ?>

      <?= GridView::widget([

          'dataProvider' =>$model->search(Yii::$app->request->queryParams),
        //  'filterModel' => $criteria,
    //   'summary'=>$nim::totalIpk($nim['id_mahasiswa'])=,
      //  'layout'=>'{items} {summary} {pager}',
          'columns' => [
      //    ['class' => 'yii\grid\CheckboxColumn'],
    'idMatakuliah.matakuliah',
      'nilai',
      'semester',
      'idTahunAjaran.tahun_ajaran',

      //'id_matakuliah',
//'nilai',
            //  ['class' => 'yii\grid\ActionColumn'],
          ],
      ]); ?>
</div>
