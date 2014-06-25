<?php 
if ($addarea&&$addarea==1) {
	echo "<script>alert('添加区域成功!');</script>";
}
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">新增楼面坐席</a> </div>
    <h1><span class="icon"> <i class="icon-plus-sign"></i> </span>新增楼面坐席</h1>
  </div>

  <div class="container-fluid"><hr>
    <div class="row-fluid">
   		<form action="<?php echo $this->createUrl('stores/addArea');?>" method="post" onsubmit="return checkForm()" class="form-horizontal">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>楼面区域</h5>
            </div>
            <div class="widget-content nopadding">
            	
                <div class="control-group"><br>
                  <label class="control-label">现有区域</label>
                  <div class="controls">
                    <input type="text" placeholder="<?
                       		if($areaArr['type']&&isset($areaArr['msg'])){
                       			foreach ($areaArr['msg'] as $iKey => $sFSStr){
                       				 echo $sFSStr." 、";
                       			}
                       		}
                      ?>" disabled="" class="span11">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">区域名称</label>
                  <div class="controls">
                    <input type="text" name="addAreaName" id="addAreaName" placeholder="请填写区域名称，例如大堂，二楼" data-title="请填写区域名称，例如大堂，二楼" class="span6 tip-right" data-original-title="">
                    <button type="submit" class="btn btn-success">添加区域</button>
                  </div><br>
                </div>
            </div>
    
          </div>
          
      </form>
      
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
								) );$this->showResult($isOk,1,$form,$model);
								?>
								
        <div class="widget-box">
         <div class="widget-content nopadding">
            <input type='hidden' name='addarea' value='0'/>
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>楼面坐席</h5>
            </div>
           
                <div class="control-group"><br>
                  <label class="control-label">坐席编号</label>
                  <div class="controls">
                  <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"请输入楼面坐席的编号",'data-title'=>"请输入楼面坐席的编号");
										 if(isset($info['seat_num'])){
										 	$val['value'] = $info['seat_num'];
										 } 
						                echo $form->textField($model,'seat_num',$val); 
						                 
						           ?>
                     </div>
                </div>
                <div class="control-group">
                  <label for="checkboxes" class="control-label">坐席类型</label>
                  <div class="controls">
                    <div data-toggle="buttons-radio" class="btn-group">
                    <?php 
                       		$sGoodsVType = isset($info['seat_type'])?$info['seat_type']:'';
                       		$aFSTag = $this->httpClient("conData/seatType");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
                       				?>
                       				<button onclick="$('#seat_type').val(this.value);" class="btn btn-warning <?=$sGoodsVType==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       			}
                       		}
                       		echo "<input type='hidden' name='StoreAddForm[seat_type]' id='seat_type' value='{$sGoodsVType}' />";
                       		
                       	?>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">状态</label>
                  <div class="controls">
                    <div data-toggle="buttons-radio" class="btn-group">
                    	 <?php 
                       		$sGoodsVType = isset($info['status'])?$info['status']:'';
                       		$aFSTag = $this->httpClient("conData/seatStatus");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
                       				?>
                       				<button onclick="$('#status').val(this.value);" class="btn btn-info <?=$sGoodsVType==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       			}
                       		}
                       		echo "<input type='hidden' name='StoreAddForm[status]' id='status' value='{$sGoodsVType}' />";
                       		
                       	?>
                     
                    </div>
                  </div>
                </div>
                <div class="control-group">
              <label class="control-label">坐席区域</label>
              <div class="controls">
                <select name='StoreAddForm[at_area]' id='at_area'>
                  <option value=''>请选择坐席的区域</option>
                   <?php 
                       		$sGoodsVType = isset($info['at_area'])?$info['at_area']:'';
                       		//$areaArr = $this->dataChannel("seat","getSeatArea",array());
                       		if($areaArr['type']&&isset($areaArr['msg'])){
                       			foreach ($areaArr['msg'] as $iKey => $sFSStr){
                       				?>
                       				<option  value="<?php echo $iKey?>" <?php echo $iKey==$sGoodsVType?"selected":""; ?>><?php echo $sFSStr?></option>
                       															
                       															<?php 
                       			}
                       		}
                       		
                      ?>
                </select>
              </div><br>
            </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-large btn-success"><i class="icon-ok-sign"></i> 保存</button>
                </div>
            </div>
                <?php $this->endWidget ();?>
    
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
function checkForm(){
	if($('#addAreaName').val()){
		return true;
	}
	alert("区域名称不能为空!");
	return false;
}
                      </script>