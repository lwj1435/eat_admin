<?php
/* @var $this SyUrlController */
/* @var $model SyUrl */

$this->breadcrumbs=array(
	'Sy Urls'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SyUrl', 'url'=>array('index')),
	array('label'=>'Create SyUrl', 'url'=>array('create')),
	array('label'=>'View SyUrl', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SyUrl', 'url'=>array('admin')),
);
?>

<!-- <h1>Update SyUrl <?php echo $model->id; ?></h1> -->
<div id="content">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>