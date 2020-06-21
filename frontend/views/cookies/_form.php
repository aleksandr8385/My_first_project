<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Cookies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cookies-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'imageFile')->fileInput() ?>

<?= $form->field($model, 'ingredient')->widget(CKEditor::className(), 
    [
        'options'=> ['rows'=> 6],
        'preset'=> 'full'
    ])  ?>

<?= $form->field($model, 'lead_text')->widget(CKEditor::className(), 
    [
        'options'=> ['rows'=> 6],
        'preset'=> 'full'
    ]) 
?>

<?= $form->field($model, 'content')->widget(CKEditor::className(), 
    [
        'options'=> ['rows'=> 6],
        'preset'=> 'full'
    ])
?>

<?php //$form->field($model, 'meta_description')->textInput(['maxlength' => true])?>

<?= $form->field($model, 'category_id')->dropDownList($model->categoryList()) ?>

<label>
    <input type="checkbox" required 
            oninvalid="this.setCustomValidity('Ты не согласился с правилами')" 
            oninput="setCustomValidity('')"/>
    <span>Я согласен с </span>
    <?= Html::a( 'правилами', ['/bakery/rule', 'id' => $model->id]) ?>

</label>

<div class="form-group">
    <?= Html::submitButton('Отправить на модерацию', ['class' => 'btn btn-success']) ?>
</div>

    <?php ActiveForm::end(); ?>

</div>
