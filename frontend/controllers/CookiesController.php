<?php

namespace frontend\controllers;

use Yii;
use common\models\Cookies;
use common\models\CookiesSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CookiesController implements the CRUD actions for Cookies model.
 */
class CookiesController extends Controller
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
     * Lists all Cookies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CookiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $сookies = Cookies::find()->where(['status_id' => 1]);
        $countCookies = clone $сookies;
        $pagination = new Pagination([
            'pageSize' => 8,
            // 'defaultPageSize' => '8',
            'totalCount' => $countCookies->count(),
           
        ]);
        
        $сookies = $сookies->offset($pagination->offset)->limit($pagination->limit)->all();
        /*для того чтобы выводило 8 элементов */    
        $dataProvider->pagination->pageSize=8;    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Cookies model.
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
     * Creates a new Cookies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  

    /**
     * Updates an existing Cookies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    

    /**
     * Deletes an existing Cookies model.
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
     * Finds the Cookies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cookies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cookies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCreate()
    {
        $model = new Cookies();
       
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
