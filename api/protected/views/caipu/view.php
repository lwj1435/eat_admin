<?php
/* @var $this CaipuController */
/* @var $model Caipu */
$this->breadcrumbs=array(
	$model->id,
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $model->cp; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<style type="text/css">
* {
	margin: 0px;
	padding: 0px;
	border: 0px;
	list-style-type: none;
}
body, td, th {
	font-size: 16px;
	color: #000;
	background-color: #f6f0eb;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family: "微软雅黑", Arial;
	line-height: 32px;
}
img {
	width: 100%
}
.div1 {
	clear: both;
	margin-top: 50px;
	width: 430px;
	margin: auto;
	text-align: right;
	color: #343434;
}
.div1 ul li {
	border: 1px solid #EBEBEB;
	background-color: #FFF;
	color: #343434;
	float: left;
	font-size: 14px;
	height: 30px;
	line-height: 30px;
	width: 200px;
	overflow: hidden;
	padding: 5px;
}
.lrlfoodlist ul li {
	text-align: left;
}
.lrlname {
	color: #343434;
	float: left;
}
.h4_1 {
	background: none repeat scroll 0 0 #F3F3F3;
    border-left: 1px solid #EBEBEB;
    border-right: 1px solid #EBEBEB;
    color: #FF3300;
    float: left;
    height: 40px;
    line-height: 40px;
    padding-left: 10px;
    width: 412px;
	text-align:left;
}
.lrlname1 {
	color: #343434;
	float: right;
}
.l34 {
	text-align: left;
}
</style>
</head>

<body style="width:448px; margin:auto;">
<div style="clear:both; height:10px;"></div>
<h1><?php echo $model->cp; ?></h1>
<div style="clear:both; height:10px;"></div>
<?php echo $model->img; ?>
<div style="clear:both; height:10px;"></div>
<div class="div1">
<?php echo $model->cl; ?>
<div style="clear:both; height:10px;"></div>
<?php echo $model->gc; ?>
</body>
</html>
