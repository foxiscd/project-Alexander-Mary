<?php
/**
 * @var $user \app\models\User
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$settings = $user->accountSetting;
$trainings = $user->trainings;
?>
<h1>Пользователь <?= $user->nickname ?></h1>
<div class="acc_profile row">
    <div class="items col-md-6">

    </div>

    <div class="items col-md-6">
        <div>
            <a data-fancybox="gallery" data-caption="<?= $settings->first_name ?>"
               href="<?= $settings->avatar ?>">
                <div class="account_img_preview"
                     style="background: url('<?= $settings->avatar ?>') center center no-repeat">
                </div>
            </a>
        </div>

        <?php if (Yii::$app->user->getId() == $user->id): ?>
            <div>
                <a href="<?= Url::to(['account/' . Yii::$app->user->id . '/settings']); ?>">
                    <button class="option">Настройки<i class="option"></i></button>

                </a>
            </div>
        <?php endif; ?>

        <div>
            <?= $settings->first_name ?> <?= $settings->last_name ?>
        </div>
        <div>
            <span class="description_item">Email: </span>
            <span><?= $user->email ?></span>
        </div>
        <div>
            <span class="description_item">Телефон: </span>
            <?= $settings->phone ?>
        </div>
        <div>
            <span class="description_item">Обо мне: </span>
            <?= $settings->about_me ?>
        </div>
        <div>
            <span class="description_item">День рождения: </span>
            <?= $settings->birthday ?>
        </div>
        <div>
            <span class="description_item">Адрес: </span>
            <?= $settings->address ?>
        </div>
    </div>
</div>

