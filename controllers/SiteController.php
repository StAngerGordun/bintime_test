<?php

namespace app\controllers;

use app\models\Addresses;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
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
            ->all();
        return $this->render('index', ['users' => $users]);
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
            $user->gender_id = $customerData['gender'];
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
            
            return $this->redirect('index');
        }
        else
            return $this->render('customer', ['model' => $model]);
    }
}
