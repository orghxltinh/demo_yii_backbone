<div id='login'>
    <div class="inner clearfix">
    	<div class="logo">
    		<!--<img src="<?php echo $this->module->AssetsUrl.'/images/logo/logo_login.png'; ?>"/>-->
    		<h3>Đăng Nhập</h3>
    	</div>
    	<div class="formLogin">
		<?php $form=$this->beginWidget('CActiveForm', array('id'=>'formLogin', 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true))); ?>
			<div class="row">		
				<?php echo $form->textField($model,'username',array(
		                    'id' => 'username_id'
		                )); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>
			<div class="row">		
				<?php echo $form->passwordField($model,'password',array(
		                    'id' => 'password'
		                )); ?>
				<?php echo $form->error($model,'password'); ?>		
			</div>
	        <div class="loginButton">
	            <div class=" pull-right" style="margin-right:-8px;">
	                <div class="row buttons btn-group">
	                        <?php echo CHtml::submitButton('Login',array(
	                            'id' => 'but_login',
	                            'class' => 'btn btn-warning'
	                        )); ?>                    
	                </div>
	            </div>
	            
	        </div>              
		<?php $this->endWidget();?>      
		</div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->module->AssetsUrl; ?>/js/btn_onoff.js"></script>
<script type="text/javascript" src="<?php echo $this->module->AssetsUrl; ?>/js/login.js"></script>