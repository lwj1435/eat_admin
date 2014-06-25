<?php
/* @var $this SyAccessController */
/* @var $model SyAccess */

$this->breadcrumbs=array(
	'Sy Accesses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SyAccess', 'url'=>array('index')),
	array('label'=>'Manage SyAccess', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>Create SyAccess</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>