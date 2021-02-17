<?php

namespace app\controllers\behaviors;

use app\models\User;
use yii\base\Behavior;
use Yii;
use yii\web\Controller;

class AccessBehavior extends Behavior
{

    /**
     * @return string[]
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'checkAdminAccess',
        ];
    }


    /**
     * @return \yii\web\Response
     */
    public function checkAdminAccess()
    {
        $user = User::findIdentity(Yii::$app->user->getId());
        if (empty($user) || $user->role !== 'admin') {
            return Yii::$app->controller->redirect(['main/index']);
        }
    }

}