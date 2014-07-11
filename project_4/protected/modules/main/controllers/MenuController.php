<?php
class MenuController extends CController{
    public function actionIndex(){
        $model = Menu::model()->findAll();
        $all = array();
        
        foreach ($model as $value):
            $arr['id'] = $value->id;
            $arr['menuname'] = $value->menuname;
            $arr['slug'] = $value->slug;
            $all[] = $arr;
        endforeach;
        $menu = array('menu'=>$all);
        echo CJSON::encode($all);
    }
}
