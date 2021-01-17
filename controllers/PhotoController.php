<?php

namespace app\controllers;

use app\models\form\PhotoForm;
use app\models\Photo;
use app\models\User;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

/**
 * Class PhotoController
 * @package app\controllers
 */
class PhotoController extends Controller
{

    /**
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        Yii::$app->view->title = 'Добавить фото';
        if (User::checkAdmin()) {
            $modelPhoto = new PhotoForm();
            $modelPhoto->scenario = PhotoForm::SCENARIO_ADD_PHOTO;
            if ($modelPhoto->load(Yii::$app->request->post()) && $modelPhoto->validate()) {
                $modelPhoto->file = UploadedFile::getInstance($modelPhoto, 'file');
                $modelPhoto->addPhoto();
            }
            return $this->render('add', ['modelPhoto' => $modelPhoto]);
        }
        Yii::$app->session->setFlash('error', 'Вы не являетесь администратором');
        return $this->redirect(['main/index']);
    }


    /**
     * @param int $id
     * @return false|string
     */
    public function actionEdit(int $id)
    {
        Yii::$app->view->title = 'Изменить фото';
        if (User::checkAdmin()) {
            if (Yii::$app->request->isAjax) {

                $modelPhoto = new PhotoForm();
                $modelPhoto->scenario = PhotoForm::SCENARIO_UPDATE_PHOTO;

                if ($modelPhoto->load(Yii::$app->request->post()) && $modelPhoto->validate()) {
                    $photo = Photo::findOne($id);
                    $modelPhoto->file = UploadedFile::getInstance($modelPhoto, 'file');
                    return json_encode($modelPhoto->updatePhoto($photo) , JSON_UNESCAPED_UNICODE);
                }
                return false;
            }
        }
        Yii::$app->session->setFlash('error', 'Вы не являетесь администратором');
        $this->redirect(['main/index']);
    }

    /**
     * @param int $id
     */
    public function actionDelete(int $id)
    {
        Yii::$app->view->title = 'Удалить фото';
        if (User::checkAdmin()) {
            if (Yii::$app->request->isAjax) {
                Photo::deletePhotoById($id);
            }
        }
    }

}