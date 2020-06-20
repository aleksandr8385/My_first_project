<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Пользователь №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователь', 'url' => ['index']];

\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ты уверен что хочешь удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            [
                'label' => 'Статус',
                'attribute' => 'status',
            ],
            [
                'label' => 'Дата создания',
                'attribute' => 'created_at',
                'format' => 'date',
            ],
            // 'created_at:date',
            // 'updated_at',
            // 'verification_token',
            [
                'label' => 'Роль пользователя',
                'attribute' => 'role',
            ],
        ],
    ]) ?>

</div>
