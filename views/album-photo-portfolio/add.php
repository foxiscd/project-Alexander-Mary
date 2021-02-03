<?php
/**
 * @var $model \app\models\form\AlbumPhotoPortfolioForm
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>Добавить альбом</h1>
<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'photo-form']]); ?>
        <?= $form->field($model , 'title');  ?>
        <?= $form->field($model , 'description');  ?>
        <?= $form->field($model , 'directions')->dropDownList(Yii::$app->params['directionsPhoto']);  ?>
        <?= $form->field($model, 'cover')->input(['type'=>'text']) ?>
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
