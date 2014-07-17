<?php
    $cs = Yii::app()->clientScript;
    $cs->registerCoreScript('jquery');
    $cs->registerCoreSCript('jquery.ui');
    $assurl = $this->module->AssetsUrl;
    $cs->registerScriptFile($this->module->AssetsUrl.'/js/animations.js',  CClientScript::POS_HEAD);
    $cs->registerScriptFile($this->module->AssetsUrl.'/js/chosen.js',  CClientScript::POS_HEAD);
    $cs->registerScriptFile($this->module->AssetsUrl.'/js/jquery.tablednd.js',  CClientScript::POS_HEAD);
    $cs->registerScriptFile($this->module->AssetsUrl.'/js/jscolor.js',  CClientScript::POS_HEAD);
    
    $cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/global.css');
    $cs->registerCssFile($this->module->AssetsUrl.'/css/style.css');
    $cs->registerCssFile($this->module->AssetsUrl.'/css/dashboard.css');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<div id="admin">

		<div id="header" class="navbar navbar-inverse navbar-fixed-top">
                    <ul id="account_info" class="pull-right">
                            <li id="admin-settings"  title="Trang chủ">
                                <?php echo CHtml::link('Trang chủ',Yii::app()->createUrl(''),array('target'=>'_blank')); ?>
                                <div id="settings"><div id="settings-ani"></div>
                                    <ul class="subnav">
                                        <li><?php echo CHtml::link("<b>Slider</b>",'#'); ?></li>
                                        <li><?php echo CHtml::link("<b>Người dùng</b>",'#'); ?></li>
                                        <li><?php echo CHtml::link("<b>Thông tin footer</b>",'#'); ?></li>
                                        <li><?php echo CHtml::link("<b>Cài đặt</b>",'#'); ?></li>
                                    </ul>
                                    
                                </div>
                            </li>
				<li><img src="<?php echo $assurl;?>/images/avatar.png" alt="Online" /></li>
				<li class="setting">
					<b class="red"><?php echo Yii::app()->user->name; ?></b>
				</li>
				<li class="logout" title="Đăng xuất">
					<a href="<?php echo Yii::app()->createUrl('admin/adminpanel/logout'); ?>" onclick="return confirm('Bạn thực sự muốn đăng xuất ?');">Đăng xuất</a>
				</li>
			</ul>
                    
			
		</div><!-- End Header -->
		<div id="main-content">
			<div id="left-cnt">
				<ul>
                                        <li id="gallery">
						<span class="ico gray folder"></span>
						<?php echo CHtml::link("<b>Admin Page</b>", Yii::app()->createUrl('admin')); ?>
					</li>
					<li id="dashboard">
						<span class="ico gray home"></span>
						<?php echo CHtml::link("<b>Question admin</b>", Yii::app()->createUrl('admin/question')); ?>
					</li>	
                                        <li id="dashboard">
						<span class="ico gray home"></span>
						<?php echo CHtml::link("<b>Customer admin</b>", Yii::app()->createUrl('admin/customer')); ?>
					</li>	
				</ul>
			</div><!-- End: left-cnt -->

			<div id="right-cnt">
				<div id="inner">
					<div class="one">
						<?php echo $content; ?>
					</div>
				</div>

			</div>

		</div>

		
	</div><!-- End: admin -->
	<?php
	
	?>
	<script type="text/javascript" src="<?php echo $this->module->AssetsUrl; ?>/js/dashboard.js"></script>
	<script type="text/javascript">
		$(function(){
			//$('select').chosen();
		});
	</script>
</body>
</html>