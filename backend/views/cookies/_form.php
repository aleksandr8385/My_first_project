<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cookies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cookies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'ingredient')->widget(CKEditor::className(), 
            [
                'options'=> ['rows'=> 6],
                'preset'=> 'full'
            ])  
    ?>

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
 
    <?= $form->field($model, 'category_id')->dropDownList($model->categoryList()) ?>

    <?= $form->field($model, 'status_id')->dropDownList(['off','on']) ?>

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
