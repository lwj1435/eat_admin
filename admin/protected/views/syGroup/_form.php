<div id="content">
<?php
/* @var $this SyGroupController */
/* @var $model SyGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sy-group-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'group_name'); ?>
		<?php echo $form->textField($model,'group_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'group_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model, 'mer_id',array('value'=>Yii::app()->cache->get('merchant_'.Yii::app()->user->id))); ?>
		<?php //echo $form->labelEx($model,'mer_id'); ?>
		<?php //echo $form->textField($model,'mer_id'); ?>
		<?php //echo $form->error($model,'mer_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>