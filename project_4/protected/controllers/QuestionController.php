<?php

class QuestionController extends CController{
    public function actionGet(){
        $models = Question::model()->findAll();
        
        $Arr = restSupport::modelToArray($models);
        restSupport::_sendResponse(200,  CJSON::encode($Arr));
    }
    public function actionPost(){
        if(isset($_POST)){
            restSupport::_sendResponse(200,  CJSON::encode($_POST));
        }
    }
}
