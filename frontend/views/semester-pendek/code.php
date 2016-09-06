<div class="nilai-view">
<h1>Matakuliah</h1>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nama Matakuliah</th>
      <th>Nilai</th>
      <th>Jam</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($modelsNilai as $i => $modelNilai): ?>
<tr>

<td> <?= $modelNilai->idDhs->idMatakuliah->matakuliah ?> </td>
<td> <?= $modelNilai->nilai ?> </td>
<td> <?= $modelNilai->idDhs->idMatakuliah->jam ?> </td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
<td>
  Total:
</td>
<td>
  <td> <?= $modelNilai->idDhs->idMatakuliah->jam *$model->harga + $model->id ?> </td>
</td>
</div>


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
