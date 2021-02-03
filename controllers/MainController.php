<?php
namespace app\controllers;

use app\models\AlbumPhotoPortfolio;
use app\models\Photo;
use Yii;

/**
 * Class MainController
 * @package app\controllers
 */
class MainController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->layout = 'main';
        Yii::$app->view->title = 'Главная';
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionPortfolio()
    {
        $this->layout = 'default';
        Yii::$app->view->title = 'Мои работы';
        $albums = AlbumPhotoPortfolio::find()->orderBy('sort')->all();
        return $this->render('portfolio', ['albums' => $albums]);
    }

    /**
     * @return string
     */
    public function actionPrice()
    {
        Yii::$app->view->title = 'Стоимость';
        return $this->render('price');
    }

    /**
     * @return string
     */
    public function actionContacts()
    {
        Yii::$app->view->title = 'Контакты';
        return $this->render('contacts');
    }

}