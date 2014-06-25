<?php
/* @var $this SyAccessController */
/* @var $model SyAccess */

$this->breadcrumbs=array(
	'Sy Accesses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SyAccess', 'url'=>array('index')),
	array('label'=>'Create SyAccess', 'url'=>array('create')),
	array('label'=>'View SyAccess', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SyAccess', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>Update SyAccess <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>