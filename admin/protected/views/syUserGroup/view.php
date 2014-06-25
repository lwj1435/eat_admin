<?php
/* @var $this SyUserGroupController */
/* @var $model SyUserGroup */

$this->breadcrumbs=array(
	'Sy User Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SyUserGroup', 'url'=>array('index')),
	array('label'=>'Create SyUserGroup', 'url'=>array('create')),
	array('label'=>'Update SyUserGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SyUserGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SyUserGroup', 'url'=>array('admin')),
);
?>

<div id="content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'group_id',
	),
)); ?>
</div>
