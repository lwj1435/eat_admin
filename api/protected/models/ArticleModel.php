<?php

class ArticleModel extends BaseModel{
	private $sTableKey;
	public function __construct(){
		$sTableKey = "article";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function getMerArticle($select, $iMerId,$where=" 1 ", $pro='',$area='',$city='' ,$startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		$where = $where." and merchant_id = {$iMerId} and type = 1 ";
		return $this->yiiPage("Article",$select, $where, $startPage, $pageNum, $count,$group, $order);
	}
	
	/**
	 * 获取笔记目录
	 * @param unknown $select
	 * @param unknown $iUser
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
	public function getUserNoteList($select, $iUser,$where=" 1 ", $pro='',$area='',$city='' ,$startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		$where = $where." and type = 2 and user_id = {$iUser} ";
		return $this->yiiPage("Article",$select, $where, $startPage, $pageNum, $count,$group, $order);
	}
	
	/**
	 * 添加商家评论
	 * @param unknown $iMerid
	 * @param unknown $sContext
	 * @param unknown $fEva
	 * @param unknown $fPer
	 * @param unknown $aImageList
	 * @param unknown $iUserId
	 */
	public function addCommon($iMerid,$sContext,$fEva,$fPer,$aImageList,$iUserId){
		$iType = 1;
		return $this->addArticle($iUserId,$sContext,$iMerid,$sContext,$fEva,$fPer,$aImageList,$iType,0,0);
	}
	
	/**
	 * 
	 * 添加评论日记
	 * @param unknown $iMerId
	 * @param unknown $sTitle
	 * @param unknown $sContext
	 * @param unknown $fEva
	 * @param unknown $fPer
	 * @param unknown $aImageList
	 * @param unknown $iUserId
	 * @param unknown $sMerName
	 * @param unknown $sMerFeel
	 * @param unknown $sArea
	 * @param unknown $sCity
	 * @param unknown $sPro
	 * @param unknown $iActivityId
	 * @return Ambigous <Ambigous, multitype:array, multitype:boolean unknown , boolean, unknown>
	 */
	public function addEssay($iMerId,$sTitle,$sContext,$fEva,$fPer,$aImageList,$iUserId,$sMerName,$sMerFeel,$sArea,$sCity,$sPro,$iActivityId,$sAddress){
		$iType= 2;
		return $this->addArticle($iUserId,$sContext,$iMerId,$sContext,$fEva,$fPer,$aImageList,$iType,0,0,$sMerName,$sMerFeel,$sArea,$sCity,$sPro,$iActivityId,$sAddress);
	}
	/**
	 * 
	 * @param unknown $iUserId
	 * @param unknown $sContext
	 * @param unknown $iMerid
	 * @param unknown $sContext
	 * @param unknown $fEva
	 * @param unknown $fPer
	 * @param unknown $aImageList
	 * @param number $type 1为店面的评价  2为试吃的文章 ,3为跟帖
	 * @param number $iFollowNum
	 * @param number $iParentId
	 * @param string $sMerName
	 * @param string $sMerFeel
	 * @param string $sArea
	 * @param string $sCity
	 * @param string $sPro
	 * @param number $activity_id
	 * @return Ambigous <multitype:array, multitype:boolean unknown >|Ambigous <boolean, unknown>
	 */
	private function addArticle($iUserId,$sContext,$iMerid,$sContext,$fEva,$fPer,$aImageList,$type,$iFollowNum=0,$iParentId=0,$sMerName='',$sMerFeel='',$sArea='',$sCity='',$sPro='',$activity_id=0,$sAddress=''){
		$o = new UserModel();
		$aUserMsg = $o->detection($iUserId);
		if (!$aUserMsg) {
			return BaseFunctions::returnResult(false, array("ER0001","用户不存在"));
		}
		$iNowTime = time();
		$aParam = array(
				'parent_id' => $iParentId,
				'conment' => $sContext,
				'type' => $type,
				'article_time' => $iNowTime,
				'modify_time' => 0,
				'user_id' => $iUserId,
				'user_name' => $aUserMsg['username'],
				'account_name' => $aUserMsg['account_name'],
				'follow_num' => $iFollowNum,
				'status' => 0,
				'evaluate' => $fEva,
				'merchant_id' => $iMerid,
				'per' => $fPer,
				'image_list' => $aImageList,
				
				'view_num' => '0',
				'love_num' => '0',
				'merchant_name' => $sMerName,
				'merchant_feel' => $sMerFeel,
				'pro' => $sPro,
				'city' => $sCity,
				'area' => $sArea,
				
				'activity_id'=>$activity_id,
				'address'=>$sAddress
		);
		return $this->add($aParam,true);
	}
}