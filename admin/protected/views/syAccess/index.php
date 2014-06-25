<?php
/* @var $this SyAccessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sy Accesses',
);

$this->menu=array(
	array('label'=>'Create SyAccess', 'url'=>array('create')),
	array('label'=>'Manage SyAccess', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>Sy Accesses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

</div>