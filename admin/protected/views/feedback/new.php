<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="#" class="current">新增反馈信息</a> </div>
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
						?>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>新增反馈信息</h5>
          </div>
          <div class="widget-content">
         
              <div class="control-group error">
                <label class="control-label" for="inputError">反馈问题</label>
                <div class="controls">
                 <?php
																				$val = array (
																						'class' => 'span11',
																				);
																				if (isset ( $info ['content'] )) {
																					$val ['value'] = $info ['content'];
																				}
																				echo $form->textField ( $model, 'content', $val );
																				
																				?>
<!--                   <input type="text" id="inputError" class="span11"> -->
                </div>
              </div>
             
                <div class="widget-content nopadding">
                  <label class="control-label" for="inputError">反馈详细内容</label>
             
                    <div class="controls">
                    <?php 
							$val = array('rows'=>6, 'cols'=>50,'class'=>"textarea_editor span12",'placeholder'=>"请输入需要反馈的内容!");
							if(isset($info['detail_content'])){
								$val['value'] = $info['detail_content'];
							}
							echo $form->textArea($model,'detail_content',$val);
							 ?>
<!--                       <textarea class="textarea_editor span12" rows="6" placeholder="Enter text ..."></textarea> -->
                    </div>
          
                </div>
           
               <div class="form-actions">
              <button type="submit" class="btn btn-success">提交</button>

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
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script> 