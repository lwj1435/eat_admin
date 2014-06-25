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
            
              <div class="control-group">
                <label class="control-label">商店名称</label>
                <div class="controls">
                  <?php echo $form->textField($model,'merchant_name'); ?>
                  <?php echo $form->error($model,'merchant_name'); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">分店名称</label>
                <div class="controls">
                  <?php echo $form->textField($model,'merchant_branch'); ?>
                  <?php echo $form->error($model,'merchant_branch'); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">别名</label>
                <div class="controls">
                  <?php echo $form->textField($model,'merchant_alias'); ?>
                  <?php echo $form->error($model,'merchant_alias'); ?>
                </div>
              </div>
<!--               <div class="control-group"> -->
<!--                 <label class="control-label">服务内容</label> -->
<!--                 <div class="controls"> -->
                 
                  <?php 
//                   foreach($service_type as $service){
//                   	echo "<input type=\"checkbox\"  name=\"MerchantMsg[merchant_service][]\">$service";
//                   }
                  ?>
                  <?php //echo $form->error($model,'merchant_alias'); ?>
<!--                 </div> -->
<!--               </div> -->
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
