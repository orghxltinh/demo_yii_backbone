<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


?>
<div class="one" style="width: 100%;" >
<h3>Quản lý sản phẩm</h3>

<div class="one">
	<a href="<?php echo Yii::app()->createUrl('admin/question/create'); ?>">
		<input type="button" style="margin-bottom: 10px;" class="btn-create btn btn-danger pull-right" value="Thêm mới"/>
	</a>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',	
	'dataProvider'=>$model->search(),
	"itemsCssClass" => "table table-bordered table-striped",
    'summaryText' => '',
    //'afterAjaxUpdate' => 'function(id,data){settings.afte rAjaxUpdate(id, data);setTimeout("$("select").chosen();", 3000);}',
    'afterAjaxUpdate' => "function(id, data) {setTimeout('$(\'select\').chosen()',10);}",
	'filter'=>$model,    
	'columns'=>array(
		
		'text',
		
		array(
			'class'=>'CButtonColumn',
			'header' => 'Thao tác',
			'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
			'deleteConfirmation'=>'Delete this record ?',
		),		
	),
)); 
?>