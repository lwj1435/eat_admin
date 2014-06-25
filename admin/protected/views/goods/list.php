<?php
/* @var $this SiteController */

$baseurl = Yii::app()->baseUrl;
?>

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#">电子餐牌内容管理</a> </div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
 <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
          </div>
          <div class="widget-content nopadding">           
        <form id="form1" name="form1" action="<?php echo $this->createUrl("article/delarticle"); ?>" method="post">
          
          	<input type="hidden" id="delid" name="delid" value="0" />
          	<input type="hidden" id="menuid" name="menuid" value="0" />
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th>ID</th>
                  <th>菜品名称</th>
                  <th>价格</th>
                  <th>促销状态</th>
                  <th>优惠状态</th>
                  <th>点餐次数</th>
                  <th>浏览次数</th>     
                  <th>点赞数</th>
                  <th>分享数</th>
                  <th>发音使用数</th>
                  <th>相关菜谱浏览数</th>
                  <th>操作</th>
                                </tr>
              </thead>
              <tbody>

              <?php
              if (!empty($goods)){
              	foreach($goods as $result){

              ?>
                <tr>
                  <td><input type="checkbox" id="select" name="select[<?php echo $result['id'];?>]" /></td>
                      <th><?php echo $result['id'];?></th>
                  <th><?php echo $result['goods_name'];?></th>
                  <th><?php echo $result['goods_pice'];?></th>
                  <th><?php if($result['status']==3){ echo '促销中';}else{ echo '销售中';}?></th>
                  <th><?php if($result['goods_real_pice']) {echo '有';}else{echo '无';}?></th>
                  <th><?php echo $result['goods_marketing_num']?$result['goods_marketing_num']:'0';?></th>
                  <th><?php echo $result['goods_visit_times'];?></th>     
                 <th><?php echo $result['good_num'];?></th>  
                   <th><?php echo $result['share_times'];?></th>  
                   <th><?php echo $result['sound_times'];?></th>  
                  <th><?php echo $result['goods_name'];?></th>  
                  <th><?php echo CHtml::link('编辑', $this->createUrl("goods/index",array('mid'=>$result['id']))); ?>&nbsp;|&nbsp;<?php echo alertHtml('myalert'.$result['id'],'删除','确定删除这条记录？','setHiddenId("'.$result['id'].'"); submitForm("form1");','','');?></th>
                </tr>
                <?php 
              	}
              }
                ?>
              </tbody>
            </table>
            
          </form>
          </div>
        </div>
      </div>
    </div>
   </div>
</div>
<!--End-Action boxes-->    

<!--end-main-container-part-->

<script src="<?php echo $baseurl;?>/js/jquery.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo $baseurl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo $baseurl;?>/js/select2.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/matrix.js"></script> 
<script src="<?php echo $baseurl;?>/js/matrix.tables.js"></script> 

<script src="<?php echo $baseurl;?>/plus/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>  
<script src="<?php echo $baseurl;?>/plus/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>  
<script src="<?php echo $baseurl;?>/plus/jQuery-File-Upload/js/jquery.fileupload.js"></script>  
<script type="text/javascript">

$("#fileupload_input1").fileupload({  
	//文件上传地址，当然也可以直接写在input的data-url属性内  
    url:"<?php echo $this->createUrl("Merchant/uploadimg");?>",
  //如果需要额外添加参数可以在这里添加  
    formData:{key:"<?php echo Yii::app()->user->id;?>"},
    done: function (e, data) {
        var dataObj = eval("("+data.result+")");
        var str = '<div class="control-group"><label class="control-label">图片文件：</label><div class="controls"><img height=100 width=100 src="'+dataObj.result+'"/><input type="hidden" name="GoodsForm[goods_image_list][]" value="'+dataObj.result+'" /></div></div>';
		$("#html1").append(str);
        
        alert(dataObj.message);
    }
})  

$("#fileupload_input2").fileupload({  
	//文件上传地址，当然也可以直接写在input的data-url属性内  
    url:"<?php echo $this->createUrl("Merchant/uploadimg");?>",
  //如果需要额外添加参数可以在这里添加  
    formData:{key:"<?php echo Yii::app()->user->id;?>"},
    done: function (e, data) {
        var dataObj = eval("("+data.result+")");
        $("#sounds").attr('value',dataObj.result);
        
        alert(dataObj.message);
    }
})  

</script>

