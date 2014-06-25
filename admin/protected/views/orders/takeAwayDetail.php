<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">外卖订单详情</a> </div>
    <h1><span class="icon"> <i class="icon-edit"></i> </span>外卖订单详情</h1>
  </div>

  <div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >订单编号：<?php echo $info['take_out_num'];?></h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
                <table border="0" cellpadding="0" cellspacing="0" class="" style="font-size:14px;">
                  <tbody>
                    <tr>
                      <td><h3><?php echo $info['take_out_name'];?></h3></td>
                    </tr>
                    <tr>
                      <td><?php echo $info['add'];?></td>
                      <td>客户电话：<?php echo isset($info['take_out_phone'])?$info['take_out_phone']:'暂无数据记录';?></td>
                    </tr>
                    <tr>
                      <td>联系电话：<?php echo isset($info['take_out_phone'])?$info['take_out_phone']:'暂无数据记录';?></td>
                      <td>联系人：<?php echo isset($info['take_out_name'])?$info['take_out_name']:'暂无数据记录';?></td>
                    </tr>
                  </tbody>
                </table><br><br>
				<div class="row-fluid">
				<?php if ($info['status']==0) {?>
					<a class="btn btn-success btn-large span4" href="javascript:changeStatus(<?php echo $info['id'];?>,1)"><i class="icon-ok"></i> 确认餐单</a>
				<?php }?>
				<?php if ($info['status']==1) {?>
					<a class="btn btn-success btn-large span4" href="javascript:changeStatus(<?php echo $info['id'];?>,2)"><i class="icon-ok"></i> 出餐送餐</a>
				<?php }?>
				<?php if ($info['status']==2) {?>
					<a class="btn btn-success btn-large span4" href="javascript:changeStatus(<?php echo $info['id'];?>,3)"><i class="icon-ok"></i> 客户签收</a>
				<?php }?>
				<?php if ($info['status']==3||$info['status']==4||$info['status']==5){
				
				}else{?>
				<a class="btn btn-success btn-large span4" href="javascript:changeStatus(<?php echo $info['id'];?>,4)"><i class="icon-time"></i> 客户取消</a>
				<?php }?>
				</div><br>
              </div>
              <div class="span6">
				<div class=" row-fluid">
                	<div class="quick-actions_homepage">
                      <ul class="quick-actions">
                        <li class="bg_ly span3 pull-right"> <a href="javascript:"><span style="font-size:16px; line-height:16px;"><?php echo BaseFunctions::changeShow('takeOutSta',$info['status'],'未知'); ?></span><br><span style="font-size:40px; line-height:48px;"><strong>未安排</strong></span></a> </li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
            <div class="row-fluid">
            	<div class="span12">
                <table class="table table-invoice" style="font-size:14px">
                  <tbody>
                    <tr>
                    <tr>
                      <td><strong>送餐时间：</strong></td>
                      <td><span class="badge badge-important badge-font"><?php echo isset($info['take_out_date'])?$info['take_out_date']:'';?>  <?php echo isset($info['take_out_time'])?$info['take_out_time']:'';?></span></td>
                    </tr>
                    <tr>
                      <td class="width10"><strong>订单状态：</strong></td>
                      <td class="width90"><?php echo BaseFunctions::changeShow('takeOutStaDel',$info['status'],'未知'); ?></td>
                    </tr>
                    <tr>
                      <td class="width10"><strong>订单类型：</strong></td>
                      <td class="width90"><?php echo BaseFunctions::changeShow('CusSourceType',$info['take_out_type'],'未知'); ?></td>
                    </tr>
                    <tr>
                      <td><strong>订单时间：</strong></td>
                      <td><?php echo $info['add_time']?date("Y-m-d H:i",$info['add_time']):"暂无数据记录"; ?></td>
                    </tr>
                    <tr>
                      <td><strong>完成时间：</strong></td>
                      <td><?php echo $info['get_time']?date("Y-m-d H:i",$info['get_time']):"暂无数据记录"; ?></td>
                    </tr>
                    <tr>
                      <td><strong>送餐地址：</strong></td>
                      <td><?php echo isset($info['add'])?$info['add']:'暂无数据记录';?></td>
                    </tr>
                    <tr>
                      <td><strong>特殊要求：</strong></td>
                      <td><?php echo isset($info['super_need'])?$info['super_need']:'暂无数据记录';?></td>
                    </tr>
                    <tr>
                      <td><strong>优惠劵：</strong></td>
                      <td>
                      <?php if (isset($info['favorable_id'])&&$info['favorable_id']){
                      	foreach($favorable as $faItem):
                      	?>
                      <span class="badge badge-other badge-font"><i class="icon-ok"></i></span>&nbsp;&nbsp;<?php echo isset($faItem->name)?$faItem->name:'';?>
                      <?php 
                      endforeach;
                      }?>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>餐单：</strong></td>
                      <td><span class="badge badge-other badge-font"><?php echo $info['take_num']?$info['take_num']:0;?></span> 份</td>
                    </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered table-striped" style="font-size:14px">
                  <thead>
                    <tr>
                      <th width="60%">菜品名称</th>
                      <th width="10%">点餐份数</th>
                      <th width="10%">菜品原价</th>
                      <th width="10%">菜品现价</th>
                      <th width="10%">小计价格</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php // $this->tempA($orderList);
                      $totalMoney = 0;
                      ?>
                  <?php  foreach ($orderList as $iteam):?>
                    <tr>
                      <td width="60%"><a href=""><?php  echo isset($iteam->greens->goods_name)?$iteam->greens->goods_name:'';?></a></td>
                      <td width="10%"><?php  echo isset($iteam->num)?$iteam->num:'1';?></td>
                      <td width="10%">￥<?php  echo isset($iteam->b_gold)&&$iteam->b_gold?$iteam->b_gold:'0';?></td>
                      <td width="10%">￥<?php  echo isset($iteam->order_gold)?$iteam->order_gold:'0';?></td>
                      <td width="10%"><strong>￥<?php  echo isset($iteam->order_gold)?$iteam->order_gold:'0';?></strong></td>
                    </tr>
                    <?php $totalMoney+= $iteam->order_gold; ?>
                    <?php  endforeach;?>          
                  </tbody>
                </table>
                <table class="table table-bordered table-striped" style="font-size:14px">
                  <tbody>
                    <tr>
                      <td width="80%"><h4>付款方式：<a href="#" class="tip-bottom" title="Wire Transfer"><?php echo BaseFunctions::changeShow('PayType',$info['pay_type'],'餐到付款'); ?></a></h4></td>
                      <td width="10%"><strong>小计总价</strong> <br>
                        <strong>优惠价格</strong></td>
                      <td width="10%"><strong>￥<?php echo $totalMoney;?> <br>
                        ￥<?php echo $replyMoney;?></strong></td>
                    </tr>
                  </tbody>
                </table>
                <div class="pull-right">
                  <h4><span>实际付款金额:</span> ￥<?php echo $realMoney;?></h4>
                  <br>
                  <a class="btn btn-success btn-large pull-right" href="#">打印订单</a> </div>
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
		//location.reload();
		 window.location.href="<?php echo $this->createUrl("orders/takeaway");?>";
	});

}
    </script>