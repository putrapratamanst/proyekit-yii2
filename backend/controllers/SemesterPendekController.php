<?php

namespace backend\controllers;

use Yii;
use backend\models\SemesterPendek;
use backend\models\SemesterPendekSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Nilai;
use frontend\models\Tabular;
use yii\helpers\ArrayHelper;
use common\models\PermissionHelpers;
/**
 * SemesterPendekController implements the CRUD actions for SemesterPendek model.
 */
class SemesterPendekController extends Controller
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
 'access2' => [
 'class' => \yii\filters\AccessControl::className(),
 'only' => ['index', 'view','create', 'update', 'delete'],
 'rules' => [
 [
 'actions' => ['index', 'view','create', 'update', 'delete'],
 'allow' => true,
 'roles' => ['@'],
 'matchCallback' => function ($rule, $action) {
 return PermissionHelpers::requireRole('baak');
 }
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
     * Lists all SemesterPendek models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SemesterPendekSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SemesterPendek model.
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
     * Creates a new SemesterPendek model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
   {
       $model = new SemesterPendek();
     //  $model->user_id = \Yii::$app->user->identity->id;
     //  $model->npm = \Yii::$app->user->identity->username;


        $modelsNilai = [new Nilai];


       if ($model->load(Yii::$app->request->post())){
       //  $model->waktu_daftar = date('Y-m-d h:m:s');

       //  $model->save();

   $modelsNilai = Tabular::createMultiple(Nilai::classname());
           Tabular::loadMultiple($modelsNilai, Yii::$app->request->post());


           // validate all models
           $valid = $model->validate();
           $valid = Tabular::validateMultiple($modelsNilai) && $valid;

           if ($valid) {
               $transaction = \Yii::$app->db->beginTransaction();
               try {
                   if ($flag = $model->save(false)) {
                       foreach ($modelsNilai as $indexTools =>$modelNilai) {
                           $modelNilai->id_sp = $model->id;
                       //    $modelNilai->user_id = \Yii::$app->user->identity->id;

                           if (! ($flag = $modelNilai->save(false))) {
                               $transaction->rollBack();
                               break;
                           }
                       }
                   }
                   if ($flag) {
                       $transaction->commit();
                       return $this->redirect(['view', 'id' => $model->id]);
                   }
               } catch (Exception $e) {
                   $transaction->rollBack(); \Yii::$app->session->setFlash('error','gagal');
               }

       }

       } else {
           return $this->render('create', [
               'model' => $model,
                'modelsNilai' => (empty($modelsNilai)) ? [new Nilai] : $modelsNilai,



           ]);
       }
   }

    /**
     * Updates an existing SemesterPendek model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionUpdate($id)
     {
         $model = $this->findModel($id);
         $modelsNilai = $model->nilais;



         if ($model->load(Yii::$app->request->post())) {

             $oldIDs = ArrayHelper::map($modelsNilai, 'id', 'id');
             $modelsNilai = Tabular::createMultiple(Nilai::classname(), $modelsNilai);
             Tabular::loadMultiple($modelsNilai, Yii::$app->request->post());
             $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsNilai, 'id', 'id')));

             // ajax validation


             // validate all models
             $valid = $model->validate();
             $valid = Tabular::validateMultiple($modelsNilai) && $valid;

             if ($valid) {
                 $transaction = \Yii::$app->db->beginTransaction();
                 try {
                     if ($flag = $model->save(false)) {
                         if (! empty($deletedIDs)) {
                             Nilai::deleteAll(['id' => $deletedIDs]);
                         }
                         foreach ($modelsNilai as $modelNilai) {
                             $modelNilai->id_sp = $model->id;
                            // $modelNilai->user_id = \Yii::$app->user->identity->id;

                             if (! ($flag = $modelNilai->save(false))) {
                                 $transaction->rollBack();
                                 break;
                             }
                         }
                     }
                     if ($flag) {
                         $transaction->commit();
                         return $this->redirect(['view', 'id' => $model->id]);
                     }
                 } catch (Exception $e) {
                     $transaction->rollBack();
                 }

         }

         } else {
             return $this->render('update', [
                 'model' => $model,
                 'modelsNilai' => (empty($modelsNilai)) ? [new Nilai] : $modelsNilai
             ]);
         }
     }

    /**
     * Deletes an existing SemesterPendek model.
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
     * Finds the SemesterPendek model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SemesterPendek the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SemesterPendek::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
