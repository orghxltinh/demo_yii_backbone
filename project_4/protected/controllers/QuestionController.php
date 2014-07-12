<?php

class QuestionController extends CController{
    public function actionGet(){
        $models = Question::model()->findAll();
        
        $Arr = restSupport::modelToArray($models);
        restSupport::_sendResponse(200,  CJSON::encode($Arr));
    }
    public function actionPost(){
        $success = TRUE;
        if(isset($_POST['infos'])){
            $infos = $_POST['infos'];
            $datas = $infos['data'];
            $user = $infos['user'];
            $other = $infos['other'];
            
            $customer = new Customer();
            $customer->name = $user;
            $customer->other = $other;
            if($customer->save()){
                foreach($datas as $data):
                    $cus_ques = new CustomerQuestion();
                    $cus_ques->customer_id = $customer->id;
                    $cus_ques->question_id = $data['id'];
                    $cus_ques->value = $data['value'];
                    if(!$cus_ques->save()){                       
                        $success = FALSE;
                    }
                endforeach;                
            }else{
                $success = FALSE;
            }
            
            if(isset($success)) restSupport::_sendResponse(200,  CJSON::encode(array('response'=>$success)));
            else restSupport::_sendResponse(500,  CJSON::encode(array('response'=>$success)));            
        }
    }
}
