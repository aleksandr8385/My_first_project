<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CookiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cookies-search">

<?php $form = ActiveForm::begin(['action' => ['index'],'method' => 'get',]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'title')
                    ->textInput(['placeholder' => 'Найти'])
                    ->label(false) 
            ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'category_id')
                    ->dropDownList($model->categoryList(), 
                    ['prompt' => 'Виды печенья'])
                    ->label(false) 
            ?>
        </div>

        <div class="col-md-2">
            <div class="btn-group">
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>

</div>
