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

    <h3><?= Html::encode($this->title) ?></h3>
    <!-- d-flex стиль в css для поиска и кнопки добавить my.css-->
    <div class ="d-flex" > 
        <div class=" " >
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>

        <div class=" " >
            <?php if(!Yii::$app->user->isGuest) : ?>
                <p><?= Html::a('Добавить рецепт', ['create'], ['class' => 'btn btn-success']) ?></p>
            <?php endif; ?>
        </div>
    </div>
    

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        
        'options' => ['class'=>'row'],
        'summary' => '',
        'itemOptions' => ['class'=>'col-md-3'],
        'itemView' => 'card',
        'viewParams' => ['showFullContent' => false]
    ]) ?>


</div>

