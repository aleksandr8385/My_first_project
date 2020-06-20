<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cookies */

$this->title = Yii::t('app', 'Редактирование: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Печенье'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="cookies-update">

    

    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList, 
    ]) ?>

</div>
