<?php


namespace app\models\form;

use app\models\Photo;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;


/**
 * Class PhotoForm
 * @package app\models\form
 *
 * @property int $album_id
 * @property UploadedFile[] $file
 */
class PhotoForm extends Model
{
    public $file;
    public $album_id;

    const SCENARIO_UPDATE_PHOTO = 'update_photo';
    const SCENARIO_ADD_PHOTO = 'add_photo';

    public function scenarios()
    {
        return [
            self::SCENARIO_ADD_PHOTO => ['file', 'album_id'],
            self::SCENARIO_UPDATE_PHOTO => ['file', 'album_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Загрузить',
        ];
    }

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'png, jpeg, jpg', 'maxFiles' => 20, 'checkExtensionByMimeType' => false],
            ['album_id', 'string'],
            [['file'], 'file', 'extensions' => 'png, jpeg, jpg', 'on' => self::SCENARIO_UPDATE_PHOTO],
        ];
    }

    public function addPhoto()
    {
        if ($this->validate()) {
            foreach ($this->file as $file) {
                $url = Photo::PHOTO_PORTFOLIO_PATH . $file->baseName . '.' . $file->extension;
                $file->saveAs('../web' . $url);
                $photo = new Photo();
                $photo->picture = $url;
                $photo->album_id = $this->album_id;
                $photo->updated_at = date("Y-m-d H:i:s");
                $photo->created_at = date("Y-m-d H:i:s");

                if ($photo->save()) {
                    continue;
                }
                return false;
            }
            return true;
        }
    }

    public function updatePhoto(Photo $photo)
    {
        if ($this->file) {
            $url = Photo::PHOTO_PORTFOLIO_PATH . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs('../web' . $url);
            $photo->picture = $url;
        }
        $photo->album_id = $this->album_id;
        $photo->updated_at = date("Y-m-d H:i:s");
        $photo->update();
        return $photo->getAttributes();
    }

}