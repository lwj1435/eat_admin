<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#">商家诚信管理</a></div>
    <h1><span class="icon-star"></span>商家诚信管理</h1>
  </div>
  <div class="container-fluid">
    <hr>
	<div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a>
                <div class="qatitle bg_lg">诚信综合评分</div><div class="qnumber"><?php echo isset($cout)?$cout:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-file"></i></span>
                <div class="qatitle bg_lg">评论数量</div><div class="qnumber"><?php echo isset($comcout)?$comcout:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-thumbs-down"></i></span>
                <div class="qatitle bg_lg">被投诉次数</div><div class="qnumber"><?php echo isset($pocout)?$pocout:0;?></div></a>
            </li>
          </ul>
        </div>

    <div class="row-fluid">
      <hr>
      <div class="widget-box">
        <div class="widget-title">
          <ul class="nav nav-tabs">
            <li><span class="icon"><i class="icon-ok"></i></span></li>
            <li class="active"><a data-toggle="tab" href="#tab4">评论</a></li>
            <li><a data-toggle="tab" href="#tab5">投诉</a></li>
            <!--         <li><a data-toggle="tab" href="#tab6">投诉</a></li>
      <li><a data-toggle="tab" href="#tab7">前天</a></li>
              <li><a data-toggle="tab" href="#tab8">更早</a></li>-->
          </ul>
        </div>
        <div class="widget-content tab-content">
          <div id="tab4" class="tab-pane active">
            <div class="todo">
              <ul>
                <li class="clearfix">
                  <div class="txt2" style="width:3%">
                    <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                  </div>
                  <div class="txt2" style="width:7%"><strong>用户昵称</strong></div>
                  <div class="txt2" style="width:5%"><strong>评分</strong></div>
                  <div class="txt2" style="width:65%"><strong>评论内容</strong></div>
                  <div class="txt2" style="width:10%"><strong>发布时间</strong></div>
                  <div class="txt2" style="width:5%"><strong>人均</strong></div>
                  <div class="txt2" style="width:5%"><strong>分享</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <div id="tab5" class="tab-pane">
            <div class="todo">
              <ul>
                <li class="clearfix">
                  <div class="txt2" style="width:3%">
                    <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                  </div>
                  <div class="txt2" style="width:7%"><strong><i class="icon-user"></i>用户昵称</strong></div>
                  <div class="txt2" style="width:10%"><strong><i class="icon-credit-card"></i>用户名称</strong></div>
                  <div class="txt2" style="width:10%"><strong><i class="icon-book"></i>用户手机</strong></div>
                  <div class="txt2" style="width:45%"><strong><i class="icon-comments-alt"></i>投诉内容</strong></div>
                  <div class="txt2" style="width:10%"><strong><i class="icon-time"></i>投诉时间</strong></div>
                  <div class="txt2" style="width:10%"><strong><i class="icon-bell"></i>状态</strong></div>
                  <div class="txt2" style="width:5%"><strong><i class=" icon-magic"></i>操作</strong></div>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
      </div>
      
  </div>
</div>

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script> 