<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">客户评价详情列表</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>客户评价详情列表</h5>
 
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>用户名称</th>
                  <th>评价类型</th>
                  <th>评价内容</th>
                  <th>评价分数</th>
<!--                  <th>评价入口</th>-->
                  <th>评价时间</th>
                </tr>
              </thead>
              <tbody>
            <?php
          	if(!empty($result['result'])){
   
              	foreach($result['result'] as $temp){

              ?>
                <tr class="odd gradeX">
                  <td><?php echo $temp['user_name'];?></td>
                  <td class="center"><?php echo $comment_type[$temp['type']];?></td>
                  <td><?php echo $temp['comment'];?></td>
                  <td><?php echo $temp['score'];?></td>
<!--                  <td class="center">5</td>-->
                  <td class="center"><?php echo date('Y-m-d H:i:s',$temp['add_time']);?></td>
                </tr>
             <?php
              	}
              }
              ?>
              </tbody>
            </table>
          </div></div>
          
          <?php echo pageshow($pagedata['pagecount'],$pagedata['nowpage'],$this->createUrl("honesty/Evaluate", array('pagecount'=>$pagedata['pagecount'],'page'=>'pagestr','offset'=>$pagedata['offset'],'sort'=>$pagedata['sort'],'asc'=>$pagedata['asc'])));?>
          </div></div></div></div>
          

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script> 
