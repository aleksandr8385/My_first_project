<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BakerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bakeries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bakery-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bakery', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            // 'slug',
            'lead_photo',
            'lead_text:ntext',
            'content:ntext',
            //'meta_description',
            'created_at',
            //'updated_at',
            // 'created_by',
            'author.username',
            //'updated_by',
            //'category_id',
            ['attribute'=>'status_id','filter'=>['off','on'],'value'=> function($model){
                if ($model->status_id==1){
                    $status = 'on';
                } else {
                    $status = 'off';
                }
                return $status;
            }
    
        ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete} {update} {view}'],
        ],
    ]); ?>


</div>
