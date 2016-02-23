<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Classroom;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest && empty(Yii::$app->request->post())) {
            $user = new User();
            return $this->render('login', [
                'model' => $user,
            ]);
        } else if (Yii::$app->user->isGuest && !empty(Yii::$app->request->post())) {
            $user = new User();
            $user->name = Yii::$app->request->post('User')['name'];
            $user->handState = 0;
            $user->insert();
            if ($user->login()) {
                return $this->render('index', ['users' => Classroom::getAllUserInClassroom(),
                    'date' => Classroom::getLastChangeTime()]);
            }
        } else {
            return $this->render('index', ['users' => Classroom::getAllUserInClassroom(),
                'date' => Classroom::getLastChangeTime()]);
        }
    }

    public function actionLogout()
    {
        User::deleteAll(['id' => Yii::$app->user->id]);
        Classroom::updateTs();
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
