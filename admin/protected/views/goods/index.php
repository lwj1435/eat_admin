<?php
/* @var $this SiteController */

$baseurl = Yii::app()->baseUrl;
?>

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="<?php echo $this->createUrl("merchant/index");?>">商家基本信息</a> </div>
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
  <?php 
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'basic_validate',
			'method'=>'post',
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'action'=>$this->createUrl('MerchantMsg/index'),
				'novalidate'=>'novalidate',
				'name'=>'basic_validate'
			)
		)); 
	?>
	<?php 
	if(isset($info['id'])){
		echo "<input type='hidden' name='mid' value='{$info['id']}' />";
	}
	
	?>
              <div class="control-group">
              <label class="control-label">菜系标签</label>
              <div class="controls">
                <select multiple  class='span4' name='GoodsForm[goods_tag][]'>
                <?php 
                	$selecttags = '';
                	if(isset($info['goods_tag'])){
                		$selecttags = explode(',', $info['goods_tag']);
                	}
                	 
                	foreach($tags as $tag){
                		if(!empty($selecttags)){
                			if(in_array($tag, $selecttags)){
                				echo  "<option selected >{$tag}</option>";
                			}else{
                				echo  "<option>{$tag}</option>";
                			}
                		}else{
                			echo  "<option>{$tag}</option>";
                		}
                		
                	}
                ?>
                </select>
                <?php echo $form->error($model,'goods_tag'); ?>
              </div>
            </div>
              <div class="control-group">
                <label class="control-label">菜名</label>
                <div class="controls">
                  <?php 
                 $val = array();
				 if(isset($info['goods_name'])){
				 	$val['value'] = $info['goods_name'];
				 }
                  echo $form->textField($model,'goods_name',$val); 
                  ?>
                  <?php echo $form->error($model,'goods_name'); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">菜系介绍</label>
                <div class="controls">
                  <?php 
                 $goods_desc = '';
				 if(isset($info['goods_desc'])){
				 	$goods_desc = $info['goods_desc'];
				 }
                   ?>
                  <textarea name="GoodsForm[goods_desc]" style="height:200px;" class="span11"><?php echo $goods_desc;?></textarea>
                   <?php echo $form->error($model,'goods_desc'); ?>
                </div>
              </div>
              <div id='html1' class="control-group">
                <label class="control-label">图片：</label>
                <div class="controls">
                  <input type="file" name="file" id="fileupload_input1" />  
                </div>
              </div>
              <?php 
				if(isset($info['goods_image_list'])){
					$images = json_decode($info['goods_image_list'],true);
					if(!empty($images)){
						foreach($images as $image){
							echo '<div class="control-group"><label class="control-label">图片文件：</label><div class="controls"><img height=100 width=100 src="'.$image.'"/><input type="hidden" name="MerchantInfoForm[merchant_image][]" value="'.$image.'" /></div></div>';
						}
					}
					
				}
			?>
              <div class="control-group">
                <label class="control-label">是否推荐</label>
                <div class="controls">
                 <label>
                  <input type="radio" value="1" <?php if(isset($info['recommend'])){ if($info['recommend']==1){ echo 'checked';}}?> name="GoodsForm[recommend]">是</label>
                  <label>
                  <input type="radio" value="0" <?php if(isset($info['recommend'])){ if(!$info['recommend']){ echo 'checked';}}?> name="GoodsForm[recommend]">否
                  </label>
                </div>
              </div>
              <div id='html2' class="control-group">
                <label class="control-label">上传语音介绍：</label>
                <div class="controls">
                <?php 
                $goods_sounds = '';
                if(isset($info['goods_sounds'])){
                	$goods_sounds = $info['goods_sounds'];
                }
                
                ?>
                 <input type="text" id="sounds" value='<?php echo $goods_sounds;?>' name="GoodsForm[goods_sounds]"/>
                  <input type="file" name="file" id="fileupload_input2" />  
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">设置状态</label>
                <div class="controls">
                 <label>
                  <input type="radio" value="1"  <?php if(isset($info['status'])){ if($info['status']==1){ echo 'checked="true"';} }?>  name="GoodsForm[status]">在售
                  </label>
                  <label>
                  <input type="radio" value="0" <?php if(isset($info['status'])){ if($info['status']==0){ echo 'checked="true"';}}?> name="GoodsForm[status]">售罄
                  </label>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">菜品价格</label>
                <div class="controls">
                 
                  <?php 
                 $val = array();
				 if(isset($info['goods_pice'])){
				 	$val['value'] = $info['goods_pice'];
				 }
                  	echo $form->textField($model,'goods_pice',$val);
                
                  ?>
                  <?php echo $form->error($model,'goods_pice'); ?>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="保存" class="btn btn-success">
              </div>
      <?php 
      	$this->endWidget();
      ?>
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

