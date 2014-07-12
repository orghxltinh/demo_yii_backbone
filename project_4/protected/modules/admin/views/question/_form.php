<style>
	.product_images{
		width: 100%;
		overflow: hidden;
	}
	.product_images li{
		display: inline-block;
		padding: 3px;
		border: 1px solid #dedede;
		height: 129px;
		width: 129px;
		float: left;
		margin-right: 5px;
		text-align: center;
		margin-bottom: 25px;
		position: relative;
	}
	.product_images li .delete{
		position: absolute;
		bottom: -20px;
		right: 5px;
		color: red;
	}
	.product_images li .default{
		position: absolute;
		bottom: -20px;
		left: 0;
	}
	#image_wrap_list{
		padding: 5px;
		line-height: 15px;
	}
	a.default.hide{
		display: none;
	}
</style>

<div style="width: 80%;">
    <div class="widget  span12 clearfix">
        <div class="widget-header">
                <span>Không được bỏ trống các ô có dấu <i class="required">*</i></span>
        </div>

        <div class="widget-content">
            <div class="form">
                <?php $form=$this->beginWidget('CActiveForm', array('id'=>'product-form', 'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>
                <?php //echo $form->errorSummary($model); ?>
                <div class="section">
                    <?php echo $form->labelEx($model,'text'); ?>
                    <div>
                            <?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'text'); ?>
                    </div>
                </div>     
                
                <div class="section">
                    <?php echo $form->labelEx($model,'color'); ?>
                    <div>
                            <?php echo $form->textField($model,'color',array('size'=>60,'maxlength'=>255,'class'=>'color')); ?>
                            <?php echo $form->error($model,'text'); ?>
                    </div>
                </div>    
                <div class="section">
                    <?php echo $form->labelEx($model,'highlight'); ?>
                    <div>
                            <?php echo $form->textField($model,'highlight',array('size'=>60,'maxlength'=>255,'class'=>'color')); ?>
                            <?php echo $form->error($model,'text'); ?>
                    </div>
                </div>    
                
                <div class="row buttons">
                    <br/>
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update',array('class'=>'btn btn-danger')); ?>
                </div>
                
                <?php $this->endWidget(); ?>
            </div><!-- form -->
        </div>
    </div>
</div>
<script type="text/javascript">
	
</script>