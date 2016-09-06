<?php

/* @var $this yii\web\View */
use yii\helpers\Html;


$this->title = '.:SISTEM INFORMASI SEMESTER PENDEK:.';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><marquee>SELAMAT DATANG!</h1></marquee>

        <p class="lead">SISTEM INFORMASI SEMESTER PENDEK D4 TEKNIK INFORMATIKA</p>





    </div>
    <div class="body-content">
<center> <?= Html::a('Profil Mahasiswa', ['/mahasiswa/index'], ['class'=>'btn btn-primary'])?> <br> <br>
<?= Html::a('Daftar Semester Pendek', ['/semester-pendek/index'], ['class'=>'btn btn-primary'])?>
 <?= Html::a('Daftar Hasil Siswa', ['/dhs/index'], ['class'=>'btn btn-primary']) ?> </center>

</div>

    <div class="body-content">



    </div>
</div>
