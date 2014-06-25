<?php
/* @var $this SiteController */

$baseurl = Yii::app()->baseUrl;
?>

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="<?php echo $this->createUrl("merchant/index");?>">客户管理</a> </div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
 <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span><h5>客户管理</h5>
          </div>
          <div class="widget-content nopadding">           
        <form id="form1" name="form1" action="<?php echo $this->createUrl("article/delarticle"); ?>" method="post">
          
          	<input type="hidden" id="delid" name="delid" value="0" />
          	<input type="hidden" id="menuid" name="menuid" value="0" />
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th>会员昵称</th>
                  <th>性别</th>

                  <th>默认联系人</th>
                  <th>默认常用地址</th>
                  <th>默认常用手机</th>
                  <th>绑定手机</th>
<!--                  <th>美食标签</th>-->
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>

              <?php
              if (!empty($result['result'])){
              	foreach($result['result'] as $temp){

              ?>
                <tr>
                  <td><input type="checkbox" id="select" name="select[<?php echo $temp['id'];?>]" /></td>
                  <td><?php echo $temp['user_name'];?></td>
                  <td><?php echo $sex_arr[$temp['sex']];?></td>
                  <td><?php echo $temp['user_name'];?></td>
                  <td><?php echo $temp['address'];?></td>
                  <td><?php echo $temp['phone'];?></td>
                  <td><?php echo $temp['phone'];?></td>
<!--                  <td><?php echo $temp['phone'];?></td>-->
                  <td><a href="#">发送推送</a> |<a href="#">发送短信</a></td>
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

<script src="<?php echo $baseurl;?>/plug/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>  
<script src="<?php echo $baseurl;?>/plug/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>  
<script src="<?php echo $baseurl;?>/plug/jQuery-File-Upload/js/jquery.fileupload.js"></script>  
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

