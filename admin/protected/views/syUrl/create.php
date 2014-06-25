<?php
/* @var $this SyUrlController */
/* @var $model SyUrl */

$this->breadcrumbs=array(
	'Sy Urls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SyUrl', 'url'=>array('index')),
	array('label'=>'Manage SyUrl', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>Create SyUrl</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>