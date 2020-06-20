<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cookies */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Печенье'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cookies-view">



    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Ты уверен что хочешь удалить'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'lead_photo',
            'ingredient:html',
            'lead_text:html',
            'content:html',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'category_id',
            'status_id',
            // 'user_id',
           
        ],
    ]) ?>

</div>
