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
            <span class="description_item">Логин: </span>
            <input onkeyup="addButtonForm(this)" name="nickname" type="text" value="<?= $user->nickname ?>">
        </div>

        <div class="item">
            <span class="description_item">Email: </span>
            <span><?= $user->email ?></span>
        </div>

        <? $form = ActiveForm::begin(['action' => '/account-setting/' . $user->id . '/edit', 'method' => 'post']); ?>

        <div class="item">
            <span class="description_item">Изображение: </span>
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
            <span class="description_item">Телефон: </span>
            <?= $form->field($model, 'phone')
                ->input('phone', ['value' => $settings->phone]); ?>
        </div>

        <div class="item">
            <span class="description_item">Обо мне: </span>
            <?= $form->field($model, 'about_me')
                ->textarea(['value' => $settings->about_me]); ?>
        </div>

        <div class="item">
            <span class="description_item">Имя: </span>
            <?= $form->field($model, 'first_name')
                ->input('text', ['value' => $settings->first_name]); ?>
        </div>

        <div class="item">
            <span class="description_item">Фамилия: </span>
            <?= $form->field($model, 'last_name')
                ->input('text', ['value' => $settings->last_name]); ?>
        </div>

        <div class="item">
            <span class="description_item">Дата рождения: </span>
            <?= $form->field($model, 'birthday')
                ->input('date', ['value' => $settings->birthday]); ?>
        </div>

        <div class="item">
            <span class="description_item">Адрес: </span>
            <?= $form->field($model, 'address')
                ->input('text', ['value' => $settings->address]); ?>
        </div>


        <div class="item">
            <span class="description_item">Дата активации: </span>
            <span><?= $user->create_at ?></span>
        </div>

        <div class="item">
            <div class="description_item"></div>
            <div id="account_button">
                <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="items col-md-6">
        <div class="item course">
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

<script>
    $(document).ready(function () {
        $('input').on('change', function () {
            $('#account_button').addClass('active');
        });
        $('textarea').on('change', function () {
            $('#account_button').addClass('active');
        });
    });
</script>
<style>
    #account_button {
        display: none;
    }

    #account_button.active {
        display: block;
    }
</style>
