<?php


namespace app\controllers\account;

use app\controllers\Controller;
use app\models\Training;
use app\models\training\Student;
use app\models\User;
use Yii;

class TrainingController extends Controller
{
    public function actionChange(int $id)
    {
        if (User::checkAdmin()) {
            if ($status_code = Yii::$app->request->get('status_code')) {
                $student = new Student();
                $training = Training::findOneByCode($status_code);
                if ($student->addStudentOfTheCourse($id, $training->id))
                    return $this->redirect(['admin/panel/account-list']);
                Yii::$app->session->setFlash('error', 'Ошибка записи, попробуйте снова');
            } else {
                $trainings = Training::find()->all();
                return $this->render('change', ['trainings' => $trainings, 'user' => User::findOne($id)]);
            }
        }
    }

}