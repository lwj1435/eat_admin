<?php
/* @var $this SyUserGroupController */
/* @var $model SyUserGroup */

$this->breadcrumbs=array(
	'Sy User Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SyUserGroup', 'url'=>array('index')),
	array('label'=>'Manage SyUserGroup', 'url'=>array('admin')),
);
?>

<div id="content">

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>