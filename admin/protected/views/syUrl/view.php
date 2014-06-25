<?php
/* @var $this SyUrlController */
/* @var $model SyUrl */

$this->breadcrumbs=array(
	'Sy Urls'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SyUrl', 'url'=>array('index')),
	array('label'=>'Create SyUrl', 'url'=>array('create')),
	array('label'=>'Update SyUrl', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SyUrl', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SyUrl', 'url'=>array('admin')),
);
?>

<div id="content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'control',
		'action',
		'order',
	),
)); ?>
</div>