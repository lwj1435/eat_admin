<?php

function json_message($errorCode,$param,$other=array(),$message=''){

	$data['errorCode'] = 0;
	$data['result'] = $param;
	$data['message'] = $message;
	if(!empty($other)){
		foreach ($other as $v=>$k){
			$data[$v] = $k;
		}
	}
	return json_encode($data);
}

function HttpClient($url,$data=array())
{	
	BaseFunctions::writeLog(Yii::app()->params['api'].$url);
	$client = HttpClientClass::quickPost(Yii::app()->params['api'].$url, $data);
	BaseFunctions::writeLog($client->getContent());
	$result = json_decode($client->getContent(),true);
	if($result['errorCode'] == 100||$client->getContent() == NULL)
	{
		Yii::app()->user->logout();
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		echo LoginTimeOutAlert();
		Yii::app()->end();
	}
	
	return $result;
}

function LoginTimeOutAlert(){
	header("Content-type: text/html; charset=utf-8");
	$return = ''; 
	$return .=  '<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/bootstrap.min.css" />
			<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/bootstrap-responsive.min.css" />
			<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/fullcalendar.css" />
			<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/uniform.css" />
			<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/select2.css" />
			<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/matrix-style.css" />
			<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/matrix-media.css" />
			<link href="'.Yii::app()->baseUrl.'/font-awesome/css/font-awesome.css" rel="stylesheet" />
			<link rel="stylesheet" href="'.Yii::app()->baseUrl.'/css/jquery.gritter.css" />
			<link href="'.Yii::app()->baseUrl.'/css/font.css" rel="stylesheet" type="text/css">';
	
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/jquery.min.js\"></script>";
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/jquery.min.js\"></script>";
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/bootstrap.min.js\"></script>";
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/jquery.uniform.js\"></script>";
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/select2.min.js\"></script>"; 
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/jquery.dataTables.min.js\"></script>";
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/matrix.js\"></script>";
	$return .=  "<script src=\"".Yii::app()->baseUrl."/js/matrix.tables.js\"></script>";
	$return .=  "<script>
		function goToLogin()
		{
			window.location.href = '".Yii::app()->createUrl("site/login")."';
		}
	</script>";
	$return .= '
		<div class="modal " id="aa"  aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>警告</h3>
			</div>
			<div class="modal-body">
		    	<p>登录超时，请重新登录！</p>
		    </div>
		    <div class="modal-footer"> <a href="#" onclick="goToLogin()"   class="btn btn-primary" data-dismiss="modal">确定</a>  </div>
		</div>';
	return $return;
}

function pAlert($message,$url = '')
{
	$str = "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	
	if($url){
		$location = "window.location.href='{$url}'";
	}
	
	$str .= "<script charset='utf-8' type='text/javascript'>alert('{$message}');{$location}</script>";
	return $str;
}

function redirect_message($message='成功',$time=3, $url=false )
{
	if(is_array($url))
	{
		$route=isset($url[0]) ? $url[0] : '';
		$url=$this->createUrl($route,array_splice($url,1));
	}
	if ($url)
	{
		$jsurl = "window.location.href='{$url}';";
	}
	else
	{
		$jsurl = "history.back();";
	}
	echo "
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>跳转</title>
		<style type='text/css'>
		<!--
		
		div,ul,li,span,p{
		list-style-type:none;
		margin:0px;
		padding:0px;
		font-family:'Microsoft YaHei','微软雅黑','SimHei','黑体';
			font-size:14px;
		}
		-->
		</style>
       <script type=\"text/javascript\">
           function run(){
           		var s = document.getElementById('sec');
                if(s.innerHTML == 0){
                    {$jsurl}
                    return false;
                }
                s.innerHTML = s.innerHTML * 1 - 1;
            }
            window.setInterval('run();', 1000);
       </script>
		
		</head>
		
		<body>
		<div style='height:150px;'></div>
		<div style=' border:#cdcdcd 1px solid; margin:auto; width:350px;;'>
		<ul>
		<li style='border-bottom:#cdcdcd 1px solid; height:40px; overflow:hidden; line-height:40px; font-size:16px;'><span style='padding-left:20px;'>系统跳转中</li>
		<li style='text-align:center; line-height:25px; padding-bottom:25px; padding-top:25px;'>您的操作已成功！--<span id=\"sec\" style=\"color:blue;\">{$time}</span>秒<br />
		<a href='{$url}'>如果你的浏览器没反应，请点击这里</a></li>
		</ul>
		
		</div>
		
		
		</body>
		</html>
	";
}

function pageshow($totalPage,$nowpage,$url)
{
	$return = '<div class="pagination"><ul>';
	$href = str_replace("pagestr", '1', $url);
	$return .= '<li><a href="'.$href.'">上一页</a></li>';
	for($i = 1;$i<=$totalPage;$i++)
	{
		if($i == $nowpage)
		{
			$href = str_replace("pagestr", $i, $url);
			$return .= "<li class=\"active\"><a href='$href'>$i</a></li>\n";
		}
		else
		{
			if($nowpage-$i>=4 && $i != 1)
			{
				$return .="<li><span class='pageMore'>...</span></li>\n";
				$i = $nowpage-3;
			}
			else
			{
				if($i >= $nowpage+5 && $i != $totalPage)
				{
					$return .="<li><span>...</span></li>\n";
					$i = $totalPage;
				}
				$href = str_replace("pagestr", $i, $url);
				$return .= "<li><a href=\"$href\">$i</a></li>\n";
			}
		}
	}
	$href = str_replace("pagestr", $totalPage, $url);
	$return .= '<li><a href="'.$href.'">下一页</a></li>';
	$return .= '</ul></div>';
	return $return;
}


///*PHP正则提取图片img标记中的任意属性*/
//$str = '<center><img src="/uploads/images/20100516000.jpg" height="120" width="120"><br />PHP正则提取或更改图片img标记中的任意属性</center>';
//
////1、取整个图片代码
//preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$str,$match);
//echo $match[0];
//
////2、取width
//preg_match('/<img.+(width=\"?\d*\"?).+>/i',$str,$match);
//echo $match[1];
//
////3、取height
//preg_match('/<img.+(height=\"?\d*\"?).+>/i',$str,$match);
//echo $match[1];
//
////4、取src
//preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$str,$match);
//echo $match[1];
//
///*PHP正则替换图片img标记中的任意属性*/
////1、将src="/uploads/images/20100516000.jpg"替换为src="/uploads/uc/images/20100516000.jpg")
//print preg_replace('/(<img.+src=\"?.+)(images\/)(.+\.(jpg|gif|bmp|bnp|png)\"?.+>)/i',"\${1}uc/images/\${3}",$str);
//echo "<hr/>";
//
////2、将src="/uploads/images/20100516000.jpg"替换为src="/uploads/uc/images/20100516000.jpg",并省去宽和高
//print preg_replace('/(<img).+(src=\"?.+)images\/(.+\.(jpg|gif|bmp|bnp|png)\"?).+>/i',"\${1} \${2}uc/images/\${3}>",$str);
function getContentImgUrl($content)
{
	preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$content,$match);
	return $match[2];
}

function getContentHttpImg($content)
{
//	"(\s+?http://)?(.*\.(jpg|gif|png|jpeg|bmp))"
//   \"(http:\/\/[^\"]+).(jpg|png|gif|jpeg)\"
//  http://.*\.(jpg|png|gif)
//	/\.(?:jpe?g|gif|bmp|png)\b/i
}


function FixUrl($url,$baseurl)
{
	
}



function alertHtml($id,$btnname,$message,$okjs='',$nojs='',$class='btn btn-danger')
{
	$okclick = "onclick='{$okjs}'";
	$noclick = "onclick=\"{$nojs}\"";
	return '<a class="'.$class.'" data-toggle="modal" href="#'.$id.'">'.$btnname.'</a> 
	<div class="modal hide" id="'.$id.'" style="display: none;" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>警告</h3>
		</div>
		<div class="modal-body">
	    	<p>'.$message.'</p>
	    </div>
	    <div class="modal-footer"> <a href="#" '.$okclick.' class="btn btn-primary" data-dismiss="modal">确定</a> <a href="#" '.$noclick.' class="btn" data-dismiss="modal">取消</a> </div>
	</div>';
}

function ckeditorJs($jsid){
	return '<script type="text/javascript" src="'.Yii::app()->baseUrl.'/plus/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="'.Yii::app()->baseUrl.'/plus/ckeditor/ckfinder/ckfinder.js"></script>
	<script type="text/javascript">
	CKEDITOR.replace(\' '.$jsid.'\',
	{
		filebrowserBrowseUrl : "'.Yii::app()->baseUrl.'/plus/ckeditor/ckfinder/ckfinder.html",
		filebrowserImageBrowseUrl : "'.Yii::app()->baseUrl.'/plus/ckeditor/ckfinder/ckfinder.html?Type=Images",
		filebrowserFlashBrowseUrl : "'. Yii::app()->baseUrl.'/plus/ckeditor/ckfinder/ckfinder.html?Type=Flash",
		filebrowserUploadUrl :  "'.  Yii::app()->baseUrl.'/plus/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
		filebrowserImageUploadUrl : "'.  Yii::app()->baseUrl.'/plus/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
		filebrowserFlashUploadUrl :  "'.  Yii::app()->baseUrl.'/plus/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
	});
	</script>';
}