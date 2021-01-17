<?php

namespace app\models\account;

use yii\db\ActiveRecord;

class AccountSetting extends ActiveRecord
{
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}