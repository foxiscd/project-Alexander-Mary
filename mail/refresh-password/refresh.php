<?php
/**
 * @var \app\models\User $user
 */
?>

Добро пожаловать на наш портал!<br>
Для сброса пароля перейдите по ссылке
<a href="http://alexandrova.mary/user/<?= $user->id ?>/refresh-password/<?= $user->auth_token ?>"><h1>Сюда</h1></a>
