<?php
/* @var $this SyAccessController */
/* @var $model SyAccess */

$this->breadcrumbs=array(
	'Sy Accesses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SyAccess', 'url'=>array('index')),
	array('label'=>'Create SyAccess', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sy-access-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="content">
<h1>Manage Sy Accesses</h1>

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
	'id'=>'sy-access-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_id',
		'url_id',
		'access',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
