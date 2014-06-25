<div id="content">
<div id="content">
<?php
/* @var $this SyUrlController */
/* @var $model SyUrl */
/* @var $form CActiveForm */
?>

<div class="form">

<form action="<?php echo $this->createUrl("system/addGroupUserRelation");?>"  method="post">
	<div class="row">
		<?php echo $model->username;?>
		<input type="hidden" name='id' value='<?php echo $id;?>'>
		<input type="hidden" name='old_group' value='<?php echo $group_id;?>'>
	</div>
	<div class="row">
		<select name='group_id'>
			<?php foreach ($list as $item):?>
			<option value='<?php echo $item->id;?>' <?php echo $item->id==$group_id?"selected":"";?>><?php echo $item->group_name;?></option>
			<?php endforeach;?>
		</select>
	</div>
	<div class="row">
		<input type="submit" value='修改 '>
	</div>
</form>

</div><!-- form -->
</div>
</div>