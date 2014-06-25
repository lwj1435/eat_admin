<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">预约订单统计</a> </div>
  </div>
  <hr>
       <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>预约订单统计图</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <div class="chart"></div>
            </div>
           <!-- <div class="span3">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong>2540</strong> <small>Total Users</small></li>
                <li class="bg_lh"><i class="icon-plus"></i> <strong>120</strong> <small>New Users </small></li>
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>656</strong> <small>Total Shop</small></li>
                <li class="bg_lh"><i class="icon-tag"></i> <strong>9540</strong> <small>Total Orders</small></li>
                <li class="bg_lh"><i class="icon-repeat"></i> <strong>10</strong> <small>Pending Orders</small></li>
                <li class="bg_lh"><i class="icon-globe"></i> <strong>8540</strong> <small>Online Orders</small></li>
              </ul>
            </div>-->
          </div>
        </div>
      </div>
    </div></div></div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>预约订单列表</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>预约号</th>
                  <th>预约时间</th>
                  <th>预约状态</th>
                  <th>联系人</th>
                  <th>预约电话</th>
                  <th>预约人数</th>
                  <th>点餐总价</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <td>A2014022401</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>已完成</td>
                  <td>李献洪</td>
                  <td class="center">18620725173</td>
                  <td class="center">192.168.1.112</td>
                  <td class="center">无网上点餐<a href="#"></a></td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022402</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>已完成</td>
                  <td>李坤锭</td>
                  <td class="center">18620725173</td>
                  <td class="center">192.168.1.112</td>
                  <td class="center">无网上点餐</td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022403</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>已完成</td>
                  <td>李文锦</td>
                  <td class="center">18620725173</td>
                  <td class="center">192.168.1.112</td>
                  <td class="center">无网上点餐</td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022404</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>已完成</td>
                  <td>许梦</td>
                  <td class="center">18620725173</td>
                  <td class="center">192.168.1.112</td>
                  <td class="center">无网上点餐</td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022405</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>已完成</td>
                  <td>张杰</td>
                  <td class="center">18620725173</td>
                  <td class="center">192.168.1.112</td>
                  <td class="center">无网上点餐</td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022406</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>已完成</td>
                  <td>刀郎</td>
                  <td class="center">18620725173</td>
                  <td class="center">192.168.1.112</td>
                  <td class="center">无网上点餐</td>
                </tr>
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
