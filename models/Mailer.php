<?php

namespace app\models;

use Yii;

class Mailer extends \yii\swiftmailer\Mailer
{
    /**
     * @param User $user
     */
    public static function sendMailRegister(User $user)
    {
        return Yii::$app->mailer->compose('layouts/register', ['userId' => $user->id, 'code' => $user->activate_code])
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo($user->email)
            ->setSubject('Регистрация аккаунта')
            ->send();
    }

    /**
     * @param string $email
     * @param string $code
     */
    public static function sendMailRefreshPassword(User $user)
    {
        return Yii::$app->mailer->compose('refresh-password/refresh', ['user' => $user])
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo($user->email)
            ->setSubject('Восстановление пароля на сайте ' . Yii::$app->getHomeUrl())
            ->send();
    }

}