<?php

namespace app\models;

use app\models\account\AccountSetting;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @param $email
     * @return User|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public static function getAccountListByRequest($request, $limit)
    {
        return self::find()->orderBy($request . 'DESC')->limit($limit)->all();
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return User|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_token' => $token]);
    }

    /**
     * @return User|false|IdentityInterface|null
     */
    public static function checkAdmin()
    {
        $user = self::findIdentity(Yii::$app->user->getId());
        if ($user->role == 'admin')
            return $user;
        return false;
    }

    /**
     * @return int|mixed|string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed|string|null
     */
    public function getAuthKey()
    {
        return $this->auth_token;
    }

    /**
     * @param $password
     * @return bool
     */
    public function validPassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $activateStatus
     * @return bool
     */
    public function validateStatus($activateStatus)
    {
        return $this->activate_status == $activateStatus;
    }

    /**
     * @param $data
     * @return bool
     */
    public function registerVk(array $data): bool
    {
        $this->email = $data['email'];
        $this->password_hash = self::getRandomPassword();
        $this->nickname = $data['nickname'] ?: $data['first_name'];
        $this->auth_token = $data['access_token'];
        $this->activate_status = Yii::$app->params['statusVk'];
        $this->create_at = date("Y-m-d H:i:s");
        $this->update_at = date("Y-m-d H:i:s");
        if ($this->save()) {
            Yii::$app->user->login($this);
            return true;
        }
        return false;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public static function getRandomPassword()
    {
        return Yii::$app->security->generatePasswordHash(md5(16) . md5(16));
    }

    /**
     * @param $data
     * @return bool
     */
    public function loginVk(array $data): bool
    {
        $user = self::findByEmail($data['email']);
        return Yii::$app->user->login($user);
    }

    /**
     * @param string $code
     * @return bool
     */
    public function activateAccount(string $code): bool
    {
        if ($this->activate_code == $code)
            $this->activate_status = Yii::$app->params['statusRegister'];
        return $this->save();
    }

    public function getAccountSetting()
    {
        return $this->hasOne(AccountSetting::className(), ['user_id'=>'id']);
    }

    public function getParent() {
        return $this->hasOne(self::className(), ['id' => 'user_id']);
    }
}