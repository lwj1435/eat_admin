<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#">Sample pages</a> <a href="#" class="current">Gallery</a> </div>
    <h1><span class="icon"> <i class="icon-paste"></i> </span>餐单菜品管理</h1>
  </div>

  <div class="container-fluid"><hr>
  <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lg"> <a href="index.html"> <i class="icon-user"></i> <span class="label label-warning label-font">1593</span>现有菜品总数</a> </li>
            <li class="bg_lg"> <a href="charts.html"> <i class="icon-ok"></i> <span class="label label-warning label-font">87</span>售卖中菜品</a> </li>
            <li class="bg_lg"> <a href="widgets.html"> <i class="icon-remove-sign"></i><span class="label label-warning label-font">34</span>已停售菜品</a> </li>
            <li class="bg_lg"> <a href="index.html"> <i class="icon-thumbs-up"></i> <span class="label label-warning label-font">56</span>好评最高菜品</a> </li>
            <li class="bg_lg"> <a href="charts.html"> <i class="icon-thumbs-down"></i> <span class="label label-warning label-font">120</span>好评最低菜品</a> </li>
            <li class="bg_lg"> <a href="widgets.html"> <i class="icon-edit"></i><span class="label label-warning label-font">15</span>高分享菜品</a> </li>        
          </ul>
    	</div>
    <div class="row-fluid"><hr>
        <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                    <h5>菜品列表</h5>
                    <a href="#"><span class="label label-important"><i class="icon-remove-sign"></i> 删除菜品</span></a>
                    <a href="#"><span class="label"><i class="icon-remove-sign"></i> 停售设置</span></a>
                    <a href="#"><span class="label label-success"><i class="icon-ok"></i> 售卖设置</span></a>
                  </div>
                  <div class="widget-content">
                    <div class="todo">
<!--                       <form name=myform action="" method=post> -->
                      <ul>


<?php 

//$add_drop = CHtml::dropDownList('catlist','',CmpCat::model()->getCmpCat('移动到分类'),array('class'=>'s_ipt w_120 removedropcatbatch'));
//$remove_drop = CHtml::dropDownList('catlist','',CmpCat::model()->getCmpCat('添加到分类'),array('class'=>'s_ipt w_120 adddropcatbatch'));
$this->widget('zii.widgets.CListView', array(
'dataProvider'=>$dataProvider,

'itemView'=>'_view',
//'template'=>"{items}\n{pager}",
'template'=>'<li class="clearfix">{sorter}</li>{items}{pager}',
'sortableAttributes'=>array('goods_name'),
    'pager' => array(
        'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css', //自定义样式
        'header' => false,
        'firstPageLabel'=>'首頁',       //列表第一个页面
        'prevPageLabel' => '上一頁',
        'nextPageLabel' => '下一頁',
        'lastPageLabel'=>'末頁',        //列表最后一个页面
        'maxButtonCount' => 5,          //最大按钮数
    ),
'itemsTagName'=>'table',
'sortableAttributes'=>array(
		'status',
		'goods_name',
		'goods_visit_times'
),
'sorterHeader'=>'Sort by:',
)); 
?>
</ul>
<!-- </form> -->
                    </div>
                  
                  </div>
                </div>
                         
    </div>
  </div>
</div>

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script>

<script	LANGUAGE="JavaScript">
$(function() {  
	alert(1);
    $("#title-checkbox").click(function() {  
        alert("gagag");
        if ($(this).attr("checked")) {  
            alert(111);
            $("input[name=cklist]").each(function() {  
                $(this).attr("checked", true);  
            });  
        } else {  
            alert(22);
            $("input[name=cklist]").each(function() {  
                $(this).attr("checked", false);  
            });  
        }  
    });  
    //得到选中的值，ajax操作使用  
    $("#submit").click(function() {  
        var text="";  
        $("input[name=cklist]").each(function() {  
            if ($(this).attr("checked")) {  
                text += ","+$(this).val();  
            }  
        });  
         alert(text);  
    });  
});  
</script>