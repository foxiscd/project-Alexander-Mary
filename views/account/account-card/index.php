<?php
/**
 * @var $user \app\models\User
 */

$settings = $user->accountSetting;
?>
<h1>Аккаунт пользователя</h1>
<div class="acc_profile">
    <div class="item">
        <div><?= $user->nickname ?></div>
        <div><?= $settings->avatar ?></div>
    </div>
    <div class="item"><?= $user->email ?></div>
    <div class="item"><?= $user->create_at ?></div>
    <div class="item"><?= $settings->phone ?></div>
    <div class="item"><?= $settings->address ?></div>
</div>

<style>

</style>