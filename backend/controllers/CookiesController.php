<?php

namespace backend\controllers;

use common\models\Bakery;
use Yii;
use common\models\Cookies;
use common\models\CookiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','create','update','delete','view'],//доступные action для role=>admin
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],

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
        $nameAuthor = Bakery::getAuthorList(); //массив имен авторов
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'nameAuthor' =>  $nameAuthor,
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
    public function actionCreate()
    {
        $model = new Cookies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

     
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
    /**
     * метод для админа вход в бекенд
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('admin')) {
                return $this->goBack();
            } else {
                Yii::$app->user->logout(false);
                Yii::$app->session->setFlash('error', 'You are not allowed to access backend!');
                $model->password = '';

                return $this->render('login', [
                'model' => $model,
                ]);
            }
        }else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * update action
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryList = Bakery::categoryList();
        $nameAuthor = Bakery::getAuthorList();
       
        if ($model->load(Yii::$app->request->post())) {
            $this->uploadImage($model);
            if($model->save()) {
                return $this->redirect(['view', 
                'id' => $model->id,
                'categoryList' =>  $categoryList,
                'nameAuthor' =>  $nameAuthor,

                ]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
            'categoryList' =>  $categoryList,
            'nameAuthor' =>  $nameAuthor,
            ]);
    }

    protected function uploadImage($model)
    {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        
        if ($model->imageFile) {
            $model->upload();
        }
    }
}
