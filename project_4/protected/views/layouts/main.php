<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php
    $this->widget('application.components.jsconfig',array(
        'jsvalue'=>array(
            'appPath' =>  Yii::app()->theme->baseUrl,
            'APIbaseUrl' => Yii::app()->baseUrl
        )        
    ));
    ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<?php
    
    $cs = Yii::app()->clientScript;
    //$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/global.css');    
    $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/vendor/require.js',  CClientScript::POS_HEAD,array('data-main'=>  Yii::app()->theme->baseUrl.'/js/jsloader.js'));    
    //$cs->registerScript();
?>
	<!-- blueprint CSS framework -->
	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="container main-contain"></div>


</body>
</html>
