<?php
/**
 * @var $accounts \app\models\User
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
            </tr>
        <?php endforeach; ?>

    </table>
    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>
