<?php
/**
 * 
 * @author Jen
 * Goods model
 */
class GoodsModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "goods";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function changeStatus($alist,$iStatus){
		$aParam = array( 'status' => $iStatus);
		foreach ($alist as $i => $iID){
			if($iID){
				$this->updateById($iID, $aParam,true);
			}
		}
		return BaseFunctions::returnResult(true, "修改成功");
	}
	
	public function delTag($aRR,$status){
		foreach ($aRR as $iAd){
			$afind = $this->findById($iAd);
			if (isset($afind['msg'][0])) {
				$sStr = $afind['msg'][0]['goods_tag'];
				$sStr = str_replace ( ",{$status}," , ',' , $sStr );
				$sStr = str_replace ( ",," , ',' , $sStr );
				$sStr = $sStr ==","?"":$sStr;
				$this->updateById($iAd, array('goods_tag'=>$sStr));
			}
		}
		return BaseFunctions::returnResult(true, "修改成功");
	}
	
	/**
	 * 
	 * 添加优惠
	 * @param unknown $iGoodsId
	 * @param unknown $iFavorableId
	 * @param unknown $iAddUser
	 * @param unknown $iMerchangtId
	 * @param number $type 1为优惠卷 2为促销卷
	 * @return Ambigous <multitype:array, multitype:boolean unknown >
	 */
	public function addFavorable($iGoodsId,$iFavorableId,$iAddUser,$iMerchangtId,$type=1){
		$o = $this->findById($iGoodsId);
		$sColName = $type=="1"?"cou_list":"pro_list";
		if (!$o['type']||!isset($o['msg'][0])) {
			return BaseFunctions::returnResult(false, "无该记录");
		}else{
			$sTemp =  $o['msg'][0][$sColName]?$o['msg'][0][$sColName]:'';
			$sTemp .= ",".$iFavorableId.",";
			$sTemp = str_replace ( ",," , ',' , $sTemp );
			return $this->updateById($iGoodsId, array(
					$sColName => $sTemp
			),true);
		}
	}
	
	/**
	 * 
	 * 添加菜品
	 * @param unknown $sGoodsName 菜品名字
	 * @param unknown $iUserId 
	 * @param unknown $iMerchantId
	 * @param unknown $sGoodsCat 菜品类型，
	 * @param unknown $sGoodsTasteTag 菜品口味
	 * @param unknown $sGoodsTag  goods_tag
	 * @param unknown $iStatus 
	 * @param unknown $iGoodsSaleType
	 * @param unknown $iGoodsPice
	 * @param unknown $sGoodsImage
	 * @param unknown $iTranslateType
	 * @param unknown $aPriGoodsList
	 * @param unknown $GoodsSounds 菜品的声音
	 * @return Ambigous <boolean, unknown>
	 */
	public function addGreens($sGoodsName,$iUserId,$iMerchantId,
			$sGoodsCat,$sGoodsTasteTag,$sGoodsTag,$iStatus,$iGoodsSaleType,$iGoodsPice,$sGoodsImage,$iTranslateType,$aPriGoodsList,
			$GoodsSounds=''){
		$aParam = array();
		$aParam['add_user_id'] = $iUserId;
		$aParam['merchant_id'] =  $iMerchantId;
		$aParam['goods_name'] = $sGoodsName;
		$aParam['goods_cat'] = $sGoodsCat;//$this->stringAndArray($goods_cat,false);
		$aParam['goods_taste_tag'] = $sGoodsTasteTag;//$this->stringAndArray($goods_taste_tag,false);
		$aParam['goods_tag'] =  $sGoodsTag;//$this->stringAndArray($goods_tag,false);
		$aParam['status'] = $iStatus;
		$aParam['goods_sale_type'] = $iGoodsSaleType;
		$aParam['goods_sounds'] = $GoodsSounds;
		$aParam['goods_pice'] = $iGoodsPice;
		$aParam['goods_real_pice'] = $iGoodsPice;
		$aParam['goods_image'] = $sGoodsImage;
		$aParam['goods_up_time'] = time();
		$aParam['goods_type'] = 1;
		$aParam['translate_type'] = $iTranslateType;
		$re =  $this->add($aParam,true);
		if ($re['type']) {
			//添加对应的表关系
			$o = new GoodsGoodsModel();
			foreach ($aPriGoodsList as $iKey =>$iVal){
				$o->addGoodsRelation($re['msg'], $iVal);
			}
			return $re;
		}else{
			return $re;
		}
	}
	
	public function updateGreens($iGoodsId,$sGoodsName,$iUserId,$iMerchantId,
			$sGoodsCat,$sGoodsTasteTag,$sGoodsTag,$iStatus,$iGoodsSaleType,$iGoodsPice,$sGoodsImage,$iTranslateType,$aPriGoodsList,
			$GoodsSounds=''){
		if (!$iMerchantId) {
			return BaseFunctions::returnResult(false, array('ER0011','缺少参数!'));
		}
		$aParam = array();
		$aParam['add_user_id'] = $iUserId;
		$aParam['merchant_id'] =  $iMerchantId;
		$aParam['goods_name'] = $sGoodsName;
		$aParam['goods_cat'] = $sGoodsCat;//$this->stringAndArray($goods_cat,false);
		$aParam['goods_taste_tag'] = $sGoodsTasteTag;//$this->stringAndArray($goods_taste_tag,false);
		$aParam['goods_tag'] =  $sGoodsTag;//$this->stringAndArray($goods_tag,false);
		$aParam['status'] = $iStatus;
		$aParam['goods_sale_type'] = $iGoodsSaleType;
		$aParam['goods_sounds'] = $GoodsSounds;
		$aParam['goods_pice'] = $iGoodsPice;
		$aParam['goods_real_pice'] = $iGoodsPice;
		$aParam['goods_image'] = $sGoodsImage;
		$aParam['translate_type'] = $iTranslateType;
		$re =  $this->updateById($iGoodsId,$aParam,true);
		if ($re['type']) {
			$o = new GoodsGoodsModel();
			$aGoodsRelation = $o->getGreensRelation($iGoodsId);
			$aGR= array();
			foreach ($aGoodsRelation as $iGR){
				$aGR[$iGR] = $iGR;
			}
			foreach ($aPriGoodsList as $iKey =>$iVal){
				if (array_key_exists($iVal,$aGR)){
					unset($aGR[$iVal]);
					continue;
				}else{
					$o->addGoodsRelation($iGoodsId, $iVal);
				}
			}
			foreach ($aGR as $iKey => $sVal){
				$o->delGoodsRelation($iGoodsId, $iKey);
			}
			return $re;
		}
		return $re;
	}
	
	/**
	 * 获取商家的菜牌
	 * @param unknown $iMerId
	 * @param unknown $select
	 * @param string $where
	 * @param number $startPage
	 * @param number $pageNum
	 * @param number $count
	 * @param string $group
	 * @param string $order
	 */
	public function getMerchantMenuList($iMerId,$select, $where=" 1 ", $startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		$sCondition = " goods_type = 1 ";
		$sCondition .= " AND merchant_id = {$iMerId} AND status  > 0 ";
		$sCondition .= " AND {$where}  ";
		return $this->yiiPage("GoodsList", $select,$sCondition,$startPage, $pageNum, $count,$group, $order);
	}
	
	/**
	 * 获取菜品通过id
	 * @param unknown $iMenuId
	 */
	public function getMenuById($iMenuId){
		$sFind = "*";
		$sWhere = " id={$iMenuId} and goods_type = 1 ";
		return $this->find($sFind, $sWhere);
	}
	
	/**
	 * 检测菜品是否合格
	 * @param unknown $iMenuId
	 */
	public function detection($iMenuId){
		$oMenu = $this->findById($iMenuId);
		if (isset($oMenu['msg'][0]['status'])&&($oMenu['msg'][0]['status']==1||$oMenu['msg'][0]['status']==2||$oMenu['msg'][0]['status']==0)) {
			return $oMenu['msg'][0];
		}
		return false;
	}
	
	
	/*
	 * 计算促销优惠后的的价格
	 * @param array $aGood array(id,gold,good_no,goods_v_type
	 * 			    'pro_order'=>0,
					'pro_id'=>0,
					'croup_id'=>0,
					'croup_str'=>''
	 * )
	 * @return array(id,gold新价格,good_no,goods_v_type,o_gold原来价格 )
	 */
	public function computerProPice($aGood,$iMerId,$aPro,$sCoupStr,$isVip=false){
		$iGood = $aGood['id'];
		$addRe = array('o_gold'=>$aGood['gold']);
		if (!$iGood) {
			return $aGood+$addRe; 
		}
		//获取 优惠卷
		$oPCoup = new Coupon();
		$oCoup = new GoodsDetailModel();
		$aCoup = $oCoup->getCoupMsg($sCoupStr,$iMerId);
		if ($aCoup['id']) {
			$aPCoup = $aCoup['parent_arr'];
			if ($aPCoup['goods_v_type'] == 2||$aPCoup['goods_v_type'] == 3) {
				$addRe = $oPCoup->computerPice($aGood, $aPCoup);
				return $aGood+$addRe;
			}
		}
		//获取促销优惠
		$oPro = new Promotions();
		//$aPro = $oPro->getProList($iMerId);
		foreach ($aPro as $ap){
			$addRe = $oPro->computerPice($aGood, $ap);
			return $aGood+$addRe;
		}
// 		if ($aPro[1]) {
// 			$addRe = $oPCoup->computerPice($aGood, $aPro[1][0]);
// 			return $aGood+$addRe;
// 		}
		
// 		if ($aPro[2]) {
// 			$addRe = $oPCoup->computerPice($aGood, $aPro[2][0]);
// 			return $aGood+$addRe;
// 		}
		
// 		if ($aPro[3]) {
// 			$addRe = $oPCoup->computerPice($aGood, $aPro[3][0]);
// 			return $aGood+$addRe;
// 		}
		
		return $aGood;
	}
	
	public function computerCroupPice($aGood,$iMerId,$sCoupStr){
		
	}
	
	/**
	 * 修改音乐
	 * @param unknown $sSound
	 * @param unknown $iMerchant
	 * @return Ambigous <multitype:array, multitype:boolean unknown >
	 */
	public function updateSound($sSound,$iGoodsId){
		$this->updateById($iGoodsId, array('goods_sounds'=>$sSound));
		return BaseFunctions::returnResult(true, "修改完毕");
	}
	
	/**
	 * 删除音乐
	 */
	public function actionDelSound($iGoodsId){
		$this->updateById($iGoodsId, array('goods_sounds'=>""));
		return BaseFunctions::returnResult(true, "删除完毕");
	}
	
	/**
	 * 更新图片
	 * @param unknown $sImage
	 * @param unknown $iMerchant
	 * @return Ambigous <multitype:array, multitype:boolean unknown >
	 */
	public function updateImage($sImage,$iGoodsId){
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
		$oMerchant = $this->findById($iGoodsId);
		$sImageList = isset($oMerchant['msg'][0]['goods_image_list'])?$oMerchant['msg'][0]['goods_image_list']:"";
		$sImageList = trim($sImageList);
		$sImageList .= ",{$iAddId},";
		$sImageList = str_replace(",,",",",$sImageList);
		$sImageList = str_replace(" ","",$sImageList);
		$sImageList = $sImageList==","?"":$sImageList;
		$this->updateById($iGoodsId, array('goods_image_list'=>$sImageList));
		return BaseFunctions::returnResult(true, $iAddId);
	}
	
	
	/**
	 *
	 * @param unknown $iImageId
	 * @param unknown $iMerchant
	 */
	public function delImage($iImageId,$iGoodsId){
		if (!$iImageId) {
			return BaseFunctions::returnResult(false, "无效id");
		}
		$o = new ImageModel();
		$o->updateById($iImageId, array("status"=>"-1"));
		$oMerchant = $this->findById($iGoodsId);
		$sImageList = isset($oMerchant['msg'][0]['goods_image_list'])?$oMerchant['msg'][0]['goods_image_list']:"";
		$sImageList = trim($sImageList);
		$sImageList = str_replace(",{$iImageId},",",",$sImageList);
		$sImageList = str_replace(",,",",",$sImageList);
		$sImageList = str_replace(" ","",$sImageList);
		$sImageList = $sImageList==","?"":$sImageList;
		$this->updateById($iGoodsId, array('goods_image_list'=>$sImageList));
		return BaseFunctions::returnResult(true, "修改完毕");
	}
	
	/**
	 * 获取列表
	 * @param unknown $iGoodsType
	 * @return Ambigous <multitype:, multitype:NULL >
	 */
	public function getList($iGoodsType,$iMerId){
		$sWhere = " goods_type = {$iGoodsType} and `status` = 1 and merchant_id = {$iMerId} ";
		$aoPro = $this->yiiPage("GoodsList","*",$sWhere);
		$aRe = array();
		foreach ($aoPro as  $oPro){
			$aTemp = array();
			$aTemp['id'] = $oPro->id;
			$aTemp['goods_id'] = $oPro->goods_id;
			$aTemp['goods_name'] = $oPro->goods_name;
			$aTemp['goods_pice'] = $oPro->goods_pice;
			$aTemp['goods_real_pice'] = $oPro->goods_real_pice;
			$aTemp['goods_style'] = $oPro->goods_style;
			$aTemp['goods_taste'] = $oPro->goods_taste;
			$aTemp['goods_evaluation'] = $oPro->goods_evaluation;
			$aTemp['goods_desc'] = $oPro->goods_desc;
			$aTemp['goods_image'] = $oPro->goods_image;
			$aTemp['goods_up_time'] = $oPro->goods_up_time;
			$aTemp['goods_modify_time'] = $oPro->goods_modify_time;
			$aTemp['goods_comment_num'] = $oPro->goods_comment_num;
			$aTemp['goods_marketing_num'] = $oPro->goods_marketing_num;
			$aTemp['goods_visit_times'] = $oPro->goods_visit_times;
			$aTemp['good_num'] = $oPro->good_num;
			$aTemp['share_times'] = $oPro->share_times;
			$aTemp['sound_times'] = $oPro->sound_times;
			$aTemp['goods_remain'] = $oPro->goods_remain;
			$aTemp['goods_image_list'] = $oPro->goods_image_list;
			$aTemp['goods_over_time'] = $oPro->goods_over_time;
			$aTemp['goods_type'] = $oPro->goods_type;
			$aTemp['goods_virtual_gold'] = $oPro->goods_virtual_gold;
			$aTemp['goods_real_virtual_gold'] = $oPro->goods_real_virtual_gold;
			$aTemp['goods_cat'] = $oPro->goods_cat;
			$aTemp['goods_tag'] = $oPro->goods_tag;
			$aTemp['goods_sounds'] = $oPro->goods_sounds;
			$aTemp['recommend'] = $oPro->recommend;
			$aTemp['merchant_id'] = $oPro->merchant_id;
			$aTemp['status'] = $oPro->status;
			$aTemp['goods_taste_tag'] = $oPro->goods_taste_tag;
			$aTemp['goods_sale_type'] = $oPro->goods_sale_type;
			$aTemp['goods_correlate'] = $oPro->goods_correlate;
			$aTemp['add_user_id'] = $oPro->add_user_id;
			$aTemp['goods_v_type'] = $oPro->goods_v_type;
			$aTemp['t_begin_time'] = $oPro->t_begin_time;
			$aTemp['t_end_time'] = $oPro->t_end_time;
			$aTemp['pri_time_per'] = $oPro->pri_time_per;
			$aTemp['pri_goods_list'] = $oPro->pri_goods_list;
			$aTemp['pri_goods_per'] = $oPro->pri_goods_per;
			$aTemp['vip_per'] = $oPro->vip_per;
			$aTemp['per_type'] = $oPro->per_type;
			$aTemp['varil_begin_time'] = $oPro->varil_begin_time;
			$aTemp['varil_end_time'] = $oPro->varil_end_time;
			$aTemp['add_time'] = $oPro->add_time;
			$aTemp['goods_or_num'] = $oPro->goods_or_num;
			$aTemp['pri_money'] = $oPro->pri_money;
			$aTemp['pro_list'] = $oPro->pro_list;
			$aTemp['cou_list'] = $oPro->cou_list;
			$aTemp['goods_share_num'] = $oPro->goods_share_num;
			$aTemp['translate_type'] = $oPro->translate_type;
			$aTemp['sendout_num'] = $oPro->sendout_num;
			$aTemp['use_num'] = $oPro->use_num;
			$aTemp['view_num'] = $oPro->view_num;
			$aTemp['translation_num'] = $oPro->translation_num;
			$aTemp['be_good_num'] = $oPro->be_good_num;
			$aTemp['be_book_num'] = $oPro->be_book_num;
			$aRe[$oPro->goods_v_type][] = $aTemp;
		}
		return $aRe;
	}
	
	public function foundNew($itype,$iMerId,$iStatus=1){
		$criteria = new CDbCriteria();
		$criteria->order = ' id DESC';
		
		$sDeCondition = " merchant_id = {$iMerId} ";
		if ($itype==1) {
			$criteria->condition = $sDeCondition.' and goods_type = 2 ';
		}else if ($itype==2) {
			$criteria->condition = $sDeCondition.' and goods_type = 3 and goods_v_type <> 4 ';
		}else if ($itype==3) {
			$criteria->condition = $sDeCondition.' and (goods_type = 3 or goods_type = 2 )';
		}else{
			$criteria->condition = $sDeCondition.' and goods_type = 1 ';
		}
		
		if ($iStatus==1) {
			$criteria->condition .= ' and `status` = 1 ';
		}elseif ($iStatus==2){
			$criteria->condition .= ' and `status` = 2 ';
		}elseif ($iStatus==3){
			$criteria->condition .= ' and `status` > -1 ';
		}else{
				
		}
		
		$criteria->limit =1;
		
		
		$list = GoodsList::model()->findAll($criteria);
		$aRe = array();
		foreach ($list as $o){
			$aRe['id'] = $o->id;
			$aRe['goods_id'] = $o->goods_id;
			$aRe['goods_name'] = $o->goods_name;
			$aRe['goods_pice'] = $o->goods_pice;
			$aRe['goods_real_pice'] = $o->goods_real_pice;
			$aRe['goods_style'] = $o->goods_style;
			$aRe['goods_taste'] = $o->goods_taste;
			$aRe['goods_evaluation'] = $o->goods_evaluation;
			$aRe['goods_desc'] = $o->goods_desc;
			$aRe['goods_image'] = $o->goods_image;
			$aRe['goods_up_time'] = $o->goods_up_time;
			$aRe['goods_modify_time'] = $o->goods_modify_time;
			$aRe['goods_comment_num'] = $o->goods_comment_num;
			$aRe['goods_marketing_num'] = $o->goods_marketing_num;
			$aRe['goods_visit_times'] = $o->goods_visit_times;
			$aRe['good_num'] = $o->good_num;
			$aRe['share_times'] = $o->share_times;
			$aRe['sound_times'] = $o->sound_times;
			$aRe['goods_remain'] = $o->goods_remain;
			$aRe['goods_image_list'] = $o->goods_image_list;
			$aRe['goods_over_time'] = $o->goods_over_time;
			$aRe['goods_type'] = $o->goods_type;
			$aRe['goods_virtual_gold'] = $o->goods_virtual_gold;
			$aRe['goods_real_virtual_gold'] = $o->goods_real_virtual_gold;
			$aRe['goods_cat'] = $o->goods_cat;
			$aRe['goods_tag'] = $o->goods_tag;
			$aRe['goods_sounds'] = $o->goods_sounds;
			$aRe['recommend'] = $o->recommend;
			$aRe['merchant_id'] = $o->merchant_id;
			$aRe['status'] = $o->status;
			$aRe['goods_taste_tag'] = $o->goods_taste_tag;
			$aRe['goods_sale_type'] = $o->goods_sale_type;
			$aRe['goods_correlate'] = $o->goods_correlate;
			$aRe['add_user_id'] = $o->add_user_id;
			$aRe['goods_v_type'] = $o->goods_v_type;
			$aRe['t_begin_time'] = $o->t_begin_time;
			$aRe['t_end_time'] = $o->t_end_time;
			$aRe['pri_time_per'] = $o->pri_time_per;
			$aRe['pri_goods_list'] = $o->pri_goods_list;
			$aRe['pri_goods_per'] = $o->pri_goods_per;
			$aRe['vip_per'] = $o->vip_per;
			$aRe['per_type'] = $o->per_type;
			$aRe['varil_begin_time'] = $o->varil_begin_time;
			$aRe['varil_end_time'] = $o->varil_end_time;
			$aRe['add_time'] = $o->add_time;
			$aRe['goods_or_num'] = $o->goods_or_num;
			$aRe['pri_money'] = $o->pri_money;
			$aRe['pro_list'] = $o->pro_list;
			$aRe['cou_list'] = $o->cou_list;
			$aRe['goods_share_num'] = $o->goods_share_num;
			$aRe['translate_type'] = $o->translate_type;
			$aRe['sendout_num'] = $o->sendout_num;
			$aRe['use_num'] = $o->use_num;
			$aRe['view_num'] = $o->view_num;
			$aRe['translation_num'] = $o->translation_num;
			$aRe['be_good_num'] = $o->be_good_num;
			$aRe['be_book_num'] = $o->be_book_num;
		}
		return $aRe;
	}
	
	public function getGreens($iGreenId){
		$re = $this->findById($iGreenId);
		if($re['type']){
			$aData = $re['msg'][0];
			//浏览数
			$oVLM = new ViewLogModel();
			$aData['view_num'] = $oVLM->coutViewNum(1,$iGreenId);
			//点餐数 TODO
			$aData['be_book_num'] = 0;
			//分享数
			$o = new ShareLogModel();
			$aData['share_times'] =  $o->coutShareNum(1,$iGreenId);
			//点赞数
			$o = new PraiseLogModel();
			$aData['be_good_num'] = $o->coutPraiseNum(1,$iGreenId);
			//翻译发音使用数
			$o = new TranslationLogModel();
			$aData['translation_num'] = $o->coutTranslateNum(1,$iGreenId);
			//相关菜谱浏览数
			$o = new GoodsGoodsModel();
			$aGoodsRelation = $o->getGreensRelation($iGreenId);
			$connectionNum = 0;
			$aData['pri_goods_arr']=array();
			foreach ($aGoodsRelation as $sKey => $iVal){
				if ($iVal) {
					$connectionNum += $oVLM->coutViewNum(1,$iVal);
					$aData['pri_goods_arr'][] = $this->getGoodsById($iVal);	
				}
			}
			$aData['connection_num'] = $connectionNum;
			
			$aData['pri_goods_list'] = $aGoodsRelation;
			return BaseFunctions::returnResult(true, array(0=>$aData));
		}else{
			return $re;
		}
	}
	
	private function getGoodsById($id){
		$re = $this->findById($id);
		return $re['type']?($re['msg']?$re['msg'][0]:array()):array();
	}
}

?>