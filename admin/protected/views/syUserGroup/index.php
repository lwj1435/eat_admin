<?php
/* @var $this SyUserGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sy User Groups',
);

$this->menu=array(
	array('label'=>'Create SyUserGroup', 'url'=>array('create')),
	array('label'=>'Manage SyUserGroup', 'url'=>array('admin')),
);
?>

<div id="content">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
