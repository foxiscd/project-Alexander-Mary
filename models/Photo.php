<?php


namespace app\models;

use app\models\ImageInterface;
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
 * @property string $album_id
 */
class Photo extends ActiveRecord implements ImageInterface
{

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
        if (is_file($_SERVER['DOCUMENT_ROOT'] . $photo->picture)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $photo->picture);
        }
        return $photo->delete();
    }

    /**
     * @return bool
     */
    public function deleteAlbumId()
    {
        $this->album_id = 0;
        return $this->save();
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return string
     */
    public function getDir()
    {
        return '/image/uploads/portfolio/';
    }

}