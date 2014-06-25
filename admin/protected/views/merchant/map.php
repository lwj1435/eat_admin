<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=AD429794c2e1fc1cfa7c408a51a28ef4 "></script>
<title>点击地图获取当前经纬度</title>
</head>
<body>
<div id="allmap"></div>
</body>
</html>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script> 
<script type="text/javascript">

// 百度地图API功能

var map = new BMap.Map("allmap");
// var point = new BMap.Point(<?php echo $long;?>, <?php echo $lat;?>);
var point = new BMap.Point(<?php echo $long==0?23:$long;?>, <?php echo $lat==0?113.20:$lat;?>);
map.centerAndZoom(point, 15);

var marker1 = new BMap.Marker(point);  // 创建标注
map.addOverlay(marker1);              // 将标注添加到地图中

function showInfo(e){
	$.get('<?php echo $this->createUrl('merchant/getAdd');?>',
			{
				log:e.point.lng,
				lat:e.point.lat
			},
			function(code,status){
				var dataObj = eval("("+code+")");
		        alert("地址:"+dataObj.result.formatted_address+"\n坐标:"+e.point.lng+","+e.point.lat);
			    window.opener.document.getElementById("longitude").value=e.point.lng ;
			    window.opener.document.getElementById("latitude").value=e.point.lat ;
			    window.opener.document.getElementById("MerchantAddForm_address").value=dataObj.result.formatted_address ;
			    window.close();
// 			location.reload(); 
	});  
	// window.opener.document.getElementById("longitude").value=e.point.lng ;
	// window.opener.document.getElementById("latitude").value=e.point.lat ;
	// alert(e.point.lng + ", " + e.point.lat);
// 	ajax('http://api.map.baidu.com/geocoder/v2/?ak=AD429794c2e1fc1cfa7c408a51a28ef4&callback=renderReverse&location='+e.point.lng+','+e.point.lat+'&output=json&pois=0',function(str){
//             var dataObj = eval("("+str+")");
//            alert(dataObj.formatted_address);
//             MerchantAddForm_address
// 			alert(e.point.lng + ", " + e.point.lat);
// 			window.close();
//         });
// 	window.close();
}
map.addEventListener("click", showInfo);

</script>