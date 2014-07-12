<?php
$link = str_replace('\\','/', dirname(__FILE__)) ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo $this->module->AssetsUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->module->AssetsUrl; ?>/css/login.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<?php
		echo '<br/>'.$content;
	?>
	<?php
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
		$cs->registerCoreSCript('jquery.ui');
	?>
</body>
</html>