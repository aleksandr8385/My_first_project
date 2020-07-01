<?php

namespace frontend\controllers;

use Yii;
use common\models\Bakery;
use common\models\BakerySearch;
use frontend\models\ContactForm;
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
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $params = Yii::$app->request->queryParams;
        $params['BakerySearch']['status_id'] = 1;
        $dataProvider = $searchModel->search($params);
       
        $bakery = Bakery::find()->where(['status_id' => 1]);
        $countBakery = clone $bakery;
        $pagination = new Pagination([
            'pageSize' => 8,
            // 'defaultPageSize' => '8',
            'totalCount' => $countBakery->count(),
           
        ]);
        
        $bakery = $bakery->offset($pagination->offset)->limit($pagination->limit)->all();
        /*для того чтобы выводило 8 элементов */    
        $dataProvider->pagination->pageSize = 8;        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            // 'bakery' => $bakery,
            'pagination' => $pagination,
         
           
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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('успешно', 'Спасибо за ваше письмо.');
            } else {
                Yii::$app->session->setFlash('ошибка', 'Ваше письмо не отправлено.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionRule()
    {
        return $this->render('rule');
    }

  
}
