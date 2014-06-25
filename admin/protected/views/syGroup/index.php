<?php
/* @var $this SyGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sy Groups',
);

$this->menu=array(
	array('label'=>'Create SyGroup', 'url'=>array('create')),
	array('label'=>'Manage SyGroup', 'url'=>array('admin')),
);
?>
<div id="content">
<h1>Sy Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
