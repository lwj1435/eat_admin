<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">优惠详情</a> </div>
    <h1><span class="icon"> <i class="icon-plus-sign"></i> </span>[<?php echo isset($info['goods_name'])?$info['goods_name']:'';?>]优惠详情</h1>
  </div>

  <div class="container-fluid"><hr>
  <div class="quick-actions_homepage">
       
              <ul class="quick-actions-queue">
               <li><a>
            	<span class="label label-warning"><i class="icon-eye-open"></i></span>
                <div class="qatitle bg_lg">促销浏览总数</div><div class="qnumber"><?php echo isset($info['goods_comment_num'])?$info['goods_comment_num']:0;?></div></a>
            </li>
             <li><a>
            	<span class="label label-warning"><i class="icon-share"></i></span>
                <div class="qatitle bg_lg">促销分享总数</div><div class="qnumber"><?php echo isset($info['goods_share_num'])?$info['goods_share_num']:0;?></div></a>
            </li>
             </ul>
        </div>
    <div class="row-fluid"><?php
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
						echo $form->errorSummary ( $model );
						?>
          <div class="span6">
            <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>促销优惠内容</h5>
              <input type="hidden" value="<?php echo isset($info['id'])?$info['id']:'';?>" name="id" />
            </div>
            <div class="widget-content">
                <div class="control-group">
                  <?php echo $form->labelEx($model,'促销名称',array('class'=>"control-label")); ?>
                  <div class="controls">
                  <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"请填写促销标题全称",'data-title'=>"请填写您的餐厅全称");
										 if(isset($info['goods_name'])){
										 	$val['value'] = $info['goods_name'];
										 } 
						                echo $form->textField($model,'goods_name',$val); 
						                 
						           ?>
<!--                     <input type="text" placeholder="请填写促销标题全称" data-title="请填写促销标题全称" class="span6 tip-right" data-original-title=""> -->
                  </div>
                </div>
                <div class="control-group">
                	<?php echo $form->labelEx($model,'促销类型',array('class'=>"control-label")); ?>
                  <div class="controls">
                    <div data-toggle="buttons-radio" class="btn-group">
                       <?php 
                       		$sGoodsVType = isset($info['goods_v_type'])?($info['goods_v_type']<0?'1':$info['goods_v_type']):"1";
                       		$aFSTag = $this->httpClient("conData/varilType");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
if($sGoodsVType==$iKey){
                       				?>
                       				<button  onclick="$('#goods_v_type').val(this.value);show('perType<?=$iKey; ?>');" class="btn btn-info <?=$sGoodsVType==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       															}
                       			}
                       		}
                       		echo "<input type='hidden' name='Goods[goods_v_type]' id='goods_v_type' value='{$sGoodsVType}' />";
                       		
                       	?>
                    </div>
                  </div>
                </div>
                <div class="control-group" id='perType1'>
                	<?php echo $form->labelEx($model,'促销优惠',array('class'=>"control-label")); ?>
                  <div class="controls">
                    <input type="text" placeholder="限时开始时段" data-title="请选择优惠时段" class="span3 tip-right" onClick="WdatePicker({dateFmt:'HH:mm'})" value="<?=isset($info['t_begin_time'])?$info['t_begin_time']:''; ?>" name="Goods[t_begin_time]" data-original-title="">
                    <input type="text" placeholder="限时结束时段" data-title="请选择优惠时段" class="span3 tip-right" onClick="WdatePicker({dateFmt:'HH:mm'})" value="<?=isset($info['t_end_time'])?$info['t_end_time']:''; ?>" name="Goods[t_end_time]" data-original-title="">
                    <div class="input-append">
                    	<?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"优惠折扣",'data-title'=>"请填写促销标题全称" );
										 if(isset($info['pri_time_per'])){
										 	$val['value'] = $info['pri_time_per'];
										 } 
						                echo $form->textField($model,'pri_time_per',$val); 
						 ?>
<!--                       <input type="text" placeholder="优惠折扣" data-title="请填写促销标题全称" class="span6 tip-right" data-original-title=""> -->
                      <span class="add-on">%</span>
                     </div>
                  </div>
                </div>
                <div class="control-group" id='perType2'>
                	<?php echo $form->labelEx($model,'菜品优惠',array('class'=>"control-label")); ?>
                  <div class="controls">
                  
                  	<select multiple placeholder="餐厅提供的服务，如:早茶、午市、外卖等" name="Goods[pri_goods_list][]" class="span6" >
										<?php
// 											$aMerTag = $this->httpClient("conData/serviceCon"); 
// 											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($goodsArr as $iKey => $sMTStr){
													?>
													<option 
													<?php echo isset($info['pri_goods_list'])?$this->isInArray($iKey,$info['pri_goods_list'])?"selected":'':'';?>
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
													<?php 
												}
// 											}
										?>
					</select>&nbsp;
                  
                    <div class="input-append">
                    	<?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"优惠折扣",'data-title'=>"请填写促销标题全称" );
										 if(isset($info['pri_goods_per'])){
										 	$val['value'] = $info['pri_goods_per'];
										 } 
						                echo $form->textField($model,'pri_goods_per',$val); 
						 ?>
<!--                       <input type="text" placeholder="优惠折扣" data-title="请填写促销标题全称" class="span6 tip-right" data-original-title=""> -->
                      <span class="add-on">%</span>
                     </div>
                  </div>
                </div>

				<div class="control-group" id='perType3'>
					<?php echo $form->labelEx($model,'会员优惠',array('class'=>"control-label")); ?>
                  <div class="controls">
                    <div class="input-append">
                    	<?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"优惠折扣",'data-title'=>"请填写促销标题全称" );
										 if(isset($info['vip_per'])){
										 	$val['value'] = $info['vip_per'];
										 } 
						                echo $form->textField($model,'vip_per',$val); 
						 ?>
<!--                       <input type="text" placeholder="优惠折扣" data-title="请填写促销标题全称" class="span12 tip-right" data-original-title=""> -->
                      <span class="add-on">%</span>
                     </div>
                  </div>
                </div>
                
            </div>
    
          </div>
          </div>
          <div class="span6">
            <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-time"></i> </span>
              <h5>促销优惠时间</h5>
            </div>
                <div class="widget-content">
                    <div class="control-group">
                    <?php echo $form->labelEx($model,'促销类型',array('class'=>"control-label")); ?>
                      <div class="controls">
                        <div data-toggle="buttons-radio" class="btn-group">
                        <?php 
                       		$per_type = isset($info['per_type'])?$info['per_type']:'1';
                       		$aFSTag = $this->httpClient("conData/promotionType");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
                       				?>
                       				<button onclick="$('#per_type').val(this.value);" class="btn btn-warning <?=$per_type==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       			}
                       		}
                       		echo "<input type='hidden' name='Goods[per_type]' id='per_type' value='{$per_type}' />";
                       		
                       	?>
<!--                           <button class="btn btn-warning" type="button">长期促销</button> -->
<!--                           <button class="btn btn-warning" type="button">短期促销</button> -->
                        </div>
                      </div>
                    </div>
                    <div class="control-group">
                    <?php echo $form->labelEx($model,'开始日期',array('class'=>"control-label")); ?>
                      <div class="controls">
                        <input type="text"  data-date-format="yyyy-mm-dd"  value="<?=isset($info['varil_begin_time'])?$info['varil_begin_time']:''; ?>" name="Goods[varil_begin_time]"   class="datepicker span11">
                        <span class="help-block">请正确选择本次促销的开始日期时间</span>
                        </div>
                    </div>                
                    <div class="control-group">
                    <?php echo $form->labelEx($model,'结束日期',array('class'=>"control-label")); ?>
                      <div class="controls">
                        <input type="text"  data-date-format="yyyy-mm-dd"  value="<?=isset($info['varil_end_time'])?$info['varil_end_time']:''; ?>" name="Goods[varil_end_time]" class="datepicker span11">
                        <span class="help-block">请正确选择本次促销的截止日期时间</span>
                        </div>
                    </div>  
                </div>
            </div>
          </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                  <h5>促销内容介绍</h5>
                </div>
                <div class="widget-content nopadding"><br>
                    <div class="control-group">
                    <?php echo $form->labelEx($model,'促销优惠介绍',array('class'=>"control-label")); ?>
                      <div class="controls">
                      <?php 
							$val = array('rows'=>6, 'cols'=>50,'class'=>"span11");
							if(isset($info['goods_desc'])){
								$val['value'] = $info['goods_desc'];
							}
							echo $form->textArea($model,'goods_desc',$val);
							 ?>
<!--                         <textarea class="span11" ></textarea> -->
                      </div>
                    </div><br>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-large btn-success"><i class="icon-ok-sign"></i> 保存</button>
                    </div>
                </div>
              </div>
      <?php $this->endWidget ();?>
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
<script src="<?php echo Yii::app()->baseUrl;?>/plus/My97DatePicker/WdatePicker.js"></script> 
  
<script>
							
function show(iId){
	hidden('perType1');
	hidden('perType2');
	hidden('perType3');
	document.getElementById(iId).style.display="";
	//alert(document.getElementById("div").style.display)
}

function hidden(iId){
	document.getElementById(iId).style.display="none";
	//alert(document.getElementById("div").style.display)
}
<?php 
		 
		 $sGoodsVType = isset($info['goods_v_type'])?($info['goods_v_type']<0?'1':$info['goods_v_type']):"1";
		 ?>
		 show('perType<?=$sGoodsVType; ?>');
</script>