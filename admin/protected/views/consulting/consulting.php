<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#">用户咨询管理</a></div>
    <h1><span class="icon"> <i class="icon-comment"></i> </span>用户咨询管理</h1>
  </div>
  <div class="container-fluid">
    <hr>
        <div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a>
            	<span class="label label-warning"><i class="icon-comments-alt"></i></span>
                <div class="qatitle bg_lg">新消息</div><div class="qnumber"><?php echo isset($todayCount)?$todayCount:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-comment-alt"></i></span>
                <div class="qatitle bg_lg">未回复</div><div class="qnumber"><?php echo isset($uncount)?$uncount:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-comments"></i></span>
                <div class="qatitle bg_lg">总咨询量</div><div class="qnumber"><?php echo isset($allcount)?$allcount:0;?></div></a>
            </li>
          </ul>
        </div>

    <div class="row-fluid">
      <form action="#" method="get" class="form-horizontal">
        <hr>
        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li><span class="icon"><i class="icon-ok"></i></span></li>
              <li class="active"><a data-toggle="tab" href="#tab4">全部消息</a></li>
              <li><a data-toggle="tab" href="#tab5">今天</a></li>
              <li><a data-toggle="tab" href="#tab6">昨天</a></li>
              <li><a data-toggle="tab" href="#tab7">前天</a></li>
              <li><a data-toggle="tab" href="#tab8">更早</a></li>
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
                    <div class="txt2" style="width:70%"><strong>咨询内容</strong></div>
                    <div class="txt2" style="width:10%"><strong>咨询时间</strong></div>
                    <div class="txt2" style="width:7%"><strong>状态</strong></div>
                    <div class="txt2" style="width:3%"><strong>操作</strong></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a> </div>
                    <div class="txt2" style="width:10%">今天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge badge-important">新咨询</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                    <div class="txt2" style="width:10%"></div>
                    <div  class="collapse accordion-body" id="collapseGTwo" style="width:90%">
                      <div class="controls2">
                        <input type="text" placeholder="请填写您的回复" data-title="快速回复" class=" span9 tip-left" data-original-title="">
                        <button type="submit" class="btn btn-success">发送</button>
                      </div>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a><br>
                      <i class="icon-share-alt"></i>您好！那些通过的名单是教务那边的老师打电话去问的，可能会有些错漏，谢谢您的告知</div>
                    <div class="txt2" style="width:10%">今天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge">已回复</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
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
                    <div class="txt2" style="width:7%"><strong>用户昵称</strong></div>
                    <div class="txt2" style="width:70%"><strong>咨询内容</strong></div>
                    <div class="txt2" style="width:10%"><strong>咨询时间</strong></div>
                    <div class="txt2" style="width:7%"><strong>状态</strong></div>
                    <div class="txt2" style="width:3%"><strong>操作</strong></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a></div>
                    <div class="txt2" style="width:10%">今天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge badge-important badge-font">新咨询</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a><br>
                      <i class="icon-share-alt"></i>您好！那些通过的名单是教务那边的老师打电话去问的，可能会有些错漏，谢谢您的告知</div>
                    <div class="txt2" style="width:10%">今天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge">已回复</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                </ul>
              </div>
            </div>
            <div id="tab6" class="tab-pane">
              <div class="todo">
                <ul>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><strong>用户昵称</strong></div>
                    <div class="txt2" style="width:70%"><strong>咨询内容</strong></div>
                    <div class="txt2" style="width:10%"><strong>咨询时间</strong></div>
                    <div class="txt2" style="width:7%"><strong>状态</strong></div>
                    <div class="txt2" style="width:3%"><strong>操作</strong></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a></div>
                    <div class="txt2" style="width:10%">昨天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge badge-important badge-font">新咨询</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a><br>
                      <i class="icon-share-alt"></i>您好！那些通过的名单是教务那边的老师打电话去问的，可能会有些错漏，谢谢您的告知</div>
                    <div class="txt2" style="width:10%">昨天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge">已回复</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                </ul>
              </div>
            </div>
            <div id="tab7" class="tab-pane">
              <div class="todo">
                <ul>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><strong>用户昵称</strong></div>
                    <div class="txt2" style="width:70%"><strong>咨询内容</strong></div>
                    <div class="txt2" style="width:10%"><strong>咨询时间</strong></div>
                    <div class="txt2" style="width:7%"><strong>状态</strong></div>
                    <div class="txt2" style="width:3%"><strong>操作</strong></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a></div>
                    <div class="txt2" style="width:10%">前天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge badge-important badge-font">新咨询</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a><br>
                      <i class="icon-share-alt"></i>您好！那些通过的名单是教务那边的老师打电话去问的，可能会有些错漏，谢谢您的告知</div>
                    <div class="txt2" style="width:10%">前天 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge">已回复</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                </ul>
              </div>
            </div>
            <div id="tab8" class="tab-pane">
              <div class="todo">
                <ul>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><strong>用户昵称</strong></div>
                    <div class="txt2" style="width:70%"><strong>咨询内容</strong></div>
                    <div class="txt2" style="width:10%"><strong>咨询时间</strong></div>
                    <div class="txt2" style="width:7%"><strong>状态</strong></div>
                    <div class="txt2" style="width:3%"><strong>操作</strong></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a></div>
                    <div class="txt2" style="width:10%">2014-3-20 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge badge-important badge-font">新咨询</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                  <li class="clearfix">
                    <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#">李鹊欢</a></div>
                    <div class="txt2" style="width:70%"><a href="#">你好，我想问下，我北师珠没有查到我有过，为什么你们发的微信上有我的名字？</a><br>
                      <i class="icon-share-alt"></i>您好！那些通过的名单是教务那边的老师打电话去问的，可能会有些错漏，谢谢您的告知</div>
                    <div class="txt2" style="width:10%">2014-3-20 23:17</div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge">已回复</span></a></div>
                    <div class="txt2" style="width:3%"><a class="tip" href="feedback_info.html" title="回复"><i class="icon-edit"></i></a></div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="pagination">
          <ul>
            <li><a href="#"><i class="icon-chevron-left"></i> 上一页</a></li>
            <li class="active"> <a href="#">1</a> </li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">下一页 <i class="icon-chevron-right"></i></a></li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in/">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script>