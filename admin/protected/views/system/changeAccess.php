<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">管理员权限管理</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5><?php echo $model->group_name;?>组别权限管理</h5>
            
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>id</th>
                  <th>名称</th>
                  <th>是否拥有</th>
                  <th>权重</th>
                  <th>变更</th>
                </tr>
              </thead>
              <tbody>
			<?php foreach ($list as $iListKey => $item): 
			$bIsExit = $this->isExit($item->groups,$group_id);
			?>
                <tr class="odd gradeX">
                  <td><?php echo $item->id?CHtml::encode($item->id ):"未知"; ?></td>
                  <th><?php 
			echo $item->name?CHtml::encode($item->name ):"未知"; ?></th>
                  <td><?php
                  	echo $bIsExit?"<i class='icon-ok'></i>":"<i class='icon-ban-circle'></i>";
                  ?></td>
                  <th><?php echo $item->order?CHtml::encode($item->order ):"0"; ?></th>
                  <td><a href='javascript:changeStatus(<?php echo $item->id;?>,<?php echo $bIsExit?0:1;?>,<?php echo $group_id;?>)'>[变更设定]</a></td>
                </tr>
                <?php endforeach;?>
                  </tbody>
            </table>
       </div></div></div></div></div></div>
       <script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap-colorpicker.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.toggle.buttons.html"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/masked.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.form_common.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.peity.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap-wysihtml5.js"></script> 
<script>
function changeStatus(iUrlId,iSta,iGroupId){
	$.post("<?php echo $this->createUrl('system/changeUrlGroupSta')?>",
			{
				urlId:iUrlId,
				status:iSta,
				groupId:iGroupId
			},
			function(code,status){
			location.reload(); 
	});  
}
</script>