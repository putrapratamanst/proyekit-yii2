<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Dhs;
use frontend\models\DhsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RecordHelpers;

/**
 * DhsController implements the CRUD actions for Dhs model.
 */
class DhsController extends Controller
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
     * Lists all Dhs models.
     * @return mixed
     */
     public function actionIndex()
 {
 if ($already_exists = RecordHelpers::userHas('dhs')) {
 return $this->render('dhs', [
 'model' => $this->findModel($already_exists),
 ]);
 } else {
 return $this->redirect(['create']);
 }
 }
    /**
     * Displays a single Dhs model.
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
     * Creates a new Dhs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dhs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dhs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dhs model.
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
     * Finds the Dhs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dhs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dhs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

          public function actionDhs($id)
          {
    ///        $searchModel = new DhsSearch();
      $nim = $this->loadNim($id);
          $model = new Dhs();
        /*  $model->setAttributes(['id'=>'','id_tahun_ajaran'=>'','npm_mahasiswa'=>'','semester'=>'','user_id'=>'','id_matakuliah'=>'','nilai'=>'']);
          if(isset($_GET['Dhs']))
          $model->attributes=$_GET['Dhs'];
*/
            // $dataProvider = $model->searchkhs($nim['id_mahasiswa']);
    //
          return $this->render('dhs', ['model'=> $model,
        'nim'=>$nim,]);
       //'searchModel' => $searchModel,
    //  'dataProvider'=> $dataProvider]);
    //return var_dump($nim);
        }


        public  function loadNim($id)
          {
            $connection = \Yii::$app->db;
            $userid = Yii::$app->user->identity->id;
            $sql = "SELECT id FROM $model_name WHERE user_id=:userid";
            $command = $connection->createCommand($sql);
            $command->bindValue(":userid", $userid);
            $result = $command->queryOne();
            if ($result == null) {
                  throw new HttpException(404,'The Requsted page does not exist');
          } else {
          return $model;
          }
          }
          public function actionGetNilai($id)
   {
       $datas = Dhs::find()->where(['nilai'=>$model])->all();
       $data = ArrayHelper::map($datas, 'id', 'nilai');
       echo Json::encode($data);
   }

   public function actionLists($id){
             $countBranches = Dhs::find()
              ->where(['id'=>$id])
               ->count();
           $branches = Dhs::find()
          ->where(['id'=>$id])
               ->all();
           if($countBranches > 0)
           {
               foreach ($branches as $branch) {
                   echo "<option value'" .$branch->id. "'>".$branch->nilai."</option>";
               }
           }
           else
           {
               echo "<option>-</option>";
           }
       }

}
