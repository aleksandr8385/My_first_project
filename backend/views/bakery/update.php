<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Bakery */

$this->title = 'Редактирования рецепта ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Торты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

?>

<div class="bakery-update">

    
    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList, 
    ]) ?>

</div>
