<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BakerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app','Выпечка');
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="bakery-index">

    
    <p>
        <?= Html::a('Create Bakery', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                      
            'title',
          
            ['attribute' =>'lead_photo',
            'format' => 'html',
            'label' => 'Фото',
            'value' => function($name)
                {
                    return Html::img('../frontend/web/'.$name->lead_photo , 
                    [ 'width' => '100px']);
                
                },
            ],
            // 'ingredient',
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
          
            // 'created_by',- автор 
            [
               
                'label' => 'Автор',
                'attribute'=>'created_by',
                'value' => 'createdBy.username',
                'filter' => $nameAuthor,
            ],
                       
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

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete} {update} {view}'],
        ],
    ]); ?>


</div>
