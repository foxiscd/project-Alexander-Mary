<?php
/**
 * @var \app\models\Training $courses
 */

use yii\helpers\Url;

?>

<h1>Мои обучающие курсы</h1>
<div class="items column col-md-6">
    <div class="item course">
        <span>
            <?php foreach ($courses as $course): ?>
                <div class="item">
                        <div class="training_box">
                            <a href="<?= Url::to(['training/' . $course->id . '/view']) ?>"><?= $course->name ?></a>
                        </div>
                </div>
            <?php endforeach; ?>
        </span>
    </div>
</div>