<?php

namespace app\controllers;

use app\api\Vkontakte;
use app\models\form\LoginForm;
use app\models\form\RegisterForm;
use app\models\Mailer;
use app\models\User;
use yii\web\Controller;
use Yii;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{

    /**
     * @return string
     */
    public function actionRegister()
    {
        $model = new RegisterForm();

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
    public function actionLoginVk()
    {
        $code = Yii::$app->request->get('code');

        if (!$code) {
            Yii::$app->session->setFlash('error', 'Ошибка авторизации, попробуйте снова, либо совершие вход через регистрацию пользователя');
            return $this->redirect(['main/index']);
        }

        $user = new User();
        $data = Vkontakte::dataAccess($code);

        if (isset($data['email'])) {
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
     * @param $id
     * @param $code
     */
    public function actionActivation(string $id ,string $code)
    {
        if ($user = User::findIdentity($id)){
            $user->activateAccount($code);
        }
        $this->redirect(['main/index']);
    }

}