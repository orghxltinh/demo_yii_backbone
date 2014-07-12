<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionController
 *
 * @author MrTy
 */
class QuestionController extends CController{
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
    
    public function actionIndex(){    	
        $model=new Question('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Question']))
                $model->attributes=$_GET['Question'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }    
    
    public function actionCreate()
    {
            $model=new Question;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Question']))
            {
                    $model->attributes=$_POST['Question'];
                    if($model->save())
                    {
                            $this->redirect(array('index'));
                    }
            }

            $this->render('create',array(
                    'model'=>$model,
                    ));
    }
    
    public function actionUpdate($id)
    {
            $model=$this->loadModel($id);	
            if(isset($_POST['Question']))
            {
                    $model->attributes=$_POST['Question'];
                    if($model->save())
                    {				
                            $this->redirect(array('update','id'=>$id));
                    }
            }

            $this->render('update',array(
                    'model'=>$model,
                    ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
            $this->loadModel($id)->delete();		
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            /*if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
             * */
            
    }
      
    public function loadModel($id){
        $model=Question::model()->findByPk($id);
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
