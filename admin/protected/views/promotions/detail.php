<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">优惠详情</a> </div>
    <h1><span class="icon"> <i class="icon-plus-sign"></i> </span>[三店优惠任您选！超值低至18元]优惠详情</h1>
  </div>

  <div class="container-fluid"><hr>
	<div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lv span5"> <a href="index.html"> <i class="icon-eye-open"></i> <span class="label label-important label-font">1593</span>促销浏览总数</a> </li>
            <li class="bg_lv span5"> <a href="charts.html"> <i class="icon-share"></i> <span class="label label-important label-font">87</span>促销分享总数</a> </li>
          </ul>
    	</div>
    <div class="row-fluid"><hr>
      <form action="#" method="get" class="form-horizontal">
          <div class="span6">
            <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>促销优惠内容</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group"><br>
                  <label class="control-label">促销名称</label>
                  <div class="controls">
                    <input type="text" placeholder="请填写促销标题全称" data-title="请填写促销标题全称" class="	tip-right" data-original-title="">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">促销类型</label>
                  <div class="controls">
                    <div data-toggle="buttons-radio" class="btn-group">
                      <button class="btn btn-info" type="button">限时优惠</button>
                      <button class="btn btn-info" type="button">菜品优惠</button>
                      <button class="btn btn-info" type="button">会员优惠</button>
                    </div>
                  </div>
                </div>
                <!--<div class="control-group">
                  <label class="control-label">限时优惠</label>
                  <div class="controls">
                    <input type="text" placeholder="限时开始时段" data-title="请选择优惠时段" class="span4 tip-right" data-original-title="">
                    <input type="text" placeholder="限时结束时段" data-title="请选择优惠时段" class="span4 tip-right" data-original-title="">
                    <div class="input-append">
                      <input type="text" placeholder="折扣" data-title="请填写促销标题全称" class="span4 tip-right" data-original-title="">
                      <span class="add-on">%</span>
                     </div>
                  </div>
                </div>-->
                <div class="control-group">
                  <label class="control-label">菜品优惠</label>
                  <div class="controls">
                    <select multiple placeholder="餐厅提供的服务，如:早茶、午市、外卖等" class="span6">
                      <option>早茶</option>
                      <option>午市</option>
                      <option>晚市</option>
                      <option>夜宵</option>
                      <option></option>
                    </select>&nbsp;
                    <div class="input-append">
                      <input type="text" placeholder="优惠折扣" data-title="请填写促销标题全称" class="span5 tip-right" data-original-title="">
                      <span class="add-on">%</span><button class="btn btn-mini btn-warning" type="button"><i class="icon-ok"></i></button>
                     </div>
                  </div>
                  <div class="controls">
                    	<ul>
                        	<li><span class="label label-inverse">凉拌黑木耳</span><span class="label label-important">70%</span>&nbsp;&nbsp;<a href=""><i class="icon-remove"></i></a></li>
                            <li><span class="label label-inverse">凉拌黑木耳</span><span class="label label-important">70%</span>&nbsp;&nbsp;<a href=""><i class="icon-remove"></i></a></li>
                            <li><span class="label label-inverse">凉拌黑木耳</span><span class="label label-important">70%</span>&nbsp;&nbsp;<a href=""><i class="icon-remove"></i></a></li>
                        </ul>
                  </div><br>
                </div>

				<!--<div class="control-group">
                  <label class="control-label">会员优惠</label>
                  <div class="controls">
                    <div class="input-append">
                      <input type="text" placeholder="优惠折扣" data-title="请填写促销标题全称" class="span6 tip-right" data-original-title="">
                      <span class="add-on">%</span>
                     </div>
                  </div>
                </div>-->
                
            </div>
    
          </div>
          </div>
          <div class="span6">
            <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-time"></i> </span>
              <h5>促销优惠时间</h5>
            </div>
                <div class="widget-content nopadding"><br>
                    <div class="control-group">
                      <label class="control-label">促销类型</label>
                      <div class="controls">
                        <div data-toggle="buttons-radio" class="btn-group">
                          <button class="btn btn-warning" type="button">长期促销</button>
                          <button class="btn btn-warning" type="button">短期促销</button>
                        </div>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">开始日期</label>
                      <div class="controls">
                        <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2013" class="datepicker span6">
                        </div>
                    </div>                
                    <div class="control-group">
                      <label class="control-label">结束日期</label>
                      <div class="controls">
                        <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2013" class="datepicker span6">
                        </div><br>
                    </div>  
                </div>
            </div>
          </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                  <h5>促销内容介绍</h5>
                </div>
                <div class="widget-content nopadding"><br>
                    <div class="control-group">
                      <label class="control-label">促销优惠介绍</label>
                      <div class="controls">
                        <textarea class="span11" ></textarea>
                      </div>
                    </div><br>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-large btn-success"><i class="icon-ok-sign"></i> 保存</button>
                    </div>
                </div>
              </div>
      </form>
    </div>
    </div>
  </div>
 
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
<script src="<?php echo Yii::app()->baseUrl;?>/plus/My97DatePicker/WdatePicker.js"></script> 