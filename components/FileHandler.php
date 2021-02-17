<?php


namespace app\components;

use Yii;
use yii\base\Model;

/**
 * Class FileHandler
 * @package app\components
 */
class FileHandler
{
    /**
     * @param $file
     * @param ImageInterface $model
     * @return string
     */
    public static function saveFile($file, ImageInterface $model)
    {
        $url = $model->getDir();
        $url .= Yii::$app->user->id . '/';
        if (!is_dir(Yii::$app->basePath . '/web' . $url)) {
            mkdir(Yii::$app->basePath . '/web' . $url);
        }
        $url .= $file->baseName . '.' . $file->extension;
        $file->saveAs('../web' . $url);
        return $url;
    }

    /**
     * @param string $path
     * @return bool
     */
    public static function deleteFile(string $path)
    {
        if (!is_dir($path)) {
            return unlink(Yii::$app->basePath . '/web' . $path);
        }
    }
}