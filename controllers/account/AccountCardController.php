<?php


namespace app\controllers\account;

use app\models\account\AccountSetting;
use app\models\User;
use yii\web\Controller;
use Yii;

/**
 * Class AccountCardController
 * @package app\controllers\account
 */
class AccountCardController extends Controller
{
    public function actionIndex($id)
    {
        $user = User::findOne($id);
        return $this->render('index', ['user'=>$user]);
    }
}