<?php

namespace backend\controllers;

use Yii;
use backend\models\Mahasiswa;
use backend\models\MahasiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
/**
 * MahasiswaController implements the CRUD actions for Mahasiswa model.
 */
class MahasiswaController extends Controller
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
     * Lists all Mahasiswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MahasiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mahasiswa model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mahasiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mahasiswa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mahasiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Mahasiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mahasiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Mahasiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mahasiswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionLists($id){
        $countBranches = Mahasiswa::find()
            ->where(['id'=>$id])
          ->count();
        $branches = Mahasiswa::find()
            ->where(['id'=>$id])
            ->all();
        if($countBranches > 0)
        {
            foreach ($branches as $branch) {
                echo "<option value'" .$branch->id. "'>".$branch->user_id."</option>";
            }
        }
        else
        {
            echo "<option>-</option>";
        }
    }
}
