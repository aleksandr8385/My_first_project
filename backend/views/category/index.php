<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-responsive table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'title_testo',
            'title_cookies',
            'created_at',
            

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete} {update}'],
        ],
    ]); ?>


</div>
