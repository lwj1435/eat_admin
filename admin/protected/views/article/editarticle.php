<?php
/* @var $this SiteController */

$baseurl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="<?php echo $baseurl;?>/plug/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="<?php echo $baseurl;?>/plug/ckeditor/ckfinder/ckfinder.js"></script>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="<?php echo $this->createUrl("article/EditArticle");?>">添加文章</a> </div>
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
            <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'basic_validate',
			'method'=>'post',
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'htmlOptions'=>array(
				'class'=>'form-vertical',
				'action'=>$this->createUrl('admin/editarticle'),
				'novalidate'=>'novalidate',
				'name'=>'basic_validate'
			)
		)); 
	?>
            
              <div class="control-group">
                <label class="control-label">文章标题</label>
                <div class="controls">
                  <?php echo $form->textField($model,'postTitle'); ?><font color='red'><?php echo $form->error($model,'postTitle'); ?></font>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">文章标签</label>
                <div class="controls">
                    <?php echo $form->textField($model,'postTag'); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">缩略图</label>
                <div class="controls">
                  <?php echo $form->textField($model,'postLitpic'); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">文章所属分类</label>
                <div class="controls">
                  <?php 
                  	$checklist = array();
                  	$checklist[0] = '无';

                  	if(!empty($catalogs)){
	                  	foreach($catalogs as $catalog)
	                  	{
	                  		$level = intval($catalog['level']) - 1;
	                  		$gang = '';
	                  		for($i=0;$i<$level;$i++){
	                  			$gang .= '－';
	                  		}
	                  		$checklist[$catalog['catalogId']] = $gang." ".$catalog['catalogName'];
	                  	}
                  	}
                  	echo $form->listBox($model,'catalogId',$checklist);
                  ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">关键字</label>
                <div class="controls">
                  <?php echo $form->textField($model,'postKeyword'); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">文章内容</label>
                <div class="controls">
                  <textarea id="postContent" name="ArticleForm[postContent]" cols="20" rows="2" class="ckeditor"></textarea>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="保存" class="btn btn-success">
              </div>
        <?php 
            $this->endWidget(); 
        ?>
            </form>
          </div>
        </div>
      </div>
    </div>
   </div>
<!--End-Action boxes-->    
</div>
<!--end-main-container-part-->

<script type="text/javascript">
CKEDITOR.replace( 'postContent',
{
	filebrowserBrowseUrl : '<?php echo $baseurl;?>/plug/ckeditor/ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : '<?php echo $baseurl;?>/plug/ckeditor/ckfinder/ckfinder.html?Type=Images',
	filebrowserFlashBrowseUrl : '<?php echo $baseurl;?>/plug/ckeditor/ckfinder/ckfinder.html?Type=Flash',
	filebrowserUploadUrl : '<?php echo $baseurl;?>/plug/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserImageUploadUrl : '<?php echo $baseurl;?>/plug/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl : '<?php echo $baseurl;?>/plug/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>

<script src="<?php echo $baseurl;?>/js/jquery.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo $baseurl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo $baseurl;?>/js/select2.min.js"></script> 
<script src="<?php echo $baseurl;?>/js/jquery.validate.js"></script> 
<script src="<?php echo $baseurl;?>/js/matrix.js"></script> 
<script src="<?php echo $baseurl;?>/js/matrix.form_validation.js"></script>
