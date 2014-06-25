<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">客户群发推送</a> </div>
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
<!--        <span class=" label badge-primary"> 总客户：<?php echo $allCount?$allCount:'0';?>位</span>
        <span class=" label badge-warning"> 选定客户：<?php echo $selectCount?$selectCount:'0';?>位</span>-->
        <span class=" label badge-success"> 剩余推送条数：3000条</span>
        </div>
      </div>
      
      <form action="<? echo $this->createUrl("consulting/push");?>" method="POST" onsubmit="return checkForm()"  class="form-horizontal"> 
        <div class="widget-content nopadding"><br />
		  <div class="control-group">
            <label class="control-label">接收人：</label>
            <div class="controls" id="selectList">
              <select multiple placeholder="选择人" name="idlist2[]" id="showIdList">
									<?php 
									foreach ($allcus as $iKey => $sMTStr){
										?>
				<option <?php echo isset($idlist)?$this->isInArray($iKey,$idlist)?"selected":'':'';?> value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
																						<?php 
																					}
									?>
			</select>
            </div>
            <div class="controls" id="allSelect" >
        		    全部人员
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">推送标题：</label>
            <div class="controls">
              <input type="text" class="span11" placeholder="请输入推送信息的标题" name='title' id="title" value='<?php echo $title;?>'/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">发送推送时间：</label>
            <div class="controls">
              <input type="text" data-date="2013-01-02" data-date-format="yyyy-mm-dd" value="<?php echo $send_time?$send_time:date("Y-m-d");?>" onfocus="WdatePicker({minDate:'%y-%M-%d'})" class="span11" name="send_time">
              <span class="help-block">预订推送的时间</span> </div>
          </div>
          <div class="control-group">
          <label class="control-label">推送内容：</label>
            <div class="controls">
              <textarea class="span11" rows="6" placeholder="推送的内容" name="send_content" id="send_content"><?php echo $send_content;?></textarea>
            </div>
          </div>
            <div class="control-group">
              <label class="control-label">发送类型</label>
              <div class="controls">
               <label>
               <?php $send_type=$send_type?$send_type:1;?>
                  <input type="radio" name="send_type" value=1 <?php echo $send_type==1?"checked":"";?> onclick="$('#allSelect').attr('style','display:none');$('#selectList').attr('style','');"/>
                  短信勾选的客户</label>
                <label>
                  <input type="radio" name="send_type" value=2 <?php echo $send_type==2?"checked":"";?> onclick="$('#selectList').attr('style','display:none');$('#allSelect').attr('style','');"/>
                  短信全部客户</label>
              </div>
              <br />
			<div class="form-actions">
              <button type="submit" class="btn btn-large btn-success span2">发送推送</button>
            </div>
            </div>
        </div>
      </form>
    </div>
      </div>
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
<script>
function checkForm(){
	if(!$('#send_content').val()){
		alert("内容不能为空!");
		return false;
	}
	if(!$('#title').val()){
		alert("标题不能为空!");
		return false;
	}
	return true;
}
$('#allSelect').attr('style','display:none');
                      </script>