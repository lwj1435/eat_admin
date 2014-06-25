<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">管理员权限管理</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5><?php echo $model->group_name;?>组别用户列表</h5>
            
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                   <th>登录ID</th>
                  <th>笔名</th>
                  <th>登录时间</th>
                  <th>登录IP</th>
                </tr>
              </thead>
              <tbody>
             	<?php foreach ($list as $iListKey => $item): ?>
	                <tr class="odd gradeX">
	                  <td><?php echo $item->account_name?></td>
	                  <td><?php echo $item->username?></td>
	                  <td class="center"><?php echo $item->last_login_time?date("Y-m-d",$item->last_login_time):'未知';?></td>
	                  <td class="center"><?php echo $item->last_login_ip?$item->last_login_ip:'未知'?></td>
	                </tr>
                <?php  endforeach;?>
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