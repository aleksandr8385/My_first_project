<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'username',
            'email:email',
            [
                'attribute' => 'created_at',
                'label' => 'Создан',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function($model) {
                    return $model->getStatusLabel();
            }],
            
            [
                'attribute' => 'updated_at',
                'label' => 'обновлен',
                'format' => 'datetime',
            ],
            
            [
                'attribute' => 'role',
                'label' => 'Роль пользователя',
                'value' => function($model) {
                    return $model->getRole();
            }],

            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
