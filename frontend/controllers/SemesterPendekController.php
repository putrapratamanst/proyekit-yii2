<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SemesterPendek;
use frontend\models\SemesterPendekSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RecordHelpers;
use frontend\models\Nilai;
use frontend\models\Tabular;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;


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
     public function actionCetak($id){
      // get your HTML raw content without any layouts or scripts
      //$content = $this->renderPartial('_reportView');
      $model = $this->findModel($id);
      $modelsNilai = $model->nilais;
      $content = $this->renderPartial('cetak',[
            'model' => $this->findModel($id),
            'modelsNilai' => (empty($modelsNilai)) ? [new Nilai] : $modelsNilai,

        ]);

      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
          // set to use core fonts only
      //    'mode' => Pdf::MODE_CORE,
          // A4 paper format
          'format' => Pdf::FORMAT_A4,
          // portrait orientation
          'orientation' => Pdf::ORIENT_PORTRAIT,
          // stream to browser inline
          'destination' => Pdf::DEST_BROWSER,
          // your html content input
          'content' => $content,
          // format content from your own css file if needed or use the
          // enhanced bootstrap css built by Krajee for mPDF formatting
          'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
          // any css to be embedded if required
          'cssInline' => '.kv-heading-1{font-size:18px}',
          // set mPDF properties on the fly
          'options' => ['title' => $this->findModel($id)->id],
          // call mPDF methods on the fly
          'methods' => [
               'SetHeader' => ['D4 TEKNIK INFORMTIKA'],
              'SetFooter'=>['{PAGENO}'],
          ]
      ]);

      // return the pdf output as per the destination setting
      return $pdf->render();
    }

     public function actionIndex()
{



if ($already_exists = RecordHelpers::userHas('semester_pendek')) {
return $this->render('view', [
'model' => $this->findModel($already_exists),

]);
} else {
return $this->redirect(['create']);
}
}

    /**
     * Displays a single SemesterPendek model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
      {
        $model = $this->findModel($id);
        $modelsNilai = $model->nilais;

        return $this->render('view',[
          'model'=> $model,
          'modelsNilai' => (empty($modelsNilai)) ? [new Nilai] : $modelsNilai,
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
      $model->user_id = \Yii::$app->user->identity->id;
      $model->npm = \Yii::$app->user->identity->username;


        $modelsNilai = [new Nilai];


       if ($model->load(Yii::$app->request->post())){
         $model->waktu_daftar = date('Y-m-d h:m:s');

         $model->save();

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
