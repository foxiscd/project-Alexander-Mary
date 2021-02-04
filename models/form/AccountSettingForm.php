<?php

namespace app\models\form;

use app\models\account\AccountSetting;
use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Class AccountSettingForm
 * @package app\models\form
 *
 * @property int $user_id
 * @property string $avatar
 * @property string $about_me
 * @property string $phone
 * @property string $address
 * @property string $first_name
 * @property string $last_name
 * @property string $birthday
 */
class AccountSettingForm extends Model
{
    public $avatar;
    public $about_me;
    public $phone;
    public $address;
    public $first_name;
    public $last_name;
    public $birthday;

    public function attributeLabels()
    {
        return [
            'avatar' => 'Фото',
            'about_me' => 'Обо мне',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'birthday' => 'Дата рождения',
        ];
    }

    public function rules()
    {
        return [
            ['avatar', 'file', 'extensions' => 'png, jpeg, jpg'],
            ['about_me', 'string', 'max' => 499],
            ['phone', 'match', 'pattern' => '/^(8)([0-9]{10})$/'],
            ['address', 'string', 'max' => 255],
            ['first_name', 'string', 'min' => '3', 'max' => 30],
            ['last_name', 'string', 'min' => '3', 'max' => 30],
            ['birthday', 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function add()
    {
        if ($this->avatar) {
            $url = AccountSetting::ACCOUNT_AVATAR_PATH;
            $url .= Yii::$app->user->id;
            mkdir(Yii::$app->basePath . '/web' . $url);
            $url .= '/' . $this->avatar->baseName . '.' . $this->avatar->extension;
            $this->avatar->saveAs('../web' . $url);
        } else {
            $url = AccountSetting::ACCOUNT_AVATAR_DEFAULT;
        }
        $setting = new AccountSetting();
        $setting->user_id = Yii::$app->user->id;
        $setting->avatar = $url ?: '';
        $setting->about_me = $this->about_me;
        $setting->phone = $this->phone;
        $setting->address = $this->address;
        $setting->first_name = $this->first_name;
        $setting->last_name = $this->last_name;
        $setting->birthday = $this->birthday;
        if ($setting->save()) {
            return $setting->getAttributes();
        }
        return false;
    }

    public function update(AccountSetting $setting)
    {
        if ($this->avatar) {
            $url = AccountSetting::ACCOUNT_AVATAR_PATH;
            $url .= Yii::$app->user->id;
            if (!is_dir(Yii::$app->basePath . '/web' . $url)) {
                mkdir(Yii::$app->basePath . '/web' . $url);
            }
            $url .= '/' . $this->avatar->baseName . '.' . $this->avatar->extension;
            $this->avatar->saveAs('../web' . $url);
            $setting->avatar = $url;
        }
        $setting->about_me = $this->about_me;
        $setting->phone = $this->phone;
        $setting->address = $this->address;
        $setting->first_name = $this->first_name;
        $setting->last_name = $this->last_name;
        $setting->birthday = $this->birthday;
        $setting->update();
        return $setting->getAttributes();
    }
}