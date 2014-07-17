<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <?php
    Yii::app()->components['urlManager']->showScriptName ? $s = 1 : $s = 0;
    $this->widget('application.components.jsconfig',array(
        'jsvalue'=>array(
            'appPath' =>  Yii::app()->theme->baseUrl,
            'APIbaseUrl' => Yii::app()->baseUrl,
            'showScriptName' => $s
        )        
    ));
    ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<?php
    
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/global.css');
    //using require js to load all js file    
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/vendor/require.js',  CClientScript::POS_HEAD,array('data-main'=>  Yii::app()->theme->baseUrl.'/js/jsloader.js'));    
    //$cs->registerScript();
?>
	<!-- blueprint CSS framework -->
	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="container main-contain"></div>
    <div id="loadingPage"></div>

</body>
</html>
