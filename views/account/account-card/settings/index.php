<?php
/**
 * @var $user \app\models\User
 * @var $model \app\models\form\AccountSettingForm
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$settings = $user->accountSetting;
$trainings = $user->trainings;
?>
<h1>Аккаунт пользователя</h1>
<div class="acc_profile row">
    <div class="items col-md-6">


        <div class="item">
            <span class="description_item option">Логин: </span>
            <input onkeyup="addButtonForm(this)" name="nickname" type="text" value="<?= $user->nickname ?>">
        </div>

        <div class="item">
            <span class="description_item option">Email: </span>
            <span><?= $user->email ?></span>
        </div>

        <? $form = ActiveForm::begin(['action' => '/account-setting/' . $user->id . '/edit', 'method' => 'post']); ?>

        <div class="item">
            <span class="description_item option">Изображение: </span>
            <?php if (empty($settings->avatar)): ?>
                <?= $form->field($model, 'avatar')
                    ->fileInput(['class' => 'picture-file', 'placeholder' => 'Изменить']); ?>
            <?php else: ?>
                <div class="item column">
                    <a data-fancybox="gallery" data-caption="<?= $settings->first_name ?>"
                       href="<?= $settings->avatar ?>">
                        <img class="account_img" src="<?= $settings->avatar ?>" alt="<?= $settings->first_name ?>">
                    </a>
                    <div class="form_file">
                        <?= $form->field($model, 'avatar')
                            ->fileInput(['class' => 'btn btnsuccess', 'placeholder' => 'Изменить']); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="item">
            <span class="description_item option">Телефон: </span>
            <?= $form->field($model, 'phone')
                ->input('phone', ['value' => $settings->phone]); ?>
        </div>

        <div class="item">
            <span class="description_item option">Обо мне: </span>
            <?= $form->field($model, 'about_me')
                ->textarea(['value' => $settings->about_me]); ?>
        </div>

        <div class="item">
            <span class="description_item option">Имя: </span>
            <?= $form->field($model, 'first_name')
                ->input('text', ['value' => $settings->first_name]); ?>
        </div>

        <div class="item">
            <span class="description_item option">Фамилия: </span>
            <?= $form->field($model, 'last_name')
                ->input('text', ['value' => $settings->last_name]); ?>
        </div>

        <div class="item">
            <span class="description_item option">Дата рождения: </span>
            <?= $form->field($model, 'birthday')
                ->input('date', ['value' => $settings->birthday]); ?>
        </div>

        <div class="item">
            <span class="description_item option">Адрес: </span>
            <?= $form->field($model, 'address')
                ->input('text', ['value' => $settings->address]); ?>
        </div>


        <div class="item">
            <span class="description_item option">Дата активации: </span>
            <span><?= $user->create_at ?></span>
        </div>

        <div class="item">
            <div class="description_item option"></div>
            <div id="account_button">
                <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="items column col-md-6">
        <div class="item c course">
            <span class="description_item">Доступные курсы: </span>
            <span>
            <?php foreach ($trainings as $training): ?>
                <div class="item">
                        <div class="training_box">
                            <a href="<?= Url::to(['training/' . $training->id . '/view']) ?>"><?= $training->name ?></a>
                        </div>
                </div>
            <?php endforeach; ?>
        </span>
        </div>
    </div>
</div>
