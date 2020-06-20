<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

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
                'label' => 'Дата создания',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'status',
                'attribute' => 'Статус',
                'format' => 'text',
                'value' => function($model) {
                    return $model->getStatusLabel();
            }],
            
            // [
            //     'attribute' => 'updated_at',
            //     'label' => 'обновлен',
            //     'format' => 'datetime',
            // ],
            
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
