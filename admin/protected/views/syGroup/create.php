<?php
/* @var $this SyGroupController */
/* @var $model SyGroup */

$this->breadcrumbs=array(
	'Sy Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SyGroup', 'url'=>array('index')),
	array('label'=>'Manage SyGroup', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>Create SyGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>