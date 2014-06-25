<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">新增排队订单</a> </div>
    <h1><span class="icon"> <i class="icon-signin"></i> </span>新增排队订单</h1>
  </div>

  <div class="container-fluid"><hr>
    <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lo span2"> <a href="">2人桌已到<br><span style="font-size:36px; line-height:36px;"><strong><?php echo isset($reachArr['A'])?($reachArr['A']?'A'.$reachArr['A']:'无'):'无';?></strong></span></a> </li>
            <li class="bg_dg span2"> <a href="">4人桌已到<br><span style="font-size:36px; line-height:36px;"><strong><?php echo isset($reachArr['B'])?($reachArr['B']?'B'.$reachArr['B']:'无'):'无';?></strong></span></a> </li>
            <li class="bg_db span2"> <a href="">5-8人桌已到<br><span style="font-size:36px; line-height:36px;"><strong><?php echo isset($reachArr['C'])?($reachArr['C']?'C'.$reachArr['C']:'无'):'无';?></strong></span></a> </li>
            <li class="bg_ly span2"> <a href="">包厢已到<br><span style="font-size:36px; line-height:36px;"><strong><?php echo isset($reachArr['D'])?($reachArr['D']?'D'.$reachArr['D']:'无'):'无';?></strong></span></a> </li>
          </ul>
        </div>  
    <div class="row-fluid"><hr>
        <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                    <h5>选择新的排队订单</h5>
                  </div>
                  <div class="widget-content">
                    <div class="todo">
                      <ul>
                        <li class="clearfix">
                              <div class="txt" style="width:16%"><strong>排队号</strong></div>
                              <div class="txt" style="width:11%"><strong>新增排队</strong></div>
                              <div class="txt" style="width:8%"><strong>订单类型</strong></div>
                              <div class="txt" style="width:8%"><strong>客户名称</strong></div>
                              <div class="txt" style="width:16%"><strong><i class="icon-time"></i> 预订时间</strong></strong></div>
                              <div class="txt" style="width:8%"><strong>人数</strong></div>
                              <div class="txt" style="width:10%"><strong>餐桌</strong></div>
                              <div class="txt" style="width:10%"><strong>优惠劵</strong></div>
                              <div class="txt" style="width:10%"><strong>餐单</strong></div>
                              <div class="txt" style="width:3%"><strong>操作</strong></div>
                        </li>
                         <?php foreach ($list as $iListKey => $item): ?> 
                        <li class="clearfix">
                              <div class="txt2" style="width:16%"><a href="#"><span class="badge badge-font">已取消</span></a></div>
                              <div class="txt2" style="width:11%"><a class="tip" href="javascript:changeStatus(<?php echo $item->id;?>,1)" title="加入排队"><span class="badge badge-important badge-font"><i class="icon-ok"></i></span></a></div>
                              <div class="txt2" style="width:8%"><a href="#"><span class="badge"><?php echo BaseFunctions::changeShow('cusSourceType',$item->book_source_type,'未知'); ?></span></a></div>
                              <div class="txt2" style="width:8%"><a href="#"><?php echo $item->book_name?$item->book_name:"未知";?></a></div>
                              <div class="txt2" style="width:16%"><a href="#"><?php echo $item->book_time?$item->book_time:"未知";?></a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo $item->book_num;?></span></div>
                              <div class="txt2" style="width:10%"><span class="badge badge-success"><?php echo BaseFunctions::changeShow('seatType',$item->book_type,'未知'); ?></span></div>
                              <div class="txt2" style="width:10%"><i class="icon-ok"></i></div>
                              <div class="txt2" style="width:10%"><i class="icon-ban-circle"></i></div>
                              <div class="txt2" style="width:3%"><a class="tip" href="<?php echo $this->createUrl("orders/editOrder")."/?ii=".$item->id;?>" title="编辑订单"><i class="icon-search"></i></a></div>
                        </li>
                        <?php endforeach;?>
                      </ul>
                    </div>
                  
                  </div>
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
</script>