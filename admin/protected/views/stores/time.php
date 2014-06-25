<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">营业时间管理</a></div>
  </div>
  
  
  <div class="container-fluid">
  <?php 

  $this->showResult($isOk,1,$sErrMsg);
  ?>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>营业时间管理</h5>
        </div>
        <div class="widget-content">
          <form class="form-horizontal"  method="post" action="<? echo $this->createUrl("stores/time");?>">
         <input type="hidden" name='set' value='1'/>
          <!--  <div class="control-group">
              <label class="control-label">设置类型</label>
              <div class="controls">
                <label>
                  <input type="radio" name="business_type" value='0' <?php echo $info['business_type']==0?"checked":"";?>/>
                  自动营业打烊</label>
                <label>
                  <input type="radio" name="business_type" value='1' <?php echo $info['business_type']==1?"checked":"";?>/>
                  手动营业打烊</label>
          
              </div>
            </div> -->
            <div class="control-group">
              <label class="control-label">营业时间</label>
              <div class="controls">
                <input type="text" name="merchant_start_time" value="<?php  
							                  if(isset($info['merchant_start_time'])){
							                  	echo $info['merchant_start_time'];
							                  }
							                  ?>" placeholder="营业时间" onClick="WdatePicker({dateFmt:'HH:mm'})" class="span5" />
							           
                <span class="help-block">时间格式 时：分：秒</span>  </div>
            </div>
            <div class="control-group">
              <label class="control-label">打烊时间</label>
              <div class="controls">
                <input type="text" name="merchant_end_time" value="<?php  
							                  if(isset($info['merchant_end_time'])){
							                  	echo $info['merchant_end_time'];
							                  }
							                  ?>"  placeholder="打烊时间" onClick="WdatePicker({dateFmt:'HH:mm'})" class="span5" />
                <span class="help-block">时间格式 时：分：秒</span> </div>
            </div>
       
            <div class="control-group">
              <label class="control-label">营业状态</label>
              <div class="controls">
              <div data-toggle="buttons-radio" class="btn-group">
                       <?php 
                       		$sGoodsVType = isset($info['status'])?$info['status']:'1';
                       		$aFSTag = $this->httpClient("conData/merchantSetStatus");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
                       				?>
                       				<button onclick="$('#status').val(this.value);" class="btn btn-info <?=$sGoodsVType==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       			}
                       		}
                       		echo "<input type='hidden' name='status' id='status' value='{$sGoodsVType}' />";
                       		
                       	?>
                    </div>
               <!-- <div   class=" date datepicker">
                <?php echo BaseFunctions::changeShow("merchantStatus", $info['status']) ?>
                </div> --> 
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success">保存</button>
              <button type="submit" class="btn btn-danger">取消</button>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap-colorpicker.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.toggle.buttons.html"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/masked.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.form_common.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.peity.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap-wysihtml5.js"></script> 
<script>
	$('.textarea_editor').wysihtml5();
</script>
<script>

$(document).ready(function(){
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$('select').select2();
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			"MerchantAddForm[merchant_name]":{
				required:true
			},
			"MerchantAddForm[merchant_othername]":{
				required:true
			},
			"MerchantAddForm[merchant_per]":{
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
});
							
</script>
<script src="<?php echo Yii::app()->baseUrl;?>/plus/My97DatePicker/WdatePicker.js"></script>
