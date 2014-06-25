<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">管理员权限管理</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>管理员权限管理</h5>
            <span class="label label-info"><a href='<?php echo $this->createUrl("syGroup/create");?>'>增加一个用户组</a></span>
            <span class="label label-info"><a href='<?php echo $this->createUrl("system/manage");?>'>管理系统用户</a></span> 
            
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>id</th>
                  <th>组名称</th>
                  <th>管理</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($list as $iListKey => $item): ?> 
                <tr class="odd gradeX">
                  <td><?php echo $item->id?CHtml::encode($item->id ):"未知"; ?></td>
                  <td><?php echo $item->group_name?CHtml::encode($item->group_name ):"未知"; ?></td>
                  <td><a href="<?php echo $this->createUrl("system/changeAccess")."?id=".$item->id;?>">[权限设定]</a> 
                  <a href="<?php echo $this->createUrl("system/groupUser")."?id=".$item->id;?>">[组用户]</a></td>
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
	$('.textarea_editor').wysihtml5();
</script>
