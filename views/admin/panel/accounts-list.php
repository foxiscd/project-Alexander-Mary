<?php
/**
 * @var $accounts \app\models\User[]
 */

use yii\widgets\LinkPager;
use yii\helpers\Url;

(Yii::$app->request->get('sort') == 'asc') ? $sort = 'desc' : $sort = 'asc';

include_once Yii::$app->getBasePath() . '/views/components/admin-menu.php';
?>

<h1>Зарегестрированные пользователи</h1>

<?php // Search by email ?>
<form class="search_form" action="" method="get">
    <input type="search" name="acc_search" placeholder="Поиск по Email"
           value="<?= Yii::$app->request->get('acc_search') ?>">
    <input type="submit" value="Поиск">
</form>

<div class="container">
    <table>
        <tr class="table_account_header" data-column="<?= Yii::$app->request->get('column') ?>"
            data-sort="<?= Yii::$app->request->get('sort') ?>">
            <td class="number">№</td>
            <td id="column_id"><a href="?column=id&sort=<?= $sort ?>">ID</a></td>
            <td id="column_email"><a href="?column=email&sort=<?= $sort ?>">Email</a></td>
            <td id="column_nickname"><a href="?column=nickname&sort=<?= $sort ?>">Логин</a></td>
            <td id="column_activate_status">
                <a href="?column=activate_status&sort=<?= $sort ?>">Статус активации</a>
            </td>
            <td id="column_create_at"><a href="?column=create_at&sort=<?= $sort ?>">Дата создания</a></td>
            <td id="column_role"><a href="?column=role&sort=<?= $sort ?>">Роль</a></td>
            <td id="column_training_status">Статус обучения</td>
        </tr>

        <?php foreach ($accounts as $key => $account): ?>
            <tr>
                <td><?= ++$key ?></td>
                <td><?= $account->id ?></td>
                <td><a href="<?= Url::to(['account/' . $account->id]) ?>"><?= $account->email ?></a></td>
                <td><a href="<?= Url::to(['account/' . $account->id]) ?>"><?= $account->nickname ?></a></td>
                <td><?= $account->activate_status ?></td>
                <td><?= $account->create_at ?></td>
                <td><?= $account->role ?></td>
                <td>
                    <?php if ($account->id != $account->student->user_id): ?>
                        <div>Не обучается</div>
                        <div>
                            <a class="btn btn-success"
                               href="<?= Url::to(['training-status/change/' . $account->id]) ?>">
                                Добавить
                            </a>
                        </div>
                    <?php else: ?>
                        <div onclick="return activeCourse(this)">
                            <div class="learns">
                                <div>Обучается</div>
                            </div>
                            <div class="courses">
                                <?php foreach ($account->trainings as $training): ?>
                                    <div><?= mb_strimwidth($training->name, 0, 50, '...'); ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-success"
                               href="<?= Url::to(['training-status/change/' . $account->id]) ?>">
                                Добавить
                            </a>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>


<script>
    function activeCourse(e) {
        e.querySelector('.courses').classList.toggle('active');
    }
</script>