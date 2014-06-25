<?php
/* @var $this SyGroupController */
/* @var $model SyGroup */

$this->breadcrumbs=array(
	'Sy Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SyGroup', 'url'=>array('index')),
	array('label'=>'Create SyGroup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sy-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="content">
<h1>Manage Sy Groups</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sy-group-grid',
	'dataProvider'=>$model->searchByMerId(Yii::app()->cache->get('merchant_'.Yii::app()->user->id)),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
