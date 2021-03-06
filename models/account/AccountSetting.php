<?php

namespace app\models\account;

use app\models\ImageInterface;
use yii\db\ActiveRecord;

/**
 * Class AccountSetting
 * @package app\models\account
 *
 * @property int $id
 * @property int $user_id
 * @property string $avatar
 * @property string $about_me
 * @property string $phone
 * @property string $address
 * @property string $first_name
 * @property string $last_name
 * @property string $birthday
 */
class AccountSetting extends ActiveRecord implements ImageInterface
{
    const ACCOUNT_AVATAR_DEFAULT = '/image/man.jpg';

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPicture()
    {
        return $this->avatar;
    }

    public function getDir()
    {
        return '/image/uploads/account/';
    }
}