<?php


namespace app\controllers;

use app\models\form\LoginForm;

/**
 * Class Controller
 * @package app\controllers
 */
class Controller extends \yii\web\Controller
{
    /**
     * @return LoginForm
     */
    public function getLoginForm()
    {
        return new LoginForm();
    }
}