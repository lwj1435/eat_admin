<style type="text/css">
#bg{background:#000;position:absolute;left:0;top:0;filter:"Alpha(opacity=20)";opacity:0.2;display:none;}
#win{width:200px;height:200px;position:absolute;left:50%;top:50%;margin:-100px -100px 0;border:4px #F00 solid;background:#FFF;display:none;}
</style>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/jqcss/pujie.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/jqcss/jquery.fileupload.css">
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="首页" class="tip-bottom"><i
				class="icon-home"></i> 首页</a> <a class="current">商户介绍信息管理</a> </div>
    <h1> <span class="icon"> <i class="icon-legal"></i> </span>商户介绍信息管理 </h1>
  </div>

  <div class="container-fluid">
    <?php
								$form = $this->beginWidget ( 'CActiveForm', array (
										'id' => 'basic_validate',
										'method' => 'post',
										//'action' => $this->createUrl ( 'MerchantMsg/introduce' ),
										'clientOptions' => array (
												'validateOnSubmit' => true 
										),
										'htmlOptions' => array (
												'class' => 'form-horizontal',
												'novalidate' => 'novalidate',
												'name' => 'basic_validate' 
										)
								) );
?>

  <?php 
  //TODO 抽离 开始
  $this->showResult($isOk,1,$form,$model);
//TODO 抽离 结束
					?>
   <hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-info-sign"></i></span>
            <h5>商户介绍信息</h5>
          </div>
          <div class="widget-content">
            <?php
								if (isset ( $info ['mer_id'] )) {
									echo "<input type='hidden' name='MerchantAddForm[mid]' value='{$info['mer_id']}' />";
								}
								?>
            <div class="control-group"> <?php echo $form->labelEx($model,'商户名称',array('class'=>"control-label")); ?>
              <div class="controls">
                <?php
						                 $val = array('class'=>'span7 tip-right','placeholder'=>"您的餐厅全称",'data-title'=>"请填写您的餐厅全称");
										 if(isset($info['merchant_name'])){
										 	$val['value'] = $info['merchant_name'];
										 } 
						                echo $form->textField($model,'merchant_name',$val); 
						                 
						           ?>
                <?php
						                 $val = array('class'=>'span4 tip-left','placeholder'=>"商家别名简称",'data-title'=>"请填写您的商家别名简称");
										 if(isset($info['merchant_othername'])){
										 	$val['value'] = $info['merchant_othername'];
										 } 
						                echo $form->textField($model,'merchant_othername',$val); 
						                echo $form->error($model,'merchant_name');
						                echo $form->error($model,'merchant_othername'); 
						           ?>
              </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'商户店长',array('class'=>"control-label")); ?>
              <div class="controls">
                <?php
						                 $val = array('class'=>'span3 tip-right','placeholder'=>"负责人姓名",'data-title'=>"请填写负责人的姓名");
										 if(isset($info['merchant_manager'])){
										 	$val['value'] = $info['merchant_manager'];
										 } 
						                echo $form->textField($model,'merchant_manager',$val); 
						                 
						           ?>
                <?php
						                 $val = array('class'=>'span8 tip-left','placeholder'=>"联系电话",'data-title'=>"请填写11位数字手机号码，如：18622228888");
										 if(isset($info['merchant_manager_phone'])){
										 	$val['value'] = $info['merchant_manager_phone'];
										 } 
						                echo $form->textField($model,'merchant_manager_phone',$val); 
						           ?>
              </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'商户标志',array('class'=>"control-label")); ?><br>
            <input type="hidden" name="MerchantAddForm[merchant_logo]" id='merchant_logo' value="<?=(isset($info['merchant_logo'])&&$info['merchant_logo'])?$info['merchant_logo']:""; ?>">
             			<ul class="resource">
                        	<li><div class="pic"><a class="lightbox_trigger" href="<?php echo Yii::app()->baseUrl;?>/files/<?php echo isset($info['merchant_logo'])?$info['merchant_logo']:"imgadd.jpg";?>"><img id="merchant_logo_show" src="<?php echo (isset($info['merchant_logo'])&&$info['merchant_logo'])?Yii::app()->baseUrl."/files/".$info['merchant_logo']:Yii::app()->baseUrl."/img/gallery/pic_add.jpg";?>" alt=""></a></div><span class="label label-success fileinput-button"><i class="icon-plus"></i><input id="fileupload" type="file" multiple="" name="files[]"></span>
                            <div id="progress" class="progress" style="width:100%">
                    			<div class="progress-bar progress-bar-success"></div>
                  			</div>
                            </li>
                        </ul>
                        
<!--              <ul class="thumbnails">
                <li class="span4"><a> <img id="merchant_logo_show" src="<?php echo (isset($info['merchant_logo'])&&$info['merchant_logo'])?Yii::app()->baseUrl."/files/".$info['merchant_logo']:Yii::app()->baseUrl."/img/gallery/imgadd.jpg";?>" alt=""> </a>
                  <div id="progress" class="progress" style="width:100%">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <input type="hidden" name="MerchantAddForm[merchant_logo]" id='merchant_logo' value="<?=(isset($info['merchant_logo'])&&$info['merchant_logo'])?$info['merchant_logo']:""; ?>">
                  <div class="actions">
                   <span class="fileinput-button"> <i class="icon-plus-sign"></i><input id="fileupload" type="file" multiple="" name="files[]"></span>
                    <span class="lightbox_trigger" href="<?php echo Yii::app()->baseUrl;?>/files/<?php echo isset($info['merchant_logo'])?$info['merchant_logo']:"imgadd.jpg";?>"><i class="icon-play"></i></span> 
                   </div>
                  <div id="progress-video" class="progress" style="width:100%"></div>
                </li>
                *请上传jpg,png格式的图片大小不能超过500K
              </ul>-->
              
              
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'营业时间',array('class'=>"control-label")); ?>
              <div class="controls">
                <input type="text" name="MerchantAddForm[merchant_start_time]" value="<?php  
							                  if(isset($info['merchant_start_time'])){
							                  	echo $info['merchant_start_time'];
							                  }
							                  ?>" placeholder="营业时间" onClick="WdatePicker({dateFmt:'HH:mm'})" class="span5" />
                <input type="text" name="MerchantAddForm[merchant_end_time]" value="<?php  
							                  if(isset($info['merchant_end_time'])){
							                  	echo $info['merchant_end_time'];
							                  }
							                  ?>"  placeholder="打烊时间" onClick="WdatePicker({dateFmt:'HH:mm'})" class="span5" />
              </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'服务内容',array('class'=>"control-label")); ?>
              <div class="controls">
                <select multiple placeholder="餐厅提供的服务，如:早茶、午市、外卖等" name="MerchantAddForm[merchant_ser][]" >
                  <?php
											$aMerTag = $this->httpClient("conData/serviceCon"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
                  <option 
													<?php echo isset($info['merchant_ser'])?$this->isInArray($iKey,$info['merchant_ser'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
                  <?php 
												}
											}
										?>
                </select>
              </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'经营菜系',array('class'=>"control-label")); ?>
              <div class="controls">
                <select multiple placeholder="餐厅经营的菜系，如:湘菜、粤菜、东北菜等" name="MerchantAddForm[merchant_tag][]" >
                  <?php
											$aMerTag = $this->httpClient("conData/merTags"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
                  <option 
													<?php echo isset($info['merchant_tag'])?$this->isInArray($iKey,$info['merchant_tag'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
                  <?php 
												}
											}
										?>
                </select>
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-phone-sign"></i> </span>
            <h5>商户联系信息</h5>
          </div>
          <div class="widget-content">
            <div class="control-group"> <?php echo $form->labelEx($model,'电话号码',array('class'=>"control-label")); ?>
              <div class="controls">
                <input type="text" placeholder="您的餐厅全称" data-title="请填写您的餐厅联系电话"
										class="span5 tip-right" data-original-title="" name="MerchantAddForm[merchant_call]"
										value="<?php
										if (isset ( $info['merchant_call'] )) {
											echo $info ['merchant_call'];
										}
										?>">
              </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'手机号码',array('class'=>"control-label")); ?>
              <div class="controls">
                <?php
						                 $val = array('class'=>'span8','placeholder'=>"13800138000" );
										 if(isset($info['merchant_phone'])){
										 	$val['value'] = $info['merchant_phone'];
										 } 
						                echo $form->textField($model,'merchant_phone',$val); 
						                 
						           ?>
                <a href="#myModal" data-toggle="modal" class="btn btn-success">绑定新手机</a>
              </div>
              <div class="controls"> <span class="help-block blue span8">请添加餐厅的手机号码</span> </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'商户地址',array('class'=>"control-label")); ?>
              <div class="controls">
                <select class="span3" name="MerchantAddForm[pro]">
                  <option>省份</option>
                   <?php
											$aMerTag = $this->httpClient("conData/provinceForGZ"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
                  <option 
													<?php echo isset($info['merchant_tag'])?($iKey==$info['pro'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
                  <?php 
												}
											}
										?>
<!--                   <option>广东省</option> -->
                </select>
                <select class="span3" name="MerchantAddForm[city]">
                  <option>城市</option>
                   <?php
											$aMerTag = $this->httpClient("conData/cityForGZ"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
                  <option 
													<?php echo isset($info['merchant_tag'])?($iKey==$info['city'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
                  <?php 
												}
											}
										?>
<!--                   <option>广州市</option> -->
                </select>
                <select class="span3" name="MerchantAddForm[area]">
                  <option>商圈区域</option>
                  <?php
											$aMerTag = $this->httpClient("conData/areaForGZ"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
                  <option 
													<?php echo isset($info['merchant_tag'])?($iKey==$info['area'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
                  <?php 
												}
											}
										?>
<!--                   <option>天河区</option> -->
                </select>
              </div>
              <br>
              <div class="controls">
                <?php
						                 $val = array('class'=>'span9 tip-left','placeholder'=>"商户详细街道地址","data-title"=>"请填写您的商户详细街道地址");
										 if(isset($info['address'])){
										 	$val['value'] = $info['address'];
										 } 
						                echo $form->textField($model,'address',$val); 
						                 
						           ?>
                <button type="button" class="btn btn-success" onclick ="setCityForBoss()"> <span class="icon"> <i class="icon-map-marker"></i> </span> </button>
              </div>
              <input type="hidden" id="longitude" name='MerchantAddForm[longitude]' value="<?php echo isset($info['longitude'])?$info['longitude']:'';?>"/>
               <input type="hidden" id="latitude" name='MerchantAddForm[latitude]' value="<?php echo isset($info['latitude'])?$info['latitude']:'';?>"/>
              <div class="controls"> <span class="help-block blue span8">请填写您的商户详细街道地址，如:城建大夏5楼</span> </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'人均消费',array('class'=>"control-label")); ?>
              <div class="controls">
                <div class="input-append">
                  <?php
							                 $val = array('class'=>'span6 tip-right','placeholder'=>"5.000","data-title"=>"请填写您的餐厅的平均消费");
											 if(isset($info['merchant_per'])){
											 	$val['value'] = $info['merchant_per'];
											 } 
							                echo $form->textField($model,'merchant_per',$val); 
						                 
						           		?>
                  <span
											class="add-on">￥</span> </div>
              </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'交通信息',array('class'=>"control-label")); ?>
              <div class="controls">
                <?php
							                 $val = array('class'=>'span11 tip-left','placeholder'=>"如何到达餐厅","data-title"=>"请填写到达您的餐厅交通工具信息");
											 if(isset($info['merchant_traffic'])){
											 	$val['value'] = $info['merchant_traffic'];
											 } 
							                echo $form->textField($model,'merchant_traffic',$val); 
						                 
						           		?>
              </div>
            </div>
            <div class="control-group"> <?php echo $form->labelEx($model,'免费服务',array('class'=>"control-label")); ?>
              <div class="controls">
                <select multiple placeholder="餐厅提供的免费服务" name="MerchantAddForm[free_service][]">
                  <?php
											$aFSTag = $this->httpClient("conData/freeSer"); 
											if($aFSTag['type']&&isset($aFSTag['msg'])){
												foreach ($aFSTag['msg'] as $iKey => $sFSStr){
													?>
                  <option 
													<?php echo isset($info['free_service'])?$this->isInArray($iKey,$info['free_service'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sFSStr?></option>
                  <?php 
												}
											}
										?>
                </select>
              </div>
              <br>
            </div>
          </div>
        </div>
      </div>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-phone-sign"></i> </span>
          <h5>商户介绍信息</h5>
        </div>
        <div class="widget-content nopadding"><br />
          <div class="control-group"> <?php echo $form->labelEx($model,'餐厅介绍',array('class'=>"control-label")); ?>
            <div class="controls">
              <?php 
							$val = array('rows'=>6, 'cols'=>50,'class'=>"span11");
							if(isset($info['merchant_desc'])){
								$val['value'] = $info['merchant_desc'];
							}
							echo $form->textArea($model,'merchant_desc',$val);
							 ?>
            </div>
            <br />
            <div class="form-actions">
              <button type="submit" class="btn btn-large btn-success span2"><i class="icon-ok-sign"></i> 确认</button>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->endWidget ();?>
</div>

			<div id="myModal" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>绑定新的手机号码</h3>
              </div>
              <div class="modal-body">
                <p><input type="text" id="bandingPhone" value="<?php echo $info['merchant_phone']?$info['merchant_phone']:'';?>" /></p>
              </div>
              <div class="modal-footer"><a data-dismiss="modal" class="btn btn-success" href="#" onclick='$("#MerchantAddForm_merchant_phone").val($("#bandingPhone").val())'>确认</a><a data-dismiss="modal" class="btn" href="#">取消</a> </div>
            </div>

<!--end-Footer-part--> 
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
<script src="<?php echo Yii::app()->baseUrl;?>/js/jqupload/vendor/jquery.ui.widget.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jqupload/jquery.iframe-transport.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jqupload/jquery.fileupload.js"></script> 
<script>
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    //alert(url);
    url = "<?php echo $this->createUrl("site/up");?>";
    var baseUrl = "<?php echo Yii::app()->baseUrl;?>/files/";
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {

              if(file.name){
                $("#merchant_logo").val(file.name); 
                $("#merchant_logo_show").attr("src",baseUrl+file.name);
                }
                
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress-video .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
// $(document).ready(function(){
// 	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
// 	$('select').select2();
// 	// Form Validation
//     $("#basic_validate").validate({
// 		rules:{
// 			"MerchantAddForm[merchant_name]":{
// 				required:true
// 			},
// 			"MerchantAddForm[merchant_othername]":{
// 				required:true
// 			},
// 			"MerchantAddForm[merchant_per]":{
// 				number:true
// 			}
// 		},
// 		errorClass: "help-inline",
// 		errorElement: "span",
// 		highlight:function(element, errorClass, validClass) {
// 			$(element).parents('.control-group').addClass('error');
// 		},
// 		unhighlight: function(element, errorClass, validClass) {
// 			$(element).parents('.control-group').removeClass('error');
// 			$(element).parents('.control-group').addClass('success');
// 		}
// 	});
	
// });


var getObj=function(id){return document.getElementById(id);}
function WinTip(){
	var win=new WinSize();
	var Tip=getObj("myModal");
	Tip.style.width=win.W+"px";
	Tip.style.height=win.H+"px";
	if(Tip.style.display=="block"){
		Tip.style.display="none";
		getObj("win").style.display="none";
		}else{
				Tip.style.display="block";
				getObj("win").style.display="block";
			}
		$("#MerchantAddForm_merchant_phone").val($("#bandingPhone").val());
	}
function WinSize() //函数：获取尺寸
{
var winWidth = 0;
var winHeight = 0;
if (window.innerWidth)
winWidth = window.innerWidth;
else if ((document.body) && (document.body.clientWidth))
winWidth = document.body.clientWidth;
if (window.innerHeight)
winHeight = window.innerHeight;
else if ((document.body) && (document.body.clientHeight))
winHeight = document.body.clientHeight;
if (document.documentElement  && document.documentElement.clientHeight && document.documentElement.clientWidth)
{winHeight = document.documentElement.clientHeight;
winWidth = document.documentElement.clientWidth;}
return{"W":winWidth,"H":winHeight}
}
function setCityForBoss(){
	var long= $('#longitude').val();
	var lat= $('#latitude').val();
	window.open("<?php echo $this->createUrl("merchant/map"); ?>?long="+long+"&lat="+lat);
}
</script> 
<script src="<?php echo Yii::app()->baseUrl;?>/plus/My97DatePicker/WdatePicker.js"></script> 

<!--end-Footer-part--> 
