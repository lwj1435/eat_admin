<?php

class MerchantController extends Controller
{
	
	
	public function filters()
	{
		return array(
			array(
				'application.filters.AdminFilter'
			),
		);
	}
	
	public function actionUploadImg()
	{	
		$attach = CUploadedFile::getInstanceByName("file");  
		
		if($attach == null){  
			
            $retValue = "提示：不能上传空文件。";  
            echo json_message(1, "",array(),$retValue);
        	Yii::app()->end();
        }else if($attach->size > 2000000){  
            $retValue = "提示：文件大小不能超过2M。"; 
            echo json_message(1, "",array(),$retValue);
        	Yii::app()->end(); 
        }else{
        	$filename = time().".".$attach->getExtensionName();
        	$attach->saveAs(Yii::app()->basePath."/upload/images/".$filename);
        	echo json_message(0,  Yii::app()->request->hostInfo."/admin/upload/images/".$filename,array('filename'=>$filename),"上传成功！");
        	Yii::app()->end();
        }
	}
	
	
	public function actionUploadSounds()
	{	
		$attach = CUploadedFile::getInstanceByName("file");  
		
		if($attach == null){  
			
            $retValue = "提示：不能上传空文件。";  
            echo json_message(1, "",array(),$retValue);
        	Yii::app()->end();
        }else if($attach->size > 2000000){  
            $retValue = "提示：文件大小不能超过2M。"; 
            echo json_message(1, "",array(),$retValue);
        	Yii::app()->end(); 
        }else{
        	$filename = time().".".$attach->getExtensionName();
        	$attach->saveAs(Yii::app()->basePath."/upload/sounds/".$filename);
        	echo json_message(0,  Yii::app()->request->hostInfo."/admin/upload/sounds/".$filename,array('filename'=>$filename),"上传成功！");
        	Yii::app()->end();
        }
	}
	
	public function actionUploadVideo()
	{	
		$attach = CUploadedFile::getInstanceByName("file");  
		
		if($attach == null){  
			
            $retValue = "提示：不能上传空文件。";  
            echo json_message(1, "",array(),$retValue);
        	Yii::app()->end();
        }else if($attach->size > 2000000){  
            $retValue = "提示：文件大小不能超过2M。"; 
            echo json_message(1, "",array(),$retValue);
        	Yii::app()->end(); 
        }else{
        	$filename = time().".".$attach->getExtensionName();
        	$attach->saveAs(Yii::app()->basePath."/upload/video/".$filename);
        	echo json_message(0,  Yii::app()->request->hostInfo."/admin/upload/video/".$filename,array('filename'=>$filename),"上传成功！");
        	Yii::app()->end();
        }
	}
	
	public function actionResources()
	{
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		if($merid == false){
			Yii::app()->end();
		}
		
		$info = array();
		$info['mer_id'] = $merid;
		//获取数据
		//1 服务商信息
		$aMerchantMsgArr = $this->dataChannel("merchant", "getMerchant",array('merchant_id'=>$info['mer_id']));
		$info['merchant_video'] = isset($aMerchantMsgArr['msg'][0]['merchant_video'])?$aMerchantMsgArr['msg'][0]['merchant_video']?$aMerchantMsgArr['msg'][0]['merchant_video']:'imgadd.jpg':'imgadd.jpg';
		$info['merchant_sounds'] = isset($aMerchantMsgArr['msg'][0]['merchant_sounds'])?$aMerchantMsgArr['msg'][0]['merchant_sounds']?$aMerchantMsgArr['msg'][0]['merchant_sounds']:'imgadd.jpg':'imgadd.jpg';
		//2 资源列表
		if ($aMerchantMsgArr['msg'][0]['merchant_image']&&$aMerchantMsgArr['msg'][0]['merchant_image']!=","&&$aMerchantMsgArr['msg'][0]['merchant_image']!=",") {
			
			$sTemp = "0".$aMerchantMsgArr['msg'][0]['merchant_image']."0";
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
		
		$this->render('resources',array('info'=>$info,"image_list"=>$list));
		
	}
	
	public function actionUpResource(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		if($merid == false){
			Yii::app()->end();
		}
		
		//获取资料信息
		$sVideo = isset($_REQUEST['merchant_video'])?$_REQUEST['merchant_video']:'';
		$sMusice = isset($_REQUEST['merchant_musice'])?$_REQUEST['merchant_musice']:'';
		$sImgArr = isset($_REQUEST['img_list'])?$_REQUEST['img_list']:array();
		//更新资料
			$info = array('merchant_video'=>$sVideo,'merchant_musice'=>$sMusice,'img_list'=>$sImgArr,"merchant_id"=>$merid);
			$aMerchantMsgArr = $this->dataChannel("merchant", "updateResources",$info);
			//跳转页面
			$this->redirect($this->createUrl("merchant/resources"));
		
	}
	
	public function actionUpVideo(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$sVideo = isset($_REQUEST['merchant_video'])?$_REQUEST['merchant_video']:'';
		if(!$sVideo){
			BaseFunctions::outputResult(false, "请选择一个video!");
			return;
		}
		$aVideo = explode('.',$sVideo);
		if ($aVideo[1]!="avi"||$aVideo[1]!="mp4") {
			BaseFunctions::outputResult(false, "不支持此类型格式的文件，请上传avi或mp4格式的文件!");
			return;
		}
		$info = array('merchant_video'=>$sVideo,"merchant_id"=>$merid);
		$aMerchantMsgArr = $this->dataChannel("merchant", "upVideo",$info);
		BaseFunctions::ouputToString($aMerchantMsgArr);
	}
	
	public function actionUpMusice(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
	
		$sMusice = isset($_REQUEST['merchant_musice'])?$_REQUEST['merchant_musice']:'';
		if(!$sMusice){
			BaseFunctions::outputResult(false, "请选择一个声音文件!");
			return;
		}
		$aVideo = explode('.',$sMusice);
		if (in_array($aVideo[1],array("wav"))) {
			$info = array('merchant_musice'=>$sMusice,"merchant_id"=>$merid);
			$aMerchantMsgArr = $this->dataChannel("merchant", "upSound",$info);
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
	
		$sImgArr = isset($_REQUEST['image'])?$_REQUEST['image']:"";
		if(!$sImgArr){
			BaseFunctions::outputResult(false, "请选择一个图片文件!");
			return;
		}
		$aVideo = explode('.',$sImgArr);
		if (in_array($aVideo[1],array("JPG","PNG","GIF","jpg","png","gif"))) {
			$info = array('image'=>$sImgArr,"merchant_id"=>$merid);
			$aMerchantMsgArr = $this->dataChannel("merchant", "upImg",$info);
			BaseFunctions::ouputToString($aMerchantMsgArr);
		}else{
			BaseFunctions::outputResult(false, "不支持此类型格式的文件，请上传JPG、PNG、GIF格式的文件!");
			return;
		}
	}
	
	public function actionDelImg(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$iImgId = isset($_REQUEST['imageId'])?$_REQUEST['imageId']:"";
		if(!$iImgId){
			BaseFunctions::outputResult(false,"请传递id");
			return;
		}
		$info = array('imageId'=>$iImgId,"merchant_id"=>$merid);
		$aMerchantMsgArr = $this->dataChannel("merchant", "delImg",$info);
		BaseFunctions::ouputToString($aMerchantMsgArr);
	}
	
	public function actionDelVideo(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$info = array("merchant_id"=>$merid);
		$aMerchantMsgArr = $this->dataChannel("merchant", "delVideo",$info);
		BaseFunctions::ouputToString($aMerchantMsgArr);
	}
	
	public function actionDelSound(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$info = array("merchant_id"=>$merid);
		$aMerchantMsgArr = $this->dataChannel("merchant", "delSound",$info);
		BaseFunctions::ouputToString($aMerchantMsgArr);
	}
	
	public function actionIntroduce()
	{
		$model = new MerchantInfoForm();
		$mysql = new MySqlClass();
		
		$uid = Yii::app()->user->id;
		
		$dataModel = new DataModelClass();
		$dataModel->skey = 'merchant';
		
		if(isset($_POST['MerchantInfoForm'])){
			$model->attributes = $_POST['MerchantInfoForm'];
			$model->validate();
			$mid = 0;
			
			$merchant_name = isset($_POST['MerchantInfoForm']['merchant_name']) ? $_POST['MerchantInfoForm']['merchant_name'] : '';
			$merchant_branch = isset($_POST['MerchantInfoForm']['merchant_branch']) ? $_POST['MerchantInfoForm']['merchant_branch'] : '';
			$merchant_alias = isset($_POST['MerchantInfoForm']['merchant_alias']) ? $_POST['MerchantInfoForm']['merchant_alias'] : '';
			$merchant_logo = isset($_POST['MerchantInfoForm']['merchant_logo']) ? $_POST['MerchantInfoForm']['merchant_logo'] : '';
			$merchant_per = isset($_POST['MerchantInfoForm']['merchant_per']) ? $_POST['MerchantInfoForm']['merchant_per'] : '';
			$address = isset($_POST['MerchantInfoForm']['address']) ? $_POST['MerchantInfoForm']['address'] : '';
			$merchant_call = isset($_POST['MerchantInfoForm']['merchant_call']) ? $_POST['MerchantInfoForm']['merchant_call'] : '';
			$merchant_start_time = isset($_POST['MerchantInfoForm']['merchant_start_time']) ? $_POST['MerchantInfoForm']['merchant_start_time'] : '';
			$merchant_end_time = isset($_POST['MerchantInfoForm']['merchant_end_time']) ? $_POST['MerchantInfoForm']['merchant_end_time'] : '';
			
			if(isset($_REQUEST['mid'])){
				$mid = $_REQUEST['mid'];
				
				$aParam = array(
					'merchant_name'=>array('type'=>'string','val'=>$merchant_name),
					'merchant_branch'=>array('type'=>'string','val'=>$merchant_branch),
					'merchant_alias'=>array('type'=>'string','val'=>$merchant_alias),
					'merchant_logo'=>array('type'=>'string','val'=>$merchant_logo),
					'merchant_per'=>array('type'=>'string','val'=>$merchant_per),
					'address'=>array('type'=>'string','val'=>$address),
					'merchant_call'=>array('type'=>'string','val'=>$merchant_call),
					'merchant_start_time'=>array('type'=>'string','val'=>$merchant_start_time),
					'merchant_end_time'=>array('type'=>'string','val'=>$merchant_end_time),
					'user_id'=>array('type'=>'string','val'=>$uid),
				);
				
				$dataModel->skey = 'merchant';
				$dataModel->update($mid, '`merchant_msg`', "`id` = '$mid'", $aParam,1);
				
			}else{
								
				$aParam = array(
					'merchant_name'=>array('type'=>'string','val'=>$merchant_name),
					'merchant_branch'=>array('type'=>'string','val'=>$merchant_branch),
					'merchant_alias'=>array('type'=>'string','val'=>$merchant_alias),
					'merchant_logo'=>array('type'=>'string','val'=>$merchant_logo),
					'merchant_per'=>array('type'=>'string','val'=>$merchant_per),
					'address'=>array('type'=>'string','val'=>$address),
					'merchant_call'=>array('type'=>'string','val'=>$merchant_call),
					'merchant_start_time'=>array('type'=>'string','val'=>$merchant_start_time),
					'merchant_end_time'=>array('type'=>'string','val'=>$merchant_end_time),
					'user_id'=>array('type'=>'string','val'=>$uid),
				);
				$dataModel->skey = 'merchant';
				$merchant_id = $dataModel->add('`merchant_msg`', $aParam);

			}
				
		}
		
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$dataModel->skey = 'merchant';
		$result = $dataModel->getInfo($merid,'`merchant_msg`', "`id` = '$merid'");
		$info = '';
		$server = '';
		if(isset($result['id'])){
			$info = $result;
		}

		$this->render('introduce',array('model'=>$model,'info'=>$info));
	}
	
	public function actionMerchantIntroduce()
	{
		$model=new MerchantAddForm();
		$isOk = "3";
		
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='merchant-add-form-merchantIntroduce-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
		$info = array();
		$info['mer_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$resultMsg = "";
		//$this->tempA($info);
		if(isset($_POST['MerchantAddForm']))
		{
			$model->attributes=$_POST['MerchantAddForm'];
			if($model->validate())
			{
				//$this->dataChannel("merchant","setMerchant",$_POST['MerchantAddForm']);
				//TODO do what 
				$upinfo = $_POST['MerchantAddForm'];
				$upinfo['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				$upinfo['mid'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				$this->dataChannel("merchant", "setMerchant",$upinfo);
// 				$resultMsg = "修改完成";
				$isOk = "1";
			}else{
				$isOk = "2";
			}
			$info = $_POST['MerchantAddForm'];
		}else{
			$aMerchantMsgArr = $this->dataChannel("merchant", "getMerchant",array('merchant_id'=>$info['mer_id']));
			//获取商家信息
			$info['merchant_id'] = isset($aMerchantMsgArr['msg'][0]['mid']) ? $aMerchantMsgArr['msg'][0]['mid'] : '';
			$info['merchant_name'] = isset($aMerchantMsgArr['msg'][0]['merchant_name']) ? $aMerchantMsgArr['msg'][0]['merchant_name'] : '';
			$info['merchant_othername'] = isset($aMerchantMsgArr['msg'][0]['merchant_othername']) ? $aMerchantMsgArr['msg'][0]['merchant_othername'] : '';
			$info['merchant_manager'] = isset($aMerchantMsgArr['msg'][0]['merchant_manager']) ? $aMerchantMsgArr['msg'][0]['merchant_manager'] : '';
			$info['merchant_manager_phone'] = isset($aMerchantMsgArr['msg'][0]['merchant_manager_phone']) ? $aMerchantMsgArr['msg'][0]['merchant_manager_phone'] : '';
			$info['merchant_logo'] = isset($aMerchantMsgArr['msg'][0]['merchant_logo']) ? $aMerchantMsgArr['msg'][0]['merchant_logo'] : '';
			$info['merchant_start_time'] = isset($aMerchantMsgArr['msg'][0]['merchant_start_time']) ? $aMerchantMsgArr['msg'][0]['merchant_start_time'] : '';
			$info['merchant_end_time'] = isset($aMerchantMsgArr['msg'][0]['merchant_end_time']) ? $aMerchantMsgArr['msg'][0]['merchant_end_time'] : '';
			$info['merchant_ser'] = isset($aMerchantMsgArr['msg'][0]['merchant_ser']) ? $aMerchantMsgArr['msg'][0]['merchant_ser'] : array();
			$info['merchant_tag'] = isset($aMerchantMsgArr['msg'][0]['merchant_tag']) ? $aMerchantMsgArr['msg'][0]['merchant_tag'] : array();
			$info['merchant_call'] = isset($aMerchantMsgArr['msg'][0]['merchant_call']) ? $aMerchantMsgArr['msg'][0]['merchant_call'] : '';
			$info['merchant_phone'] = isset($aMerchantMsgArr['msg'][0]['merchant_phone']) ? $aMerchantMsgArr['msg'][0]['merchant_phone'] : '';
			$info['address'] = isset($aMerchantMsgArr['msg'][0]['address']) ? $aMerchantMsgArr['msg'][0]['address'] : '';
			$info['pro'] = isset($aMerchantMsgArr['msg'][0]['pro']) ? $aMerchantMsgArr['msg'][0]['pro'] : '';
			$info['city'] = isset($aMerchantMsgArr['msg'][0]['city']) ? $aMerchantMsgArr['msg'][0]['city'] : '';
			$info['area'] = isset($aMerchantMsgArr['msg'][0]['area']) ? $aMerchantMsgArr['msg'][0]['area'] : '';
			$info['merchant_per'] = isset($aMerchantMsgArr['msg'][0]['merchant_per']) ? $aMerchantMsgArr['msg'][0]['merchant_per'] : '';
			$info['merchant_traffic'] =isset($aMerchantMsgArr['msg'][0]['merchant_traffic']) ? $aMerchantMsgArr['msg'][0]['merchant_traffic'] : '';
			$info['free_service'] =isset($aMerchantMsgArr['msg'][0]['free_service']) ? $aMerchantMsgArr['msg'][0]['free_service'] : array();
			$info['merchant_desc'] =isset($aMerchantMsgArr['msg'][0]['merchant_desc']) ? $aMerchantMsgArr['msg'][0]['merchant_desc'] : '';
			$info['longitude'] =isset($aMerchantMsgArr['msg'][0]['longitude']) ? $aMerchantMsgArr['msg'][0]['longitude'] : '';
			$info['latitude'] =isset($aMerchantMsgArr['msg'][0]['latitude']) ? $aMerchantMsgArr['msg'][0]['latitude'] : '';
		}
		
		$this->render('merchantIntroduce',array('model'=>$model,'info'=>$info,'resultMsg'=>$resultMsg,"isOk"=>$isOk));
	}
	
	public function actionGetAdd(){
		$log = $_REQUEST['log']?$_REQUEST['log']:0;
		$lat = $_REQUEST['lat']?$_REQUEST['lat']:0;
		$sHttp = "http://api.map.baidu.com/geocoder/v2/?ak=AD429794c2e1fc1cfa7c408a51a28ef4&location={$lat},{$log}&output=json&pois=0";
// 		echo $sHttp;
//39.983424,116.322987
// 		$sHttp = "http://api.map.baidu.com/geocoder/v2/?ak=AD429794c2e1fc1cfa7c408a51a28ef4&location=39.983424,116.322987&output=json&pois=0";
		echo file_get_contents($sHttp);
	}
	
	public function actionMap(){
		$this->layout = "//layouts/blank";
		$long = isset($_REQUEST['long'])?$_REQUEST['long']:'116.404';
		$lat = isset($_REQUEST['lat'])?$_REQUEST['lat']:'39.915';
		$long = $long?$long:'113.27';
		$lat = $lat?$lat:'23.117';
		$this->render('map',array('long'=>$long,'lat'=>$lat));
	}
}