<?php

namespace app\controllers;

use app\api\Vkontakte;
use app\models\AlbumPhotoPortfolio;
use app\models\form\AccountSettingForm;
use app\models\form\LoginForm;
use app\models\form\RegisterForm;
use app\models\Mailer;
use app\models\User;
use Yii;
use app\components\AuthHandler;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{

    public function actions()
    {
        return [
          'auth' => [
              'class' => 'yii\authclient\AuthAction',
              'successCallback' => [$this, 'onAuthSuccess'],
          ]
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        $model = new RegisterForm();
        $model->scenario = RegisterForm::SCENARIO_REGISTER;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->save()) {
                Mailer::sendMailRegister($user);
                Yii::$app->session->setFlash('success', 'Потвердите регистрацию через сообщение, которое пришло на указанный Email');

                return $this->redirect(['main/index']);
            }
        }
        return $this->render('register', ['model' => $model]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['main/index']);
        }
        return $this->render('login', ['model' => $model]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLoginVk(string $code = null)
    {
        if (empty($code)) {
            $url = Vkontakte::authorizeUrl();
            return $this->redirect($url);
        }

        $data = Vkontakte::dataAccess($code);
        if (isset($data['email'])) {
            $user = new User();
            if (User::findByEmail($data['email'])) {
                $user->loginVk($data);
            } else {
                $user->registerVk($data);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка авторизаци, попробуйте снова');
        }
        return $this->redirect(['main/index']);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        $this->redirect(['main/index']);
    }

    /**
     * @param string $id
     * @param string $code
     */
    public function actionActivation(string $id, string $code)
    {
        if ($user = User::findIdentity($id)) {
            $user->activateAccount($code);
            if (Yii::$app->user->login($user)) {
                $model = new AccountSettingForm();
                $model->add();
            }
        }
        $this->redirect(['main/index']);
    }

    public function actionRefreshPassword()
    {
        $model = new RegisterForm();
        $model->scenario = RegisterForm::SCENARIO_REFRESH_PASSWORD;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->refreshPassword()) {
                Yii::$app->session->setFlash('success', 'Перейдите по ссылке, которая пришла на указанный Email');
            } else {
                if (empty(Yii::$app->session->getFlash('error'))) {
                    Yii::$app->session->setFlash('error', 'Пользователя с указаным email не существует');
                }
            }
        }
        return $this->render('refresh-password', ['model' => $model]);
    }

    public function actionRefresh(int $id, string $token)
    {
        $model = new RegisterForm();
        $model->scenario = RegisterForm::SCENARIO_NEW_PASSWORD;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findOne($id);
            if ($user->auth_token == $token && $model->newPassword($user)) {
                return $this->redirect(['main/index']);
            }
        }
        return $this->render('refresh', ['model' => $model]);
    }

}