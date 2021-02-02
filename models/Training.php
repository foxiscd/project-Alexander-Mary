<?php


namespace app\models;


use app\models\training\Student;
use yii\db\ActiveRecord;


/**
 * Class Training
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property string $training_code
 * @property string $date_valid
 *
 * @property Student $student
 * @property Student[] $students
 */
class Training extends ActiveRecord
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['training_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['training_id' => 'id']);
    }

    /**
     * @param string $training_code
     * @return array|ActiveRecord|null
     */
    public static function findOneByCode(string $training_code)
    {
        return self::find()->where(['training_code' => $training_code])->one();
    }

}