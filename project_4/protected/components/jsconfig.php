<?php
class jsconfig extends CWidget{
    public $jsvalue = array();
    public function init(){
        $script = 'window.jglobal = new Object();';
        foreach($this->jsvalue as $key => $value):
            $script .='jglobal.'.$key.'="'.$value.'";'; 
        endforeach;
        $script.= 'jglobal.currentPage="'.$this->getController()->id.'";';
        $script.= 'jglobal.currentAction="'.$this->getController()->action->id.'";';
        
        $cs = Yii::app()->clientScript;
        $cs->registerScript('globalScript',$script,  CClientScript::POS_HEAD);
    }   
}