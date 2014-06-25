<?php
/* @var $this SyUserGroupController */
/* @var $model SyUserGroup */

$this->breadcrumbs=array(
	'Sy User Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SyUserGroup', 'url'=>array('index')),
	array('label'=>'Create SyUserGroup', 'url'=>array('create')),
	array('label'=>'View SyUserGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SyUserGroup', 'url'=>array('admin')),
);
?>

<div id="content">

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>