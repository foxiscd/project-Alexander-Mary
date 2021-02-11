<?php
/**
 * @var \app\models\form\RegisterForm $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'password')->textInput(); ?>
<?= $form->field($model, 'repeat_password')->textInput(); ?>
<?= Html::submitButton('Изменить'); ?>
<?php ActiveForm::end(); ?>
