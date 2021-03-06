<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerController
 *
 * @author MrTy
 * this Controller is used to CRUD the question
 */
class CustomerController extends CController{
    public function filters(){
        return array(
            'accessControl',
        );
    }
    
    public function accessRules() {
        return array(
            array(
                'allow','actions' => array('create','update','delete'),
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
    
    // main view
    public function actionIndex(){    	
        $model=new Customer('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Customer']))
                $model->attributes=$_GET['Customer'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }    
    
    //create new question
    public function actionCreate()
    {
            $model=new Customer;
           
            if(isset($_POST['Customer']))
            {
                    $model->attributes=$_POST['Customer'];
                    if($model->save())
                    {
                            $this->redirect(array('index'));
                    }
            }

            $this->render('create',array(
                    'model'=>$model,
                    ));
    }
    
    //udate new question
    public function actionUpdate($id)
    {
            $model=$this->loadModel($id);	
            if(isset($_POST['Customer']))
            {
                    $model->attributes=$_POST['Customer'];
                    if($model->save())
                    {				
                            $this->redirect(array('update','id'=>$id));
                    }
            }

            $this->render('update',array(
                    'model'=>$model,
                    ));
    }

 
    public function actionDelete($id)
    {
            $this->loadModel($id)->delete();		
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            /*if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
             * */
            
    }
      
    public function loadModel($id){
        $model=Customer::model()->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='question-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
