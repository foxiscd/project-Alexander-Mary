<?php

namespace app\controllers;

use app\controllers\behaviors\AccessBehavior;
use app\models\form\PostForm;
use app\models\Photo;
use app\models\Post;
use app\models\User;
use Yii;
use yii\web\UploadedFile;

/**
 * Class PostController
 * @package app\controllers
 */
class PostController extends Controller
{

    public function behaviors()
    {
        return [
            AccessBehavior::class,
        ];
    }


    /**
     * @param int $id
     * @return string
     */
    public function actionDetail(int $id)
    {
        $post = Post::findOne($id);

        return $this->render('detail', ['post' => $post]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $modelPost = new PostForm();
        $modelPost->scenario = PostForm::SCENARIO_ADD_POST;

        if ($modelPost->load(Yii::$app->request->post()) && $modelPost->validate()) {
            $modelPost->file = UploadedFile::getInstance($modelPost, 'file');
            $modelPost->addPost();
        }

        return $this->render('add', ['modelPost' => $modelPost]);
    }

    /**
     * @param int $id
     * @return false|string
     */
    public function actionEdit(int $id)
    {
        if (Yii::$app->request->isAjax) {
            $modelPost = new PostForm();
            $modelPost->scenario = PostForm::SCENARIO_UPDATE_POST;

            if ($modelPost->load(Yii::$app->request->post()) && $modelPost->validate()) {
                $post = Post::findOne($id);
                $modelPost->file = UploadedFile::getInstance($modelPost, 'file');
                return json_encode($modelPost->updatePost($post), JSON_UNESCAPED_UNICODE);
            }

            echo 'error';
        }
    }

    /**
     * @param int $id
     */
    public function actionDelete(int $id)
    {
        if (Yii::$app->request->isAjax) {
            Photo::deletePhotoById($id);
        }
    }

}
