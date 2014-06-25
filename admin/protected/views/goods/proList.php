<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">餐单菜品管理</a> </div>
    <h1><span class="icon"> <i class="icon-paste"></i> </span>餐单菜品管理</h1>
  </div>

  <div class="container-fluid"><hr>
  	<div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a >
            	<span class="label label-warning"><i class="icon-user"></i></span>
                <div class="qatitle bg_lg">现有总数</div><div class="qnumber"><?php echo isset($count)?$count:0;?></div></a>
            </li>
            <li><a >
            	<span class="label label-warning"><i class="icon-ok"></i></span>
                <div class="qatitle bg_lg">售卖中</div><div class="qnumber"><?php echo isset($onsealcount)?$onsealcount:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-remove-sign"></i></span>
                <div class="qatitle bg_lg">已停售</div><div class="qnumber"><?php echo isset($overcount)?$overcount:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-thumbs-up"></i></span>
                <div class="qatitle bg_lg">好评最高</div><div class="qnumber"><?php echo isset($maxcount)?$maxcount:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-thumbs-down"></i></span>
                <div class="qatitle bg_lg">好评最低</div><div class="qnumber"><?php echo isset($lastcount)?$lastcount:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-edit"></i></span>
                <div class="qatitle bg_lg">高分享</div><div class="qnumber"><?php echo isset($goodcount)?$goodcount:0;?></div></a>
            </li>
          </ul>
        </div>
    <div class="row-fluid"><hr>
        <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                    <h5>菜品列表</h5>
                    <a href="javascript:changeStatus(-1)"><span class="label label-important"><i class="icon-remove-sign"></i> 删除菜品</span></a>
                    <a href="javascript:changeStatus(2)"><span class="label"><i class="icon-remove-sign" ></i> 停售设置</span></a>
                    <a href="javascript:changeStatus(1)"><span class="label label-success"><i class="icon-ok"></i> 售卖设置</span></a>
                  </div>
                  <div class="widget-content">
                    <div class="todo">
                      <form name=myform action="" method=post>
                      <ul>
                      <li class="clearfix">
                              <div class="txt" style="width:3%"><input type="checkbox" id="title-checkbox" name="title-checkbox"/></div>
                              <div class="txt" style="width:27%"><strong >菜牌名称<?php //echo CHtml::encode($oModer->getAttributeLabel('goods_name')); ?></strong></div>
							  <div class="txt" style="width:15%"><strong>菜品标签</strong></div>
                              <div class="txt" style="width:15%"><strong>优惠状态</strong></div>
                              <div class="txt" style="width:20%"><strong>浏览数<?php //echo CHtml::encode($oModer->getAttributeLabel('goods_visit_times')); ?></strong></div>
                              <div class="txt" style="width:15%"><strong>菜品状态<?php //echo CHtml::encode($oModer->getAttributeLabel('status')); ?></strong></div>
                              <div class="txt" style="width:5%"><strong>操作</strong></div>
                        </li>
<?php 
foreach ($list as $item): 
?> 
 
<li class="clearfix">
                              <div class="txt2" style="width:3%"><input type="checkbox" name="cklist" value="<?php echo CHtml::encode($item->id ); ?>" /></div>
                              <div class="txt2" style="width:27%"><a href="#"><?php echo CHtml::encode($item->goods_name ); ?></a></div>
                              <div class="txt2" style="width:15%">
                              	<?php
                              	 if (strpos($item->goods_tag,',1,')>-1) {
                              		?>
                              		<a href="javascript:delTag(<?php echo $item->id;?>,1)"><span class="badge badge-success tip-top" data-original-title="删除标签">新</span></a>
                              		<?php 
                              	}?>
                              	
                              	<?php if (strpos($item->goods_tag,',2,')>-1) {
                              		?>
                              		<a href="javascript:delTag(<?php echo $item->id;?>,2)"><span class="badge badge-success tip-top" data-original-title="删除标签">热</span></a> 
                              		<?php 
                              	}?>
                              	
                              	<?php if (strpos($item->goods_tag,',3,')>-1) {
                              		?>
                              		<a href="javascript:delTag(<?php echo $item->id;?>,3)"><span class="badge badge-success tip-top" data-original-title="删除标签">推</span></a>
                              		<?php 
                              	}?>
                              	<?php 
                              	if(!$item->goods_tag||$item->goods_tag==',,'){
echo "暂无";
}
                              	?>
                              </div>
                              <div class="txt2" style="width:15%">
                              	<?php if($item->proCount>0){?>
                              	<span class="label label-warning">促</span>
                              	<?php }?>
                              	<?php if($item->coupCount>0){?>
                              	<span class="label label-important">劵</span>
                              	<?php }?>
                              	<?php if (($item->proCount==0)&&($item->coupCount==0)) {
                              		echo "<span>暂无 </span>";
                              	}?>
                              </div>
                              <div class="txt2" style="width:20%"><span class="badge badge-important"><?php echo CHtml::encode($item->greensViewNum );  ?></span></div>
                              <div class="txt2" style="width:15%"><span class="badge <?php echo $item->status==1?'badge-important':'';?>">
                              <?php 
//tempArr array(0=>"待售",1=>'售完',2=>"在售")
echo BaseFunctions::changeShow('goodsStatus',$item->status,'已无效');
//echo CHtml::dropDownList('city_id','"'.$data->status.'"',BaseFunctions::getConfig('goodsStatus'),array('disabled'=>true,'class'=>'badge badge-important'));?></span></div>
                              <div class="txt2" style="width:5%"><a class="tip" href="<?php echo $this->createUrl("goods/updateGoods")."?id=".$item->id;?>" title="操作"><i class="icon-pencil"></i></a> 
                              <a class="tip" href="javascript:changeSta(<?php echo $item->id;?>,-1)" title="删除"><i class="icon-remove"></i></a></div>
                        </li>
 
<?php endforeach; ?> 

</ul>
</form>
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
<script	LANGUAGE="JavaScript">
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
      			//alert(code);
      			//$("#content_code").text(code);
     			location.reload(); 
      	});  
        }else{
			alert("请选择最少一条记录");
        }
}

function changeSta(id,sta){
  	$.post("<?php echo $this->createUrl('goods/changeStatus')?>",
    			{
    			id_list:","+id+",",
    			status:sta
    			},
    			function(code,status){
    			//alert(code);
    			//$("#content_code").text(code);
   			location.reload(); 
    	});  
}

function delTag(id,tag){
  	$.post("<?php echo $this->createUrl('goods/delTag')?>",
    			{
    			id_list:","+id+",",
    			status:tag
    			},
    			function(code,status){
    			//alert(code);
    			//$("#content_code").text(code);
   			location.reload(); 
    	});  
}
</script>