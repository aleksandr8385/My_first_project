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
    <?= $this->render('_view', [
        'model' => $model,
        'showFullContent' => true,
        'class'=>'col-md-12'
        ])
    ?>
</div>
