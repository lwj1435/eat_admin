<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">访客统计</a> </div>
  </div>
  <hr>
       <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>访客统计图</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <div class="chart"></div>
            </div>
           <!-- <div class="span3">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong>2540</strong> <small>总访客数</small></li>
                <li class="bg_lh"><i class="icon-plus"></i> <strong>120</strong> <small>新增访客数</small></li>
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
            <h5>访客列表</h5>
            
   
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>访客名称</th>
                  <th>访客IP</th>
                  <th>浏览页数</th>
                  <th>停留时间</th>
                  <th>平均每页停留</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <td>admin</td>
                  <td>192.168.1.1</td>
                  <td>6</td>
                  <td class="center"> 10m</td>
                  <td class="center">2m</td>
                </tr>
                <tr class="odd gradeX">
                  <td>admin2</td>
                  <td>192.168.1.2</td>
                  <td>20</td>
                  <td class="center"> 10m</td>
                  <td class="center">2m</td>
                </tr>
                <tr class="odd gradeX">
                  <td>admin3</td>
                  <td>192.168.1.3</td>
                  <td>5</td>
                  <td class="center"> 10m</td>
                  <td class="center">2m</td>
                </tr>
                <tr class="odd gradeX">
                  <td>admin4</td>
                  <td>192.168.1.4</td>
                  <td>5</td>
                  <td class="center"> 10m</td>
                  <td class="center">2m</td>
                </tr>
                <tr class="odd gradeX">
                  <td>admin5</td>
                  <td>192.168.1.5</td>
                  <td>7</td>
                  <td class="center"> 10m</td>
                  <td class="center">2m</td>
                </tr>
                <tr class="odd gradeX">
                  <td>admin6</td>
                  <td>192.168.1.6</td>
                  <td>8</td>
                  <td class="center"> 10m</td>
                  <td class="center">2m</td>
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
