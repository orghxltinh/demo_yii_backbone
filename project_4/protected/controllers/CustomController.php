<?php

class CustomController extends CController{
    public function actionIndex(){
        echo 'this is Custom index';
    }
    
    public function actionPages($page){
        echo $page;
    }
}
