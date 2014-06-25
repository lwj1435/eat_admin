<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">外卖订单管理</a> </div>
    <h1><span class="icon"> <i class="icon-edit"></i> </span>外卖订单管理</h1>
  </div>

  <div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li><span class="icon"><i class="icon-ok"></i></span></li>
              <li class="active"><a data-toggle="tab" href="#tab4">已确认订单</a></li>
              <li><a data-toggle="tab" href="#tab5">未确认订单 <?php if($uncount>0){?><span class="badge badge-important" style="font-weight:normal"><?php echo $uncount?$uncount:0;?></span><?php }?></a></li>
              <li><a data-toggle="tab" href="#tab6">已完成/已取消订单</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab4" class="tab-pane active">
				<div class="todo">
                      <ul>
                      	<li class="clearfix">
                        	<div class="txttitle">订单时间是：<?php if (isset($bookData)&&$bookData==date("Y-m-d")) {?><?php }?><input type="text" onClick="WdatePicker()"  value="<?php echo $bookData;?>" name="bookData" id="bookData" style="margin-top:5px;"><button type="button" class="btn btn-success" onclick="findBook()" style="margin-top:-5px;"><i class="icon-search"></i></button></div>
                            <div class="txttitle_right"><strong><?php echo $bookData;?></strong>&nbsp;共有预约订单&nbsp;<a href="#"><span class="label label-no">&nbsp;<?php echo $allToday?$allToday:0;?>&nbsp;</span></a>&nbsp;条</div>
                        </li>
                        <li class="clearfix">
                              <div class="txt" style="width:11%"><strong>订单状态</strong></div>
                              <div class="txt" style="width:12%"><strong>外卖送餐</strong></div>
                              <div class="txt" style="width:8%"><strong>订单类型</strong></div>
                              <div class="txt" style="width:12%"><strong>客户名称</strong></div>
                              <div class="txt" style="width:16%"><strong><i class="icon-time"></i> 送餐时间</strong></strong></div>
                              <div class="txt" style="width:8%"><strong>餐单</strong></div>
                              <div class="txt" style="width:10%"><strong>优惠劵</strong></div>
                              <div class="txt" style="width:10%"><strong>支付方式</strong></div>
                              <div class="txt" style="width:10%"><strong>支付状态</strong></div>
                              <div class="txt" style="width:3%"><strong>操作</strong></div>
                        </li>
                        <?php foreach ($list as $item):?>
                        <li class="clearfix">
                              <div class="txt2" style="width:11%"><span class="badge <?php echo $item->status==2?"badge-important":"badge-other";?>"><?php echo BaseFunctions::changeShow('takeOutStaDel',$item->status,'未知'); ?></span></div>
                              <div class="txt2" style="width:12%">
	                              <a class="tip" title="点击展开/收起订单" data-parent="#collapse-group" href="#showDiv<?php echo $item->id;?>" data-toggle="collapse">
	                              <?php if ($item->status==1) {
	                              	echo '<span class="badge badge-warning badge-no">';
	                              }else{
									echo '<span class="badge badge-important badge-no">';
									}?>
	                              <?php echo BaseFunctions::changeShow('takeOutSta',$item->status,'未知'); ?></span>
	                              </a>
                              </div>
                              <div class="txt2" style="width:8%"><a href="#"><span class="badge"><?php echo BaseFunctions::changeShow('CusSourceType',$item->take_out_type,'未知'); ?></span></a></div>
                              <div class="txt2" style="width:12%"><a href="#"><?php echo $item->take_out_name?$item->take_out_name:'未知';?></a></div>
                              <div class="txt2" style="width:16%"><a href="#"><span class="badge badge-success"><?php echo $item->take_out_time?></span> 前送到</a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo $item->take_num?></span></div>
                              <div class="txt2" style="width:10%"><?php if(isset($item->favorable_id)&$item->favorable_id) {
                              	echo '<i class="icon-ok"></i>';
                              }else{?><i class="icon-ban-circle"></i><?php }?></div>
                              <div class="txt2" style="width:10%"><span class="badge badge-success"><?php echo BaseFunctions::changeShow('PayType',$item->pay_type,'餐到付款'); ?></span></div>
                              <div class="txt2" style="width:10%"><a href="#"><?php echo BaseFunctions::changeShow('PaySta',$item->pay_status,"未支付"); ?></a></div>
                              <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("orders/takeAwayDetail")."?id=".$item->id;?>" title="编辑订单"><i class="icon-pencil"></i></a></div>
                              <div  class="collapse accordion-body" id="showDiv<?php echo $item->id;?>" style="width:100%">
                              <?php if ($item->status==1){
                              ?>
                              <div class="txt_open">订单已确认，未安排送餐。订单设置：<a class="btn btn-success btn-small" href="javascript:changeStatus(<?php echo $item->id;?>,2)">出餐送餐</a>&nbsp;&nbsp;<a class="btn btn-success btn-small" href="javascript:changeStatus(<?php echo $item->id;?>,4)">客户取消</a></div>
                              <?php 
                              }else{
							?>
                                  <div class="txt_open">送餐已安排，待客户签收。订单设置：<a class="btn btn-success btn-small" href="javascript:changeStatus(<?php echo $item->id;?>,3)">客户签收</a>&nbsp;&nbsp;<a class="btn btn-success btn-small" href="javascript:changeStatus(<?php echo $item->id;?>,4)">客户拒收</a></div>
                              <?php }?>
                              </div>
                        </li>
                        <?php endforeach;?>
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
            <div id="tab5" class="tab-pane">
                <div class="todo">
                      <ul>
                        <li class="clearfix">
                              <div class="txt" style="width:12%"><strong>外卖送餐</strong></div>
                              <div class="txt" style="width:8%"><strong>订单类型</strong></div>
                              <div class="txt" style="width:12%"><strong>客户名称</strong></div>
                              <div class="txt" style="width:16%"><strong><i class="icon-time"></i> 送餐时间</strong></strong></div>
                              <div class="txt" style="width:8%"><strong>餐单</strong></div>
                              <div class="txt" style="width:10%"><strong>优惠劵</strong></div>
                              <div class="txt" style="width:10%"><strong>支付方式</strong></div>
                              <div class="txt" style="width:10%"><strong>支付状态</strong></div>
                              <div class="txt" style="width:3%"><strong>操作</strong></div>
                        </li>
                         <?php foreach ($unlist as $item):?>
                        <li class="clearfix">
                              <div class="txt2" style="width:12%"><a class="tip" href="javascript:changeStatus(<?php echo $item->id;?>,1)" title="确认订单"><span class="badge badge-important badge-font"><i class="icon-ok"></i></span></a> <a class="tip" href="javascript:changeStatus(<?php echo $item->id;?>,4)" title="取消订单"><span class="badge badge-warning badge-font"><i class="icon-remove-sign"></i></span></a></div>
                              <div class="txt2" style="width:8%"><a href="#"><span class="badge"><?php echo BaseFunctions::changeShow('CusSourceType',$item->take_out_type,'未知'); ?></span></a></div>
                              <div class="txt2" style="width:12%"><a href="#"><?php echo $item->take_out_name?$item->take_out_name:"未知"; ?></a></div>
                              <div class="txt2" style="width:16%"><a href="#"><span class="badge badge-success"><?php echo $item->take_out_time?></span> 前送到</a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo $item->take_num?></span></div>
                              <div class="txt2" style="width:10%"><?php if(isset($item->favorable_id)&$item->favorable_id) {
                              	echo '<i class="icon-ok"></i>';
                              }else{?><i class="icon-ban-circle"></i><?php }?></div>
                              <div class="txt2" style="width:10%"><span class="badge badge-success"><?php echo BaseFunctions::changeShow('PayType',$item->pay_type,'餐到付款'); ?></span></div>
                              <div class="txt2" style="width:10%"><a href="#"><?php echo BaseFunctions::changeShow('PaySta',$item->pay_status,"未支付"); ?></a></div>
                              <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("orders/takeAwayDetail")."?id=".$item->id;?>" title="编辑订单"><i class="icon-pencil"></i></a></div>
                             
                        </li>
                        <?php endforeach;?>
                      </ul>
                    </div>
                    <div class="pagination">
                      <?php 

    $this->widget('CLinkPager', array( 

        'pages' => $unpages, 

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
                        <li class="clearfix">
                              <div class="txt" style="width:11%"><strong>订单状态</strong></div>
                              <div class="txt" style="width:12%"><strong>外卖送餐</strong></div>
                              <div class="txt" style="width:8%"><strong>订单类型</strong></div>
                              <div class="txt" style="width:12%"><strong>客户名称</strong></div>
                              <div class="txt" style="width:16%"><strong><i class="icon-time"></i> 送餐时间</strong></strong></div>
                              <div class="txt" style="width:8%"><strong>餐单</strong></div>
                              <div class="txt" style="width:10%"><strong>优惠劵</strong></div>
                              <div class="txt" style="width:10%"><strong>支付方式</strong></div>
                              <div class="txt" style="width:10%"><strong>支付状态</strong></div>
                              <div class="txt" style="width:3%"><strong>操作</strong></div>
                        </li>
                        <?php foreach ($dellist as $item):?>
                        <li class="clearfix">
                              <div class="txt2" style="width:11%"><span class="badge <?php echo $item->status == 4?"badge-inverse" :"badge-info";?>badge-info"><?php echo BaseFunctions::changeShow('takeOutStaDel',$item->status,'未知'); ?></span></div>
                              <div class="txt2" style="width:12%"><a href="#"><span class="badge badge-font"><?php echo BaseFunctions::changeShow('takeOutSta',$item->status,'未知'); ?></span></a></div>
                              <div class="txt2" style="width:8%"><a href="#"><span class="badge"><?php echo BaseFunctions::changeShow('CusSourceType',$item->take_out_type,'未知'); ?></span></a></div>
                              <div class="txt2" style="width:12%"><a href="#"><?php echo $item->take_out_name?$item->take_out_name:"未知"; ?></a></div>
                              <div class="txt2" style="width:16%"><a href="#"><span class="badge badge-success"><?php echo $item->take_out_time; ?></span> 前送到</a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo $item->take_num; ?></span></div>
                              <div class="txt2" style="width:10%"><?php if(isset($item->favorable_id)&$item->favorable_id) {
                              	echo '<i class="icon-ok"></i>';
                              }else{?><i class="icon-ban-circle"></i><?php }?></div>
                              <div class="txt2" style="width:10%"><span class="badge badge-success"><?php echo BaseFunctions::changeShow('PayType',$item->pay_type,'餐到付款'); ?></span></div>
                              <div class="txt2" style="width:10%"><a href="#"><?php echo BaseFunctions::changeShow('PaySta',$item->pay_status,'未支付'); ?></a></div>
                              <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("orders/takeAwayDetail")."?id=".$item->id;?>" title="编辑订单"><i class="icon-search"></i></a></div>
                        </li>
                        <?php endforeach;?>
                        
                        
                      </ul>
                    </div>
                    <div class="pagination">
                      <?php 

    $this->widget('CLinkPager', array( 

        'pages' => $delpages, 

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

<script src="<?php echo Yii::app()->baseUrl;?>/plus/My97DatePicker/WdatePicker.js"></script>

<script>

function changeStatus(id,sta){
	
	$.post("<?php echo $this->createUrl('orders/changeTakeOutSta')?>",
	{
		id:id,
		sta:sta
	},
	function(code,status){
		alert(code);
		//$("#content_code").text(code);
		location.reload();
	});

}

function findBook(){
	var s_d = $("#bookData").val();
	location.href="<?php echo $this->createUrl("orders/takeaway")."?bookData="?>"+s_d;
}
    </script>