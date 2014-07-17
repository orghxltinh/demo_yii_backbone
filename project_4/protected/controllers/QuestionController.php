<?php
/*
 * this is main Rest API use for this app
 */
class QuestionController extends CController{
    //send all data to front end from this 
    public function actionGet(){
        $models = Question::model()->findAll();
        
        $Arr = restSupport::modelToArray($models);
        //Using my custom Yii Restful Webservices support
        //protected/helpers/restSupport.php
        restSupport::_sendResponse(200,CJSON::encode($Arr));
    }    
    //get all data from front end, save to database, end return the result
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
                    if($data['value'] == 1){
                        $cus_ques = new CustomerQuestion();
                        $cus_ques->customer_id = $customer->id;
                        $cus_ques->question_id = $data['id'];
                        $cus_ques->value = $data['value'];
                        if(!$cus_ques->save()){                       
                            $success = FALSE;
                        }
                    }
                endforeach;    
                $percentArr = $this->percentInfos();
                
            }else{
                $success = FALSE;
            }
            
            if(isset($success)) restSupport::_sendResponse(200,  CJSON::encode(array('response'=>$percentArr)));
            else restSupport::_sendResponse(500,  CJSON::encode(array('response'=>$success)));            
        }
    }
    private function percentInfos(){
        $question = Question::model()->findAll();
        $num_other = Customer::model()->count('other!=""');
        $total = CustomerQuestion::model()->count('id') + $num_other;
        $arr = array();
        foreach($question as $q):
            $count = CustomerQuestion::model()->count('question_id=:id',array(
                ':id'=>$q->id));
            $value = array(
                'id'=>$q->id,'name'=>$q->text,'color'=>$q->color,
                'highlight'=>$q->highlight, 'percent'=>($count/$total*100)
            );    
            $arr[] = $value;
        endforeach;
        $arr = array('percent'=>$arr,'other'=>($num_other/$total*100));
        return $arr;
    }
}
