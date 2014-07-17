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
<h3>Customer View</h3>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',	
	'dataProvider'=>$model->search(),
	"itemsCssClass" => "table table-bordered table-striped",
    'summaryText' => '',
    //'afterAjaxUpdate' => 'function(id,data){settings.afte rAjaxUpdate(id, data);setTimeout("$("select").chosen();", 3000);}',
    'afterAjaxUpdate' => "function(id, data) {setTimeout('$(\'select\').chosen()',10);}",
	'filter'=>$model,    
	'columns'=>array(
		
		'name',
                array(
			'name' => 'question_ids',
			'header'=>'Danh mục',
			'value' => '$data->getQuestionName()',
                        'type' => 'raw',
			//'filter' => CHtml::listData( Category::model()->findAll(), 'id', 'name'),
	        //'filter' => CHtml::activeDropDownList($model, 'categories_ids',CHtml::listData( Category::model()->findAll(), 'id', 'name'), array('multiple' => 'true')),
                    ),
                'other',
		
		array(
			'class'=>'CButtonColumn',
			'header' => 'Thao tác',
			'template'=>'{delete}',
			'deleteConfirmation'=>'Delete this record ?',
		),		
	),
)); 
?>