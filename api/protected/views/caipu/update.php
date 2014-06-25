<?php
/* @var $this CaipuController */
/* @var $model Caipu */

$this->breadcrumbs=array(
	'Caipus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Caipu', 'url'=>array('index')),
	array('label'=>'Create Caipu', 'url'=>array('create')),
	array('label'=>'View Caipu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Caipu', 'url'=>array('admin')),
);
?>

<h1>Update Caipu <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>