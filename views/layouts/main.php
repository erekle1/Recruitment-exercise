<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="top-header">
        <div class="container">
            <ul>
                <li>Klienditeenindus</li>
                <li class="top-header-item"><?= Html::img('@web/img/phone.png', ['alt' => 'Phone']) ?> 1715</li>
                <li class="top-header-item"><?= Html::img('@web/img/clock.png', ['alt' => 'Phone']) ?> E-P 9.00-21.00
                </li>
            </ul>
            <ul class="pull-right">
                <li>Tere, Kaupo Kasutaja</li>
                <li class="top-header-item">
                    <a href="javascript:"
                       class="header-button"><?= html::img('@web/img/logout.png') ?> Log Out</a>
                </li>

            </ul>
        </div>
    </div>
    <?php
    NavBar::begin([
        'brandImage' => '@web/img/logo.png',
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light main-menu',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items'   => [
            Html::tag('li', '<a href="javascript:">Home</a>'),
            Html::tag('li', '<a href="javascript:">About</a>'),
            Html::tag('li', '<a href="javascript:">Contact</a>'),
        ],
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
