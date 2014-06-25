<?php

class PromotionsController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}
	
	public function actionList()
	{
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id DESC';
		
		$criteria->condition = ' `status` >-1 and (goods_type = 2 or goods_type = 3) and goods_v_type<>4 and merchant_id = '.$merid.' ';
		
		$count = Promotions::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = Promotions::model()->findAll($criteria);
		
		$this->render('list', array('list' => $list, 'pages' => $pages,"oModer"=>new Promotions()));
		
	}
	
	public function actionNew()
	{
		
		$model=new PromotionFrom();
		$isOk="3";
		$info = array();
		if(isset($_POST['PromotionFrom']))
		{
			$model->attributes=$_POST['PromotionFrom'];
			if($model->validate())
			{	
				//$this->dataChannel("merchant","setMerchant",$_POST['MerchantAddForm']);
				//TODO do what
				//$this->dataChannel("merchant", "setMerchant",$_POST['MerchantAddForm']);
				if (isset($_POST['PromotionFrom']['goods_v_type'])&&$_POST['PromotionFrom']['goods_v_type']=="1") {
					if (!isset($_POST['PromotionFrom']['pri_time_per'])||!preg_match("/^[1-9]{1}[0-9]?$/",$_POST['PromotionFrom']['pri_time_per'])){
						$model->addError("pri_time_per", "限时优惠率要在1到99范围");
						$isOk= "2";
					}
					//t_begin_time
					if (!isset($_POST['PromotionFrom']['t_begin_time'])||!$_POST['PromotionFrom']['t_begin_time']){
						$model->addError("t_begin_time", "优惠开始时间不可以为空");
						$isOk= "2";
					}
					//t_end_time
					if (!isset($_POST['PromotionFrom']['t_end_time'])||!$_POST['PromotionFrom']['t_end_time']){
						$model->addError("t_end_time", "优惠结束时间不可以为空");
						$isOk= "2";
					}
					//pri_time_per]
				}else if (isset($_POST['PromotionFrom']['goods_v_type'])&&$_POST['PromotionFrom']['goods_v_type']=="2") {
					if (!isset($_POST['PromotionFrom']['pri_goods_per'])||!preg_match("/^[1-9]{1}[0-9]?$/",$_POST['PromotionFrom']['pri_goods_per'])){
						$model->addError("pri_goods_per", "菜品优惠率要在1到99范围");
						$isOk= "2";
					}
					if (!isset($_POST['PromotionFrom']['pri_goods_list'])||!$_POST['PromotionFrom']['pri_goods_list']){
						$model->addError("pri_goods_per", "优惠菜单不可以为空");
						$isOk= "2";
					}
				}else if (isset($_POST['PromotionFrom']['goods_v_type'])&&$_POST['PromotionFrom']['goods_v_type']=="3") {
					if (!isset($_POST['PromotionFrom']['vip_per'])||!preg_match("/^[1-9]{1}[0-9]?$/",$_POST['PromotionFrom']['vip_per'])){
						$model->addError("vip_per", "vip优惠率要在1到99范围");
						$isOk= "2";
					}
				}
				if ($isOk=="3") {
					$info = $_POST['PromotionFrom'];
					$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
// 					$this->dataChannel("promotions","addPromotion",$info);
					$aRe = $this->dataChannel("promotions","addPromotion",$info);
					$this->tempA($aRe);
					if (isset($aRe['type'])&&$aRe['type']) {
						$isOk="1";
					}else{
						$model->addError("goods_v_type", $aRe['msg'][1]);
						$isOk= "2";
					}
					
				}
				$info = $_POST['PromotionFrom'];
			}else{
				$info = $_POST['PromotionFrom'];
				$isOk= "2";
			}
		}
		$info['mer_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$arrGoods = $this->getMerGoods();
// 		$this->tempA($arrGoods);
		$this->render('new',array('model'=>$model,'info'=>$info,'goodsArr'=>$arrGoods,"isOk"=>$isOk));
	}
	
	public function actionNewCoupon(){
			$model=new CouponForm();
			//$this->tempA($_POST['StoreAddForm']);
			$info = array();
			$isOk= "3";
			if(isset($_POST['CouponForm']))
			{
				$model->attributes=$_POST['CouponForm'];
				if($model->validate())
				{
					// form inputs are valid, do something here
					//TODO user id and merchant id
					//$_POST['StoreAddForm']['add_user_id'] = "1";
					//$_POST['GoodsForm']['merchant_id'] = "1";
					if (isset($_POST['CouponForm']['goods_v_type'])&&$_POST['CouponForm']['goods_v_type']=="1") {
						if (!isset($_POST['CouponForm']['pri_money'])||!preg_match("/^[1-9]\d*\.\d*|[1-9]\d*$/",$_POST['CouponForm']['pri_money'])){
							$model->addError("pri_money", "代金卷必须为数字");
							$isOk= "2";
						}
					}else if (isset($_POST['CouponForm']['goods_v_type'])&&$_POST['CouponForm']['goods_v_type']=="2") {
						if (!isset($_POST['CouponForm']['pri_goods_per'])||!preg_match("/^[1-9]+[0-9]?$/",$_POST['CouponForm']['pri_goods_per'])){
							$model->addError("pri_goods_per", "优惠率要在1到99范围");
							$isOk= "2";
						}
					}else if (isset($_POST['CouponForm']['goods_v_type'])&&$_POST['CouponForm']['goods_v_type']=="3") {
						if (!isset($_POST['CouponForm']['pri_goods_list'])||!$_POST['CouponForm']['pri_goods_list']){
							$model->addError("pri_goods_list", "指定兑换的菜品不能为空");
							$isOk= "2";
						}
					}
					if ($isOk=="3") {
						$model->addError("pri_goods_list", "指定兑换的菜品不能为空");
						$info = $_POST['CouponForm'];
						$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
						$this->dataChannel("promotions","addCoupon",$info);
						$isOk= "1";
					}
				}else{
					$info = $_POST['CouponForm'];
					$isOk= "2";
				}
				//$model->addError("per_type", "促销 类型不能为空");
				$info = $_POST['CouponForm'];
			}
			$arrGoods = $this->getMerGoods();
			$this->render('addCoupon',array('model'=>$model,'info'=>$info,'goodsArr'=>$arrGoods,"isOk"=>$isOk));
		}
		
		public function actionUpdateCoupon(){
			$model=new CouponForm();
			$idGoods = isset($_REQUEST['id'])?$_REQUEST['id']:'';
			$isOk= "3";
			if (!$idGoods) {
				return;
			}
			//$this->tempA($_POST['StoreAddForm']);
			$info = array();
			if(isset($_POST['CouponForm']))
			{
				$oldGoodNum = isset($_REQUEST['old_good_num'])?$_REQUEST['old_good_num']:0;
				$model->attributes=$_POST['CouponForm'];
				if ($_POST['CouponForm']['good_num']<$oldGoodNum) {
					echo "<script>alert('发放数量不能比原来的少!');</script>";
					$info = $_POST['CouponForm'];
					$info['old_good_num'] = $oldGoodNum;
				}else{
					if($model->validate())
					{
			
						// form inputs are valid, do something here
						//TODO user id and merchant id
						//$_POST['StoreAddForm']['add_user_id'] = "1";
						//$_POST['GoodsForm']['merchant_id'] = "1";
						if (isset($_POST['CouponForm']['goods_v_type'])&&$_POST['CouponForm']['goods_v_type']=="1") {
							if (!isset($_POST['CouponForm']['pri_money'])||!preg_match("/^[1-9]\d*\.\d*|[1-9]\d*$/",$_POST['CouponForm']['pri_money'])){
								$model->addError("pri_money", "代金卷必须为数字");
								$isOk= "2";
							}
						}else if (isset($_POST['CouponForm']['goods_v_type'])&&$_POST['CouponForm']['goods_v_type']=="2") {
							if (!isset($_POST['CouponForm']['pri_goods_per'])||$_POST['CouponForm']['pri_goods_per']<0||$_POST['CouponForm']['pri_goods_per']>99){
								$model->addError("pri_goods_per", "优惠率要在0到99范围");
								$isOk= "2";
							}
						}else if (isset($_POST['CouponForm']['goods_v_type'])&&$_POST['CouponForm']['goods_v_type']=="3") {
							if (!isset($_POST['CouponForm']['pri_goods_list'])||!$_POST['CouponForm']['pri_goods_list']){
								$model->addError("pri_goods_list", "指定兑换的菜品不能为空");
								$isOk= "2";
							}
						}
						if ($isOk=="3") {
							$info = $_POST['CouponForm'];
							$info['add_user_id'] = Yii::app()->user->id;
							$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
							$info['couponId'] = $idGoods;
							$this->dataChannel("promotions","updateCoupon",$info);
							$re = $this->dataChannel("promotions","GetCoupon",array('id'=>$idGoods));
							$info = $re['msg'];
							$info['varil_begin_time'] = $info['varil_begin_time']?date("Y-m-d",$info['varil_begin_time']):'';
							$info['varil_end_time'] = $info['varil_end_time']?date("Y-m-d",$info['varil_end_time']):'';
							$info['old_good_num'] = $info['good_num'];
							$isOk= "1";
						}
						
					}else{
						$info = $_POST['CouponForm'];
						$info['old_good_num'] = $oldGoodNum;
						$isOk= "2";
					}
				}
				
			}else{
				$re = $this->dataChannel("promotions","GetCoupon",array('id'=>$idGoods));
				$info = $re['msg'];
				$info['varil_begin_time'] = $info['varil_begin_time']?date("Y-m-d",$info['varil_begin_time']):'';
				$info['varil_end_time'] = $info['varil_end_time']?date("Y-m-d",$info['varil_end_time']):'';
				$info['old_good_num'] = $info['good_num'];
			}
			$info['id'] = $idGoods;
			$arrGoods = $this->getMerGoods();
			$this->render('couponDetail',array('model'=>$model,'info'=>$info,'goodsArr'=>$arrGoods,"isOk"=>$isOk));
		}
		
		public function actionUpdatePromotions(){
			$isOk="3";
			$model=new PromotionFrom();
			
			$idGoods = isset($_REQUEST['id'])?$_REQUEST['id']:'';
			if (!$idGoods) {
				return;
			}
			//$this->tempA($_POST['StoreAddForm']);
			$iMerchantId = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
			$info = array();
			if(isset($_POST['PromotionFrom']))
			{
				$model->attributes=$_POST['PromotionFrom'];
				if($model->validate())
				{
					if (isset($_POST['PromotionFrom']['goods_v_type'])&&$_POST['PromotionFrom']['goods_v_type']=="1") {
						if (!isset($_POST['PromotionFrom']['pri_time_per'])||!preg_match("/^[1-9]+[0-9]?$/",$_POST['PromotionFrom']['pri_time_per'])){
							$model->addError("pri_time_per]", "限时优惠率要在1到99范围");
							$isOk= "2";
						}
						//t_begin_time
						if (!isset($_POST['PromotionFrom']['t_begin_time'])||!$_POST['PromotionFrom']['t_begin_time']){
							$model->addError("t_begin_time", "优惠开始时间不可以为空");
							$isOk= "2";
						}
						//t_end_time
						if (!isset($_POST['PromotionFrom']['t_end_time'])||!$_POST['PromotionFrom']['t_end_time']){
							$model->addError("t_end_time", "优惠结束时间不可以为空");
							$isOk= "2";
						}
						//pri_time_per]
					}else if (isset($_POST['PromotionFrom']['goods_v_type'])&&$_POST['PromotionFrom']['goods_v_type']=="2") {
						if (!isset($_POST['PromotionFrom']['pri_goods_per'])||!preg_match("/^[1-9]+[0-9]?$/",$_POST['PromotionFrom']['pri_goods_per'])){
							$model->addError("pri_goods_per", "菜品优惠率要在1到99范围");
							$isOk= "2";
						}
						if (!isset($_POST['PromotionFrom']['pri_goods_list'])||!$_POST['PromotionFrom']['pri_goods_list']){
							$model->addError("pri_goods_per", "优惠菜单不可以为空");
							$isOk= "2";
						}
					}else if (isset($_POST['PromotionFrom']['goods_v_type'])&&$_POST['PromotionFrom']['goods_v_type']=="3") {
						if (!isset($_POST['PromotionFrom']['vip_per'])||!preg_match("/^[1-9]+[0-9]?$/",$_POST['PromotionFrom']['vip_per'])){
							$model->addError("vip_per", "vip优惠率要在1到99范围");
							$isOk= "2";
						}
					}
					//$this->dataChannel("merchant","setMerchant",$_POST['MerchantAddForm']);
					//TODO do what
					//$this->dataChannel("merchant", "setMerchant",$_POST['MerchantAddForm']);
					$info = $_POST['PromotionFrom'];
					$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
					$info['user_id'] = Yii::app()->user->id;
					$info['iProId'] = $idGoods;
					if ($isOk=="3") {
						$upRe = $this->dataChannel("promotions","updatePro",$info);
						$info['id'] = $idGoods;
						$info['varil_begin_time'] = $info['varil_begin_time']?$info['varil_begin_time']:'';
						$info['varil_end_time'] = $info['varil_end_time']?$info['varil_end_time']:'';
						if (isset($upRe['type'])&&$upRe['type']) {
							$isOk="1";
						}else{
							$sErrorMsg = isset($upRe['msg'][1])?$upRe['msg'][1]:'error';
							$model->addError("goods_v_type",$sErrorMsg );
							$isOk= "2";
						}
					}
					$info['id'] = $idGoods;
				}else{
					$info = $_POST['PromotionFrom'];
				}
			}else{
				$re = $this->dataChannel("promotions","GetPro",array('id'=>$idGoods,'merchant_id'=>$iMerchantId));
				$info = $re['msg'];
				$info['varil_begin_time'] = $info['varil_begin_time']?date("Y-m-d",$info['varil_begin_time']):'';
				$info['varil_end_time'] = $info['varil_end_time']?date("Y-m-d",$info['varil_end_time']):'';
				$info['id'] = $idGoods;
			}
			$info['mer_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
			$arrGoods = $this->getMerGoods();
			
			//统计
			$this->render('updatePromotions',array('model'=>$model,'info'=>$info,'goodsArr'=>$arrGoods,"isOk"=>$isOk));
		}
		
		public function actionUseCoupon(){
			$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
			$info['user_id'] = Yii::app()->user->id;
			$info['cou_str'] = isset($_REQUEST['couponStr'])?trim($_REQUEST['couponStr']):'';
			if (!$info['cou_str']) {
				BaseFunctions::outputResult(false, "请输入优惠卷号码");
				return;
			}
			$re = $this->dataChannel("goods","UseFavorable",$info);
			BaseFunctions::ouputToString($re);
		}
}