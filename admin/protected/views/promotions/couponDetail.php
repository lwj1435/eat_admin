<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">优惠劵详情</a> </div>
    <h1><span class="icon"> <i class="icon-plus-sign"></i> </span>[<?php echo isset($info['goods_name'])?$info['goods_name']:'';?>]优惠劵详情</h1>
  </div>

  <div class="container-fluid"><hr>
		<div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a href="">
            	<span class="label label-warning"><i class="icon-money"></i></span>
                <div class="qatitle bg_lg">优惠劵总数</div><div class="qnumber"><?php echo isset($info['good_num'])?$info['good_num']:'0';?></div></a>
            </li>
            <li><a href="">
            	<span class="label label-warning"><i class="icon-download-alt"></i></span>
                <div class="qatitle bg_lg">已发放数量</div><div class="qnumber"><?php echo isset($info['get_good_num'])?$info['get_good_num']:'0';?></div></a>
            </li>
            <li><a href="">
            	<span class="label label-warning"><i class="icon-check"></i></span>
                <div class="qatitle bg_lg">已使用数量</div><div class="qnumber"><?php echo isset($info['use_good_num'])?$info['use_good_num']:'0';?></div></a>
            </li>
            <li><a href="">
            	<span class="label label-warning"><i class="icon-eye-open"></i></span>
                <div class="qatitle bg_lg">浏览总数</div><div class="qnumber"><?php echo isset($info['goods_visit_times'])?$info['goods_visit_times']:'0';?></div></a>
            </li>
          </ul>
        </div>

    <div class="row-fluid"><hr />
    <form action="#" method="get" class="form-horizontal">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-content nopadding">
                    <div class="control-group"><br>
                      <label class="control-label">验证使用优惠劵</label>
                      <div class="controls">
                   			 <input type="text" placeholder="请填写客户提供的优惠劵编码（包括手机短信码和应用编码）" data-title="请填写优惠劵编码" class="span11 tip-right" data-original-title="" id="couponStr"><button type="button" onclick="useCou()" class="btn btn-success">验证使用</button>
                        </div><br>
                    </div>                
                </div>
        </div>
      </div>
      </form>
    </div>
    <div class="row-fluid">
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
						
						?><hr />
     
          <div class="span6">
            <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>优惠劵内容</h5>
              <input type="hidden" value="<?php echo isset($info['id'])?$info['id']:'';?>" name="id" />
              <input type="hidden" value="<?php echo isset($info['old_good_num'])?$info['old_good_num']:'0';?>" name="old_good_num" />
            </div>
            <div class="widget-content nopadding">
                <div class="control-group"><br>
                  <label class="control-label">优惠劵名称</label>
                  <div class="controls">
                    <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"请填写优惠劵标题全称",'data-title'=>"请填写优惠劵标题全称");
										 if(isset($info['goods_name'])){
										 	$val['value'] = $info['goods_name'];
										 } 
						                echo $form->textField($model,'goods_name',$val); 
						                 
						           ?>
<!--                     <input type="text" placeholder="请填写优惠劵标题全称" data-title="请填写优惠劵标题全称" class="span6 tip-right" data-original-title=""> -->
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">优惠劵类型</label>
                  <div class="controls">
                    <div data-toggle="buttons-radio" class="btn-group">
                      <?php 
                       		$sGoodsVType = isset($info['goods_v_type'])?($info['goods_v_type']<0?'1':$info['goods_v_type']):"1";
                       		$aFSTag = $this->httpClient("conData/couponType");
                       		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($aFSTag['msg'] as $iKey => $sFSStr){
if($sGoodsVType==$iKey){
                       				?>
                       				<button onclick="$('#goods_v_type').val(this.value);show('perType<?=$iKey; ?>');" class="btn btn-info <?=$sGoodsVType==$iKey?"active":""; ?>" type="button"  value="<?php echo $iKey?>"><?php echo $sFSStr?></button>
                       															
                       															<?php 
                       															}
                       			}
                       		}
                       		echo "<input type='hidden' name='CouponForm[goods_v_type]' id='goods_v_type' value='{$sGoodsVType}' />";
                       		
                       	?>
                    </div>
                  </div>
                </div>
                <div class="control-group" id='perType1'>
                  <label class="control-label">代金金额</label>
                  <div class="controls">
                    <div class="input-append">
                     <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"优惠折扣",'data-title'=>"请填写优惠折扣");
										 if(isset($info['pri_money'])){
										 	$val['value'] = $info['pri_money'];
										 } 
						                echo $form->textField($model,'pri_money',$val); 
						                 
						           ?>
<!--                       <input type="text" placeholder="优惠折扣" data-title="请填写促销标题全称" class="span12 tip-right" data-original-title=""> -->
                      <span class="add-on">￥</span>
                     </div>
                  </div>
                </div>
                <div class="control-group" id='perType2'>
                  <label class="control-label">优惠折扣</label>
                  <div class="controls">
                    <div class="input-append">
                     <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"优惠折扣",'data-title'=>"请填写优惠折扣","maxlength"=>"2");
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
                  <label class="control-label">指定兑换菜品</label>
                  <div class="controls">
                    <select multiple placeholder="餐厅提供的服务，如:早茶、午市、外卖等" class="span6">
<!--                       <option>早茶</option> -->
<!--                       <option>午市</option> -->
<!--                       <option>晚市</option> -->
<!--                       <option>夜宵</option> -->
<!--                       <option></option> -->
                      
                       <?php 
                       		$sGoodsVType = isset($info['pri_goods_list'])?$info['pri_goods_list']:'';
//                        		$aFSTag = $this->httpClient("seat/getSeatArea");
//                        		if($aFSTag['type']&&isset($aFSTag['msg'])){
                       			foreach ($goodsArr as $iKey => $sFSStr){
                       				?>
                       				<option  value="<?php echo $iKey?>" 
                       				<?php echo isset($info['pri_goods_list'])?$this->isInArray($iKey,$info['pri_goods_list'])?"selected":'':'';?>
                       				><?php echo $sFSStr?></option>
                       															
                       															<?php 
                       			}
//                        		}
                       		
                      ?>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">发放数量</label>
                  <div class="controls">
                    <div class="input-append">
                     <?php
						                 $val = array('class'=>'span6 tip-right','placeholder'=>"发放数量",'data-title'=>"请填写优惠劵发放数量");
										 if(isset($info['good_num'])){
										 	$val['value'] = $info['good_num'];
										 } 
						                echo $form->textField($model,'good_num',$val); 
						                 
						           ?>
<!--                       <input type="text" placeholder="发放数量" data-title="请填写优惠劵发放数量" class="span6 tip-right" data-original-title=""> -->
                      <span class="add-on">张</span>
                     </div>
                  </div>
                </div>
                <br>
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
                      <label class="control-label">开始日期</label>
                      <div class="controls">
                      <?php
						                 $val = array('class'=>'datepicker span11','data-date-format'=>'yyyy-mm-dd');
										 if(isset($info['varil_begin_time'])){
										 	$val['value'] = $info['varil_begin_time'];
										 } 
						                echo $form->textField($model,'varil_begin_time',$val); 
						                 
						           ?>
<!--                         <input type="text" data-date="01-02-2013" data-date-format="yyyy-mm-dd" value="01-02-2013" class="datepicker span11"> -->
                        <span class="help-block">请正确选择本次促销的开始日期时间</span>
                        </div>
                    </div>                
                    <div class="control-group">
                      <label class="control-label">结束日期</label>
                      <div class="controls">
                      <?php
						                 $val = array('class'=>'datepicker span11','data-date-format'=>'yyyy-mm-dd');
										 if(isset($info['varil_end_time'])){
										 	$val['value'] = $info['varil_end_time'];
										 } 
						                echo $form->textField($model,'varil_end_time',$val); 
						                 
						           ?>
<!--                         <input type="text" data-date="01-02-2013" data-date-format="yyyy-mm-dd" value="01-02-2013" class="datepicker span11"> -->
                        <span class="help-block">请正确选择本次促销的截止日期时间</span>
                        </div>
                    </div>  
                </div>
            </div>
          </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                  <h5>优惠劵内容介绍</h5>
                </div>
                <div class="widget-content nopadding"><br>
                    <div class="control-group">
                      <label class="control-label">促销优惠介绍</label>
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
      <?php $this->endWidget(); ?>
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


function useCou(){
	var text = $("#couponStr").val();
	if(f_check_userID(text)){
		$.post("<?php echo $this->createUrl('promotions/useCoupon')?>",
				{
					couponStr:text
				},
				function(code,status){
					var re = eval("("+code+")");
					if(re.type){
						alert(re.msg);
						location.reload(); 
					}else{
						alert(re.msg);
					}
					//$("#content_code").text(code);
					//location.reload(); 
		});  
  	}
}

function f_check_userID(userID)   
{   
   //var userID = obj.value;   
   if(userID.length > 30)   
   {   
       alert("长度不能大于30");   
       return false;   
   }   
 
   if(!/^\w{1,30}$/.test(userID))    
   {   
	   alert("只能由数字、字母组合而成");   
       return false;   
   }   
   return true;   
}   
							 
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