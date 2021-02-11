<?php
/**
 * @var \app\models\form\LoginForm $model
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'email')->textInput(); ?>
<?= Html::submitButton('Восстановить'); ?>
<?php ActiveForm::end(); ?>
