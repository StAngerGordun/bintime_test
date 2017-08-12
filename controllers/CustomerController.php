<?php
/**
 * Created by PhpStorm.
 * User: ANDREW
 * Date: 09.08.2017
 * Time: 16:01
 */

namespace app\controllers;
use app\models\CustomerForm;
use yii\web\Controller;
use \yii;

class CustomerController extends Controller
{
    private $model;

    public function actionCustomer()
    {
        $this->model = CustomerForm::getInstance();
        
        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate())
        {
            return $this->render('index', ['model' => $this->model]);
        }
        else
            return $this->render('customer', ['model' => $this->model]);
    }
}