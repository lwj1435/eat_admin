<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">外卖订单统计</a> </div>
  </div>
  <hr>
       <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>外卖订单统计图</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <div class="chart"></div>
            </div>
          
          </div>
        </div>
      </div>
    </div></div></div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>外卖订单列表</h5>
            
   
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>订单号</th>
                  <th>订单状态</th>
                  <th>总外卖份数</th>
                  <th>总价格</th>
                  <th>订餐时间</th>
                  <th>订餐人</th>
                  <th>订餐电话</th>
                  <th>订餐地址</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <td>A2014022401</td>
                  <td class="center">送餐中</td>
                  <td>5</td>
                  <td>50</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>李献洪</td>
                  <td class="center">18620725173</td>
                  <td class="center">广州市天河区体育西路189号城建大厦5楼<a href="#"></a></td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022402</td>
                  <td class="center">送餐中</td>
                  <td>8</td>
                  <td>80</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>李坤锭</td>
                  <td class="center">18620725173</td>
                  <td class="center">广州市天河区体育西路189号城建大厦5楼<a href="#"></a></td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022403</td>
                  <td class="center">送餐中</td>
                  <td>12</td>
                  <td>120</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>李文锦</td>
                  <td class="center">18620725173</td>
                  <td class="center">广州市天河区体育西路189号城建大厦5楼<a href="#"></a></td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022404</td>
                  <td class="center">送餐中</td>
                  <td>3</td>
                  <td>30</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>许梦</td>
                  <td class="center">18620725173</td>
                  <td class="center">广州市天河区体育西路189号城建大厦5楼<a href="#"></a></td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022405</td>
                  <td class="center">商家已确认</td>
                  <td>2</td>
                  <td>20</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>张杰</td>
                  <td class="center">18620725173</td>
                  <td class="center">广州市天河区体育西路189号城建大厦5楼<a href="#"></a></td>
                </tr>
                <tr class="odd gradeX">
                  <td>A2014022406</td>
                  <td class="center">用户已下单</td>
                  <td>4</td>
                  <td>40</td>
                  <td class="center">2014-04-24 18:30</td>
                  <td>刀郎</td>
                  <td class="center">18620725173</td>
                  <td class="center">广州市天河区体育西路189号城建大厦5楼<a href="#"></a></td>
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
