<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#">用户咨询管理</a></div>
    <h1><span class="icon"> <i class="icon-comment"></i> </span>用户咨询管理</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a href="javascript:">
            	<span class="label label-warning"><i class="icon-comments-alt"></i></span>
                <div class="qatitle bg_lg">新消息</div><div class="qnumber"><?php echo isset($todayCount)?$todayCount:0;?></div></a>
            </li>
            <li><a href="javascript:">
            	<span class="label label-warning"><i class="icon-comment-alt"></i></span>
                <div class="qatitle bg_lg">未回复</div><div class="qnumber"><?php echo isset($uncount)?$uncount:0;?></div></a>
            </li>
            <li><a href="javascript:">
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
                  
                  <?php foreach ($alllist as $item): ?> 
                 	<li class="clearfix">
                     <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#"><?php echo CHtml::encode($item->from_user_name ); ?></a></div>
                    
                    <div class="txt2" style="width:70%">
                     <?php if ($item->status != 2) {
                        ?>
                        <a data-parent="#collapse-group" href="#collapseGTwo<?php echo $item->id;?>" data-toggle="collapse"><?php echo CHtml::encode($item->content ); ?></a> 
                        <?php 
                      }else{
						?>
						<a href="#"><?php echo CHtml::encode($item->content ); ?></a><br>
                      <span class="badge badge-success">回复内容</span> <?php echo CHtml::encode($item->reply_content ); ?>
						<?php }?>
                    </div>
                    
                    <div class="txt2" style="width:10%"><?php echo date('Y-m-d H:i:s',$item->add_time)?></div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge <?php echo $item->status==2?"":"badge-important"; ?>"><?php   echo BaseFunctions::changeShow('msgSta',$item->status,'未知');?></span></a></div>
                    
                    <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("consulting/relyDetail")."?name=".$item->from_user_name."&id=".$item->id;?>" title="回复"><i class="icon-edit"></i></a></div>
                    
                    <div class="txt2" style="width:10%"></div>
                    <div  class="collapse accordion-body" id="collapseGTwo<?php echo $item->id;?>" style="width:90%">
                      <div class="controls2">
                        <input type="text" id="input<?php echo $item->id;?>" placeholder="请填写您的回复" data-title="快速回复" class=" span9 tip-left" data-original-title="">
                        <button type="submit" class="btn btn-success" onclick="replyMsg(<?php echo $item->id;?>)">发送</button>
                      </div>
                    </div>
                    
                  </li>
                  
                  <?php endforeach; ?> 
                </ul>
              </div>
               <div class="pagination">
		         <?php 
		
				    $this->widget('CLinkPager', array( 
				
				        'pages' => $allpages, 
				
				        'selectedPageCssClass' => 'active', 
				
				        'hiddenPageCssClass' => 'disabled', 
				
				        'header' => '', 
				
				        'maxButtonCount' => 10, 
				
				        'htmlOptions' => array('class' => ''), 
				
				        'firstPageLabel' => '首页', 
				
				        'nextPageLabel' => '后', 
				
				        'prevPageLabel' => '前', 
				
				        'lastPageLabel' => '最后', 
				
				            ) 
				
				    ); 
		
		   		 ?> 
		      </div>
            </div>
            <div id="tab5" class="tab-pane">
              <div class="todo">
                <ul>
					 <?php foreach ($list as $item): ?> 
                 	<li class="clearfix">
                     <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#"><?php echo CHtml::encode($item->from_user_name ); ?></a></div>
                    
                    <div class="txt2" style="width:70%">
                     <?php if ($item->status != 2) {
                        ?>
                        <a data-parent="#collapse-group" href="#collapseGTwo<?php echo $item->id;?>" data-toggle="collapse"><?php echo CHtml::encode($item->content ); ?></a> 
                        <?php 
                      }else{
						?>
						<a href="#"><?php echo CHtml::encode($item->content ); ?></a><br>
                      <span class="badge badge-success">回复内容</span> <?php echo CHtml::encode($item->reply_content ); ?>
						<?php }?>
                    </div>
                    
                    <div class="txt2" style="width:10%"><?php echo date('Y-m-d H:i:s',$item->add_time)?></div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge <?php echo $item->status==2?"":"badge-important"; ?>"><?php   echo BaseFunctions::changeShow('msgSta',$item->status,'未知');?></span></a></div>
                    
                    <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("consulting/relyDetail")."?name=".$item->from_user_name."&id=".$item->id;?>" title="回复"><i class="icon-edit"></i></a></div>
                    
                    <div class="txt2" style="width:10%"></div>
                    <div  class="collapse accordion-body" id="collapseGTwo<?php echo $item->id;?>" style="width:90%">
                      <div class="controls2">
                        <input type="text" id="input<?php echo $item->id;?>" placeholder="请填写您的回复" data-title="快速回复" class=" span9 tip-left" data-original-title="">
                        <button type="submit" class="btn btn-success" onclick="replyMsg(<?php echo $item->id;?>)">发送</button>
                      </div>
                    </div>
                    
                  </li>
                  
                  <?php endforeach; ?> 
                </ul>
              </div>
               <div class="pagination">
		         <?php 
		
				    $this->widget('CLinkPager', array( 
				
				        'pages' => $pages, 
				
				        'selectedPageCssClass' => 'active', 
				
				        'hiddenPageCssClass' => 'disabled', 
				
				        'header' => '', 
				
				        'maxButtonCount' => 10, 
				
				        'htmlOptions' => array('class' => ''), 
				
				        'firstPageLabel' => '首页', 
				
				        'nextPageLabel' => '后', 
				
				        'prevPageLabel' => '前', 
				
				        'lastPageLabel' => '最后', 
				
				            ) 
				
				    ); 
		
		   		 ?> 
		      </div>
            </div>
            <div id="tab6" class="tab-pane">
              <div class="todo">
                <ul>
                  <?php foreach ($yeslist as $item): ?> 
                 	<li class="clearfix">
                     <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#"><?php echo CHtml::encode($item->from_user_name ); ?></a></div>
                    
                    <div class="txt2" style="width:70%">
                     <?php if ($item->status != 2) {
                        ?>
                        <a data-parent="#collapse-group" href="#collapseGTwo<?php echo $item->id;?>" data-toggle="collapse"><?php echo CHtml::encode($item->content ); ?></a> 
                        <?php 
                      }else{
						?>
						<a href="#"><?php echo CHtml::encode($item->content ); ?></a><br>
                      <span class="badge badge-success">回复内容</span><?php echo CHtml::encode($item->reply_content ); ?>
						<?php }?>
                    </div>
                    
                    <div class="txt2" style="width:10%"><?php echo date('Y-m-d H:i:s',$item->add_time)?></div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge <?php echo $item->status==2?"":"badge-important"; ?>"><?php   echo BaseFunctions::changeShow('msgSta',$item->status,'未知');?></span></a></div>
                    
                    <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("consulting/relyDetail")."?name=".$item->from_user_name."&id=".$item->id;?>" title="回复"><i class="icon-edit"></i></a></div>
                    
                    <div class="txt2" style="width:10%"></div>
                    <div  class="collapse accordion-body" id="collapseGTwo<?php echo $item->id;?>" style="width:90%">
                      <div class="controls2">
                        <input type="text" id="input<?php echo $item->id;?>" placeholder="请填写您的回复" data-title="快速回复" class=" span9 tip-left" data-original-title="">
                        <button type="submit" class="btn btn-success" onclick="replyMsg(<?php echo $item->id;?>)">发送</button>
                      </div>
                    </div>
                    
                  </li>
                  
                  <?php endforeach; ?> 
                </ul>
              </div>
               <div class="pagination">
		         <?php 
		
				    $this->widget('CLinkPager', array( 
				
				        'pages' => $yespages, 
				
				        'selectedPageCssClass' => 'active', 
				
				        'hiddenPageCssClass' => 'disabled', 
				
				        'header' => '', 
				
				        'maxButtonCount' => 10, 
				
				        'htmlOptions' => array('class' => ''), 
				
				        'firstPageLabel' => '首页', 
				
				        'nextPageLabel' => '后', 
				
				        'prevPageLabel' => '前', 
				
				        'lastPageLabel' => '最后', 
				
				            ) 
				
				    ); 
		
		   		 ?> 
		      </div>
            </div>
            <div id="tab7" class="tab-pane">
              <div class="todo">
                <ul>
                   <?php foreach ($beflist as $item): ?> 
                 	<li class="clearfix">
                     <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#"><?php echo CHtml::encode($item->from_user_name ); ?></a></div>
                    
                    <div class="txt2" style="width:70%">
                     <?php if ($item->status != 2) {
                        ?>
                        <a data-parent="#collapse-group" href="#collapseGTwo<?php echo $item->id;?>" data-toggle="collapse"><?php echo CHtml::encode($item->content ); ?></a> 
                        <?php 
                      }else{
						?>
						<a href="#"><?php echo CHtml::encode($item->content ); ?></a><br>
                      <span class="badge badge-success">回复内容</span><?php echo CHtml::encode($item->reply_content ); ?>
						<?php }?>
                    </div>
                    
                    <div class="txt2" style="width:10%"><?php echo date('Y-m-d H:i:s',$item->add_time)?></div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge <?php echo $item->status==2?"":"badge-important"; ?>"><?php   echo BaseFunctions::changeShow('msgSta',$item->status,'未知');?></span></a></div>
                    
                    <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("consulting/relyDetail")."?name=".$item->from_user_name."&id=".$item->id;?>" title="回复"><i class="icon-edit"></i></a></div>
                    
                    <div class="txt2" style="width:10%"></div>
                    <div  class="collapse accordion-body" id="collapseGTwo<?php echo $item->id;?>" style="width:90%">
                      <div class="controls2">
                        <input type="text" id="input<?php echo $item->id;?>" placeholder="请填写您的回复" data-title="快速回复" class=" span9 tip-left" data-original-title="">
                        <button type="submit" class="btn btn-success" onclick="replyMsg(<?php echo $item->id;?>)">发送</button>
                      </div>
                    </div>
                    
                  </li>
                  
                  <?php endforeach; ?> 
                </ul>
              </div>
               <div class="pagination">
		         <?php 
		
				    $this->widget('CLinkPager', array( 
				
				        'pages' => $befpages, 
				
				        'selectedPageCssClass' => 'active', 
				
				        'hiddenPageCssClass' => 'disabled', 
				
				        'header' => '', 
				
				        'maxButtonCount' => 10, 
				
				        'htmlOptions' => array('class' => ''), 
				
				        'firstPageLabel' => '首页', 
				
				        'nextPageLabel' => '后', 
				
				        'prevPageLabel' => '前', 
				
				        'lastPageLabel' => '最后', 
				
				            ) 
				
				    ); 
		
		   		 ?> 
		      </div>
            </div>
            <div id="tab8" class="tab-pane">
              <div class="todo">
                <ul>
                  <?php foreach ($oldlist as $item): ?> 
                 	<li class="clearfix">
                     <div class="txt2" style="width:3%">
                      <input type="checkbox" />
                    </div>
                    <div class="txt2" style="width:7%"><a href="#"><?php echo CHtml::encode($item->from_user_name ); ?></a></div>
                    
                    <div class="txt2" style="width:70%">
                     <?php if ($item->status != 2) {
                        ?>
                        <a data-parent="#collapse-group" href="#collapseGTwo<?php echo $item->id;?>" data-toggle="collapse"><?php echo CHtml::encode($item->content ); ?></a> 
                        <?php 
                      }else{
						?>
						<a href="#"><?php echo CHtml::encode($item->content ); ?></a><br>
                      <span class="badge badge-success">回复内容</span><?php echo CHtml::encode($item->reply_content ); ?>
						<?php }?>
                    </div>
                    
                    <div class="txt2" style="width:10%"><?php echo date('Y-m-d H:i:s',$item->add_time)?></div>
                    <div class="txt2" style="width:7%"><a href="#"><span class="badge <?php echo $item->status==2?"":"badge-important"; ?>"><?php   echo BaseFunctions::changeShow('msgSta',$item->status,'未知');?></span></a></div>
                    
                    <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("consulting/relyDetail")."?name=".$item->from_user_name."&id=".$item->id;?>" title="回复"><i class="icon-edit"></i></a></div>
                    
                    <div class="txt2" style="width:10%"></div>
                    <div  class="collapse accordion-body" id="collapseGTwo<?php echo $item->id;?>" style="width:90%">
                      <div class="controls2">
                        <input type="text" id="input<?php echo $item->id;?>" placeholder="请填写您的回复" data-title="快速回复" class=" span9 tip-left" data-original-title="">
                        <button type="submit" class="btn btn-success" onclick="replyMsg(<?php echo $item->id;?>)">发送</button>
                      </div>
                    </div>
                    
                  </li>
                  
                  <?php endforeach; ?> 
                </ul>
              </div>
               <div class="pagination">
		         <?php 
		
				    $this->widget('CLinkPager', array( 
				
				        'pages' => $oldpages, 
				
				        'selectedPageCssClass' => 'active', 
				
				        'hiddenPageCssClass' => 'disabled', 
				
				        'header' => '', 
				
				        'maxButtonCount' => 10, 
				
				        'htmlOptions' => array('class' => ''), 
				
				        'firstPageLabel' => '首页', 
				
				        'nextPageLabel' => '后', 
				
				        'prevPageLabel' => '前', 
				
				        'lastPageLabel' => '最后', 
				
				            ) 
				
				    ); 
		
		   		 ?> 
		      </div>
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
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script>

<script>
	function replyMsg(id){
		var content = $("#input"+id).val();
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