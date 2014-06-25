<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">客户资源管理</a> </div>
    <h1><span class="icon"> <i class="icon-group"></i> </span>客户资源管理</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="quick-actions_homepage">
      <ul class="quick-actions-queue">
        <li><a> <span class="label label-warning"><i class="icon-thumbs-up"></i></span>
          <div class="qatitle bg_lg">新增关注</div>
          <div class="qnumber"><?php echo isset($count)?$count:0;?></div>
          </a> </li>
        <li><a> <span class="label label-warning"><i class="icon-time"></i></span>
          <div class="qatitle bg_lg">新增预约</div>
          <div class="qnumber"><?php echo isset($bookcount)?$bookcount:0;?></div>
          </a> </li>
        <li><a> <span class="label label-warning"><i class="icon-truck"></i></span>
          <div class="qatitle bg_lg">新增外卖</div>
          <div class="qnumber"><?php echo isset($takeoutcount)?$takeoutcount:0;?></div>
          </a> </li>
        <li><a> <span class="label label-warning"><i class="icon-user"></i></span>
          <div class="qatitle bg_lg">总客户资源</div>
          <div class="qnumber"><?php echo isset($culcount)?$culcount:0;?></div>
          </a> </li>
      </ul>
    </div>
    <div class="row-fluid">
      <hr>
      <div class="widget-box">
        <div class="widget-title">
          <ul class="nav nav-tabs">
            <li><span class="icon"><i class="icon-ok"></i></span></li>
            <li class="active"><a data-toggle="tab" href="#tab4">全部客户</a></li>
            <li><a data-toggle="tab" href="#tab5">新增客户<?php if ($newcount>0) {?> <span class="badge badge-important"><?php echo isset($newcount)?$newcount:0;?></span><?php }?></a></li>
            <a href="javascript:gotoSNS();"><span class="label btn-success">群发推送</span></a> <a href="javascript:gotoPOST();"><span class="label btn-warning"> 群发短信</span></a>
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
                  <div class="txt2" style="width:14%"><strong>昵称</strong></div>
                  <div class="txt2" style="width:14%"><strong>预订</strong></div>
                  <div class="txt2" style="width:14%"><strong>外卖</strong></div>
                  <div class="txt2" style="width:14%"><strong>优惠卷</strong></div>
                  <div class="txt2" style="width:14%"><strong>点评次数</strong></div>
                  <div class="txt2" style="width:14%"><strong>来源</strong></div>
                  <div class="txt2" style="width:12%"><strong>操作</strong></div>
                </li>
                <?php foreach ($list as $item): ?>
                <li class="clearfix">
                  <div class="txt2" style="width:3%">
                    <input type="checkbox" id="title-checkbox" name="cklist" value="<?php echo $item->id;?>"/>
                  </div>
                  <div class="txt2" style="width:14%"><?php echo CHtml::encode($item->c_name ); ?></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-success"><?php echo CHtml::encode($item->book_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-warning"><?php echo CHtml::encode($item->take_out_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-important"><?php echo CHtml::encode($item->coupon_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-success"><?php echo CHtml::encode($item->comment_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><?php echo BaseFunctions::changeShow('cusSourceType',$item->source_type,'其他');?></div>
                  <div class="txt2" style="width:12%"><a class="tip" href="<?php echo $this->createUrl('client/customerDetail')."?id=".$item->id;?>" title="查看详情"><i class="icon-file"></i></a> 
                  <a class="tip" href="javascript:gotoPOSTById(<?php echo $item->id;?>);" title="推送"><i class="icon-external-link"></i></a> 
                  <a class="tip" href="javascript:gotoSNSById(<?php echo $item->id;?>);"  title="短信"><i class="icon-envelope"></i></a></div>
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
                  <div class="txt2" style="width:3%">
                    <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                  </div>
                  <div class="txt2" style="width:14%"><strong>昵称</strong></div>
                  <div class="txt2" style="width:14%"><strong>预订</strong></div>
                  <div class="txt2" style="width:14%"><strong>外卖</strong></div>
                  <div class="txt2" style="width:14%"><strong>优惠卷</strong></div>
                  <div class="txt2" style="width:14%"><strong>点评次数</strong></div>
                  <div class="txt2" style="width:14%"><strong>来源</strong></div>
                  <div class="txt2" style="width:12%"><strong>操作</strong></div>
                </li>
                <?php foreach ($list2 as $item2): ?>
                <li class="clearfix">
                  <div class="txt2" style="width:3%">
                    <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                  </div>
                  <div class="txt2" style="width:14%"><?php echo CHtml::encode($item2->c_name ); ?></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-success"><?php echo CHtml::encode($item2->book_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-warning"><?php echo CHtml::encode($item2->take_out_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-important"><?php echo CHtml::encode($item2->coupon_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><span class="badge badge-success"><?php echo CHtml::encode($item2->comment_num ); ?></span></div>
                  <div class="txt2" style="width:14%"><?php echo BaseFunctions::changeShow('cusSourceType',$item2->source_type,'其他');?></div>
                  <div class="txt2" style="width:12%"><a class="tip" href="customer_detail.html" title="查看详情"><i class="icon-file"></i></a> 
                  <a class="tip" href="javascript:gotoPOSTById(<?php echo $item2->id;?>);" title="推送"><i class="icon-external-link"></i></a> 
                  <a class="tip" href="javascript:gotoSNSById(<?php echo $item2->id;?>);" title="短信"><i class="icon-envelope"></i></a></div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="pagination">
      <?php 

    $this->widget('CLinkPager', array( 

        'pages' => $pages2, 

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

<script>
$(function() {  
    $("#title-checkbox").click(function() {  
        if ($(this).attr("checked")) {  
            $("input[name=cklist]").each(function() {  
                $(this).attr("checked", true);  
                this.parentNode.className = "checked";
            });  
        } else {  
            $("input[name=cklist]").each(function() {  
                $(this).attr("checked", false);  
                this.parentNode.className = "";
            });  
        }  
    });  
    //得到选中的值，ajax操作使用  
//     $("#submit").click(function() {  
//         var text="";  
//         $("input[name=cklist]").each(function() {  
//             if ($(this).attr("checked")) {  
//                 text += ","+$(this).val();  
//             }  
//         });  
//          alert(text);  
//     });  
});  

function gotoSNS(){
	var text=",";  
    $("input[name=cklist]").each(function() {  
        if ($(this).attr("checked")) {  
            text += $(this).val()+",";  
        }  
    });  
       
       if(text!=","){
	location.href="<?php echo $this->createUrl('Consulting/ad');?>?idlist="+text;
       }else{
			alert("请选择最少一条记录");
       }
}

function gotoPOST(){
	var text=",";  
    $("input[name=cklist]").each(function() {  
        if ($(this).attr("checked")) {  
            text += $(this).val()+",";  
        }  
    });  
       
       if(text!=","){
	location.href="<?php echo $this->createUrl('Consulting/push');?>?idlist="+text;
       }else{
			alert("请选择最少一条记录");
       }
}

function gotoSNSById(id){
	location.href="<?php echo $this->createUrl('Consulting/ad');?>?idlist=,"+id+',';
}

function gotoPOSTById(id){
	location.href="<?php echo $this->createUrl('Consulting/push');?>?idlist=,"+id+',';
}
    </script>