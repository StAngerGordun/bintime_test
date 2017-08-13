<?php

namespace app\controllers;

use app\models\Addresses;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CustomerForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    
        $users = User::find()
            ->innerJoinWith(['addresses'])
            ->innerJoinWith(['gender'])
            ->all();
        return $this->render('index', ['users' => $users]);
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        return $this->goHome();
    }
    
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
        {
            Yii::$app->session->setFlash('contactFormSubmitted');
            
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionCustomer()
    {
        $model = CustomerForm::getInstance();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $customerData = Yii::$app->request->post()['CustomerForm'];
            $user = new User();
            $user->name = $customerData['name'];
            $user->surname = $customerData['surname'];
            $user->login = $customerData['login'];
            $user->password = $customerData['password'];
            $user->gender = $customerData['gender'];
            $user->save();
            
           
            
            $count = count($customerData['country']);
            for ($i = 0; $i < $count; $i++)
            {
                $addresses = new Addresses();
                $addresses->user_id = $user->id;
                $addresses->country = $customerData['country'][$i];
                $addresses->country_short = $customerData['country_short'][$i];
                $addresses->city = $customerData['locality'][$i];
                $addresses->street = $customerData['street'][$i];
                $addresses->street_number = $customerData['street_number'][$i];
                $addresses->postal_code = $customerData['postal_code'][$i];
                $addresses->office_number = $customerData['office_number'][$i];
                $addresses->save();
            }
            
            return $this->redirect(['site/index']);
        }
        else
            return $this->render('site/customer', ['model' => $model]);
    }
}
