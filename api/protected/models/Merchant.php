<?php
/**
 * 
 * @author jen
 * merchant model
 */
class Merchant extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "merchant_msg";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	/**
	 * 获取merchant 的用户类型
	 * @return number
	 */
	public function getUserType(){
		return 2;
	}
	
	public function login($accountName,$password){
		$oBj = new UserModel();
		return $oBj->login($accountName, $password,$this->getUserType());
	}
	
	public function geyStatistics($iBeginTime=0,$iEndTime=0){
		//预约列表
	}
	
	/**
	 * 获取预约到号
	 */
	public function getBookReachNum(){
		//2 - 3
		//4
		//5 - 8
		//包厢
	}
	
	public function getMerchantMsg($iMerchantId){
		return $this->findById($iMerchantId);
	}
	
	public function updateVideo($sVideo,$iMerchant){
		$this->updateById($iMerchant, array('merchant_video'=>$sVideo));
		return BaseFunctions::returnResult(true, "修改完毕");
	}
	
	public function updateSound($sSound,$iMerchant){
		$this->updateById($iMerchant, array('merchant_sounds'=>$sSound));
		return BaseFunctions::returnResult(true, "修改完毕");
	}
	
	public function delSound($iMerchant){
		$this->updateById($iMerchant, array('merchant_sounds'=>""));
		return BaseFunctions::returnResult(true, "删除完毕");
	}
	
	public function updateImage($sImage,$iMerchant){
		$oImage = new ImageModel();
		$iAddImage = $oImage->add(array(
				'image_name' => '',
				'image_link' => $sImage,
				'image_up_time' => '',
				'image_modify_time' => '',
				'image_up_user_id' => '',
				'image_up_user_name' => '',
				'image_up_user_account_name' => '',
				'up_user_id' => '',
				'up_account_name' => '',
				'up_user_name' => '',
				'status' => 0
		));
		$iAddId = $iAddImage['msg'];
		$oMerchant = $this->findById($iMerchant);
		$sImageList = isset($oMerchant['msg'][0]['merchant_image'])?$oMerchant['msg'][0]['merchant_image']:"";
		$sImageList = trim($sImageList);
		$sImageList .= ",{$iAddId},";
		$sImageList = str_replace(",,",",",$sImageList);
		$sImageList = str_replace(" ","",$sImageList);
		$sImageList = $sImageList==","?"":$sImageList;
		$this->updateById($iMerchant, array('merchant_image'=>$sImageList));
		return BaseFunctions::returnResult(true, $iAddId);
	}
	
	/**
	 *
	 * @param unknown $iImageId
	 * @param unknown $iMerchant
	 */
	public function delImage($iImageId,$iMerchant){
		if (!$iImageId) {
			return BaseFunctions::returnResult(false, "无效id");
		}
		$o = new ImageModel();
		$o->updateById($iImageId, array("status"=>"-1"));
		$oMerchant = $this->findById($iMerchant);
		$sImageList = isset($oMerchant['msg'][0]['merchant_image'])?$oMerchant['msg'][0]['merchant_image']:"";
		$sImageList = trim($sImageList);
		$sImageList = str_replace(",{$iImageId},",",",$sImageList);
		$sImageList = str_replace(",,",",",$sImageList);
		$sImageList = str_replace(" ","",$sImageList);
		$sImageList = $sImageList==","?"":$sImageList;
		$this->updateById($iMerchant, array('merchant_image'=>$sImageList));
		return BaseFunctions::returnResult(true, "修改完毕");
	}
	
	public function delVideo($iMerchant){
		$this->updateById($iMerchant, array('merchant_video'=>""));
		return BaseFunctions::returnResult(true, "修改完毕");
	}
	
	/**
	 * 
	 * @param unknown $iMerchant
	 */
	public function getBusinessTime($iMerchant){
		$sFind = " merchant_start_time,merchant_end_time,status,business_type ";
		$sWhere = " id = {$iMerchant} ";
		$re = $this->find($sFind, $sWhere);
		$merchant_start_time = isset($re['msg'][0]['merchant_start_time'])?$re['msg'][0]['merchant_start_time']:'';
		$merchant_end_time = isset($re['msg'][0]['merchant_end_time'])?$re['msg'][0]['merchant_end_time']:'';
		return BaseFunctions::returnResult(true, array('merchant_start_time'=>$merchant_start_time,'merchant_end_time'=>$merchant_end_time,'status'=>$re['msg'][0]['status'],'business_type'=>$re['msg'][0]['business_type']));
	}
	
	/**
	 * 
	 * @param unknown $iMerchant
	 * @param unknown $sStartTime
	 * @param unknown $sEndTime
	 */
	public function upBusinessTime($iMerchant,$sStartTime,$sEndTime,$business_type,$status){
		$aParam = array('merchant_end_time'=>$sEndTime,'merchant_start_time'=>$sStartTime,'business_type'=>$business_type,'status'=>$status);
		$this->updateById($iMerchant, $aParam);
		return BaseFunctions::returnResult(true, "修改完毕");
	}
	
	/**
	 * 获取 推介商家
	 * @param unknown $select
	 * @param string $where
	 * @param string $pro
	 * @param string $area
	 * @param string $city
	 * @param number $startPage
	 * @param number $pageNum
	 * @param number $count
	 * @param string $group
	 * @param string $order
	 */
	public function getReferralsList($select, $where=" 1 ", $pro='',$area='',$city='' , $startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		//100米
		//200米
		//300米
		//400米
		//500米
		//600米
		//700米
		//800
		//900
		//1000
		//2000
		
		$condition = " and referrals =1 ";
		/*$allNum = 0;
		$dis = 0;
		$returnArr = array();
		while ($allNum<$pageNum&&$dis<2000){
			$dis = 100;
			$distance = $this->dist($lat,$long,$dis);
			$where .= $condition." and longitude > {$distance['minlong']} and latitude > {$distance['minlat']} and longitude < {$distance['maxlong']} and latitude < {$distance['maxlat']} ";
			$re = $this->yiiPage("MerchantMsg",$select, $where, $startPage, $pageNum, $count,$group, $order);
			$returnArr += $re;
			$dis += 100;
			$dis = $dis >1000?2000:$dis;
			$allNum = count($returnArr);
		}*/
		return $this->yiiPage("MerchantMsg",$select, $where, $startPage, $pageNum, $count,$group, $order);
	}
	
	/**
	 * 获取 附近商家
	 * @param unknown $select
	 * @param string $where
	 * @param string $lat
	 * @param string $long
	 * @param string $pro
	 * @param string $area
	 * @param string $city
	 * @param number $startPage
	 * @param number $pageNum
	 * @param number $count
	 * @param string $group
	 * @param string $order
	 */
	public function getNearbyMerchant($select, $where=" 1 ", $lat='',$long='',$pro='',$area='',$city='' , $startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		//TODO 地点 什么的
		return $this->yiiPage("MerchantMsg",$select, $where, $startPage, $pageNum, $count,$group, $order);
	}
	
	private function dist($lat,$long,$rou){
		$residual = 0.0001;
		$maxlat = $lat+$rou * $residual;
		$minlat = $lat-$rou * $residual;
		$maxlong = $long+$rou * $residual;
		$minlong = $long-$rou * $residual;
		
		return array("maxlat"=>$maxlat,"minlat"=>$minlat,"maxlong"=>$maxlong,"minlong"=>$minlong);
	}
	
	public function countCounpon($merId){
		$sWhere = " merchant_id = {$merId} and goods_type = 2 ";
		return $this->count("GoodsList",$sWhere);
	}
	
	public function countTeamActivity($merId){
		$sWhere = " merchant_id = {$merId} ";
		return $this->count("TeamActivityModel",$sWhere);
	}
	
	/**
	 * 检查是否合法
	 * @param unknown $iMerId
	 * @return boolean
	 */
	public function detection($iMerId){
		$iMerId = $iMerId?$iMerId:0;
		$oUser = $this->findById($iMerId);
		if (isset($oUser['msg'][0]['status'])&&$oUser['msg'][0]['status']>-1) {
			return $oUser['msg'][0];
		}
		return false;
	}
}

?>