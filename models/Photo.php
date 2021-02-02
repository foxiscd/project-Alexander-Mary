<?php


namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * Class Photo
 * @package app\models
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $picture
 * @property string $directions
 * @property string $description
 * @property string $title
 */
class Photo extends ActiveRecord
{
    const PHOTO_PORTFOLIO_PATH = '/image/uploads/portfolio/';

    /**
     * @param string $url
     * @return array|ActiveRecord|null
     */
    public static function findByUrl(string $url)
    {
        return self::find()->where(['path' => $url])->one();
    }

    /**
     * @param string $limit
     * @return array|self[]
     */
    public static function getAllPhoto($limit = '')
    {
        return self::find()->limit($limit)->all();
    }

    /**
     * @param int $id
     * @return false|true
     */
    public static function deletePhotoById(int $id)
    {
        $photo = self::findOne($id);
        return $photo->delete();
    }

    /**
     * @return mixed
     */
    public function getDirectionRus()
    {
        $arrDirections = Yii::$app->params['directionsPhoto'];
        foreach ($arrDirections as $key => $direction) {
            if ($this->directions == $key) {
                return $direction;
            }
        }
    }
}