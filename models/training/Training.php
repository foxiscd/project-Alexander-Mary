<?php

namespace app\models\training;

use yii\db\ActiveRecord;

class Training extends ActiveRecord
{
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'training_id']);
    }

}