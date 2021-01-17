<?php

namespace app\controllers\admin;

use app\controllers\Controller;
use app\models\form\PhotoForm;
use app\models\form\PostForm;
use app\models\Photo;
use app\models\Post;
use app\models\User;
use yii\data\Pagination;
use Yii;

/**
 * Class PanelController
 * @package app\controllers\admin
 */
class PanelController extends Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        if ($user = User::checkAdmin()) {
            return $this->render('index', []);
        }
        return $this->redirect(['main/index']);
    }

    /**
     * @param string $column
     * @param string $sort
     * @return string|\yii\web\Response
     */
    public function actionAccountList(string $column = 'id', string $sort = 'asc', string $acc_search = null)
    {
        if ($user = User::checkAdmin()) {

            $query = User::find();
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => Yii::$app->params['accountPageSize']]);
            $accounts = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy($column . ' ' . $sort)
                ->all();
            if (!empty($acc_search)) {
                $query = User::find();
                $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => Yii::$app->params['accountPageSize']]);
                $accounts = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->where(['like', 'email', $acc_search])
                    ->all();
            }

            return $this->render('accounts-list', ['accounts' => $accounts, 'pages' => $pages]);
        }
        return $this->redirect(['main/index']);
    }

    /**
     * @return string
     */
    public function actionHelp()
    {
        return $this->render('help', []);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionPhoto()
    {
        if ($user = User::checkAdmin()) {

            $modelPhoto = new PhotoForm();
            $modelPhoto->scenario = PhotoForm::SCENARIO_UPDATE_PHOTO;

            $query = Photo::find();
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => Yii::$app->params['adminPageSize']]);
            $photos = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('photo', ['photos' => $photos, 'pages' => $pages, 'modelPhoto' => $modelPhoto]);
        }
        return $this->redirect(['main/index']);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionPosts()
    {
        if ($user = User::checkAdmin()) {

            $modelPost = new PostForm();
            $modelPost->scenario = PhotoForm::SCENARIO_UPDATE_PHOTO;

            $query = Post::find();
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => Yii::$app->params['adminPageSize']]);
            $posts = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('posts', ['posts' => $posts, 'pages' => $pages, 'modelPost' => $modelPost]);
        }
        return $this->redirect(['main/index']);
    }
}