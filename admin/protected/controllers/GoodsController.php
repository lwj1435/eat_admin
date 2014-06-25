<?php

class GoodsController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionIndex()
	{
		global $tags;
		
		
		$model = new GoodsForm();
		
		$dataModel = new DataModelClass();
		
		
		$info = '';
		$server ='';
		
		if(isset($_POST['GoodsForm'])){
			$model->attributes = $_POST['GoodsForm'];
			$mid = 0;
			
			
			$goods_tag = '';
			if(isset($_POST['GoodsForm']['goods_tag'])){
				$goods_tag = $_POST['GoodsForm']['goods_tag'];
			}

			
			$image_list = '';
			if(isset($_POST['GoodsForm']['goods_image_list'])){
				$image_list =json_encode($_POST['GoodsForm']['goods_image_list']);
			}
			$goods_name = '';
			if(isset($_POST['GoodsForm']['goods_name'])){
				$goods_name = $_POST['GoodsForm']['goods_name'];
			}
			
			$pice = '';
			if(isset($_POST['GoodsForm']['goods_pice'])){
				$pice = intval($_POST['GoodsForm']['goods_pice']);
			}
			
			$goods_desc = '';
			if(isset($_POST['GoodsForm']['goods_desc'])){
				$goods_desc = $_POST['GoodsForm']['goods_desc'];
			}
			
			$goods_sounds = '';
			if(isset($_POST['GoodsForm']['goods_sounds'])){
				$goods_sounds = $_POST['GoodsForm']['goods_sounds'];
			}
			$recommend = '';
			if(isset($_POST['GoodsForm']['recommend'])){
				$recommend = $_POST['GoodsForm']['recommend'];
			}
			
			$status = '';
			if(isset($_POST['GoodsForm']['status'])){
				$status = $_POST['GoodsForm']['status'];
			}
			
			if(isset($_REQUEST['mid'])){
				$mid = $_REQUEST['mid'];
				
				$aParam = array(
					'goods_tag'=>array('type'=>'string','val'=>implode(",", $goods_tag)),
					'goods_name'=>array('type'=>'string','val'=>$goods_name),
					'goods_pice'=>array('type'=>'string','val'=>$pice),
					'goods_desc'=>array('type'=>'string','val'=>$goods_desc),
					'goods_image_list'=>array('type'=>'string','val'=>$image_list),
					'goods_sounds'=>array('type'=>'string','val'=>$goods_sounds),
					'status'=>array('type'=>'string','val'=>$status),
					'recommend'=>array('type'=>'string','val'=>$recommend),
				);
				
				$dataModel->update($mid, '`goods`', "`id` = '$mid'", $aParam);
//				$mysql->update('`goods`', "`id` = '$mid'", $aParam);
				
			}else{
							
				$aParam = array(
					'goods_tag'=>array('type'=>'string','val'=>implode(",", $goods_tag)),
					'goods_name'=>array('type'=>'string','val'=>$goods_name),
					'goods_pice'=>array('type'=>'string','val'=>$pice),
					'goods_desc'=>array('type'=>'string','val'=>$goods_desc),
					'goods_image_list'=>array('type'=>'string','val'=>$image_list),
					'goods_sounds'=>array('type'=>'string','val'=>$goods_sounds),
					'recommend'=>array('type'=>'string','val'=>$recommend),
					'status'=>array('type'=>'string','val'=>$status),
					'merchant_id'=>array('type'=>'string','val'=>$merid),
				);
//				$good_id = $mysql->add('`goods`', $aParam);
				$dataModel->add('`goods`', $aParam);

			}
			
			
		}
		
		if(isset($_REQUEST['mid'])){
			$mid = $_REQUEST['mid'];
//			$service = $mysql->find("`goods`", "`id` = '$mid'");
			$service = $dataModel->getInfo($mid, '`goods`', "`id` = '$mid'");
			if(!empty($service)){
				$info = $service;
			}
		}
		
		$this->render('index',array('model'=>$model,'info'=>$info,'tags'=>$tags));
	}
	
	public function actionList()
	{
		$mysql = new MySqlClass();
		
		$uid = Yii::app()->user->id;
		
		$info = $mysql->find("`merchant_msg`", "`user_id` = '$uid'");
		$merchant_id = 0;
		if(!$info['msg'][0]['id']){
			echo "<script>alert('请先设置保存商店信息！');</script>";
			$this->redirect($this->createUrl("merchant/index"));
		}
		$merchant_id = $info['msg'][0]['id'];
		
		$goods = $mysql->find("`goods`", "`merchant_id` = '$merchant_id'");
		
		$this->render('list',array('goods'=>$goods['msg']));
	}
	
	
	public function actionNew()
	{
		$this->render('new');
	}

	public function actionInfo()
	{
		$this->render('info');
	}
	
	public function actionResources()
	{
		$this->render('resources');
	}
	
	public function actionAddGoods()
	{
		$model=new GoodsForm;
	
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='goods-form-addGoods-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
		$isOk="3";
		$info = array();
// 		echo "<xmp>";
// 		print_r($_REQUEST);
// 		echo "</xmp>";
// 		echo "<xmp>";
// 		print_r($_POST);
// 		echo "</xmp>";
		if(isset($_REQUEST['GoodsForm']))
		{
			$model->attributes=$_REQUEST['GoodsForm'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				//TODO user id and merchant id
				$_REQUEST['GoodsForm']['add_user_id'] = "1";
				//$_POST['GoodsForm']['merchant_id'] = "1";
				$info = $_POST['GoodsForm'];
				$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				$this->dataChannel("Goods","addGoods",$info);
				$this->redirect($this->createUrl("goods/proList"));
				return;
			}else{
				$isOk="2";
				$info = $_POST['GoodsForm'];
			}
				$info = $_POST['GoodsForm'];
		}
		$goodsArr = $this->getMerGoods();
		$this->render('addGoods',array('model'=>$model,'info'=>$info,'goodsArr'=>$goodsArr,"isOk"=>$isOk));
	}
	
	public function actionUpdateGoods(){
		$isOk="3";
		$model=new GoodsForm;
		$info = array();
		$resultMsg=isset($_REQUEST['msg'])?$_REQUEST['msg']:'';
		$resultMsg=$resultMsg?"修改 完毕":"";
// 		$this->tempA($_REQUEST['msg']);
// 		$this->tempA($resultMsg);
		$idGoods = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		if (!$idGoods) {
			return;
		}
		if(isset($_POST['GoodsForm']))
		{
			$model->attributes=$_POST['GoodsForm'];
			
			if($model->validate())
			{
				// form inputs are valid, do something here
				//TODO user id and merchant id goods_id
				$_POST['GoodsForm']['add_user_id'] = Yii::app()->user->id;
				$_POST['GoodsForm']['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				$_POST['GoodsForm']['goods_id'] = $idGoods;
				$this->dataChannel("Goods","updateGoods",$_POST['GoodsForm']);
				$this->redirect($this->createUrl("goods/proList"));
				return;
				$info = $_POST['GoodsForm'];
			}else{
				$info = $_POST['GoodsForm'];
				$info['pri_goods_list'] = isset($info['pri_goods_list'])?$info['pri_goods_list']:'';
				$info['connection_num'] = $this->countNum($info['pri_goods_list']);
				$resultMsg = "参数有误";
				$isOk="2";
			}
			$info = $_POST['GoodsForm'];
		}else{
			$re = $this->dataChannel("Goods","getGoods",array('id'=>$idGoods));
			$info = $re['msg'][0];
			//$info['connection_num'] = $this->countNum($info['pri_goods_list']);
		}
		$info['id'] = $idGoods;
		$goodsArr = $this->getMerGoods($idGoods);
		$this->render('goodsDetail',array('model'=>$model,'info'=>$info,'goodsArr'=>$goodsArr,'resultMsg'=>$resultMsg,"isOk"=>$isOk));
	}
	
	private function countNum($str){
		$num = 0;
		$str = $str?$str:'';
		$arr = is_array($str)?$str:$this->stringAndArray($str);
		foreach ($arr as $item){
			if ($item) {
				$num++;
			}
		}
		return $num;
	}
	
	public function actionGoodsList(){
		//TODO find the goods list to the view and show it on the web
		$order = isset($_REQUEST['goods_name'])?$_REQUEST['goods_name']:'id';
    	//Yii page get
    	$dataProvider=new CActiveDataProvider('GoodsList', array(  
        	'pagination'=>array(  
            	'pageSize'=>10,  
            	'pageVar'=>'page',  
       	 	),  
                'sort'=>array(  
                    'defaultOrder'=>$order,  
                    ),  
                ));  
		$this->render('glTest',array('dataProvider'=>$dataProvider,'tempArr'=>array('0'=>'停售','1'=>'在售','2'=>'售完')));
	}
	
	public function actionProList(){
		$iMerId =  Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$sDeCon= " merchant_id = {$iMerId} ";
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id DESC';
		
		$criteria->condition = $sDeCon.' and goods_type = 1 and (status = 1 or status =2)  ';
		$criteria->with = array('greensViewNum','proCount','coupCount');
		$count = Goods::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = Goods::model()->findAll($criteria);
		
		//
		$criteria1 = new CDbCriteria();
		
		$criteria1->order = 'id DESC';
		
		$criteria1->condition = $sDeCon.' and goods_type = 1 and status=1 ';
		
		$count1 = Goods::model()->count($criteria1);
		
		//停售
		$criteria2 = new CDbCriteria();
		
		$criteria2->order = 'id DESC';
		
		$criteria2->condition = $sDeCon.' and goods_type = 1 and status=2 ';
		
		$overcount = Goods::model()->count($criteria2);
		
		//停售
// 		$criteria3 = new CDbCriteria();
		
// 		$criteria3->order = 'id DESC';
		
// 		$criteria3->condition = $sDeCon.' and goods_type = 1 and status=2 ';
		
// 		$overcount = Promotions::model()->count($criteria3);
		$this->render('proList', array('list' => $list,
				'count'=>$count ,
				'onsealcount'=>$count1,
				'overcount'=>$overcount,
				'pages' => $pages,"oModer"=>new Goods()));
	}
	
	public function actionChangeStatus(){
		$status = isset($_REQUEST['status'])?$_REQUEST['status']:'';
		$aList = isset($_REQUEST['id_list'])?$_REQUEST['id_list']:'';
		if(!$status){
			echo "错误选择!";
			return;
		}
		if($aList ==','){
			echo "错误选择!";
			return;
		}
		$info = array('status'=>$status,'list'=>$aList);
		$aRe = $this->dataChannel("Goods","changeStatus",$info);
		echo isset($aRe['msg'])?$aRe['msg']:'error!';
	}
	
	public function actionDelTag(){
		$status = isset($_REQUEST['status'])?$_REQUEST['status']:'';
		$aList = isset($_REQUEST['id_list'])?$_REQUEST['id_list']:'';
		if(!$status){
			echo "错误选择!";
			return;
		}
		if($aList ==','){
			echo "错误选择!";
			return;
		}
		$info = array('status'=>$status,'list'=>$aList);
		$aRe = $this->dataChannel("Goods","delTag",$info);
		echo isset($aRe['msg'])?$aRe['msg']:'error!';
	}

	public function actionGoodsResource(){
		
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		if($merid == false){
			Yii::app()->end();
		}
		
		$info = array();
		$info['mer_id'] = 117;
		//获取数据
		//1 服务商信息
		$aMerchantMsgArr = $this->dataChannel("goods", "GetGoods",array('id'=>$info['mer_id']));
		$info['goods_image_list'] = isset($aMerchantMsgArr['msg'][0]['goods_image_list'])?$aMerchantMsgArr['msg'][0]['goods_image_list']?$aMerchantMsgArr['msg'][0]['goods_image_list']:'imgadd.jpg':'imgadd.jpg';
		$info['goods_sounds'] = isset($aMerchantMsgArr['msg'][0]['goods_sounds'])?$aMerchantMsgArr['msg'][0]['goods_sounds']?$aMerchantMsgArr['msg'][0]['goods_sounds']:'imgadd.jpg':'imgadd.jpg';
		if ($aMerchantMsgArr['msg'][0]['goods_image_list']&&$aMerchantMsgArr['msg'][0]['goods_image_list']!=","&&$aMerchantMsgArr['msg'][0]['goods_image_list']!=",") {
				
			$sTemp = "0".$aMerchantMsgArr['msg'][0]['goods_image_list']."0";
			$criteria = new CDbCriteria();
		
			$criteria->order = 'id DESC';
				
			$criteria->condition = '  status=0 and id in ('.$sTemp.') ';
				
			$count = Image::model()->count($criteria);
				
			$pages = new CPagination($count);
				
			$pages->pageSize = 1000;
				
			$pages->applyLimit($criteria);
				
			$list = Image::model()->findAll($criteria);
		}else{
			$list = array();
		}
		$this->render('goodsResource',array('info'=>$info,"image_list"=>$list));
	}
	
	//--------------------------------------------------------------------------
	/**
	 * 添加声音
	 */
	public function actionUpMusice(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$merid = 117;
		$sMusice = isset($_REQUEST['merchant_musice'])?$_REQUEST['merchant_musice']:'';
		if(!$sMusice){
			BaseFunctions::outputResult(false, "请选择一个声音文件!");
			return;
		}
		$aVideo = explode('.',$sMusice);
		if (in_array($aVideo[1],array("wav"))) {
			$info = array('merchant_musice'=>$sMusice,"goods_id"=>$merid);
			$aMerchantMsgArr = $this->dataChannel("Goods", "upSound",$info);
			BaseFunctions::ouputToString($aMerchantMsgArr);
		}else{
			BaseFunctions::outputResult(false, "不支持此类型格式的文件，请上传wav格式的文件!");
			return;
		}
	
	}
	
	/**
	 * 1:每次添加都是添加一个
	 * 2:
	 */
	public function actionUpImg(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$merid = 117;
		$sImgArr = isset($_REQUEST['image'])?$_REQUEST['image']:"";
		if(!$sImgArr){
			BaseFunctions::outputResult(false, "请选择一个图片文件!");
			return;
		}
		$aVideo = explode('.',$sImgArr);
		if (in_array($aVideo[1],array("JPG","PNG","GIF","jpg","png","gif"))) {
			$info = array('image'=>$sImgArr,"goods_id"=>$merid);
			$aMerchantMsgArr = $this->dataChannel("Goods", "upImg",$info);
			BaseFunctions::ouputToString($aMerchantMsgArr);
		}else{
			BaseFunctions::outputResult(false, "不支持此类型格式的文件，请上传JPG、PNG、GIF格式的文件!");
			return;
		}
	}
	
	

	public function actionDelImg(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$merid = 117;
		$iImgId = isset($_REQUEST['imageId'])?$_REQUEST['imageId']:"";
		if(!$iImgId){
			BaseFunctions::outputResult(false,"请传递id");
			return;
		}
		$info = array('imageId'=>$iImgId,"goods_id"=>$merid);
		$aMerchantMsgArr = $this->dataChannel("goods", "delImg",$info);
		BaseFunctions::ouputToString($aMerchantMsgArr);
	}
	
	public function actionDelSound(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$merid = 117;
		$info = array("goods_id"=>$merid);
		$aMerchantMsgArr = $this->dataChannel("goods", "delSound",$info);
		BaseFunctions::ouputToString($aMerchantMsgArr);
	}
	
	
}