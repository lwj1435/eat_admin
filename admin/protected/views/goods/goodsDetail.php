<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/jqcss/pujie.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/jqcss/jquery.fileupload.css">
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">菜品详情</a> </div>
    <h1><span class="icon"> <i class="icon-pencil"></i> </span><?php echo $info ['goods_name']?$info ['goods_name']:'';?>详情</h1>
  </div>
  <div class="container-fluid"><hr>
	<div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a>
            	<span class="label label-warning"><i class="icon-user"></i></span>
                <div class="qatitle bg_lg">浏览数</div><div class="qnumber"><?php echo isset($info['view_num'])?$info['view_num']:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-edit"></i></span>
                <div class="qatitle bg_lg">点餐数</div><div class="qnumber"><?php echo isset($info['be_book_num'])?$info['be_book_num']:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-share-alt"></i></span>
                <div class="qatitle bg_lg">分享数</div><div class="qnumber"><?php echo isset($info['share_times'])?$info['share_times']:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-thumbs-up"></i></span>
                <div class="qatitle bg_lg">点赞数</div><div class="qnumber"><?php echo isset($info['be_good_num'])?$info['be_good_num']:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-volume-down"></i></span>
                <div class="qatitle bg_lg">翻译发音使用数</div><div class="qnumber"><?php echo isset($info['translation_num'])?$info['translation_num']:0;?></div></a>
            </li>
            <li><a>
            	<span class="label label-warning"><i class="icon-inbox"></i></span>
                <div class="qatitle bg_lg">相关菜谱浏览数</div><div class="qnumber"><?php echo isset($info['connection_num'])?$info['connection_num']:0;?></div></a>
            </li>
          </ul>
        </div>
        
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
						?>
	<?php if ($isOk==1) {
							?>
							<div class="container-fluid">
    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading">成功!</h4>
     修改成功!
    </div>
							<?php 
						}else if ($isOk==3) {
							
						}else{?>
						<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading">错误!</h4>
						
						<?php 
						echo $form->errorSummary ( $model );
						?>
						</div>
						<?php }?>
    <div class="row-fluid"><hr>
		<div class="row-fluid">
          <div class="span6">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"> <i class="icon-info-sign"></i>
						</span>
						<h5>菜品内容</h5>
						<input type="hidden" value="<?php echo isset($info['id'])?$info['id']:'';?>" name="id" />
					</div>
					<div class="widget-content nopadding">
						<div class="control-group">
							<br>
                	<?php echo $form->labelEx($model,'菜品名称',array('class'=>"control-label")); ?>
                  <div class="controls">
                    <?php
																				$val = array (
																						'class' => 'span6 tip-right',
																						'placeholder' => "您的菜品全称",
																						"data-title" => "请填写您的菜品全称" 
																				);
																				if (isset ( $info ['goods_name'] )) {
																					$val ['value'] = $info ['goods_name'];
																				}
																				echo $form->textField ( $model, 'goods_name', $val );
																				
																				?>
                  </div>
						</div>
						<div class="control-group">
							<?php echo $form->labelEx($model,'菜品类型',array('class'=>"control-label")); ?>
							<div class="controls">
								<select multiple placeholder="菜品类型，如:早茶、午市、外卖等" name="GoodsForm[goods_cat][]" >
										<?php
											$aMerTag = $this->httpClient("conData/greensMenu"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
													<option 
													<?php echo isset($info['goods_cat'])?$this->isInArray($iKey,$info['goods_cat'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
													<?php 
												}
											}
										?>
									</select>
							</div>
						</div>
						<div class="control-group">
							<?php echo $form->labelEx($model,'菜品口味',array('class'=>"control-label")); ?>
							<div class="controls">
								<select multiple placeholder="菜品类型，如:早茶、午市、外卖等" name="GoodsForm[goods_taste_tag][]" >
										<?php
											$aMerTag = $this->httpClient("conData/greensTaste"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
													<option 
													<?php echo isset($info['goods_taste_tag'])?$this->isInArray($iKey,$info['goods_taste_tag'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
													<?php 
												}
											}
										?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<?php echo $form->labelEx($model,'菜品标签',array('class'=>"control-label")); ?>
							<div class="controls">
								<select multiple placeholder="菜品标签" name="GoodsForm[goods_tag][]" >
										<?php
											$aMerTag = $this->httpClient("conData/goodsTag"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
													<option 
													<?php echo isset($info['goods_tag'])?$this->isInArray($iKey,$info['goods_tag'])?"selected":'':'';?> 
													 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
													<?php 
												}
											}
										?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label for="checkboxes" class="control-label">售卖状态</label>
							<div class="controls">
								<div data-toggle="buttons-radio" class="btn-group">
									<?php
											$aMerTag = $this->httpClient("conData/goodsStatus"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
													<button class="btn btn-info<?php echo isset($info['status'])?$info['status']==$iKey?" active":"":"";?>" type="button" value="<?php echo $iKey?>" onclick="$('#GoodsForm_status').val(this.value);"><?php echo $sMTStr?></button>
													<?php 
												}
											}
											$val = array ();
											if (isset ( $info ['status'] )) {
												$val ['value'] = $info ['status'];
											}
											echo $form->hiddenField($model,"status",$val);
									?>
									
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="checkboxes" class="control-label">售卖方式</label>
							<div class="controls">
								<div data-toggle="buttons-radio" class="btn-group">
									<?php
											$aMerTag = $this->httpClient("conData/goodsSaleType"); 
											if($aMerTag['type']&&isset($aMerTag['msg'])){
												foreach ($aMerTag['msg'] as $iKey => $sMTStr){
													?>
													<button class="btn btn-info<?php echo isset($info['goods_sale_type'])?$info['goods_sale_type']==$iKey?" active":"":"";?>" type="button" value="<?php echo $iKey?>" onclick="$('#GoodsForm_goods_sale_type').val(this.value);"><?php echo $sMTStr?></button>
													<?php 
												}
											}
											$val = array ();
											if (isset ( $info ['status'] )) {
												$val ['value'] = $info ['status'];
											}
											echo $form->hiddenField($model,"goods_sale_type",$val);
									?>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="checkboxes" class="control-label">发音翻译</label>
							<div class="controls">
								<div data-toggle="buttons-radio" class="btn-group">
								<?php
									// ranslateType
									// TODO 这里一定要修改
									// echo isset($info['status'])?$info['status']==$iKey?" active":"":"";
								$aMerTag = $this->httpClient ( "conData/translateType" );
								if ($aMerTag ['type'] && isset ( $aMerTag ['msg'] )) {
									foreach ( $aMerTag ['msg'] as $iKey => $sMTStr ) {
										?>
																					<button
										class="btn btn-warning<?php echo isset($info['translate_type'])?$info['translate_type']==$iKey?" active":"":"";?>"
										type="button" value="<?php echo $iKey?>"
										onclick="$('#GoodsForm_translate_type').val(this.value);"><?php echo $sMTStr?></button>
																					<?php
									}
								}
								$val = array ();
								if (isset ( $info ['translate_type'] )) {
									$val ['value'] = $info ['translate_type'];
																			}
																			echo $form->hiddenField($model,"translate_type",$val);
								?>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">菜品售价</label>
							<div class="controls">
								<div class="input-append">
								 <?php
																				$val = array (
																						'class' => 'span4 tip-right',
																						'placeholder' => "价格",
																						"data-title" => "请填写您的菜品价格,价格必须填写数字；" 
																				);
																				if (isset ( $info ['goods_pice'] )) {
																					$val ['value'] = $info ['goods_pice'];
																				}
																				echo $form->textField ( $model, 'goods_pice', $val );
																				
																				?>
									 <span
										class="add-on">￥</span>
								</div>
							</div>
							<br>

						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-large btn-success">
								<i class="icon-ok-sign"></i> 保存
							</button>
						</div>
					</div>

				</div>
			</div>
			<div class="span6">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"> <i class="icon-picture"></i>
						</span>
						<h5>菜品图片</h5>
					</div>
					<div class="widget-content"><br>
						<div class="control-group">
                        		
                                <ul class="resource_big">
									
                                    <li>
                                    <div class="pic">
                                    <a class="lightbox_trigger" id="goods_image_detail" href="<?php echo Yii::app()->baseUrl;?>/files/<?php echo isset($info['goods_image'])?$info['goods_image']:"imgadd.jpg";?>"><img id="goods_image_show" src="<?php echo Yii::app()->baseUrl;?>/files/<?php echo isset($info['goods_image'])?$info['goods_image']:"imgadd.jpg";?>" alt=""></a>
                                    <input type="hidden" name="GoodsForm[goods_image]" id='goods_image' value="<?=(isset($info['goods_image'])&&$info['goods_image'])?$info['goods_image']:""; ?>">
                                    </div><span class="label label-success fileinput-button"><i class="icon-pencil"></i><input id="fileupload" type="file" multiple="" name="files[]"></span>
                                    <div id="progress" class="progress" style="width:100%">
                                        <div class="progress-bar progress-bar-success"></div>
                                    </div>
                                    </li>
                                    <li class="resource_txt">请上传您的餐厅环境视频介绍文件，格式为：“mp4”的文件，文件大小请控制在6MB以内</li>
                                </ul>
                                
						</div>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"> <i class="icon-info-sign"></i>
						</span>
						<h5>相关菜品管理</h5>
					</div>
					<div class="widget-content nopadding">
						<br>
						<div class="control-group">
							<label class="control-label">相关菜品</label>
							<div class="controls">
								<select multiple placeholder="相关菜品管理等" name="GoodsForm[pri_goods_list][]">
									<?php 
									foreach ($goodsArr as $iKey => $sMTStr){
										?>
																						<option 
																						<?php echo isset($info['pri_goods_list'])?$this->isInArray($iKey,$info['pri_goods_list'])?"selected":'':'';?> 
																						 value="<?php echo $iKey?>"><?php echo $sMTStr?></option>
																						<?php 
																					}
									?>
								</select>
							</div>
						</div>
						<br>
					</div>
				</div>
			</div>
    </div>
  </div>
      		<?php $this->endWidget ();?>
</div>
<!--Footer-part-->

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
                $("#goods_image").val(file.name); 
                $("#goods_image_show").attr("src",baseUrl+file.name);
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
									</script>
	