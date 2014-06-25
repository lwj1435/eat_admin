<?php
/* @var $this CaipuController */
/* @var $model Caipu */

$this->breadcrumbs=array(
	'Caipus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Caipu', 'url'=>array('index')),
	array('label'=>'Manage Caipu', 'url'=>array('admin')),
);
?>

<h1>Create Caipu</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>