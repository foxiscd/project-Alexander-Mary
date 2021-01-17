<?php
namespace app\controllers;

use app\models\form\PostForm;
use app\models\Photo;
use app\models\Post;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class PostController extends Controller
{

    public function actionDetail($id)
    {
        $post = Post::findOne($id);

        return $this->render('detail' , ['post'=>$post]);
    }

    public function actionAdd()
    {
        if (User::checkAdmin()) {
            $modelPost = new PostForm();
            $modelPost->scenario = PostForm::SCENARIO_ADD_POST;

            if ($modelPost->load(Yii::$app->request->post()) && $modelPost->validate()) {
                $modelPost->file = UploadedFile::getInstance($modelPost, 'file');
                $modelPost->addPost();
            }
            return $this->render('add', ['modelPost' => $modelPost]);
        }
        Yii::$app->session->setFlash('error', 'Вы не являетесь администратором');
        return $this->redirect(['main/index']);
    }

    public function actionEdit($id)
    {
        if (User::checkAdmin()) {
            if (Yii::$app->request->isAjax) {

                $modelPost = new PostForm();
                $modelPost->scenario = PostForm::SCENARIO_UPDATE_POST;

                if ($modelPost->load(Yii::$app->request->post()) && $modelPost->validate()) {
                    $post = Post::findOne($id);
                    $modelPost->file = UploadedFile::getInstance($modelPost, 'file');
                    return json_encode($modelPost->updatePost($post) , JSON_UNESCAPED_UNICODE);
                }
                return false;
            }
        }
        Yii::$app->session->setFlash('error', 'Вы не являетесь администратором');
        $this->redirect(['main/index']);
    }

    public function actionDelete($id)
    {
        if (User::checkAdmin()) {
            if (Yii::$app->request->isAjax) {
                Photo::deletePhotoById($id);
            }
        }
    }

}
