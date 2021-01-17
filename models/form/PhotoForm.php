<?php


namespace app\models\form;

use app\models\Photo;
use yii\base\Model;
use Yii;

class PhotoForm extends Model
{
    public $directions;
    public $file;
    public $title;
    public $description;

    const SCENARIO_UPDATE_PHOTO = 'update_photo';
    const SCENARIO_ADD_PHOTO = 'add_photo';

    public function scenarios()
    {
        return [
            self::SCENARIO_ADD_PHOTO => ['file', 'directions', 'title', 'description'],
            self::SCENARIO_UPDATE_PHOTO => ['file', 'title', 'description'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'directions' => 'Направление съемки',
            'file' => 'Загрузить',
            'title' => 'Название',
            'description' => 'Описание',
        ];
    }

    public function rules()
    {
        return [
            [['directions'], 'required'],
            [['directions'], 'string'],
            ['file', 'file', 'extensions' => 'png, jpeg, jpg'],
            ['title', 'string', 'max' => '50'],
            [['description', 'title'], 'trim'],
            ['description', 'string'],
            [['file', 'title', 'description'], 'safe', 'on' => self::SCENARIO_UPDATE_PHOTO],
        ];
    }

    public function addPhoto()
    {
        $url = Photo::PHOTO_PORTFOLIO_PATH . $this->file->baseName . '.' . $this->file->extension;
        $this->file->saveAs('../web' . $url);
        $photo = new Photo();
        $photo->directions = $this->directions;
        $photo->picture = $url;
        $photo->description = $this->description;
        $photo->title = $this->title;
        $photo->updated_at = date("Y-m-d H:i:s");
        $photo->created_at = date("Y-m-d H:i:s");
            return $photo->save();
    }

    public function updatePhoto(Photo $photo)
    {
        if ($this->file){
            $url = Photo::PHOTO_PORTFOLIO_PATH . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs('../web' . $url);
            $photo->picture = $url;
        }
        if ($this->title)
            $photo->title = $this->title;
        if ($this->description)
            $photo->description = $this->description;
        $photo->updated_at = date("Y-m-d H:i:s");
        $photo->update();
        return $photo->getAttributes();
    }

}