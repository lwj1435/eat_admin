<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Sample pages</a> <a href="#" class="current">Gallery</a> </div>
    <h1><span class="icon"> <i class="icon-user"></i> </span>客户详情</h1>
  </div>
  <div class="container-fluid"><hr>
	<div class="quick-actions_homepage">
           <ul class="quick-actions-queue">
            <li><a href=""><div class="qatitle bg_lg">预约次数</div><div class="qnumber"><?php echo isset($bookcount)?$bookcount:0;?></div></a></li>
            <li><a href=""><div class="qatitle bg_lg">外卖次数</div><div class="qnumber"><?php echo isset($takeoutcount)?$takeoutcount:0;?></div></a></li>
            <li><a href=""><div class="qatitle bg_lg">浏览次数</div><div class="qnumber"><?php echo isset($cusMsg['view_num'])?$cusMsg['view_num']:0;?></div></a></li>
            <li><a href=""><div class="qatitle bg_lg">优惠劵总数</div><div class="qnumber"><?php echo isset($cusMsg['coupon_num'])?$cusMsg['coupon_num']:0;?></div></a></li>
            <li><a href=""><div class="qatitle bg_lg">点评次数</div><div class="qnumber"><?php echo isset($cusMsg['comment_num'])?$cusMsg['comment_num']:0;?></div></a></li>
            <li><a href=""><div class="qatitle bg_lg">分享次数</div><div class="qnumber"><?php echo isset($cusMsg['share_num'])?$cusMsg['share_num']:0;?></div></a></li>
          </ul>
        </div>
    <div class="row-fluid"><hr>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
          <h5 >用户基础信息</h5>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span6">
               <table border="0" cellpadding="0" cellspacing="0" class="" style="font-size:14px;">
                <tbody>
                  <tr>
                  <tr>
                    <td><h3><?php echo $cusMsg['username'];?> </h3></td>
                  </tr>
                  <tr>
                    <td class="width10">绑定手机：</td>
                    <td class="width90"><?php echo $cusMsg['phone']?$cusMsg['phone']:"暂无数据记录";?></td>
                  </tr>
                  <tr>
                    <td>绑定邮箱：</td>
                    <td><?php echo $cusMsg['email']?$cusMsg['email']:"暂无数据记录";?></td>
                  </tr>
                  <tr>
                    <td class="width10">常用联系人：</td>
                    <td class="width90"><?php echo $cusMsg['nor_name']?$cusMsg['nor_name']:"暂无数据记录";?></td>
                  </tr>
                  <tr>
                    <td>常用联系方式：</td>
                    <td><?php echo $cusMsg['nor_phone']?$cusMsg['nor_phone']:"暂无数据记录";?></td>
                  </tr>
                  
                  <tr>
                    <td>常用地址：</td>
                    <td><?php echo $cusMsg['nor_add']?$cusMsg['nor_add']:"暂无数据记录";?></td>
                  </tr>
                </tbody>
              </table><br><br>
            </div>
            </div>
            <div class="row-fluid">
            <div class="span12">
              <table class="table table-invoice" style="font-size:14px">
                <tbody>
                  <tr>
                  <tr>
                    <td>个性标签：</td>
                    <td><?php 
                    //TODO 标签数据
                    echo $cusMsg['tag']?$cusMsg['tag']:"暂无数据记录";?>
<!--                     <span class="label label-other label-font">粤菜</span> <span class="label label-other label-font">爱辣</span> <span class="label label-other label-font">IT男</span> <span class="label label-other label-font">多喝汤</span> <span class="label label-other label-font">多喝汤</span> <span class="label label-other label-font">多喝汤</span> <span class="label label-other label-font">多喝汤</span> -->
                    </td>
                  </tr>
                  <tr>
                    <td>最后上线时间：</td>
                    <td><span class="badge badge-important badge-font"><?php echo $cusMsg['last_login_time']?date("Y-m-d H:i",$cusMsg['last_login_time']):"无记录";?></span></td>
                  </tr>
                  <tr>
                    <td class="width10">最后定位地址：</td>
                    <td class="width90"><?php echo $cusMsg['com_add']?$cusMsg['com_add']:"暂无数据记录";?></td>
                  </tr>
                   <tr>
                    <td>是否关注商家：</td>
                    <td>
                    <?php if ($cusMsg['like']) {?>
                    	<span class="badge badge-other badge-font"><i class="icon-ok"></i></span>
                    <?php }else{
                    	echo '<span class="badge badge-other badge-font"><i class="icon-ban-circle"></i></span>';
                    }?>
                    </td>
                  </tr>
                  <tr>
                    <td class="width10">最后预订时间：</td>
                    <td class="width90"><?php echo $cusMsg['last_book_time']?date("Y-m-d H:i",$cusMsg['last_book_time']):"无记录";?></td>
                  </tr>
                  <tr>
                    <td>最后外卖时间：</td>
                    <td><?php echo $cusMsg['last_take_out_time']?date("Y-m-d H:i",$cusMsg['last_take_out_time']):"无记录";?></td>
                  </tr>
                  <tr>
                    <td>最后点评时间：</td>
                    <td><?php echo $cusMsg['last_comment_time']?date("Y-m-d H:i",$cusMsg['last_comment_time']):"无记录";?></td>
                  </tr>
                  <tr>
                    <td>最后获取优惠卷时间：</td>
                    <td><?php echo $cusMsg['last_coupon_time']?date("Y-m-d H:i",$cusMsg['last_coupon_time']):"无记录";?></td>
                  </tr>
                  <tr>
                    <td>最后浏览餐厅信息时间：</td>
                    <td><?php echo $cusMsg['last_brow_time']?date("Y-m-d H:i",$cusMsg['last_brow_time']):"无记录";?></td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
     
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
    <form action="#" method="get" class="form-horizontal">
      <hr>
      <div class="widget-box">
        <div class="widget-title">
          <ul class="nav nav-tabs">
            <li><span class="icon"><i class="icon-ok"></i></span></li>
            <li class="active"><a data-toggle="tab" href="#tab4">客户预约历史记录</a></li>
            <li><a data-toggle="tab" href="#tab5">客户外卖历史记录</a></li>
                <li><a data-toggle="tab" href="#tab6">优惠卷历史记录</a></li>
      <li><a data-toggle="tab" href="#tab7">客户点评记录</a></li>
             
          </ul>
        </div>
        <div class="widget-content tab-content">
          <div id="tab4" class="tab-pane active">
            <div class="todo">
              <ul>
                <li class="clearfix">

                  <div class="txt" style="width:15%"><strong>订单号</strong></div>
                  <div class="txt" style="width:15%"><strong>预约时间</strong></div>
                  <div class="txt" style="width:15%"><strong>预约人姓名</strong></div>
                  <div class="txt" style="width:15%"><strong>预约电话</strong></div>
                  <div class="txt" style="width:15%"><strong>是否有到店</strong></div>
                  <div class="txt" style="width:25%"><strong>是否使用优惠卷</strong></div>
                </li>
                <?php foreach ($bookList as $item):?>
                <li class="clearfix">
                  <div class="txt2" style="width:15%"><?php echo $item->book_or_num;?></div>
                  <div class="txt2" style="width:15%"><?php echo $item->book_date." ".$item->book_time;?></div>
                  <div class="txt2" style="width:15%"><?php echo $item->book_name;?></div>
                  <div class="txt2" style="width:15%"><?php echo $item->book_phone;?></div>
                  <div class="txt2" style="width:15%"><?php if($item->status==3){?><i class="icon-ok"></i><?php }else{
                  	echo '<i class="icon-ban-circle"></i>';
                  } ?></div>
                  <div class="txt2" style="width:25%">
                  <?php if(isset($item->coupon_use)&&$item->coupon_use){
                  	?>
                  	<span class="badge badge-success"><i class="icon-ok"></i></span>&nbsp;&nbsp;优惠劵：超值午餐之选15元优惠</div>
                  	<?php 
                  }?>
                  
                </li>
                <?php endforeach;?>
                
              </ul>
            </div>
          </div>
          <?php //TODO 其他列表要有对应的关联?>
          <div id="tab5" class="tab-pane">
            <div class="todo">
              <ul>
                <li class="clearfix">
                 
                  <div class="txt" style="width:12%"><strong>订单号</strong></div>
                  <div class="txt" style="width:12%"><strong>外卖时间</strong></div>
                  <div class="txt" style="width:12%"><strong>联系人</strong></div>
                  <div class="txt" style="width:12%"><strong>联系电话</strong></div>
                  <div class="txt" style="width:12%"><strong>份数</strong></div>
                  <div class="txt" style="width:12%"><strong>总价</strong></div>
                  <div class="txt" style="width:20%"><strong>是否使用优惠卷</strong></div>
                  <div class="txt" style="width:8%"><strong>支付方式</strong></div>
                </li>
                <?php foreach ($takeoutList as $item):?>
                <li class="clearfix">
                  <div class="txt2" style="width:12%"><?php echo $item->take_out_num;?></div>
                  <div class="txt2" style="width:12%"><?php echo ($item->take_out_date&&$item->take_out_time)?$item->take_out_date." ".$item->take_out_time:"无记录";?></div>
                  <div class="txt2" style="width:12%"><?php echo $item->user_name;?></div>
                  <div class="txt2" style="width:12%"><?php echo $item->user_phone;?></div>
                  <div class="txt2" style="width:12%"><span class="badge badge-success"><?php echo $item->take_num_count;?></span> 份</div>
                  <div class="txt2" style="width:12%"><span class="badge badge-success">￥<?php echo $item->price_count;?></span></div>
                  <div class="txt2" style="width:20%">
                  <?php if ($item->favorable_id) {
                  	echo '<i class="icon-ok"></i>';
                  }else{
				  ?>
                  <i class="icon-ban-circle"></i>
                  <?php }?>
                  </div>
                  <div class="txt2" style="width:8%"><?php echo BaseFunctions::changeShow('PayType',$item->pay_type,'餐到付款'); ?></div>
                </li>
                <?php endforeach;?>
              
              </ul>
            </div>
          </div>
          <div id="tab6" class="tab-pane">
            <div class="todo">
              <ul>
                <li class="clearfix">
            
                  <div class="txt" style="width:15%"><strong>优惠卷编号</strong></div>
                  <div class="txt" style="width:15%"><strong>获取方式</strong></div>
                  <div class="txt" style="width:15%"><strong>获取时间</strong></div>
                  <div class="txt" style="width:15%"><strong>是否已使用</strong></div>
                  <div class="txt" style="width:15%"><strong>使用时间</strong></div>
                  <div class="txt" style="width:15%"><strong>关联订单</strong></div>
                </li>
                <?php foreach ($couponList as $item):?>
                <li class="clearfix">
                  <div class="txt2" style="width:15%"><?php echo $item->goods_at_num;?></div>
                  <div class="txt2" style="width:15%"><span class="badge badge-success"><?php echo  BaseFunctions::changeShow('couponGetType',$item->get_type,'未知');?></span></div>
                  <div class="txt2" style="width:15%"><?php echo $item->get_time?date("Y-m-d H:i",$item->get_time):"未知";?></div>
                  <div class="txt2" style="width:15%"><?php if ($item->status == 3) {
                  	echo '<i class="icon-ok"></i>';
                  }else{
					echo '<i class="icon-ban-circle"></i>';
					}?></div>
                  <div class="txt2" style="width:15%"><?php echo $item->user_time?date("Y-m-d H:i",$item->user_time):"未知";?></div>
                  <div class="txt2" style="width:15%"><?php echo isset($item->order_num)?$item->order_num:"未知";?></div>

                </li>
                <?php endforeach;?>
              </ul>
            </div>
          </div>
          <div id="tab7" class="tab-pane">
            <div class="todo">
              <ul>
                <li class="clearfix">
                  <div class="txt" style="width:15%"><strong>时间</strong></div>
                  <div class="txt" style="width:5%"><strong>评分</strong></div>
                  <div class="txt" style="width:55%"><strong>内容</strong></div>
                  <div class="txt" style="width:25%"><strong>推荐</strong></div>
              
                </li>
                <?php foreach ($commentList as $item):?>
                <li class="clearfix">
             <div class="txt2 center" style="width:15%">2014-3-25 18:00</div>
                  <div class="txt2 center" style="width:5%"><span class="badge badge-success">4</span></div>
                  <div class="txt2" style="width:55%">看了《舌尖上的中国》S2E2，慕名而去。排队的人真多，足足等了一小时。停车停出数百米外。</div>
                  <div class="txt2 center" style="width:25%">黄鳝饭,椒盐濑尿虾,蟹黄豆腐</div>
                
                </li>
               <?php endforeach;?>
              </ul>
            </div>
          </div>
        </div>
      </div>
     </form></div>
      <div class="pagination">
         <?php 

    $this->widget('CLinkPager', array( 

        'pages' => $bookpages, 

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

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script>