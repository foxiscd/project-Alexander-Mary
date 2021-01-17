<?php


namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Photo extends ActiveRecord
{
    const PHOTO_PORTFOLIO_PATH = '/image/uploads/portfolio/';

    public static function findByUrl($url)
    {
        return self::find()->where(['path' => $url])->one();
    }

    public static function getAllPhoto($limit = '')
    {
        return self::find()->limit($limit)->all();
    }

    public static function deletePhotoById($id)
    {
        $photo = self::findOne($id);
        return $photo->delete();
    }

    public function getDirectionRus()
    {
        $arrDirections = Yii::$app->params['directionsPhoto'];
        foreach ($arrDirections as $key => $direction){
            if ($this->directions == $key){
                return $direction;
            }
        }
    }
}