<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
// use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ADMIN',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    // $menuItems = [
    //     ['label' => 'Home', 'url' => ['/site/index']],
    //     ['label' => 'Категории', 'url' => ['/category']],
    //     ['label' => 'Теги', 'url' => ['/tag']],
    //     ['label' => 'Выпечка', 'url' => ['../../bakery']],
    //     ['label' => 'Users', 'url' => ['/user/index']]
    
    // ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Вход админа', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'ADMIN (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            
            . Html::endForm()
            . '</li>';
            $menuItems[] = ['label' => 'Зарегистрированные', 'url' => ['/user/index']];
            $menuItems[] = ['label' => 'Категории', 'url' => ['/category']];
            $menuItems[] = ['label' => 'Теги', 'url' => ['/tag']];
            $menuItems[] = ['label' => 'Выпечка', 'url' => ['/bakery']];
            
            if (Yii::$app->language == 'ru')
            {
                echo Html::a('English' , array_merge(Yii::$app->request->get(),
                    [Yii::$app->controller->route, 'language' => 'en']));
            }
            else 
            {
                echo Html::a('Русский' , array_merge(Yii::$app->request->get(),
                    [Yii::$app->controller->route, 'language' => 'ru']));
            }
         
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
