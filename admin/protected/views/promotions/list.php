
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">促销优惠管理</a> </div>
    <h1><span class="icon"> <i class="icon-tags"></i> </span>促销优惠管理</h1>
  </div>

  <div class="container-fluid"><hr>
  
	<div class="row-fluid">
    <form action="#" method="get" class="form-horizontal">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-content nopadding">
                    <div class="control-group"><br>
                      <label class="control-label">验证使用优惠劵</label>
                      <div class="controls">
                   			 <input type="text" placeholder="请填写客户提供的优惠劵编码（包括手机短信码和应用编码）" data-title="请填写优惠劵编码" class="span10 tip-right" data-original-title="" id="couponStr"><button type="button" onclick="useCou();" class="btn btn-success">验证使用</button>
                        </div><br>
                    </div>                
                </div>
        </div>
      </div>
      </form>
    </div>
    <div class="row-fluid"><hr>
        <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                    <h5>促销优惠列表</h5>
                    <a href="javascript:changeStatus(-1)"><span class="label label-important"><i class="icon-remove-sign"></i> 删除优惠</span></a>
                  </div>
                  <div class="widget-content">
                    <div class="todo">
                      <ul>
                        <li class="clearfix">
                              <div class="txt" style="width:3%"><input type="checkbox" id="title-checkbox" name="title-checkbox" /></div>
                              <div class="txt" style="width:27%"><strong>名称</strong></div>
                              <div class="txt" style="width:10%"><strong><i class="icon-time"></i> 开始</strong></div>
                              <div class="txt" style="width:10%"><strong><i class="icon-time"></i> 结束</strong></div>
                              <div class="txt" style="width:7%"><strong>类型</strong></div>
                              <div class="txt" style="width:8%"><strong>预发放</strong></div>
                              <div class="txt" style="width:8%"><strong>已发放</strong></div>
                              <div class="txt" style="width:8%"><strong>已使用</strong></div>
                              <div class="txt" style="width:7%"><strong>浏览数</strong></div>
                              <div class="txt" style="width:7%"><strong>优惠状态</strong></div>
                              <div class="txt" style="width:5%"><strong>操作</strong></div>
                        </li>
       <?php foreach ($list as $item): ?> 
                        <li class="clearfix">
                              <div class="txt2" style="width:3%"><input id="cklist" name="cklist" type="checkbox" value="<?php echo $item->id;?>"/></div>
                              <div class="txt2" style="width:27%"><span class="label  <?php echo $item->goods_type==2?"label-warning":"label-important";?>"><?php echo $item->goods_type==2?"促":"劵";?></span><a href="#" class="offset0"><?php echo CHtml::encode($item->goods_name ); ?></a></div>
                              <div class="txt2" style="width:10%"><a href="#"><?php echo date("Y-m-d",$item->varil_begin_time);?></a></div>
                              <div class="txt2" style="width:10%"><a href="#"><?php echo date("Y-m-d",$item->varil_end_time);?></a></div>
                              <div class="txt2" style="width:7%"><a href="#"><span class="badge"><?php echo $item->goods_type==2?BaseFunctions::changeShow('varilType',$item->goods_v_type,'未知'):BaseFunctions::changeShow('couponType',$item->goods_v_type,'未知');?></span></a></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo $item->good_num;?></span></div>
                              <div class="txt2" style="width:8%"><span class="badge badge-success"><?php echo $item->sendout_num;?></span></div>
                              <div class="txt2" style="width:8%"><span class="badge"><?php echo $item->use_num;?></span></div>
                              <div class="txt2" style="width:7%"><span class="badge badge-important"><?php echo $item->view_num;?></span></div>
                              <div class="txt2" style="width:7%"><span class="badge badge-important"><?php echo BaseFunctions::changeShow('CouponStatus',$item->status,'未知');?></span></div>
                              <div class="txt2" style="width:5%"><a class="tip" href="<?php echo $item->goods_type==2?$this->createUrl("promotions/updatePromotions"):$this->createUrl("promotions/UpdateCoupon"); echo "?id=".$item->id;?>" title="编辑"><i class="icon-pencil"></i></a>
                              <a class="tip" href="javascript:changeStaSig(<?php echo $item->id;?>,-1)" title="删除"><i class="icon-remove"></i></a></div>
                        </li>
                     <?php endforeach; ?> 
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

        'maxButtonCount' => 6, 

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
<!--Footer-part-->

<!--end-Footer-part-->
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
});  
function changeStatus(sta){
	 var text=",";  
   $("input[name=cklist]").each(function() {  
       if ($(this).attr("checked")) {  
           text += $(this).val()+",";  
       }  
   });  
      
      if(text!=","){
  	$.post("<?php echo $this->createUrl('goods/changeStatus')?>",
    			{
    			id_list:text,
    			status:sta
    			},
    			function(code,status){
    			alert(code);
    			//$("#content_code").text(code);
   			location.reload(); 
    	});  
      }else{
    		alert("请最少选择一个");
    	}
}
function changeStaSig(id,sta){
	if(id){
		var text=","+id+","; 
		$.post("<?php echo $this->createUrl('goods/changeStatus')?>",
				{
				id_list:text,
				status:sta
				},
				function(code,status){
				alert(code);
				//$("#content_code").text(code);
				location.reload(); 
		});  
	}else{
		alert("数据异常");
	}
}

function useCou(){
	var text = $("#couponStr").val();
	if(f_check_userID(text)){
		$.post("<?php echo $this->createUrl('promotions/useCoupon')?>",
				{
					couponStr:text
				},
				function(code,status){
					var re = eval("("+code+")");
					if(re.type){
						alert(re.msg);
						location.reload(); 
					}else{
						alert(re.msg);
					}
					//$("#content_code").text(code);
					//location.reload(); 
		});  
  	}
}

function f_check_userID(userID)   
{   
   //var userID = obj.value;   
   if(userID.length > 30)   
   {   
       alert("长度不能大于30");   
       return false;   
   }   
 
   if(!/^\w{1,30}$/.test(userID))    
   {   
	   alert("只能由数字、字母组合而成");   
       return false;   
   }   
   return true;   
}   
</script>