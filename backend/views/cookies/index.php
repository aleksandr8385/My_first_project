<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CookiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cookies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cookies-index">

   

    <p>
        <?= Html::a(Yii::t('app', 'Create Cookies'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            ['attribute' =>'lead_photo',
            'format' => 'html',
            'label' => 'Фото',
            'value' => function($name)
                {
                    return Html::img('../backend/web/'.$name->lead_photo , 
                    [ 'width' => '70px']);
                
                },
            ],

            [
                'attribute' =>'ingredient',
                'label' => 'Ингредиенты',
                'value' => function ($name) 
                {
                    return StringHelper::truncate($name->ingredient, 20);
                }
            ],
            [
                'attribute' =>'lead_text',
                'format' => 'html',
                'label' => 'Описание',
                'value' => function ($name) 
                {
                    return StringHelper::truncate($name->lead_text, 20);
                }
            ],
            [
                'attribute' =>'content',
                'format' => 'html',
                'label' => 'Рецепт',
                'value' => function ($name) {
                    return StringHelper::truncate($name->content, 20);
                }
            ],
            'created_at',
            [
                'label' => 'Автор',
                'attribute'=>'created_by',
                'value' => 'createdBy.username',
                'filter' => $nameAuthor,
            ],
            //'updated_at',
            // 'created_by',
            //'updated_by',
            // 'category_id',
            ['attribute'=>'status_id',
                'filter'=>['off','on'],
                'value'=> function($model)
                {
                    if ($model->status_id==1){
                        $status = 'on';
                    }else {
                        $status = 'off';
                    }
                        return $status;
                }
            ],
            // 'user_id',
           

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete} {update} {view}'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
