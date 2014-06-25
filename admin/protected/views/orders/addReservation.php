<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">新增预约订单</a> </div>
    <h1><span class="icon"> <i class="icon-plus-sign"></i> </span>新增预约订单</h1>
  </div>

						
  <div class="container-fluid">
  
      <?php
						$form = $this->beginWidget ( 'CActiveForm', array (
								'id' => 'basic_validate',
								'method' => 'post',
								// 'action' => $this->createUrl ( 'MerchantMsg/introduce' ),
								'clientOptions' => array (
										'validateOnSubmit' => true 
								),
								'htmlOptions' => array (
										'class' => 'form-horizontal',
										'novalidate' => 'novalidate',
										'name' => 'basic_validate' 
								) 
						) );
            $this->showResult($isOk,1,$form,$model);
						?><hr>

    <div class="row-fluid">
          <div class="span12">
            <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>预订内容</h5>
            </div>
            <div class="widget-content nopadding">
            	<div class="control-group"><br>
                      <label class="control-label">预订日期</label>
                      <div class="controls">
                   <?php
						                 $val = array('class'=>'span6','placeholder'=>"请选择预约的准确时间",'data-title'=>"请选择预约的准确时间",'data-date-format'=>"yyyy-mm-dd",'onClick'=>"WdatePicker({minDate:'%y-%M-%d'})");
										 if(isset($info['book_date'])){
										 	$val['value'] = $info['book_date'];
										 } 
						                echo $form->textField($model,'book_date',$val); 
						                 
						           ?>
<!--                         <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2013" class="datepicker span6"> -->
<!--                         <span class="help-block">请正确选择本次促销的开始日期时间</span> -->
                        </div>
                </div>
                <div class="control-group">
                  <label class="control-label">预约时间</label>
                  <div class="controls">
                   <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"请选择预约的准确时间",'data-title'=>"请选择预约的准确时间",'onClick'=>"WdatePicker({dateFmt:'HH:mm'})");
										 if(isset($info['book_time'])){
										 	$val['value'] = $info['book_time'];
										 } 
						                echo $form->textField($model,'book_time',$val); 
						                 
						           ?>
<!--                     <input type="text" placeholder="请选择预约的准确时间" data-title="请选择预约的准确时间" class="span6 tip-right" data-original-title=""> -->
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">联系人姓名</label>
                  <div class="controls">
                   <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"请填写预约客人姓名",'data-title'=>"请填写联系人姓名");
										 if(isset($info['book_phone'])){
										 	$val['value'] = $info['book_name'];
										 } 
						                echo $form->textField($model,'book_name',$val); 
						                 
						           ?>
<!--                     <input type="text" placeholder="请填写预约客人姓名" data-title="请填写联系人姓名" class="span6 tip-right" data-original-title=""> -->
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">性别</label>
                  <div class="controls">
                    <div data-toggle="buttons-radio" class="btn-group">
<!--                       <button class="btn btn-info" type="button">男性</button> -->
<!--                       <button class="btn btn-info" type="button">女性</button> -->
                      <?php 
                       		$sGoodsVType = isset($info['book_sex'])?$info['book_sex']:'0';
                       		$aFSTag = $this->httpClient("conData/sex");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
                       				?>
                       				<button onclick="$('#book_sex').val(this.value);" class="btn btn-warning <?=$sGoodsVType==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       			}
                       		}
                       		echo "<input type='hidden' name='BookForm[book_sex]' id='book_sex' value='{$sGoodsVType}' />";
                       	?>
                    </div>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">联系电话</label>
                  <div class="controls">
                   <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"请填写预约客人联系电话",'data-title'=>"请填写预约客人联系电话");
										 if(isset($info['book_phone'])){
										 	$val['value'] = $info['book_phone'];
										 } 
						                echo $form->textField($model,'book_phone',$val); 
						                 
						           ?>
<!--                     <input type="text" placeholder="请填写预约客人联系电话" data-title="请填写预约客人联系电话" class="span6 tip-right" data-original-title=""> -->
                  </div>
                </div>
				
                <div class="control-group">
                  <label class="control-label">预约人数</label>
                  <div class="controls">
                    <div class="input-append">
                    <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"预约人数",'data-title'=>"请填写预约人数");
										 if(isset($info['book_num'])){
										 	$val['value'] = $info['book_num'];
										 } 
						                echo $form->textField($model,'book_num',$val); 
						                 
						           ?>
<!--                       <input type="text" placeholder="预约人数" data-title="请填写预约人数" class="span6 tip-right" data-original-title=""> -->
                      <span class="add-on">人</span>
                     </div>
                  </div>
                </div>
                <div class="control-group">
                  <label for="checkboxes" class="control-label">预约餐桌</label>
                  <div class="controls">
                    <div data-toggle="buttons-radio" class="btn-group">
<!--                       <button class="btn btn-warning" type="button">2人桌</button> -->
<!--                       <button class="btn btn-warning" type="button">4人桌</button> -->
<!--                       <button class="btn btn-warning" type="button">5-8人桌</button> -->
<!--                       <button class="btn btn-warning" type="button">包厢</button> -->
                       <?php 
                       		$sGoodsVType = isset($info['book_type'])?$info['book_type']:'';
                       		$aFSTag = $this->httpClient("conData/seatType");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
                       				?>
                       				<button onclick="$('#book_type').val(this.value);" class="btn btn-warning <?=$sGoodsVType==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       			}
                       		}
                       		echo "<input type='hidden' name='BookForm[book_type]' id='book_type' value='{$sGoodsVType}' />";
                       	?>
                    </div>
                  </div><br>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-large btn-success"><i class="icon-ok-sign"></i> 保存</button>
                </div>
                
            </div>
    
          </div>
          </div>
    </div>
      <?php $this->endWidget ();?>
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
<script src="<?php echo Yii::app()->baseUrl;?>/plus/My97DatePicker/WdatePicker.js"></script> 
