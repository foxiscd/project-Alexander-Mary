<?php


namespace app\controllers;


use app\controllers\behaviors\AccessBehavior;
use app\models\AlbumPhotoPortfolio;
use app\models\form\AlbumPhotoPortfolioForm;
use app\models\Photo;
use app\models\User;
use Yii;

class AlbumPhotoPortfolioController extends Controller
{

    /**
     * @param int $id
     * @return string
     */
    public function actionView(int $id)
    {
        $album = AlbumPhotoPortfolio::findOne($id);

        Yii::$app->view->title = $album->title;
        $photos = Photo::find()->where('album_id = ' . $id)->all();

        return $this->render('view', ['album' => $album, 'photos' => $photos]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        Yii::$app->view->title = 'Добавление альбома';

        $model = new AlbumPhotoPortfolioForm();
        $model->scenario = AlbumPhotoPortfolioForm::SCENARIO_ADD_ALBUM;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->addAlbum();
        }
        return $this->render('add', ['model' => $model]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionEdit(int $id)
    {
        Yii::$app->view->title = 'Изменение альбома';

        $album = AlbumPhotoPortfolio::findOne($id);
        $modelAlbum = new AlbumPhotoPortfolioForm();
        $modelAlbum->scenario = AlbumPhotoPortfolioForm::SCENARIO_UPDATE_ALBUM;
        if ($modelAlbum->load(Yii::$app->request->post()) && $modelAlbum->validate()) {
            $modelAlbum->updateAlbum($album);
        }
        $photos = Photo::find()->where('album_id = ' . $id)->all();
        return $this->render('edit', ['album' => $album, 'photos' => $photos, 'modelAlbum' => $modelAlbum]);
    }
}