<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="/client/culist.html">客户资源管理</a> <a href="#" class="current">客户群发推送</a> </div>
    <h1><span class="icon"> <i class="icon-external-link"></i> </span>客户群发推送</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
      <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        <h5>群发推送信息</h5>
        <div style="float:right; line-height:40px; margin-right:15px;">
        <span class=" label badge-primary"> 总客户：300位</span>
        <span class=" label badge-warning"> 选定客户：30位</span>
        <span class=" label badge-success"> 剩余推送条数：3000条</span>
        </div>
      </div>
      
      <form action="#" method="get" class="form-horizontal">
      <input type="hidden" name="idlist" id="idlist" value="<?php echo $idlist;?>"/>
        <div class="widget-content">
          <div class="control-group">
            <label class="control-label">推送标题：</label>
            <div class="controls">
              <input type="text" class="span11" placeholder="请输入推送信息的标题" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">发送推送时间：</label>
            <div class="controls">
              <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2013" class="datepicker span11">
              <span class="help-block">预订推送的时间</span> </div>
          </div>
          <div class="control-group">
          <label class="control-label">推送内容：</label>
            <div class="controls">
              <textarea class="textarea_editor span12" rows="6" placeholder="推送的内容"></textarea>
            </div>
          </div>
            <div class="control-group">
              <label class="control-label">发送类型</label>
              <div class="controls">
                <label>
                  <input type="radio" name="radios" />
                  推送勾选的客户</label>
                <label>
                  <input type="radio" name="radios" />
                  推送全部客户</label>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success">发送推送</button>
            </div>
        </div>
      </form>
    </div>
      </div>
    </div>
  </div>
</div>