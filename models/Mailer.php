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
        Yii::$app->mailer->compose('layouts/register', ['userId' => $user->id, 'code' => $user->activate_code])
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo($user->email)
            ->setSubject('Регистрация аккаунта')
            ->send();
    }

}