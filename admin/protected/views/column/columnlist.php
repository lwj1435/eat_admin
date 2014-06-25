<?php
/* @var $this SiteController */

$baseurl = Yii::app()->baseUrl;
?>

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="<?php echo $this->createUrl("column/index");?>">栏目</a> </div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
          	<span class="icon">
            <input type="checkbox" id="title-checkbox" name="title-checkbox" />
            </span>
            <h5>栏目列表</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th>ID</th>
                  <th>栏目名称</th>
                  <th>排序</th>
                  <th>今日IP</th>
                  <th>今日PV</th>
                  <th>累计IP</th>
                  <th>累计PV</th>
                  <th>文章数量</th>
                  <th>最后更新时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if (!empty($catalogs)){
              		
              
              	foreach($catalogs as $catalog){
              		$explod = '';
              		$level = intval($catalog['level']) - 1;
                  	
                  	for($i=0;$i<$level;$i++){
                  		$explod .= '－';
                  	}
                  	$catalogName = $explod." ".$catalog['catalogName'];
              ?>
                <tr>
                  <td><input type="checkbox" /></td>
                  <td><?php echo $catalog['catalogId'];?></td>
                  <td><?php echo $catalogName;?></td>
                  <td>Win <?php echo $i;?></td>
                  <td class="center">4</td>
                  <td>Trident</td>
                  <td>Internet
                    Explorer <?php echo $i;?></td>
                  <td>Win 95+</td>
                  <td>4</td>
                  <td>4</td>
                  <td><a href="#">内容</a>&nbsp;|&nbsp;<a href="#">增加子栏目</a>&nbsp;|&nbsp;<a href="#">编辑</a>&nbsp;|&nbsp;<a href="#"><font color='red'>删除</font></a></td>
                </tr>
                <?php 
              	}
              }
                ?>

              </tbody>
            </table>
          </div>
        </div>
        <!-- 
        <div class="pagination">
              <ul>
                <li><a href="#">Prev</a></li>
                <li class="active"> <a href="#">1</a> </li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
              </ul>
		</div>
		 -->
      </div>
    </div>
  </div>
<!--End-Action boxes-->    
</div>
<!--end-main-container-part-->

<script src="<?php echo $baseurl;?>/js/jquery.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo $baseurl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo $baseurl;?>/js/select2.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/matrix.js"></script> 
<script src="<?php echo $baseurl;?>/js/matrix.tables.js"></script> 
