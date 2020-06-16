<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Cookies */
?>

<div class="panel">
    <div class="btn-group pull-right" role="group">
        <?php if(Yii::$app->user->can('updatePost')) : ?>
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                ['/cookies/update', 'id' => $model->id],
                [
                    'class' => 'btn btn-warning btn-sm'
                ])
            ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>',
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                    ],
                ]) 
            ?>
        <?php endif; ?>
    </div>
    
    <?php if ($model->status_id) : ?>                
        <div class="panel-heading">
            <?php if ($showFullContent) : ?>
                <h1><?= Html::encode($model->title) ?></h1>
                <?php else : ?>
                <h4><?= Html::a(Html::encode($model->title), ['/cookies/view', 'id' => $model->id])?></h4>
            <?php endif; ?>

                <div>
                    <span class="glyphicon glyphicon-calendar"></span>
                    <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
                    <span class="glyphicon glyphicon-user"></span>
                    <?= $model->createdBy->username ?>
                    <span class="badge" > <?= $model->createdBy->email ?></span>
                </div>
        </div>
        <div class="container">
           
                <div class="content"> <!--my.css -->
                    <?php if ($showFullContent) :?>    
                        <div class="foto-ing"> 
                            <div>
                                <?= ($model->lead_photo) ? Html::img(Url::to(['/']) . $model->lead_photo,
                                    ['class' => 'img-responsive  img-photo']
                                    ) : ''
                                ?>
                            </div>
                            <div class="ingredient">
                                <?=!empty($model->ingredient) ? Yii::$app->formatter->asHtml($model->ingredient                                                
                                ) : ''?>
                            </div>
                        </div>
                    <?php endif; ?>  

                        <?= !empty($model->lead_text) ? Yii::$app->formatter->asHtml($model->lead_text
                                                    
                            ) : ''
                        ?>
                        
                        <?= $showFullContent?Yii::$app->formatter->asHtml($model->content): '' ?>
                            <?php if (!$showFullContent) :?>
                                <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Подробнее...',
                                    ['/cookies/view', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) 
                                ?>
                            <?php endif; ?>
                </div>
            
        </div>

        
    <?php endif; ?>
</div>
    
   
