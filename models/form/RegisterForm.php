<?php

namespace app\models\form;

use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Class RegisterForm
 * @package app\models\form
 */
class RegisterForm extends Model
{
    public $nickname;
    public $email;
    public $password;
    public $repeat_password;

    public function attributeLabels()
    {
        return [
            'nickname' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
        ];
    }

    public function rules()
    {
        return [
            [['nickname', 'email', 'password', 'repeat_password'], 'required'],
            [['nickname'], 'string', 'min' => 3],
            ['email', 'email'],
            ['email', 'string', 'min' => 5],
            ['password', 'string', 'min' => 6],
            ['repeat_password', 'string', 'min' => 6],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'operator' => '=='],
        ];
    }

    /**
     * @return User|false
     * @throws \yii\base\Exception
     */
    public function save()
    {
        $user = new User();
        if (User::findByEmail($this->email)) {
            Yii::$app->session->setFlash('error', 'Аккаунт с таким email существует');
            return false;
        }
        $user->email = $this->email;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->nickname = $this->nickname;
        $user->auth_token = Yii::$app->security->generateRandomString(32);
        $user->activate_code = Yii::$app->security->generateRandomString(32);
        $user->create_at = date("Y-m-d H:i:s");
        $user->update_at = date("Y-m-d H:i:s");

        if ($user->save())
            return $user;
        Yii::$app->session->setFlash('error', 'Ошибка регистрации, попробуйте снова');
        return false;
    }

}