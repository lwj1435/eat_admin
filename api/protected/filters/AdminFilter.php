<?php
class AdminFilter extends CFilter
{
	protected function preFilter($filterChain)
	{
		$key = $_REQUEST['key'];
		$keystr = MD5Crypt::Decrypt ($key,100);
		$keyarr = explode(":", $keystr);
		
		$id = $keyarr[0];
		$username = $keyarr[1];
		$time = $keyarr[2];
		
		if($id==''||$username==''||$time==''){
			echo json_encode(array('errorCode'=>10,'message'=>'密匙错误！'));
			Yii::app()->end();
		}
		$now = time();
		
		$mredis = new MRedisClass;
		$conn = $mredis->getConnect();
		$username = $conn->hget('user:'.$id,'username');
		$conn->close();
		
		if(!$username)
		{
			echo json_encode(array('errorCode'=>100,'message'=>'key过期，请重新登陆！'));
			Yii::app()->end(); 
		}
		
		return true;
	}
	
	protected function postFilter($filterChain)
	{
		echo "-->Filter-->post";
	}
}