<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body id="page-wrapper">
<!-- Header -->
<header id="header" class="alt">
    <div class="logo">
        <a href="#">MARU.PH</a>
    </div>
    <h1><a href="index.html">Spectral</a></h1>
    <nav id="nav">

        <ul>
            <li class="special">
                <a href="#menu" class="menuToggle"><span>Menu</span></a>
                <div id="menu">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Generic</a></li>
                        <li><a href="#">Elements</a></li>
                        <li><a href="#">Sign Up</a></li>
                        <li><a href="#">Log In</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</header>
<!-- Banner -->
<section id="banner">
    <div class="inner">
        <h2>MARU.PH</h2>
        <p>Лучший фотограф Челябинска</p>
    </div>
    <a href="#one" class="more scrolly">Далее</a>
</section>
<?php $this->beginBody() ?>

<!-- Page Wrapper -->
<div id="page-wrapper">

    <section id="one" class="wrapper style1 special">
        <div class="inner">
            <?= $content ?>
        </div>
    </section>


    <footer class="footer" id="footer">
        <ul class=" icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
            <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
        </ul>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
