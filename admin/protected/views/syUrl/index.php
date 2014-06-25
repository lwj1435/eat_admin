<?php
/* @var $this SyUrlController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sy Urls',
);

$this->menu=array(
	array('label'=>'Create SyUrl', 'url'=>array('create')),
	array('label'=>'Manage SyUrl', 'url'=>array('admin')),
);
?>

<div id="content">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>