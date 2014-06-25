<?php if ($index==0) { ?>
<li class="clearfix">
                              <div class="txt"><input type="checkbox" id="title-checkbox" name="title-checkbox"/></div>
                              <div class="txt offset0"><strong ><?php echo CHtml::encode($data->getAttributeLabel('goods_name')); ?></strong></div>
                              <div class="pull-right offset30"><strong>操作</strong></div>
                              <div class="pull-right offset20"><strong><?php echo CHtml::encode($data->getAttributeLabel('status')); ?></strong></div>
                              <div class="pull-right offset30"><strong><?php echo CHtml::encode($data->getAttributeLabel('goods_visit_times')); ?></strong></div>
                        </li>
<?php  } ?>

<li class="clearfix">
                              <div class="txt"><input type="checkbox" name="cklist" value="<?php echo CHtml::encode($data->id ); ?>" /></div>
                              <div class="txt offset0"><a href="#"><?php echo CHtml::encode($data->goods_name ); ?></a></div>
                              <div class="txt offset0">
                              	<?php
                              	 if (strpos($data->goods_tag,',1,')>-1) {
                              		?>
                              		<a href="#"><span class="badge badge-success tip-top" data-original-title="删除标签">新</span></a>
                              		<?php 
                              	}?>
                              	
                              	<?php if (strpos($data->goods_tag,',2,')>-1) {
                              		?>
                              		<a href="#"><span class="badge badge-success tip-top" data-original-title="删除标签">热</span></a> 
                              		<?php 
                              	}?>
                              	
                              	<?php if (strpos($data->goods_tag,',3,')>-1) {
                              		?>
                              		<a href="#"><span class="badge badge-success tip-top" data-original-title="删除标签">推</span></a>
                              		<?php 
                              	}?>
                              </div>
                              <div class="txt offset0">
                              	<span class="label label-warning">促</span>
                              	<span class="label label-important">劵</span>
                              </div>
                              <div class="pull-right offset0"><a class="tip" href="goods_detail.html" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a></div>
                              <div class="pull-right offset0"><span class="badge badge-important"><?php 
//tempArr array(0=>"待售",1=>'售完',2=>"在售")
echo BaseFunctions::changeShow('goodsStatus',$data->status,'未知');
//echo CHtml::dropDownList('city_id','"'.$data->status.'"',BaseFunctions::getConfig('goodsStatus'),array('disabled'=>true,'class'=>'badge badge-important'));?></span></div>
                              <div class="pull-right offset0"><span class="badge badge-important"><?php echo CHtml::encode($data->goods_visit_times ); ?></span></div>
                        </li>
