<?php


namespace app\models\form;

use app\components\FileHandler;
use app\models\Photo;
use app\models\Post;
use phpDocumentor\Reflection\Types\This;
use yii\base\Model;
use Yii;

class PostForm extends Model
{
    public $file;
    public $title;
    public $description;
    public $theme;

    const SCENARIO_UPDATE_POST = 'update_post';
    const SCENARIO_ADD_POST = 'add_post';

    public function scenarios()
    {
        return [
            self::SCENARIO_ADD_POST => ['file', 'title', 'description', 'theme'],
            self::SCENARIO_UPDATE_POST => ['file', 'title', 'description', 'theme'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Загрузить',
            'title' => 'Заголовок',
            'description' => 'Текст',
            'theme' => 'Тема'
        ];
    }

    public function rules()
    {
        return [
            [['title', 'theme'], 'required'],
            ['file', 'file', 'extensions' => 'png, jpeg, jpg'],
            ['title', 'string', 'max' => '255'],
            [['description', 'title', 'theme'], 'trim'],
            [['description', 'title', 'theme'], 'string'],
            [['file', 'title', 'description', 'theme'], 'safe', 'on' => self::SCENARIO_UPDATE_POST],
        ];
    }

    public function addPost()
    {
        $post = new Post();
        $url = FileHandler::saveFile($this->file, $post);
        $post->picture = $url;
        $post->theme = $this->theme;
        $post->description = $this->description;
        $post->title = $this->title;
        $post->author_id = Yii::$app->user->getId();
        $post->updated_at = date("Y-m-d H:i:s");
        $post->created_at = date("Y-m-d H:i:s");
        return $post->save();
    }

    public function updatePost(Post $post)
    {
        if ($this->file) {
            FileHandler::deleteFile($post->getPicture());
            $url = FileHandler::saveFile($this->file, $post);
        }
        $post->picture = $url;
        $post->theme = $this->theme;
        $post->title = $this->title;
        $post->description = $this->description;
        $post->updated_at = date("Y-m-d H:i:s");
        $post->update();

        return $post->getAttributes();
    }

}