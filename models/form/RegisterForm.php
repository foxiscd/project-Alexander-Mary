<?php

namespace app\models\form;

use app\models\Mailer;
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

    const SCENARIO_REFRESH_PASSWORD = 'refresh-password';
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_NEW_PASSWORD = 'new-password';

    public function scenarios()
    {
        return [
            self::SCENARIO_REFRESH_PASSWORD => ['email'],
            self::SCENARIO_REGISTER => ['password', 'email', 'nickname', 'repeat_password'],
            self::SCENARIO_NEW_PASSWORD => ['password', 'repeat_password'],
        ];
    }

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

    public function refreshPassword()
    {
        if (!empty($this->email) && $this->validate()) {
            if ($user = User::findByEmail($this->email)) {
                if (Mailer::sendMailRefreshPassword($user)) {
                    return true;
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка отправки сообщения');
                }
            }
        }
        return false;
    }

    public function newPassword(User $user)
    {
        if (!empty($this->password) && $this->validate()) {
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $user->activate_status = Yii::$app->params['statusRegister'];
            $user->auth_token = Yii::$app->security->generateRandomString(32);
            return $user->save();
        }
        return false;
    }
}