<?php
	class ConDataController extends BaseController{
		public function actionIndex()
		{
			
		}
		
		/**
		 * user type
		 */
		public function actionUserType(){
			$aResult = array(
					'1' => '普通用户',
					'2' => '商家用户'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionServiceCon(){
			$aResult = array(
					1=>"早茶",
					2=>'午市',
					3=>'晚市',
					4=>'夜宵',
					5=>'外卖订餐'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 菜系
		 */
		public function actionMerTags(){
			$tags =  array(
					'1'=>'川菜',
					'2'=>'湘菜',
					'3'=>'粤菜',
					'4'=>'闽菜',
					'5'=>'浙菜',
					'6'=>'鲁菜',
					'7'=>'苏菜',
					'8'=>'徽菜',
					'9'=>'京菜',
					'10'=>'天津菜',
					'11'=>'上海菜',
					'12'=>'渝菜',
					'13'=>'东北菜',
					'14'=>'清真菜',
					'15'=>'豫菜',
					'16'=>'晋菜',
					'17'=>'赣菜',
					'18'=>'湖北菜',
					'19'=>'云南菜',
					'20'=>'贵州菜',
					'21'=>'新疆菜',
					'22'=>'淮扬菜',
					'23'=>'潮州菜',
					'24'=>'客家菜',
					'25'=>'广西菜',
					'26'=>'西北菜',
					'27'=>'香港美食',
					'28'=>'台湾菜',
					'29'=>'澳门美食',
					'30'=>'西餐',
					'31'=>'火锅',
					'32'=>'自助餐',
					'33'=>'小吃',
					'34'=>'简餐',
					'35'=>'快餐',
					'36'=>'日本料理',
					'37'=>'韩国料理',
					'38'=>'泰国菜',
					'39'=>'越南菜',
					'40'=>'意大利菜',
					'41'=>'墨西哥菜',
					'42'=>'西班牙菜',
					'43'=>'法国菜',
					'44'=>'美国菜',
					'45'=>'巴西烧烤',
					'46'=>'东南亚菜',
					'47'=>'印度菜',
					'48'=>'伊朗菜',
					'49'=>'土耳其菜',
					'50'=>'澳大利亚菜',
			);
			BaseFunctions::outputResult(true, $tags);
		}
		
		public function actionFreeSer(){
// 			$type= isset($_REQUEST['type'])?$_REQUEST['type']:0;
			$aResult = array(
					1=>"Wiff",
					2=>'免茶位费',
					3=>'免外卖费'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionGoodsTag(){
			$aResult = array(
					1=>'新品上市',
					2=>'热卖菜品',
					3=>'推荐菜品');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionGoodsStatus(){
			$aResult = array(
					1=>'在售',
					2=>'已停售'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionGoodsSaleType(){
			$aResult = array(
					1=>'堂吃',
					2=>'外卖',
					3=>'全部'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionVarilType(){
			$aResult = array('1'=>'限时优惠','2'=>'菜品优惠','3'=>'会员优惠');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 优惠卷类型
		 */
		public function actionPromotionType(){
			$aResult = array('1'=>'长期促销','2'=>'短期促销');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 预定状态
		 */
		public function actionBookStatus(){
			$aResult = array('-1'=>'删除','1'=>'排队','2'=>'到号','3'=>'入席','4'=>'客人取消','5'=>'订餐取消');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 座位类型
		 */
		public function actionSeatType(){
			$aResult = array('A'=>'2人桌','B'=>'4人桌','C'=>'5~8人桌','D'=>'包厢');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 座位状态
		 */
		public function actionSeatStatus(){
			$aResult = array('1'=>'开启','2'=>'停用');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 性别
		 */
		public function actionSex(){
			$aResult = array('0'=>'女','1'=>'男');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 优惠卷类型
		 */
		public function actionCouponType(){
			$aResult = array('1' =>'代金劵',
							'2' =>'折扣劵',
							'3' =>'菜品兑换劵',
			);
			BaseFunctions::outputResult(true, $aResult);
		}

		/**
		 * 优惠卷时间类型
		 */
		public function actionCouponTimeType(){
			$aResult = array(
					'1' =>'长期 促销',
					'2' =>'短期促销',
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 来源路径
		 */
		public function actionCusSourceType(){
			$aResult = array(
					'1' =>'线上',
					'2' =>'线下',
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/*
		 * 消息状态
		 */
		public function actionMsgSta(){
			//status
			$aResult = array(
					'-1' => '删除',
					'0' => '新',
					'1' => '已查看',
					'2' => '已回复',
					'4' => '已屏蔽'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 外面状态
		 */
		public function actionTakeOutSta(){
			$aResult = array(
					'-1' => '删除',
					'0' => '未确认',
					'1' => '已确认',
					'2' => '已送餐',
					'3'	=> '已完成',
					'4' => '已取消'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 外卖状态
		 */
		public function actionTakeOutStaDel(){
			$aResult = array(
					'-1' => '删除',
					'0' => '未确认',
					'1' => '送餐未安排',
					'2' => '送餐中，待客户签收',
					'3'	=> '客户签收',
					'4' => '外卖取消'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 支付类型
		 */
		public function actionPaySta(){
			
			$aResult = array(
					'-1' => '删除',
					'0' => '未支付',
					'1' => '已支付'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionPayType(){
				
			$aResult = array(
					'0' => '餐到支付',
					'1' => '线上支付'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionCouponGetType(){
			$aResult = array(
					'0' => '应用获得',
					'1' => '其他获得'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionMerchantStatus(){
			$aResult = array(
					'-1'=>'已删除',
					'0' => '营业',
					'1' => '打烊',
					'2' => '停业'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionMerchantSetStatus(){
			$aResult = array(
					'0' => '营业',
					'1' => '打烊',
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 菜品类型
		 */
		public function actionGreensMenu(){
			$aResult = array(
							'1'=>'家常菜',
							'2'=>'私房菜',
							'3'=>'快手菜',
							'4'=>'热菜',
							'5'=>'凉菜',
							'6'=>'素菜',
							'7'=>'蒸菜',
							'8'=>'创意菜',
							'9'=>'下饭菜',
							'10'=>'下酒菜',
							'11'=>'海鲜',
							'12'=>'药膳',
							'13'=>'斋菜',
							'14'=>'卤菜',
							'15'=>'腌菜',
							'16'=>'农家菜',
							'17'=>'宫廷菜',
							'18'=>'婴儿辅食',
							'19'=>'饭',
							'20'=>'炒饭',
							'21'=>'盖浇饭',
							'22'=>'煲仔饭',
							'23'=>'粥',
							'24'=>'面食',
							'25'=>'面',
							'26'=>'炒面',
							'27'=>'粉',
							'28'=>'饼',
							'29'=>'油酥类面点',
							'30'=>'糕点',
							'31'=>'汤圆',
							'32'=>'馄饨',
							'33'=>'馒头',
							'34'=>'饺子',
							'35'=>'包子',
							'36'=>'卷子',
							'37'=>'烘焙',
							'38'=>'蛋糕',
							'39'=>'面包',
							'40'=>'饼干',
							'41'=>'披萨',
							'42'=>'派类',
							'43'=>'挞类',
							'44'=>'果冻',
							'45'=>'布丁',
							'46'=>'冰淇淋',
							'47'=>'糖果',
							'48'=>'点心',
							'49'=>'零食',
							'50'=>'汤',
							'51'=>'羹',
							'52'=>'炖品',
							'53'=>'甜品',
							'54'=>'饮品',
							'55'=>'冰品',
							'56'=>'糖水',
							'57'=>'沙拉',
							'58'=>'茶饮',
							'59'=>'酒水',
							'60'=>'花草茶',
							'61'=>'果汁',
							'62'=>'小吃',
							'63'=>'便当',
							'64'=>'烧烤',
							'65'=>'串烧',
							'66'=>'寿司',
							'67'=>'拼盘',
							'68'=>'杂烩',
							'69'=>'酱汁',
							'70'=>'果酱',
							'71'=>'火锅',
							'72'=>'干锅',
							'73'=>'香锅',
							'74'=>'佐料',
							'75'=>'自制调味料',
							'76'=>'懒人食谱',
							'77'=>'包子馅',
							'78'=>'馄饨馅',
							'79'=>'饺子馅',
							'80'=>'水饺馅',
							'81'=>'粽子',
							'82'=>'月饼',
							'83'=>'月饼馅',
							'84'=>'果茶',
							'85'=>'石锅拌饭',
							'86'=>'谭家菜',
							'87'=>'官府菜',
							'88'=>'孔府菜',);
							BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 菜品口味
		 */
		public function actionGreensTaste(){
			$aResult = array(
					'1'=>'酸',
					'2'=>'甜',
					'3'=>'苦',
					'4'=>'辣',
					'5'=>'咸',
					'6'=>'爽口',
					'7'=>'清淡',
					'8'=>'酸甜',
					'9'=>'咸甜',
					'10'=>'香甜',
					'11'=>'微辣',
					'12'=>'中辣',
					'13'=>'超辣',
					'14'=>'麻辣',
					'15'=>'酸辣',
					'16'=>'鲜辣',
					'17'=>'香辣',
					'18'=>'咸鲜',
					'19'=>'椒盐',
					'20'=>'咸香',
					'21'=>'原味',
					'22'=>'鲜香',
					'23'=>'奶香',
					'24'=>'葱香',
					'25'=>'韭香',
					'26'=>'蒜香',
					'27'=>'酱香',
					'28'=>'糟香',
					'29'=>'五香',
					'30'=>'蚝香',
					'31'=>'鱼香',
					'32'=>'果味',
					'33'=>'草莓味',
					'34'=>'香草味',
					'35'=>'薄荷味',
					'36'=>'橘子味',
					'37'=>'番茄味',
					'38'=>'柠檬味',
					'39'=>'苹果味',
					'40'=>'蓝莓味',
					'41'=>'咖喱味',
					'42'=>'孜然味',
					'43'=>'芥末味',
					'44'=>'黑椒味',
					'45'=>'姜汁味',
					'46'=>'茄汁味',
					'47'=>'烧烤味',
					'48'=>'红油味',
					'49'=>'蛋黄味',
					'50'=>'蟹黄味',
					'51'=>'糖醋味',
					'52'=>'泡椒味',
					'53'=>'怪味',
					'54'=>'芝士味',
					'55'=>'抹茶味',
					'56'=>'芝麻味',
					'57'=>'巧克力味',
					'58'=>'糊辣',
					'59'=>'芒果味',
					'60'=>'西瓜味',
					'61'=>'西柚味',
					'62'=>'水蜜桃味',
			);
			BaseFunctions::outputResult(true, $aResult);
		}

		/*
		 * 翻译类型
		*/
		public function actionTranslateType(){
			//status
			$aResult = array(
					'1' => '韩文',
					'2' => '日文',
					'3' => '英文'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		/**
		 * 优惠劵等状态
		 */
		public function actionCouponStatus(){
			$aResult = array(
					'-1' => '已删除',
					'0' => '待发放',
					'1' => '发放中',
					'2' => '已过期'
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionAreaForGZ(){
			$aResult = array(
				'440101'=>'市辖区',
				'440102'=>'东山区',
				'440103'=>'荔湾区',
				'440104'=>'越秀区',
				'440105'=>'海珠区',
				'440106'=>'天河区',
				'440107'=>'芳村区',
				'440111'=>'白云区',
				'440112'=>'黄埔区',
				'440113'=>'番禺区',
				'440114'=>'花都区',
				'440183'=>'增城市',
				'440184'=>'从化市',
			);
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionCityForGZ(){
			$aResult = array(
			'440100'=>'广州');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionProvinceForGZ(){
			$aResult = array(
					'440000'=>'广东');
			BaseFunctions::outputResult(true, $aResult);
		}
		
		public function actionCoupDetailStatus(){
			$aResult = array(
					'-1'=>"已删除",
					'0'=>'待发放',
					'1'=>'发放中',
					'2'=>'已领取',
					'3'=>'已使用',
	 				'4'=>'使用中',
			);
			BaseFunctions::outputResult(true, $aResult);
		}
	}
?>