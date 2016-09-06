<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pembayaran;
use frontend\models\PembayaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\RecordHelpers;

/**
 * PembayaranController implements the CRUD actions for Pembayaran model.
 */
class PembayaranController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
                   {
                   return [

                   'access' => [
                   'class' => \yii\filters\AccessControl::className(),
                   'only' => ['index', 'view','create', 'update', 'delete'],
                   'rules' => [
                   [
                   'actions' => ['index', 'view','create', 'update', 'delete'],
                   'allow' => true,
                   'roles' => ['@'],
                   ],
                   ],

                   ],

                   'verbs' => [
                   'class' => VerbFilter::className(),
                   'actions' => [
                   'delete' => ['post'],
                   ],
                   ],
                   ];
                   }


    /**
     * Lists all Pembayaran models.
     * @return mixed
     */
     public function actionIndex()
  {
  if ($already_exists = RecordHelpers::userHas('pembayaran')) {
  return $this->render('view', [
  'model' => $this->findModel($already_exists),
  ]);
  } else {
  return $this->redirect(['create']);
  }
  }

    /**
     * Displays a single Pembayaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
     {
         $model = new Pembayaran();
         $model->user_id = Yii::$app->user->identity->id;
         $model->id_mahasiswa = Yii::$app->user->identity->username;
         $model->status = 0;


         if ($model->load(Yii::$app->request->post())) {

         	$model->file = UploadedFile::getInstance($model, 'file');

         	if(!$model->file==NULL){
         		//save file
         		$unik = $model->id_mahasiswa;
         		$namafile = $model->file->baseName.$unik;
         		$extensi = $model->file->extension;

         		$model->file->saveAs('uploads/'.$namafile.'.'.$extensi);
         		$model->file = 'uploads/'.$namafile.'.'.$extensi;
         	}

         	$model->save();

             return $this->redirect(['view', 'id' => $model->id]);
         } else {
             return $this->render('create', [
                 'model' => $model,
             ]);
         }
     }

    /**
     * Updates an existing Pembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionUpdate($id)
       {
           $model = $this->findModel($id);
           $tmpfile = $model->file;

           if ($model->load(Yii::$app->request->post())) {

           	$model->file = UploadedFile::getInstance($model, 'file');

           	if(!$model->file==NULL){
           		//save file
           		$unik = $model->id;
           		$namafile = $model->file->baseName.$unik;
           		$extensi = $model->file->extension;

           		$model->file->saveAs('uploads/'.$namafile.'.'.$extensi);
           		$model->file = 'uploads/'.$namafile.'.'.$extensi;
           	} else {
           		if($tmpfile!=NULL) $model->file = $tmpfile;
           	}
           	$model->save();

               return $this->redirect(['view', 'id' => $model->id]);
           } else {
               return $this->render('update', [
                   'model' => $model,
               ]);
           }
       }

    /**
     * Deletes an existing Pembayaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pembayaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
