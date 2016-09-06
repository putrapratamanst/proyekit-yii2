<?php
namespace backend\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use backend\models\SemesterPendek;
class SemesterPendekRestController extends ActiveController{
  public $modelClass='backend\models\SemesterPendek';

public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}


	/*
    public function actionIndex()
    {
        return $this->render('index');
    }*/

    //kustom, untuk semua tanpa token
    //http://localhost/biasa/web/barang-ws/lihat?nama=ter
    public function actionLihat($id)
    {
    	$result = SemesterPendek::find()
    	 ->where(['like', 'id', $id])
    	->all();

    	return $result;
    }
}
