<?php
/**
 * @var $model app\models\User;
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\Alert;

?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div style="text-align: left; background-color: #00ffcc"><?= Yii::$app->session->getFlash($status) ?></div>
<?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div style="text-align: left; background-color: orangered"><?= Yii::$app->session->getFlash($status) ?></div>
<?php endif; ?>

<div class="form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->textInput(['class'=>'login_input']); ?>
    <?= $form->field($model, 'password')->passwordInput(['class'=>'login_input']); ?>
    <?= Html::submitButton('Войти', ['class' => 'btn bts-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
