<?php

namespace app\models\form;

use app\models\Mailer;
use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Class LoginForm
 * @package app\models\form
 *
 * @property string $email
 * @property string $password
 */
class LoginForm extends Model
{
    public $email;
    public $password;

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['email', 'required'],
            ['email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            if ($user = User::findByEmail($this->email)) {
                if ($user->activate_status > 0) {
                    return Yii::$app->user->login($user);
                } else {
                    Yii::$app->session->setFlash('error', 'Активируйте аккаунт через указанный email');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Аккаунта с таким email не существует');
            }
        }
        return false;
    }

    /**
     * @param $attribute
     * @param $params
     * @return bool
     */
    public function validatePassword($attribute, $params)
    {
        $user = User::findByEmail($this->email);

        if (!$user || !$user->validPassword($this->password)) {
            $this->addError($attribute, 'Пользователя с такими данными не существует');
            return false;
        }
        return true;
    }


}