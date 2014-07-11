<?php 
$THEME_NAME     = 'Demo Backbone and Yii';
$TABLE_PREFIX   = 'ecom';
//theme name
$THEME		= 'demo_app';
//defaul module
//$DEFAULT_MODULE = 'main';
//admin module
//$ADMIN_MODULE   = 'admin';
//server 
$MYSQL_HOSTNAME = 'localhost';//Your hostname here
$MYSQL_USERNAME = 'root';//Your username here
$MYSQL_PASSWORD = '123456';//Your password here
$MYSQL_DATABASE = 'demo';//Your database

define('UPLOAD_PATH',dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR);
define('PRODUCT_IMAGE_PATH',UPLOAD_PATH.'images'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR);
define('SLIDER_IMAGE_PATH',UPLOAD_PATH.'images'.DIRECTORY_SEPARATOR.'slider'.DIRECTORY_SEPARATOR);
define('IMAGE_PATH',UPLOAD_PATH.'logo'.DIRECTORY_SEPARATOR);
define('SLOGAN_IMG_PATH',UPLOAD_PATH.'slogan'.DIRECTORY_SEPARATOR);
define('BE', 1);
define('FE', 2);
define('IMAGE_FULL',1);
define('IMAGE_THUMB',2);
define('ENABLE',1);
define('DISABLE',0);

function d($object, $is_exit = false)
{
	if(defined('YII_DEBUG') && YII_DEBUG)
	{
		if(is_array($object) || is_object($object))
		{
			echo "<pre>".print_r($object,true)."</pre>";
		}
		else
		{
			var_dump($object);

		}
		if($is_exit == true)
		{
			die('<br/>--------------------------------------<br/>exit by debug.');
		}
	}	
}

function get_setting($category, $key){
    return Yii::app()->settings->get($category, $key);
}

function get_employees(){
    $emps_arr = array();
    $emps = Yii::app()->settings->get('employee','information');
    if(!empty($emps)){
        
        //$employees = preg_split('/\;/', $emps);
        $employees = explode(';',$emps);
        $i=0; $emp_arr = array();
        foreach($employees as $value):
            $infos = explode('-', $value);
            $emp_arr[] = array('name'=>$infos[0],'phone'=>$infos[1],'enable'=>$infos[2]);
            $i++;
        endforeach;        
        return $emp_arr;
    }else
    return NULL;
}

function _baseUrl(){
    //$index = '/index.php';
    $index = '';
    return (Yii::app()->baseUrl.$index);
}

class cookieHandle{
      public function hasCookie($name)
      {
        return !empty(Yii::app()->request->cookies[$name]->value);
      }

      public function getCookie($name)
      {
        return Yii::app()->request->cookies[$name]->value;
      }

      public function setCookie($name, $value)
      {
        $cookie = new CHttpCookie($name,$value);
        Yii::app()->request->cookies[$name] = $cookie;
      }

      public function removeCookie($name)
      {
        unset(Yii::app()->request->cookies[$name]);
      }
}

