<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 * @var $modelLogin \app\models\form\LoginForm
 */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\api\Vkontakte;

$modelLogin = Yii::$app->view->context->getLoginForm();

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
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css"/>
    </noscript>
</head>
<body id="page-wrapper">

<!-- Header -->
<header id="header" class="alt">
    <h1><a href="<?= Url::to(['main/index']); ?>">MARU.PH</a></h1>
    <div id="error" data-content="<?= Yii::$app->session->getFlash('error') ?: null ?>"></div>
    <nav id="nav">
        <ul>
            <li class="special">
                <a href="#menu" class="menuToggle"><span>Menu</span></a>
                <div id="menu">
                    <ul>
                        <li><a href="<?= Url::to(['main/index']); ?>">Главная</a></li>
                        <li><a href="<?= Url::to(['main/portfolio']); ?>">Мои работы</a></li>
                        <li><a href="#">Советы для клиента</a></li>
                        <li><a href="<?= Url::to(['main/price']); ?>">Стоимость</a></li>
                        <li><a href="#">Обучение</a></li>
                        <li><a href="<?= Url::to(['main/contacts']); ?>">Контакты</a></li>
                    </ul>
                    <hr>

                    <!-- login form -->
                    <div class="form-login">
                        <div class="loginForm">
                            <?php $form = ActiveForm::begin(['action' => ['user/login']]) ?>
                            <?= $form->field($modelLogin, 'email')->input('email', ['class' => 'login_input']); ?>
                            <?= $form->field($modelLogin, 'password')->passwordInput(['class' => 'login_input']); ?>
                            <?= Html::submitButton('Войти', ['class' => 'btn btn-success']); ?>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>

                    <?php if (Yii::$app->user->isGuest): ?>
                        <!-- auth button -->
                        <div class="account_manager">
                            <button class="btn btn-success butLogin">Войти</button>

                            <a href="<?= Url::to(['user/register']); ?>">
                                <button class="btn btn-primary">Зарегестрироваться</button>
                            </a>
                        </div>
                        <!-- auth social network -->
                        <?php if (empty(Yii::$app->request->get('code'))): ?>
                            <div class="icons-login">
                                <p>Войти через</p>
                                <div class="row">
                                    <div style="float: left">
                                        <a href="<?= Vkontakte::authorizeUrl() ?>">
                                            <div class="icon vk"></div>
                                        </a>
                                    </div>
                                    <div style="float: left">
                                        <a href="#">
                                            <div class="icon facebook"></div>
                                        </a>
                                    </div>
                                    <div style="float: left">
                                        <a href="#">
                                            <div class="icon google"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- greeting -->
                        <div style="text-align: left">
                            <span>Привет, </span>
                            <a href="<?= Url::to(['account/' . Yii::$app->user->id]) ?>">
                                <?= Yii::$app->user->identity->nickname; ?>
                            </a>
                            <a href="<?= Url::to(['user/logout']) ?>">
                                <button class="btn btn-success">Выйти</button>
                            </a>
                            <?php // admin panel ?>
                            <?php if (Yii::$app->user->identity->role == 'admin'): ?>
                                <a href="<?= Url::to(['admin/panel/photo']) ?>">
                                    <button class="btn btn-info">Панель администратора</button>
                                </a>
                            <? endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </nav>
</header>

<?php $this->beginBody() ?>

<!-- Page Wrapper -->
<div id="page-wrapper">
    <section id="one" class="wrapper style1 special">
        <div class="container">
            <?php Alert::widget() ?>
            <div class="inner">
                <?= $content ?>
            </div>
        </div>
    </section>
</div>

<footer class="footer" id="footer">
    <div class="container">
        <p style="margin-bottom: 0px; text-align: left">Все права защищены.</p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
