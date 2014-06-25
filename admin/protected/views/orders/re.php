<?php $aArrBookTypeCss = array(
		"A"=>"badge-important badge-no",
		"B"=>"badge-success badge-no",
		"C"=>"badge-info badge-no",
		"D"=>"badge-warning badge-no",
);?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">预约订单管理</a> </div>
    <h1><span class="icon"> <i class="icon-edit"></i> </span>预约订单管理</h1>
  </div>
	<input type="hidden" id="clickType" value="" ></input>
  <div class="container-fluid"><hr>
        <div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a href=""><div class="qatitle bg_lo">2人桌已到</div><div class="qnumber"><?php echo isset($reachArr['A'])?($reachArr['A']?'A'.$reachArr['A']:'无'):'无';?></div></a></li>
            <li><a href=""><div class="qatitle bg_dg">4人桌已到</div><div class="qnumber"><?php echo isset($reachArr['B'])?($reachArr['B']?'B'.$reachArr['B']:'无'):'无';?></div></a></li>
            <li><a href=""><div class="qatitle bg_db">5-8人桌已到</div><div class="qnumber"><?php echo isset($reachArr['C'])?($reachArr['C']?'C'.$reachArr['C']:'无'):'无';?></div></a></li>
            <li><a href=""><div class="qatitle bg_ly">包厢已到</div><div class="qnumber"><?php echo isset($reachArr['D'])?($reachArr['D']?'D'.$reachArr['D']:'无'):'无';?></div></a></li>
            <li class="bg_lb"><a href="<?php echo $this->createUrl("orders/addReservation");?>"><span class="label label-warning"><i class="icon-plus-sign"></i></span><div class="qbutton">新增预约</div></a></li>
            <li class="bg_lb"><a href="<?php echo $this->createUrl("orders/queueList");?>"><span class="label label-warning"><i class="icon-signin"></i></span><div class="qbutton">新增排队</div></a></li>
        </ul>
        </div>
    <div class="row-fluid"><hr>
        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li><span class="icon"><i class="icon-ok"></i></span></li>
              <li class="active"><a data-toggle="tab" href="#tab4">排队中订单</a></li>
              <li><a data-toggle="tab" href="#tab5">未确认订单 <?php if ($uncount>0) {
              	?><span class="badge badge-important" style="font-weight:normal"><?php echo isset($uncount)?$uncount:0;?></span><?php }?></a></li>
              <li><a data-toggle="tab" href="#tab6">已完成/已取消订单</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab4" class="tab-pane active">
				<div class="todo">
                      <ul>
                      	<li class="clearfix">
                        	<div class="txttitle">订单时间是：<?php if (isset($bookData)&&$bookData==date("Y-m-d")) {?><?php }?><input type="text" onClick="WdatePicker()"  value="<?php echo $bookData;?>" name="bookData" id="bookData" style="margin-top:5px;"><button type="button" class="btn btn-success" onclick="findBook()" style="margin-top:-5px;"><i class="icon-search"></i></button></div>
                            <div class="txttitle_right"><a href="javascript:findBookByType('D')"><span class="label label-warning label-no">&nbsp;包厢&nbsp;</span><span class="label label-no">&nbsp;<?php echo isset($dcount)?$dcount:0;?>&nbsp;</span></a></div>
                            <div class="txttitle_right"><a href="javascript:findBookByType('C')"><span class="label label-info label-no">&nbsp;5-8人桌&nbsp;</span><span class="label label-no">&nbsp;<?php echo isset($ccount)?$ccount:0;?>&nbsp;</span></a>&nbsp;&nbsp;</div>
                            <div class="txttitle_right"><a href="javascript:findBookByType('B')"><span class="label label-success label-no">&nbsp;4人桌&nbsp;</span><span class="label label-no">&nbsp;<?php echo isset($bcount)?$bcount:0;?>&nbsp;</span></a>&nbsp;&nbsp;</div>
                            <div class="txttitle_right"><a href="javascript:findBookByType('A')"><span class="label label-important label-no">&nbsp;2人桌&nbsp;</span><span class="label label-no">&nbsp;<?php echo isset($acount)?$acount:0;?>&nbsp;</span></a>&nbsp;&nbsp;</div>
                            <div class="txttitle_right"><strong><?php echo $bookData;?></strong>&nbsp;共有预约订单&nbsp;<a href="javascript:findBookByType('')"><span class="label label-no">&nbsp;<?php echo isset($count)?$count:0;?>&nbsp;</span></a>&nbsp;条，</div>
                        </li>
                        <li class="clearfix">
                              <div class="txt" style="width:20%"><strong>排队号</strong></div>
                              <!-- <div class="txt" style="width:8%"><strong>订单类型</strong></div> -->
                              <div class="txt" style="width:8%"><strong>客户名称</strong></div>
                              <div class="txt" style="width:20%"><strong><i class="icon-time"></i> 预订时间</strong></div>
                              <div class="txt" style="width:8%"><strong>人数</strong></div>
                              <div class="txt" style="width:10%"><strong>餐桌</strong></div>
                              <div class="txt" style="width:10%"><strong>优惠劵</strong></div>
                              <div class="txt" style="width:10%"><strong>餐单</strong></div>
                              <div class="txt" style="width:11%"><strong>订单状态</strong></div>
                              <div class="txt" style="width:3%"><strong>操作</strong></div>
                        </li>
                        
                         <?php foreach ($list as $iListKey => $item): ?> 
                        <li class="clearfix">

                              <div class="txt2" style="width:20%"><a class="tip" title="点击展开/收起订单" data-parent="#collapse-group" href="#showDiv<?php echo $item->id;?>" data-toggle="collapse"><span class="badge <?php echo isset($aArrBookTypeCss[$item->book_type])?$aArrBookTypeCss[$item->book_type]:'';?>"><?php echo  ($item->book_no>0)? $item->book_type.$item->book_no:"等号中";
                              	?></span></a>
                              	<?php if ($item->status ==2 ) {
                              		?>
                              			<span class="badge badge-no"><i class="icon-ok"></i></span>
                              		<?php 
                              	}?>
                              	</div>
                              <!-- <div class="txt2" style="width:8%"><a href="#"><span class="badge"><?php echo BaseFunctions::changeShow('cusSourceType',$item->book_source_type,'未知'); ?></span></a></div>-->
                              <div class="txt2" style="width:8%"><a href="#"><?php echo $item->book_name?CHtml::encode($item->book_name ):"未知"; ?></a></div>
                              <div class="txt2" style="width:20%"><a href="#"><?php echo $item->book_time?CHtml::encode($item->book_time ):"未知"; ?></a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo CHtml::encode($item->book_num ); ?></span></div>
                              <div class="txt2" style="width:10%"><span class="badge badge-success"><?php echo BaseFunctions::changeShow('seatType',$item->book_type,'未知'); ?></span></div>
                              <div class="txt2" style="width:10%"><i class="<?php echo $item->cou_list!=""&&$item->cou_list!=",,"?"icon-ok":"icon-ban-circle";?>"></i></div>
                              <div class="txt2" style="width:10%"><i class="<?php echo $item->order_num?"icon-ok":"icon-ban-circle";?>"></i></div>
                              <div class="txt2" style="width:11%"><span class="badge <?php echo $item->status==2?"badge-important":"badge-other";?>">
                              <?php 
                              echo BaseFunctions::changeShow('bookStatus',$item->status,'未知');
                              ?></span></div>
                              <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("orders/editOrder")."/?ii=".$item->id;?>" title="编辑订单"><i class="icon-pencil"></i></a></div>
  <!--                             <div  class="collapse accordion-body" id="showDiv<?php //echo $item->id;?>" style="width:100%"> -->
<!--                                   <div class="txt_open">订单排队已到号，等待客户到店中，安排就餐位置为：<span class="badge badge-success">A23桌</span><br>订单设置：<span class="badge badge-success">客户到店</span>&nbsp;&nbsp;<span class="badge badge-success">排队延时</span></div> -->
<!--                               </div> -->
                              
                              <div  class="collapse accordion-body" id="showDiv<?php echo $item->id;?>" style="width:100%">
                              	<?php if ($item->status==1) {?>
                                  <div class="txt_open">订单排队未到号，设置订单为：<a href="#myModal<?php echo $item->id;?>" data-toggle="modal" class="badge badge-success" onclick="$('#clickType').val(1)">排队到号</a>&nbsp;&nbsp;<a href="#myModal<?php echo $item->id;?>" data-toggle="modal" class="badge badge-success" onclick="$('#clickType').val(2)" >客户到店</a>&nbsp;&nbsp;<span class="badge badge-success">排队延时</span>
                                  	<div id="myModal<?php echo $item->id;?>" class="modal hide">
                                          <div class="modal-header">
                                            <button data-dismiss="modal" class="close" type="button">×</button>
                                            <h3>选择坐席位置</h3>
                                          </div>
                                          <div class="modal-body">
                                                <div class="quick-actions_homepage">
                                                  <ul class="quick-actions padding-L20">
                                                  <?php 
                                                  if (isset($seatList[$item->book_type])) {
														foreach ($seatList[$item->book_type] as $iSLKey => $aSLval){?>
														<li class="bg_lg"><a href="javascript:changeOrder(<?php echo $item->id;?>,2,<?php echo $aSLval->id;?>,'<?php echo $aSLval->seat_type;?>',<?php echo $aSLval->seat_num;?>,<?php echo $item->status;?>)"><span class="store-txt"><?php echo BaseFunctions::changeShow('seatType',$item->book_type,'未知'); ?></span><br><span class="store-number"><?php echo $item->book_type.$aSLval->seat_num;?></span></a></li>
													<?php }
													
                                                  }else{
													
											      }
											      foreach ($seatList as $iSLKey => $aSLval){
											      	if ($iSLKey!=$item->book_type) {
											      															foreach ($aSLval as $adetailSLVal){?>
											      														<li class="bg_lg"><a href="javascript:changeOrder(<?php echo $item->id;?>,2,<?php echo $adetailSLVal->id;?>,'<?php echo $adetailSLVal->seat_type;?>',<?php echo $adetailSLVal->seat_num;?>,<?php echo $item->status;?>)"><span class="store-txt"><?php echo BaseFunctions::changeShow('seatType',$iSLKey,'未知'); ?></span><br><span class="store-number"><?php echo $iSLKey.$adetailSLVal->seat_num;?></span></a></li>
											      														<?php }
											      														}
											      													}
                                                  ?>
                                                  </ul>
                                                </div>
                                          </div>
                                   	</div>
                                  </div>
                                  <?php }else{?>
                                  		 
                                  		<div class="txt_open">订单排队已到号，等待客户到店中，安排就餐位置为：<span class="badge badge-success"><?php echo $item->book_seat_type;?><?php echo $item->book_seat_num;?></span><br>订单设置：<a class="badge badge-success" href="javascript:changeStatus(<?php echo $item->id;?>,3)">客户到店</a>&nbsp;&nbsp;<a class="badge badge-success" href='javascript:addTime(<?php echo $item->id;?>)' >排队延时</a>&nbsp;&nbsp;<span class="badge badge-success">短信提醒</span></div>
                              			
                                  <?php }?>
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
            <div id="tab5" class="tab-pane">
                <div class="todo">
                      <ul>
                        <li class="clearfix">
                              <div class="txt" style="width:20%"><strong>排队号</strong></div>
                              <!-- <div class="txt" style="width:8%"><strong>订单类型</strong></div> -->
                              <div class="txt" style="width:8%"><strong>客户名称</strong></div>
                              <div class="txt" style="width:20%"><strong><i class="icon-time"></i> 预订时间</strong></strong></div>
                              <div class="txt" style="width:8%"><strong>人数</strong></div>
                              <div class="txt" style="width:10%"><strong>餐桌</strong></div>
                              <div class="txt" style="width:10%"><strong>优惠劵</strong></div>
                              <div class="txt" style="width:10%"><strong>餐单</strong></div>
                              <div class="txt" style="width:11%"><strong>订单状态</strong></div>
                              <div class="txt" style="width:3%"><strong>操作</strong></div>
                        </li>
                        <?php foreach ($unlist as $iListKey => $item): ?> 
                        <li class="clearfix">
                              <div class="txt2" style="width:20%"><a class="tip" href="javascript:changeStatus(<?php echo $item->id ; ?>,1)" title="确认订单"><span class="badge badge-important badge-font"><i class="icon-ok"></i></span></a> <a class="tip" href="javascript:changeStatus(<?php echo $item->id ; ?>,5)" title="取消订单"><span class="badge badge-warning badge-font"><i class="icon-remove-sign"></i></span></a></div>
                              <!-- <div class="txt2" style="width:8%"><a href="#"><span class="badge"><?php echo BaseFunctions::changeShow('cusSourceType',$item->book_source_type,'未知'); ?></span></a></div> -->
                              <div class="txt2" style="width:8%"><a href="#"><?php echo $item->book_name?CHtml::encode($item->book_name ):"未知"; ?></a></div>
                              <div class="txt2" style="width:20%"><a href="#"><?php echo $item->book_time?CHtml::encode($item->book_time ):"未知"; ?></a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo CHtml::encode($item->book_num ); ?></span></div>
                              <div class="txt2" style="width:10%"><span class="badge badge-success"><?php echo BaseFunctions::changeShow('seatType',$item->book_type,'未知'); ?></span></div>
                              <div class="txt2" style="width:10%"><i class="icon-ok"></i></div>
                              <div class="txt2" style="width:10%"><i class="icon-ban-circle"></i></div>
                              <div class="txt2" style="width:11%"><span class="badge">待确认</span></div>
                              <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("orders/editOrder")."/?ii=".$item->id;?>" title="编辑订单"><i class="icon-pencil"></i></a></div>
                        </li>
                        <?php endforeach; ?>
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
                              <div class="txt" style="width:20%"><strong>排队号</strong></div>
                              <!-- <div class="txt" style="width:8%"><strong>订单类型</strong></div> -->
                              <div class="txt" style="width:8%"><strong>客户名称</strong></div>
                              <div class="txt" style="width:20%"><strong><i class="icon-time"></i> 预订时间</strong></strong></div>
                              <div class="txt" style="width:8%"><strong>人数</strong></div>
                              <div class="txt" style="width:10%"><strong>餐桌</strong></div>
                              <div class="txt" style="width:10%"><strong>优惠劵</strong></div>
                              <div class="txt" style="width:10%"><strong>餐单</strong></div>
                              <div class="txt" style="width:11%"><strong>订单状态</strong></div>
                              <div class="txt" style="width:3%"><strong>操作</strong></div>
                        </li>
                        <?php foreach ($dellist as $iListKey => $item): ?> 
                        <li class="clearfix">

                              <div class="txt2" style="width:20%"><a href="#"><span class="badge badge-font"><?php echo $item->status == 3?"已完成":"已取消"; ?></span></a></div>
                              <!-- <div class="txt2" style="width:8%"><a href="#"><span class="badge"><?php echo BaseFunctions::changeShow('cusSourceType',$item->book_source_type,'未知'); ?></span></a></div>-->
                              <div class="txt2" style="width:8%"><a href="#"><?php echo $item->book_name?CHtml::encode($item->book_name ):"未知"; ?></a></div>
                              <div class="txt2" style="width:20%"><a href="#"><?php echo $item->book_time?CHtml::encode($item->book_time ):"未知"; ?></a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo CHtml::encode($item->book_num ); ?></span></div>
                              <div class="txt2" style="width:10%"><span class="badge badge-success"><?php echo BaseFunctions::changeShow('seatType',$item->book_type,'未知'); ?></span></div>
                              <div class="txt2" style="width:10%"><i class="icon-ok"></i></div>
                              <div class="txt2" style="width:10%"><i class="icon-ban-circle"></i></div>
                              <div class="txt2" style="width:11%"><span class="badge badge-other">
                              		<?php echo $item->status == 3?"客户已到店消费":($item->status == 4?"客人已取消":"餐厅取消");?>
                              			</span></div>
                              <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("orders/editOrder")."/?ii=".$item->id;?>" title="编辑订单"><i class="icon-search"></i></a></div>
                        </li>
                        <?php endforeach; ?>                      
                      </ul>
                    </div>
            </div>
          </div>
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
function changeOrder(oId,toSta,seatId,seatType,seatNum,nowSta){
	var clickType = $("#clickType").val();
	if(clickType){
		$.post("<?php echo $this->createUrl('orders/changeOrderStatus')?>",
	  			{
	  			id:oId,
	  			toStatus:toSta,
	  			seatType:seatType,
	  			seatNum:seatNum,
	  			seatId:seatId,
	  			nowStatus:nowSta,
	  			clType:clickType
	  			},
	  			function(code,status){
	  			alert(code);
	  			//$("#content_code").text(code);
	 			location.reload(); 
	  	});  
	}
}

function changeStatus(id,sta){
	
	$.post("<?php echo $this->createUrl('orders/changeOrderSta')?>",
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

function addTime(id){
	$.post("<?php echo $this->createUrl('orders/addTime')?>",
			{
				id:id
			},
			function(code,status){
				alert(code);
			});
}
function findBook(){
	var s_d = $("#bookData").val();
	location.href="<?php echo $this->createUrl("orders/reservation")."?bookData="?>"+s_d;
}
function findBookByType(bookType){
	var s_d = $("#bookData").val();
	location.href="<?php echo $this->createUrl("orders/reservation")."?bookData="?>"+s_d+"&bookType="+bookType;
}
</script>