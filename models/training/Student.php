<?php

namespace app\models\training;

use app\models\User;
use yii\db\ActiveRecord;

/**
 * Class Student
 * @package app\models\training
 *
 * @property int $user_id
 * @property int $training_id
 */
class Student extends ActiveRecord
{

    public function getTraining()
    {
        return $this->hasOne(Training::className(), ['id' => 'training_id']);
    }

    public function addStudentOfTheCourse(int $user_id, int $training_id)
    {
        $this->user_id = $user_id;
        $this->training_id = $training_id;
        return $this->save();
    }

    public function getStudent($user_id = null, $training_id = null)
    {
        return self::find()->where(['user_id' => $user_id, 'training_id' => $training_id])->one();
    }

}