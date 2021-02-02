<?php
/**
 * @var $trainings \app\models\training\Training
 * @var $user \app\models\User
 */

use yii\helpers\Url;

?>
<h1>Изменения статуса</h1>
<span>Пользователь: <span style="color: #0a73bb; font-family: Arial;"><?= $user->email ?></span></span>
<br><br>
<table>
    <tr class="table_account_header" data-column="<?= Yii::$app->request->get('column') ?>"
        data-sort="<?= Yii::$app->request->get('sort') ?>">
        <td>Название обучающего курса</td>
        <td>Статус</td>
    </tr>
    <?php foreach($trainings as $training): ?>
        <tr>
            <td style="margin: 20px"><?= $training->name ?></td>
            <td style="margin: 20px">
                <?php
                if (!$training->student->getStudent($user->id, $training->id)): ?>
                    <a class="btn btn-success"
                       href="<?= Url::to(['training-status/change/' . $user->id . "?status_code=".$training->training_code]) ?>">
                        Добавить
                    </a>
                <?php else: ?>
                    <div>Активно</div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
