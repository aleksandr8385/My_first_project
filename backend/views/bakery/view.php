<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Bakery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Торты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bakery-view">

 
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ты уверен что хочешь удалить',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
           
            'ingredient:html',
            'lead_photo',
            'lead_text:html',
            'content:html',
            // 'meta_description',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'category_id',
            'status_id',
        ],
    ]) ?>

</div>
