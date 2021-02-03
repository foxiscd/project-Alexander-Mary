<?php


namespace app\models\form;

use app\models\AlbumPhotoPortfolio;
use app\models\Photo;
use yii\base\Model;
use Yii;


/**
 * Class PhotoForm
 * @package app\models\form
 *
 * @property string $directions
 * @property string $cover
 * @property string $title
 * @property string $description
 * @property string $hidden
 * @property int $sort
 */
class AlbumPhotoPortfolioForm extends Model
{
    public $directions;
    public $cover;
    public $title;
    public $description;
    public $hidden;
    public $sort;

    const SCENARIO_UPDATE_ALBUM = 'update_photo';
    const SCENARIO_ADD_ALBUM = 'add_photo';

    public function scenarios()
    {
        return [
            self::SCENARIO_ADD_ALBUM => ['cover', 'directions', 'title', 'description', 'sort', 'hidden'],
            self::SCENARIO_UPDATE_ALBUM => ['cover', 'title', 'description', 'sort', 'hidden'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'directions' => 'Направление съемки',
            'cover' => 'Обложка',
            'title' => 'Название',
            'description' => 'Описание',
            'sort' => 'Сортировка',
            'hidden' => 'Скрыть блок',
        ];
    }

    public function rules()
    {
        return [
            [['directions'], 'required'],
            [['directions'], 'string'],
            ['cover', 'string'],
            ['title', 'string', 'max' => '50'],
            [['description', 'title'], 'trim'],
            ['description', 'string'],
            ['sort', 'integer'],
            ['hidden', 'string'],
            [['cover', 'title', 'description'], 'string', 'on' => self::SCENARIO_UPDATE_ALBUM],
        ];
    }

    public function addAlbum()
    {
        $album = new AlbumPhotoPortfolio();
        $album->directions = $this->directions;
        $album->cover = $this->cover;
        $album->description = $this->description;
        $album->title = $this->title;
        $album->updated_at = date("Y-m-d H:i:s");
        $album->created_at = date("Y-m-d H:i:s");
        return $album->save();
    }

    public function updateAlbum(AlbumPhotoPortfolio $album)
    {
        $album->cover = $this->cover;
        $album->title = $this->title;
        $album->description = $this->description;
        $album->updated_at = date("Y-m-d H:i:s");
        if ($this->sort) {
            $album->sort = $this->sort;
        }
        if ($this->hidden) {
            $album->hidden = $this->hidden;
        }
        $album->update();
        return $album->getAttributes();
    }

}