<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="#" class="current">商户介绍信息管理</a> </div>
  </div>
  <div class="container-fluid">
  <div class="widget-box">
    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
      <h5>商户介绍信息管理</h5>
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
				'action'=>$this->createUrl('MerchantMsg/introduce'),
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
        <div id='html' class="control-group">
          <label class="control-label">商户logo</label>
          <div class="controls">
            <input type="text" class="span11" id='logo' value="<?php  
                  if(isset($info)){
                  	echo $info['merchant_logo'];
                  }
                  ?>" name='MerchantInfoForm[merchant_logo]' placeholder="商户logo" /><br/>
            <input type="file" name="file" id="fileupload_input" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">人均价格:</label>
          <div class="controls">
            <input type="text" name="MerchantInfoForm[merchant_per]" value=<?php  
                  if(isset($info)){
                  	echo $info['merchant_per'];
                  }
                  ?> class="span11" placeholder="人均价格" />
            <span class="help-block">一般消费的人均价格</span> 
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">商户名称</label>
          <div class="controls">
            <?php
                 $val = array('class'=>'span11');
				 if(isset($info['merchant_name'])){
				 	$val['value'] = $info['merchant_name'];
				 } 
                echo $form->textField($model,'merchant_name',$val); 
                echo $form->error($model,'merchant_name'); 
           ?>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">商户简称</label>
          <div class="controls">
           <?php
                 $val = array('class'=>'span11');
				 if(isset($info['merchant_branch'])){
				 	$val['value'] = $info['merchant_branch'];
				 } 
                echo $form->textField($model,'merchant_branch',$val); 
                echo $form->error($model,'merchant_branch'); 
           ?>
            <span class="help-block">例如：广州七升科技有限公司 简称”七升科技“</span> 
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">商户地址</label>
          <div class="controls">
             <input type="text" class="span11"  name="MerchantInfoForm[address]" id="required" value="<?php  
                  if(isset($info)){
                  	echo $info['address'];
                  }
             ?>">
            <span class="help-block">例如：广东省广州市天河区体育西路189号城建大厦5楼</span> </div>
        </div>
        <div class="control-group">
          <label class="control-label">商户号码</label>
          <div class="controls">
            <input type="text"  class="span11"  name="MerchantInfoForm[merchant_call]" id="required" value="<?php  
                  if(isset($info)){
                  	echo $info['merchant_call'];
                  }
                  ?>">
            <span class="help-block">例如：4006780033,18620725173 多个号码请用英文逗号隔开</span> </div>
        </div>
         <div class="control-group">
          <label class="control-label">营业时间</label>
          <div class="controls">
            <input type="text" name="MerchantInfoForm[merchant_start_time]" value="<?php  
                  if(isset($info)){
                  	echo $info['merchant_start_time'];
                  }
                  ?>" onClick="WdatePicker({dateFmt:'HH:mm'})" class="span11" />
            <span class="help-block">例如：11:00</span> </div>
        </div>
         <div class="control-group">
          <label class="control-label">打烊时间</label>
          <div class="controls">
            <input type="text" name="MerchantInfoForm[merchant_end_time]"  value="<?php  
                  if(isset($info)){
                  	echo $info['merchant_end_time'];
                  }
                  ?>" onClick="WdatePicker({dateFmt:'HH:mm'})" class="span11" />
            <span class="help-block">例如：21:00</span> </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-success">保存</button>
        </div>
      <?php 
      	$this->endWidget();
      ?>
    </div>
  </div>
</div>
</div>


<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script> 

<script type="text/javascript">

$("#fileupload_input").fileupload({  
	//文件上传地址，当然也可以直接写在input的data-url属性内  
    url:"<?php echo $this->createUrl("Merchant/uploadimg");?>",
  //如果需要额外添加参数可以在这里添加  
    formData:{key:"<?php echo Yii::app()->user->id;?>"},
    done: function (e, data) {
        var dataObj = eval("("+data.result+")");
        var str = '<div class="control-group"><label class="control-label">logo：</label><div class="controls"><img height=100 width=100 src="'+dataObj.result+'"/><input type="hidden" name="MerchantInfoForm[merchant_image][]" value="'+dataObj.result+'" /></div></div>';
		$("#html").append(str);

		$("#logo").val(dataObj.result);
        
        alert(dataObj.message);
    }
})  

</script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script> 

<script src="<?php echo Yii::app()->baseUrl;?>/plus/My97DatePicker/WdatePicker.js"></script> 