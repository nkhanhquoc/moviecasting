<?php
/* @var $this \yii\web\View */
/* @var $content string */

use awesome\backend\toast\AwsAlertToast;
use backend\assets\DefaultAsset;
use yii\helpers\Html;

DefaultAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--[if IE 8]>
    <html lang="<?= Yii::$app->language ?>" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]>
    <html lang="<?= Yii::$app->language ?>" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="<?= Yii::$app->language ?>" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    </head>

    <body class="">
        <div id="page-loading">
            <img src="/img/ajax-loading2.gif" />
        </div>
    <?php $this->beginBody() ?>
    <div class="page-lock">
        <div class="page-logo">
            <a class="brand text-logo" href="/">

<!--                <img src="/img/logo-big.png" alt="logo"/> -->
            </a>
        </div>
        <div class="page-body">
            <div class="lock-head"><?= Html::encode($this->title) ?></div>
            <div class="lock-body">
                <?= $content ?>
            </div>
            <div class="lock-bottom">
                <?=
                AwsAlertToast::widget([
                ]);
                ?>
            </div>
        </div>
        <div class="page-footer-custom"> 2016 &copy; TT VAS - VTT.</div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>