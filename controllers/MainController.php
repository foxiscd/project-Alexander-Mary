<?php
namespace app\controllers;

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
        $photos = Photo::getAllPhoto();
        return $this->render('portfolio', ['photos' => $photos]);
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