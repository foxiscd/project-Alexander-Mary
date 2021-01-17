<?php
/**
 * @var $model app\models\User;
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>Регистрация</h1>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div style="text-align: left; background-color: #00ffcc"><?= Yii::$app->session->getFlash($status) ?></div>
<?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div style="text-align: left; background-color: orangered"><?= Yii::$app->session->getFlash($status) ?></div>
<?php endif; ?>

<div class="form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nickname')->textInput(); ?>
    <?= $form->field($model, 'email')->textInput(); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= $form->field($model, 'repeat_password')->passwordInput(); ?>
    <?= Html::submitButton('Зарегестрироваться', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
