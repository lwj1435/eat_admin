<?php

class GoodsController extends BaseController
{
	public function actionGetGoods(){
		$aData = json_decode($_REQUEST['d'],true);
		$iGoodsId = isset($aData['id'])?$aData['id']:'';
		$o = new GoodsModel();
		BaseFunctions::ouputToString($o->getGreens($iGoodsId));
	}
	public function actionAddGoods()
	{
		$oGoods = new GoodsModel();
		if ($this->checkData($_REQUEST)) {
			BaseFunctions::writeLog(json_encode($_REQUEST));
			$aData = json_decode($_REQUEST['d'],true);
			$aParam = array();
			//用户id
			$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
			//商户id
			$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
			$aPriGoodsList = isset($aData['pri_goods_list'])?$aData['pri_goods_list']:array();
			$goods_cat = isset($aData['goods_cat']) ? $aData['goods_cat'] : array();
			$aPriTasteTag = isset($aData['goods_taste_tag']) ? $aData['goods_taste_tag'] : array();
			$goods_tag = isset($aData['goods_tag']) ? $aData['goods_tag'] : array();
			$sGoodsCat = $this->stringAndArray($goods_cat,false);
			$sGoodsTasteTag = $this->stringAndArray($aPriTasteTag,false);
			$sGoodsTag = $this->stringAndArray($goods_tag,false);
			$iStatus = isset($aData['status']) ? $aData['status'] : '0';
			$iGoodsSaleType = isset($aData['goods_sale_type']) ? $aData['goods_sale_type'] : '1';
			$sGoodsName =  isset($aData['goods_name'])?$aData['goods_name'] : '';
			$iGoodsPice = isset($aData['goods_pice']) ? $aData['goods_pice'] : 0;
			$sGoodsImage = isset($aData['goods_image']) ? $aData['goods_image'] : "";
			$iTranslateType = isset($aData['translate_type']) ? $aData['translate_type'] : '1';
			$re = $oGoods->addGreens($sGoodsName,$user_id,$merchant_id,
			$sGoodsCat,$sGoodsTasteTag,$sGoodsTag,$iStatus,$iGoodsSaleType,$iGoodsPice,$sGoodsImage,$iTranslateType,$aPriGoodsList);
			
			echo BaseFunctions::ouputToString($re);
		}
	}
	
	public function actionChangeStatus(){
		$aData = json_decode($_REQUEST['d'],true);
		$aParam = array();
		//用户id
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$status = isset($aData['status'])?$aData['status']:'';
		$aList = isset($aData['list'])?$aData['list']:'';
		$aRR = $this->stringAndArray($aList);
		if(!$aRR){
			BaseFunctions::outputResult(false, "没选择任何记录");
		}else{
			$oGoods = new GoodsModel();
			
			BaseFunctions::ouputToString($oGoods->changeStatus($aRR,$status));
		}
	}
	
	public function actionDelTag(){
		$aData = json_decode($_REQUEST['d'],true);
		$aParam = array();
		//用户id
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$status = isset($aData['status'])?$aData['status']:'';
		$aList = isset($aData['list'])?$aData['list']:'';
		$aRR = $this->stringAndArray($aList);
		if(!$aRR){
			BaseFunctions::outputResult(false, "没选择任何记录");
		}else{
			$oGoods = new GoodsModel();
				
			BaseFunctions::ouputToString($oGoods->delTag($aRR,$status));
		}
	}
	
	public function actionGoodsList(){
		$aData = json_decode($_REQUEST['d'],true);
// 		$aData = $_REQUEST;
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$itype = isset($aData['type'])?$aData['type'] : '';
		
		$pageVar = isset($aData['pageNum'])?$aData['pageNum']:1;
		$iCount = isset($aData['count'])?$aData['count']:1;
		
		$iStatus = isset($aData['status'])?$aData['status']:1;
		
		$iPageNum = 10;
		$iCount = $iCount<1?1:$iCount;
		$pageVar= $pageVar<1?1:$pageVar;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		
		$criteria = new CDbCriteria();
		
		$criteria->order = ' id DESC';
		
		$sDeCondition = " merchant_id = {$merchant_id} ";
		if ($itype==1) {
			$criteria->condition = $sDeCondition.' and goods_type = 2 ';
		}else if ($itype==2) {
			$criteria->condition = $sDeCondition.' and goods_type = 3 ';
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

		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);
		
		$list = GoodsList::model()->findAll($criteria);
		$aReAll = array();
		foreach ($list as $i => $o){
			$aRe = array();
				$aRe['id'] = $o->id;// => '序号',
				$aRe['goods_id'] = $o->goods_id;// => '餐单编号',
				$aRe['goods_name'] = $o->goods_name;// => '菜品名称',
				$aRe['goods_pice'] = $o->goods_pice;// => '价格',
				$aRe['goods_real_pice'] = $o->goods_real_pice;// => '销售价格',
				$aRe['goods_style'] = $o->goods_style;// => '色评分',
				$aRe['goods_taste'] = $o->goods_taste;// => '口感评分',
				$aRe['goods_evaluation'] = $o->goods_evaluation;// => '总评分',
				$aRe['goods_desc'] = $o->goods_desc;// => '描述',
				$aRe['goods_image'] = 'http://testadmin.77tng.com/files/'.$o->goods_image;// => '图片',
				$aRe['goods_up_time'] = $o->goods_up_time;// => '上传时间',
				$aRe['goods_modify_time'] = $o->goods_modify_time;// => '修改时间',
				$aRe['goods_comment_num'] = $o->goods_comment_num;// => '文章数目',
				$aRe['goods_marketing_num'] = $o->goods_marketing_num;// => '评论总数',
				$aRe['goods_visit_times'] = $o->goods_visit_times;// => '浏览次数',
				$aRe['good_num'] = $o->good_num;// => '销售总数',
				$aRe['share_times'] = $o->share_times;// => '分享次数',
				$aRe['sound_times'] = $o->sound_times;// => '',
				$aRe['goods_remain'] = $o->goods_remain;// => '',
				$aRe['goods_image_list'] = $o->goods_image_list;// => '所有的图片',
				$aRe['goods_over_time'] = $o->goods_over_time;// => '下架时间',
				$aRe['goods_type'] = $o->goods_type;// => '类型',
				$aRe['goods_virtual_gold'] = $o->goods_virtual_gold;// => '虚拟价格',
				$aRe['goods_real_virtual_gold'] = $o->goods_real_virtual_gold;// => '真是虚拟价格',
				$aRe['goods_cat'] = $o->goods_cat;// => '分组',
				$aRe['goods_tag'] = $o->goods_tag;// => '标签',
				$aRe['goods_sounds'] = $o->goods_sounds;// => '声音',
				$aRe['recommend'] = $o->recommend;// => '',
				$aRe['merchant_id'] = $o->merchant_id;// => '',
				$aRe['status'] = $o->status;// => '状态',
				$aRe['goods_taste_tag'] = $o->goods_taste_tag;// => '口味',
				$aRe['goods_sale_type'] = $o->goods_sale_type;// => '销售类型',
				$aRe['goods_correlate'] = $o->goods_correlate;// => '相关菜式',
				$aRe['add_user_id'] = $o->add_user_id;// => '添加用户id',
				$aRe['use_num'] = $o->use_num;// => '添加用户id',
				$aReAll[]=$aRe;
		}
		//$uResult = array('records' => $aReAll, 'totalPage' => $pages->pageCount, 'totalNum'=>$count, 'pageNum' => $pages->pageSize );
		BaseFunctions::outputResult(TRUE, $aReAll);
	}
	
	public function actionUpdateGoods(){
		$oGoods = new GoodsModel();
		if ($this->checkData($_REQUEST)) {
			BaseFunctions::writeLog(json_encode($_REQUEST));
			$aData = json_decode($_REQUEST['d'],true);
			$aParam = array();
			//用户id
			$iUserId = isset($aData['user_id'])?$aData['user_id'] : '';
			//商户id
			$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
			
			$iGoodsId = isset($aData['goods_id'])?$aData['goods_id'] : '';
			$sGoodsName = isset($aData['goods_name']) ? $aData['goods_name'] : '';
			$goods_cat = isset($aData['goods_cat']) ? $aData['goods_cat'] : array();
			$goods_taste_tag = isset($aData['goods_taste_tag']) ? $aData['goods_taste_tag'] : array();
			$goods_tag = isset($aData['goods_tag']) ? $aData['goods_tag'] : array();
			$status = isset($aData['status']) ? $aData['status'] : '';
			$goods_sale_type = isset($aData['goods_sale_type']) ? $aData['goods_sale_type'] : '';
			$goods_sounds = isset($aData['goods_sounds']) ? $aData['goods_sounds'] : '';
			$goods_real_pice = isset($aData['goods_pice']) ? $aData['goods_pice'] : 0;
			$goods_image = isset($aData['goods_image']) ? $aData['goods_image'] : "";
			$goods_correlate = isset($aData['goods_correlate']) ? $aData['goods_correlate'] : '';
			$iTranslateType = isset($aData['translate_type']) ? $aData['translate_type'] : '';
			$aPriGoodsList = isset($aData['pri_goods_list'])?$aData['pri_goods_list']:array();
			$aParam = array();
			$sGoodsCat = $this->stringAndArray($goods_cat,false);
			$sGoodsTasteTag = $this->stringAndArray($goods_taste_tag,false);
			$sGoodsTag = $this->stringAndArray($goods_tag,false);
			$iStatus = $status;
			$iGoodsSaleType = $goods_sale_type;
			$iGoodsPice = $goods_real_pice;
			$sGoodsImage = $goods_image;
			$re = $oGoods->updateGreens($iGoodsId,$sGoodsName,$iUserId,$iMerchantId,
			$sGoodsCat,$sGoodsTasteTag,$sGoodsTag,$iStatus,$iGoodsSaleType,$iGoodsPice,$sGoodsImage,$iTranslateType,$aPriGoodsList
			);
			BaseFunctions::ouputToString($re);
		}
	}
	
	public function actionGetMerGoods(){
		BaseFunctions::writeLog(json_encode($_REQUEST));
		$aData = json_decode($_REQUEST['d'],true);
		//用户id
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$o = new GoodsModel();
		$sFind ="*";
		$sWhere = " goods_type = 1 and merchant_id = $merchant_id and (status = 1 or status = 2) ";
		$aFindArr = $o->find($sFind,$sWhere,true);
		$re = array();
		foreach ($aFindArr['msg'] as $findArr){
			$re[$findArr['id']] = $findArr['goods_name'];
		}
		BaseFunctions::outputResult(true, $re);
	}
	
	public function actionUseFavorable(){
		$o = new GoodsDetailModel();
		$aData = json_decode($_REQUEST['d'],true);
		//用户id
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$sStr = isset($aData['cou_str'])?$aData['cou_str'] : '';
		BaseFunctions::ouputToString($o->userGoodsDetail($sStr,$merchant_id));
	}

	/**
	 * 菜牌的详细信息 co12 94
	 */
	public function actionMoGoodsDetail(){
		//TODO 记录log
		$aData = json_decode($_REQUEST['d'],true);
		$aData = $_REQUEST;
		//用户id
		$iGoodsId = isset($aData['menu_id'])?$aData['menu_id'] : '';
		if (!$iGoodsId) {
			BaseFunctions::outputResult(false, array());
			return ;
		}
		$o = new GoodsModel();
		$aGood = $o->getMenuById($iGoodsId);
		if (!isset($aGood['msg'][0]['id'])) {
			BaseFunctions::outputResult(false, array());
			return;
		}
		$aRe = array();
		$aRe+=$aGood['msg'][0];
		$aConGoods = array();
		$aConArr = $this->stringAndArray($aGood['msg'][0]['pri_goods_list']);
		foreach ($aConArr as $sTempVal){
			if ($sTempVal) {
				$aGoodContect = $o->getMenuById($sTempVal);
				if (isset($aGoodContect['msg'][0]['id'])) $aConGoods[] = $aGoodContect['msg'][0];
			}
		}
		//相关菜牌
		$aRe['connection_menu'] = $aConGoods;
		BaseFunctions::outputResult(true, $aRe);
	}
	
	public function actionUpSound(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['goods_id'])?$aData['goods_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$sSound = isset($aData['merchant_musice'])?$aData['merchant_musice']:'';
		$o = new GoodsModel();
		$re = $o->updateSound($sSound,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}

	public function actionUpImg(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['goods_id'])?$aData['goods_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$sImg = isset($aData['image'])?$aData['image']:"";
		$o = new GoodsModel();
		$re = $o->updateImage($sImg,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}

	public function actionDelImg(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['goods_id'])?$aData['goods_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$iImgId = isset($aData['imageId'])?$aData['imageId']:"";
		$o = new GoodsModel();
		$re = $o->delImage($iImgId,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}

	public function actionDelSound(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['goods_id'])?$aData['goods_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$o = new GoodsModel();
		$re = $o->delSound($iMerchantId);
		BaseFunctions::ouputToString($re);
	}
	
}

?>
