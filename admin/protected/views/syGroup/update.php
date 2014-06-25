<?php
/* @var $this SyGroupController */
/* @var $model SyGroup */

$this->breadcrumbs=array(
	'Sy Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SyGroup', 'url'=>array('index')),
	array('label'=>'Create SyGroup', 'url'=>array('create')),
	array('label'=>'View SyGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SyGroup', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>Update SyGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>