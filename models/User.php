<?php

namespace app\models;

use app\models\account\AccountSetting;
use app\models\training\Student;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\training\Training;

/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $nickname
 * @property string $auth_token
 * @property int $activate_status
 * @property string $activate_code
 * @property string $create_at
 * @property string $update_at
 * @property string $role
 * @property string $training_status
 *
 * @property Training $training
 * @property Training[] $trainings
 * @property AccountSetting[] $accountSettings
 * @property AccountSetting $accountSetting
 */
class User extends ActiveRecord implements IdentityInterface
{

    /**
     * @param string $email
     * @return User|null
     */
    public static function findByEmail(string $email)
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
    public static function getAccountListByRequest(string $request,int $limit)
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
     * @return User|false
     */
    public static function checkAdmin()
    {
        $user = self::findIdentity(Yii::$app->user->getId());
        if ($user->role == 'admin')
            return $user;
        return false;
    }

    /**
     * @return bool
     */
    public static function checkUser(int $user_id)
    {
        if (Yii::$app->user->identity->getId() == $user_id){
            return true;
        }
        return false;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAuthKey()
    {
        return $this->auth_token;
    }

    /**
     * @param $password
     * @return bool
     */
    public function validPassword(string $password)
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
    public function validateStatus(string $activateStatus)
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

    /**
     * @return AccountSetting
     */
    public function getAccountSetting()
    {
        return $this->hasOne(AccountSetting::class, ['user_id' => 'id']);
    }

    /**
     * @return Student
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['user_id' => 'id']);
    }

    /**
     * @return Student[]
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['user_id' => 'id']);
    }

    public function getTraining()
    {
        return $this->hasOne(Training::class, ['id' => 'training_id'])
            ->viaTable(Student::tableName(), ['user_id' => 'id']);
    }

    public function getTrainings()
    {
        return $this->hasMany(Training::class, ['id' => 'training_id'])
            ->viaTable(Student::tableName(), ['user_id' => 'id']);
    }

}