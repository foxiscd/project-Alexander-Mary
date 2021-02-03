<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "album_photo_portfolio".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $directions
 * @property string $cover
 * @property string $title
 * @property string $description
 * @property string $hidden
 * @property int $sort
 */
class AlbumPhotoPortfolio extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'album_photo_portfolio';
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

    public function getPhotos()
    {
        return $this->hasMany(Photo::class , ['album_id'=>'id']);
    }
}
