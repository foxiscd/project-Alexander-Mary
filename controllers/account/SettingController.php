<?php


namespace app\controllers\account;

use app\controllers\Controller;
use app\models\account\AccountSetting;
use app\models\form\AccountSettingForm;
use app\models\form\PhotoForm;
use app\models\Photo;
use app\models\User;
use Yii;
use yii\web\UploadedFile;

class SettingController extends Controller
{

    /**
     * @param int $user_id
     * @return false|string
     */
    public function actionEdit(int $user_id)
    {
        if (User::checkUser($user_id)) {
            $model = new AccountSettingForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $model->avatar = UploadedFile::getInstance($model, 'avatar');
                if ($setting = AccountSetting::find()->where('user_id = ' . $user_id)->one()) {
                    return json_encode($model->update($setting), JSON_UNESCAPED_UNICODE);
                } else {
                    return json_encode($model->add(), JSON_UNESCAPED_UNICODE);
                }
            }

            return false;
        }

        Yii::$app->session->setFlash('error', 'У вас не хватает прав');
        $this->redirect(['main/index']);
    }

}