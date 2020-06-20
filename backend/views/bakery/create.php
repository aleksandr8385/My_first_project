<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Bakery */

$this->title = 'Добавить рецепт';
$this->params['breadcrumbs'][] = ['label' => 'Торты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bakery-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
