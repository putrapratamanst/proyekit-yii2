<?php

namespace backend\controllers;

use Yii;
use backend\models\Penjadwalan;
use backend\models\PenjadwalanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
/**
 * PenjadwalanController implements the CRUD actions for Penjadwalan model.
 */
class PenjadwalanController extends Controller
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
  return PermissionHelpers::requireRole('prodi');
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
     * Lists all Penjadwalan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenjadwalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penjadwalan model.
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
     * Creates a new Penjadwalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penjadwalan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Penjadwalan model.
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
     * Deletes an existing Penjadwalan model.
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
     * Finds the Penjadwalan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penjadwalan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penjadwalan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
