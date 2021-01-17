<?php


namespace app\controllers;

use app\models\form\LoginForm;


class Controller extends \yii\web\Controller
{
    public function getLoginForm()
    {
        $model = new LoginForm();
        return $model;
    }
}