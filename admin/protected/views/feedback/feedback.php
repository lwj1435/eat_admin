<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="#">客户反馈管理</a></div>
    <h1><span class="icon"> <i class="icon-comment"></i> </span>客户反馈管理</h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <form action="#" method="get" class="form-horizontal">
        <hr>
        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li><span class="icon"><i class="icon-ok"></i></span></li>
              <h5>反馈管理</h5>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab4" class="tab-pane active">
              <div class="todo">
                <ul>
                  <li class="clearfix">
                    <div class="txt" style="width:7%"><strong><i class="icon-user"></i>商家名称</strong></div>
                    <div class="txt" style="width:70%"><strong><i class="icon-comments-alt"></i>反馈内容</strong></div>
                    <div class="txt" style="width:10%"><strong><i class="icon-time"></i>反馈时间</strong></div>
                    <div class="txt" style="width:7%"><strong><i class="icon-bell"></i>状态</strong></div>
                  </li>
                   <?php foreach ($list as $iListKey => $item): ?> 
                  <li class="clearfix">
                    <div class="txt2" style="width:7%"><a href="#"><?php echo CHtml::encode($item->from_user_name ); ?></a></div>
                    <div class="txt2" style="width:70%"><a href="#"><?php echo strlen($item->content)>30?CHtml::encode(BaseFunctions::substr_ext($item->content,0,10))."...":CHtml::encode($item->content); ?></a><br>
                     <?php if ($item->status==2) {
                    	?>
                      <p><span class="badge badge-warning">回复 </span> <?php echo CHtml::encode($item->reply_content ); ?></p>
                      <?php }?>
                      </div>
                    <div class="txt2" style="width:10%"><?php echo $item->reply_time?date("Y-m-d H:i",$item->reply_time):"未回复"; ?></div>
                    <div class="txt2" style="width:7%">
                    <?php if ($item->status==2) {
                    	?>
                    	<a href="#"><span class="badge">已回复</span></a>
                    	<?php 
                    }else{?>
                    	<a href="#"><span class="badge badge-important">新咨询</span></a>
                    	<?php }?>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
           
          </div>
        </div>
             <div class="pagination">

    <?php 

    $this->widget('CLinkPager', array( 

        'pages' => $page, 

        'selectedPageCssClass' => 'active', 

        'hiddenPageCssClass' => 'disabled', 

        'header' => '', 

        'maxButtonCount' => 10, 

        'htmlOptions' => array('class' => ''), 

        'firstPageLabel' => '首页', 

        'nextPageLabel' => '后', 

        'prevPageLabel' => '前', 

        'lastPageLabel' => '最后', 

            ) 

    ); 

    ?> 

</div> 
      </form>
    </div>
  </div>
</div>
<!--Footer-part-->

</div>
<!--end-Footer-part-->
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script>
<!--end-Footer-part-->