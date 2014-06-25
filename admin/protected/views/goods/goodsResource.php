<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/jqcss/pujie.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/jqcss/jquery.fileupload.css">
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> <a href="#" class="current">菜品资源管理</a> </div>
    <h1><span class="icon"> <i class="icon-reorder"></i> </span>菜品资源管理</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-volume-down"></i> </span>
          <h5>推介语音资源管理</h5>
        </div>
        <div class="widget-content"></br>

		  		<div class="row-fluid"></br>
                      <ul class="resource_big">
                        	<li>
                            <div class="pic"><img id="goods_musice_show" src="<?php echo Yii::app()->baseUrl;?>/files/<?php echo isset($info['goods_sounds'])?$info['goods_sounds']:"imgadd.jpg";?>" height="200px" alt="" ></div><span class="label label-success fileinput-button"><i class="icon-plus"></i><input id="musiceupload" type="file" multiple="" name="files[]"></span>
							<div id="progress-video" class="progress" style="width:100%">
                				<div class="progress-bar progress-bar-success"></div>
              				</div>
                            </li>
                            <li class="resource_txt">请上传您的餐厅环境视频介绍文件，格式为：“mp4”的文件，文件大小请控制在6MB以内</li>
                      </ul>                	
                </div>
        
          
        </div>
      </div>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-picture"></i> </span>
          <h5>菜品图片资源管理</h5>
        </div>
        <div class="widget-content">
        
          <div class="row-fluid">
         	<ul class="resource" id="image_list">
            <?php 
            foreach ($image_list as $item):?>                                                                                                                                                                                         
            	<li id="imageList<?php echo $item->id;?>"><div class="pic"><a class="lightbox_trigger" href="<?php echo Yii::app()->baseUrl;?>/files/<?php echo $item->image_link;?>"><img src="<?php echo Yii::app()->baseUrl;?>/files/<?php echo $item->image_link;?>" alt="" ></a></div><a title="" class="" href="javascript:delImg(<?php echo $item->id?>);"><span class="label label-important"><i class="icon-remove"></i></span></a>
            	</li>
            <?php endforeach;?>
            <li><div class="pic"><a><img src="<?php echo Yii::app()->baseUrl;?>/files/imgadd.jpg" alt="" ></a></div><span class="label label-success fileinput-button"><i class="icon-plus"></i><input id="fileupload1" type="file" multiple="" name="files[]"></span>
              <div id="progress" class="progress" style="width:100%">
                <div class="progress-bar progress-bar-success"></div>
              </div>
            </li>
          </ul>
          </div>
          <div>请上传您的餐厅LOGO标志，图片格式:JPG、PNG、GIF</div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in/">Themedesigner.in</a> </div>
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
    
    $('#musiceupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	if(file.name){
                	$.post("<?php echo $this->createUrl('goods/UpMusice')?>",
                  			{
                				merchant_musice:file.name
                  			},
                  			function(code,status){
							var res = eval("("+code+")");
							if(res.type){
// 				            	$("#goods_musice").val(file.name);
				           	 	$("#goods_musice_show").attr("src",baseUrl+file.name);
							}else{
								alert(res.msg);
							}
                  	});  
                }
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#musiceprogress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('#fileupload1').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	if(file.name){
                	$.post("<?php echo $this->createUrl('goods/UpImg')?>",
                  			{
                				image:file.name
                  			},
                  			function(code,status){
							var res = eval("("+code+")");
							if(res.type){
								$('#image_list').prepend('<li class="span2" id="imageList'+res.msg+'"> <input type="hidden" name="img_list[]" value="'+file.name+'"/> <a> <img src="'+baseUrl+file.name+'" alt="" > </a><div class="actions"> <a class="lightbox_trigger" href="'+baseUrl+file.name+'"><i class="icon-search"></i></a> <a title="" class="" href="javascript:delImg('+res.msg+')"><i class="icon-remove-sign"></i></a></div></li>');
							}else{
								alert(res.msg);
							}
                  	});  
                }
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    
});
var defaultImg = "imgadd.jpg";
var baseUrl = "<?php echo Yii::app()->baseUrl;?>/files/";

function delImg(iImgId){
	$.post("<?php echo $this->createUrl('merchant/delImg')?>",
  			{
				imageId:iImgId
  			},
  			function(code,status){
			var res = eval("("+code+")");
			if(res.type){
				$('#imageList'+iImgId).remove();
			}else{
				alert(res.msg);
			}
  	}); 
}
function delVideo(){
	$.post("<?php echo $this->createUrl('merchant/delVideo')?>",
  			{
				
  			},
  			function(code,status){
			var res = eval("("+code+")");
			if(res.type){
            	$("#merchant_video").val(defaultImg);
           	 	$("#merchant_video_show").attr("src",baseUrl+defaultImg);
			}else{
				alert(res.msg);
			}
  	});  
}

function delSound(){
	$.post("<?php echo $this->createUrl('merchant/delSound')?>",
  			{
				
  			},
  			function(code,status){
			var res = eval("("+code+")");
			if(res.type){
            	$("#merchant_musice").val(defaultImg);
            	$("#merchant_musice_show").attr("src",baseUrl+defaultImg);
			}else{
				alert(res.msg);
			}
  	});  
}

</script>
