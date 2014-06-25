<?php
/* @var $this SyAccessController */
/* @var $model SyAccess */

$this->breadcrumbs=array(
	'Sy Accesses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SyAccess', 'url'=>array('index')),
	array('label'=>'Create SyAccess', 'url'=>array('create')),
	array('label'=>'Update SyAccess', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SyAccess', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SyAccess', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>View SyAccess #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id',
		'url_id',
		'access',
	),
)); ?>
</div>