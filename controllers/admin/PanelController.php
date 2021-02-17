<?php

namespace app\controllers\admin;

use app\controllers\behaviors\AccessBehavior;
use app\controllers\Controller;
use app\models\AlbumPhotoPortfolio;
use app\models\form\PhotoForm;
use app\models\form\PostForm;
use app\models\Photo;
use app\models\Post;
use app\models\User;
use yii\data\Pagination;
use Yii;
use yii\db\Query;

/**
 * Class PanelController
 * @package app\controllers\admin
 */
class PanelController extends Controller
{

    /**
     * @return string[]
     */
    public function behaviors()
    {
        return [
            AccessBehavior::class,
        ];
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        return $this->render('index', []);

    }


    /**
     * @param string $column
     * @param string $sort
     * @return string|\yii\web\Response
     */
    public function actionAccountList(string $column = 'id', string $sort = 'asc', string $acc_search = null)
    {
        $query = User::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => Yii::$app->params['accountPageSize']]);
        if (!empty($acc_search)) {
            $query = User::find();
            $accounts = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->where(['like', 'email', $acc_search])
                ->all();
        } else {
            $accounts = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy($column . ' ' . $sort)
                ->all();
        }

        return $this->render('accounts-list', ['accounts' => $accounts, 'pages' => $pages]);
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
        $albums = AlbumPhotoPortfolio::find()->all();
        $modelPhoto = new PhotoForm();
        $modelPhoto->scenario = PhotoForm::SCENARIO_UPDATE_PHOTO;

        $query = Photo::find()->where('album_id = 0 OR album_id IS NULL');
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => Yii::$app->params['adminPageSize']]);
        $photos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('photo', [
            'photos' => $photos,
            'pages' => $pages,
            'modelPhoto' => $modelPhoto,
            'albums' => $albums,
        ]);
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionPosts()
    {
        $modelPost = new PostForm();
        $modelPost->scenario = PhotoForm::SCENARIO_UPDATE_PHOTO;

        $query = Post::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => '3']);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('posts', ['posts' => $posts, 'pages' => $pages, 'modelPost' => $modelPost]);
    }
}