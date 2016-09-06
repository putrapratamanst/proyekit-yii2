<?php

namespace backend\controllers;

use Yii;
use backend\models\Matakuliah;
use backend\models\MatakuliahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;

/**
 * MatakuliahController implements the CRUD actions for Matakuliah model.
 */
class MatakuliahController extends Controller
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
     * Lists all Matakuliah models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatakuliahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Matakuliah model.
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
     * Creates a new Matakuliah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Matakuliah();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Matakuliah model.
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
     * Deletes an existing Matakuliah model.
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
     * Finds the Matakuliah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Matakuliah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Matakuliah::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
