<?php
/* @var $this CaipuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Caipus',
);

$this->menu=array(
	array('label'=>'Create Caipu', 'url'=>array('create')),
	array('label'=>'Manage Caipu', 'url'=>array('admin')),
);
?>

<h1>Caipus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
