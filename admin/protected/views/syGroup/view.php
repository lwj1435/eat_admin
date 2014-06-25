<?php
/* @var $this SyGroupController */
/* @var $model SyGroup */

$this->breadcrumbs=array(
	'Sy Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SyGroup', 'url'=>array('index')),
	array('label'=>'Create SyGroup', 'url'=>array('create')),
	array('label'=>'Update SyGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SyGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SyGroup', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>View SyGroup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_name',
		'mer_id',
	),
)); ?>
</div>