<?php
/**
 * @var $modelPost \app\models\form\PostForm
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-md-6">
        <?php $form= ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data' , 'class'=>'photo-form']]); ?>
        <?= $form->field($modelPost , 'title'); ?>
        <?= $form->field($modelPost , 'description'); ?>
        <?= $form->field($modelPost , 'theme'); ?>
        <?= $form->field($modelPost , 'file')->fileInput(['class'=>'btn btn-success', 'multiple'=>'multiple']); ?>
        <?= Html::submitButton('Добавить' , ['class'=>'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

