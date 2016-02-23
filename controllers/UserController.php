<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Classroom;


class UserController extends Controller
{

    public function actionRaise()
    {
        User::changeState();
        return $this->render('//site/index', ['users' => Classroom::getAllUserInClassroom(),
            'date' => Classroom::getLastChangeTime()]);

    }

}
