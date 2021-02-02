<?php


namespace app\controllers\account;

use app\controllers\Controller;
use app\models\account\AccountSetting;
use app\models\form\AccountSettingForm;
use app\models\User;
use Yii;

/**
 * Class AccountCardController
 * @package app\controllers\account
 */
class AccountCardController extends Controller
{
    /**
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionSettingsIndex(int $id)
    {
        if (User::checkUser($id)) {
            $user = User::findOne($id);
            $model = new AccountSettingForm();
            return $this->render('settings/index', ['user' => $user, 'model' => $model]);
        }
        return $this->redirect(['main/index']);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionView(int $id)
    {
        $user = User::findOne($id);
        return $this->render('view', ['user' => $user]);
    }
}