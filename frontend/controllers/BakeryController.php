<?php

namespace frontend\controllers;

use Yii;
use common\models\Bakery;
use common\models\BakerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;

/**
 * BakeryController implements the CRUD actions for Bakery model.
 */
class BakeryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Bakery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BakerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 8; //пагинация
       
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
         
           
        ]);
    }

    /**
     * Displays a single Bakery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bakery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  

    /**
     * Updates an existing Bakery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    

    /**
     * Deletes an existing Bakery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bakery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bakery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bakery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreate()
    {
        $model = new Bakery();
       
        if ($model->load(Yii::$app->request->post())) {
            $this->uploadImage($model);
            if($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create',
            ['model' => $model]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       
        if ($model->load(Yii::$app->request->post())) {
            $this->uploadImage($model);
            if($model->save()) {
                return $this->redirect(['view',
                 'id' => $model->id
                ]);
            }
        }
        
        return $this->render('update', ['model' => $model]);
    }

    protected function uploadImage($model)
    {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        
        if ($model->imageFile) {
            $model->upload();
        }
    }

  
}
