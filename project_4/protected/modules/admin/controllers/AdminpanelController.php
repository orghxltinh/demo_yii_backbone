<?php

class AdminpanelController extends CController{
    
    public function filters(){
        return array(
            'accessControl',
        );
    }
    
    public function accessRules() {
        return array(
            array(
                'allow','actions' => array('login','logout'),
                'users' => array('*')
            ),
            array(
                'allow','actions' => array('index','view'),
                'roles' => array('admin')
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }
    
    public function actionIndex()
    {    	
        $this->render('index');
    }

    public function actionLogout(){
        $model = new LoginForm;
        $model->logout();
        $this->redirect('index');
    }
        
    public function actionLogin(){
        $this->layout = 'login';
        $model = new LoginForm;
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
                $model->attributes=$_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if($model->validate() && $model->login())
                        $this->redirect(Yii::app()->user->returnUrl);
        }
        
        $this->render('login',array('model'=>$model));
    }
      
    
    
}