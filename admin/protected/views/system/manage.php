<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">管理员管理</a></div>
    <h1> <span class="icon"> <i class="icon-legal"></i> </span>管理员管理</h1>
  </div>
  <div class="container-fluid">
	<div class="widget-box">

    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>管理员管理</h5>
            <span class="label label-info"><a href='<?php echo $this->createUrl("system/addManageUer");?>'>增加管理员</a></span> 
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>登录ID</th>
                  <th>笔名</th>
                  <th>级别</th>
                  <th>登录时间</th>
                  <th>登录IP</th>
                  <th>管理项</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach ($list as $iListKey => $item): ?>
                <tr class="odd gradeX">
                  <td><?php echo $item->account_name?></td>
                  <td><?php echo $item->username?></td>
                  <td><?php 
                  $sTemp = "";
                  $iTempId = 0;
                  $iGroupId = 0;
                  if ($item->groups) {
	                  foreach ($item->groups as $iGroupKey => $groupVal):
 	                  	$sTemp =  $groupVal->group_name;
	                 	$iTempId = $groupVal->id;
	                 	$iGroupId = $groupVal->id;
	                  endforeach;
                  }
                  echo $sTemp?$sTemp:'无';
                  ?></td>
                  <td class="center"><?php echo $item->last_login_time?date("Y-m-d",$item->last_login_time):'未知';?></td>
                  <td class="center"><?php echo $item->last_login_ip?$item->last_login_ip:'未知'?></td>
                  <td class="center"><a href="<?php echo $this->createUrl("system/changeUserGroup")."?id={$item->id}&groupId={$iGroupId}";?>">更改</a> | <a href="#">删除</a></td>
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
