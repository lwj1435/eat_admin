<div id="content">
 <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">用户咨询管理</a> </div>
    <h1><span class="icon"> <i class="icon-comment"></i> </span>用户咨询管理</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box widget-chat">
          <div class="widget-title"> <span class="icon"> <i class="icon-comment"></i> </span>
            <h5>Let's do a chat</h5>
          </div>
          <div class="widget-content nopadding">
            <div class="chat-users panel-right2">
              <div class="panel-title">
                <h5>在线咨询客户</h5>
              </div>
              <div class="panel-content nopadding">
                  <ul class="contact-list">
                  <li id="user-John" class="online new"><a href="#"><img alt="" src="img/demo/av3.jpg" /> <span><?php echo $sName;?></span></a><span class="msg-count badge badge-info"><?php echo $count;?></span></li>
                  </ul>
              </div>
            </div>
            <div class="chat-content panel-left2">
              <div class="chat-messages" id="chat-messages">
                <div id="chat-messages-inner">
                <?php foreach ($list as $item): ?> 
                 <p><span class="msg-block"><strong>用户名</strong><span class="time"><?php echo $item->from_user_name;?></span><span class="msg"><?php echo $item->content;?></span></span></p>
                 <?php endforeach;?>
                </div>
              </div>
              <div class="chat-message well">
                <button class="btn btn-success" onclick="replyMsg(<?php echo $iId;?>)">发送</button>
                <span class="input-box">
                <input type="text" name="msg-box" id="msg-box" />
                </span> </div>
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
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<!-- <script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.chat.js"></script> -->

<script>
	function replyMsg(id){
		var content = $("#msg-box").val();
		if(content){
			$.post("<?php echo $this->createUrl('consulting/replyMsg')?>",
		  			{
		  			id:id,
		  			content:content
		  			},
		  			function(code,status){
		  				var objs = eval('('+code+')');
			  		if(objs.type){
						alert("回复成功");
						location.reload();
				  	}else{
				  		alert(objs.msg);
					}
		  	});  
		}
	}
</script>