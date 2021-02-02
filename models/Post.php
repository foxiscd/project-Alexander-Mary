<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * Class Post
 * @package app\models
 *
 * @property int $id
 * @property string $picture
 * @property string $title
 * @property string $description
 * @property string $theme
 * @property string $author_id
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends ActiveRecord
{
    const PICTURE_POST_PATH = '/image/uploads/post/';

}