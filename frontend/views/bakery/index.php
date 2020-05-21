<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BakerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bakeries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bakery-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest) : ?>
    <p>
        <?= Html::a('Добавить рецепт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_view',
        'viewParams' => ['showFullContent' => false]
    ]) ?>


</div>
