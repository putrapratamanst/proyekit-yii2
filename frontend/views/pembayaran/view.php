<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pembayaran */

$this->title = $model->id_mahasiswa;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'file',
            'id_mahasiswa',
            [
                'label' => 'Status',
                'attribute'=>'status',
                'value' => $model->status==1 ?      'Telah Di Approve' : 'Belum Di Approve',

            ],
//'user_id',
        ],


    ]) ?>

</div>
