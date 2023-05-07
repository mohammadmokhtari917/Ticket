<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\Details;
$details=Details::findOne(1);

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<!-- ----------------------------  header  -------------------------------- -->
<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('/ticket/css/Site/Image/logo.png', ['alt' => $details->name,'class' => 'img-logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            Yii::$app->user->isGuest
            ? ['label' => 'ورود', 'url' => ['/site/login']]
            : '<li class="nav-item">'
            . Html::beginForm(['/site/logout'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . Html::endForm()
            . '</li>', 
            Yii::$app->user->isGuest
            ? ['label' => 'ثبت نام', 'url' => ['/site/signup']]
            : '<li class="nav-item">'
            . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>
<!-- ----------------------------  header  -------------------------------- -->

<!-- ----------------------------  sidebar  -------------------------------- -->
<sidebar id="sidebar" class="sidebar-main">
    <div class="container">
        <div class="row text-muted">
            <ul>
                <li><a href='/ticket/site/about'>درباره ما<i class='glyphicon glyphicon-comment'></i></a></li>
                <li><a href='/ticket/site/contact'>تیکت<i class='glyphicon glyphicon-envelope'></i></a></li>
                <li><a href="#"><i class="fab fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</sidebar>
<!-- ----------------------------  sidbar  -------------------------------- -->

<!-- ----------------------------  main  -------------------------------- -->
<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= 
   Breadcrumbs::widget([
      'homeLink' => [ 
                      'label' => Yii::t('yii', 'خانه / '),
                      'url' => Yii::$app->homeUrl,
                 ],
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
   ]) 
    ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<!-- ----------------------------  main  -------------------------------- -->

<!-- ----------------------------  footer  -------------------------------- -->
<footer id="footer" class="mt-auto py-3 bg-dark">
    <div class="container">
        <div class="row text-muted">
            <ul>
                <li><a href='/ticket/site/about'>درباره ما<i class='glyphicon glyphicon-comment'></i></a></li>
                <li><a href='/ticket/site/contact'>تیکت<i class='glyphicon glyphicon-envelope'></i></a></li>
                <li><a href="#"><i class="fab fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</footer>
<!-- ----------------------------  footer  -------------------------------- -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style>
.img-logo {
    width: 50px;
}
</style>    