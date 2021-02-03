<?php
/**
 * @var $modelPhoto \app\models\form\PhotoForm
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>Добавить фотографию</h1>
<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'photo-form']]); ?>
        <?= $form->field($modelPhoto, 'album_id')->input(['type' => 'text']); ?>
        <? // $form->field($modelPhoto , 'title');  ?>
        <? // $form->field($modelPhoto , 'description');  ?>
        <? // $form->field($modelPhoto , 'album_id')->dropDownList(Yii::$app->params['directionsPhoto']);  ?>
        <?= $form->field($modelPhoto, 'file')->fileInput(['class' => 'btn btn-success', 'multiple' => 'multiple']); ?>
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
