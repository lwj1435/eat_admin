<?php

class SiteController extends Controller
{
	
	public function actionTm(){
		Yii::app()->cache->set('testMemcache', "100", 10);
		echo Yii::app()->cache->get('testMemcache');
	}

	public function actionIndex()
	{
//		$_SERVER['HTTP_REFERER']
		if(Yii::app()->user->isGuest == true)
		{
			$this->redirect($this->createUrl('site/Login'));
		}
		$this->render('index');
	}

	public function actionLogin()
	{

		$this->layout = '//layouts/blank.php';
		
		if(Yii::app()->user->isGuest == false){
			$this->redirect($this->createUrl('site/index'));
		}
		
		$model=new LoginForm;
		
		
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			BaseFunctions::writeLog(json_encode($_POST['LoginForm']));
			BaseFunctions::writeLog($model->validate());
			if ($model->validate()) {
					BaseFunctions::writeLog("begin--------------------------------------------------------->");
				if($model->login())
				{
					BaseFunctions::writeLog("login--------------------------------------------------------->");
					BaseFunctions::writeLog($this->createUrl('site/index'));
					$this->redirect($this->createUrl('site/index'));
				}
			BaseFunctions::writeLog("out--------------------------------------------------------->");
			}
		}
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		
		Yii::app()->cache->delete('username_'.Yii::app()->user->id);
		Yii::app()->cache->delete('mkey_'.Yii::app()->user->id);
		
		Yii::app()->user->logout();
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		$this->redirect($this->createUrl('site/Login'));
	}
	
	
	public function actionAdminLogin()
	{
		if(isset($_REQUEST['username'])&&isset($_REQUEST['password'])) 
		{
			$username = htmlspecialchars(trim($_REQUEST['username']));
			$password = htmlspecialchars(trim($_REQUEST['password']));
			$ip = htmlspecialchars(trim($_REQUEST['ip']));
			
			$user = new Admin();
			$userobj = $user->find('userName=:userName', array(':userName'=>$username));
			
			if($userobj == null)
			{
				echo json_encode(array('errorCode'=>5,'message'=>'用户名或者密码错误'));
				Yii::app()->end();
			}
			
			if($userobj->userPassword!=$password){
				echo json_encode(array('errorCode'=>5,'message'=>'用户名或者密码错误'));
				Yii::app()->end();
			}
			$now = time();
			$key = base64_encode($userobj->userId.":".$userobj->userName.":".$now);
			
			Yii::import('ext.dao.MRedisClass');
			$mredis = new MRedisClass;
			$conn = $mredis->getConnect();
			$conn->hMset('user:'.$userobj->userId, array('username' => $userobj->userName, 'thisLoginTime' => $now));
			$conn->setTimeout('user:'.$userobj->userId, 3600*24);
			$conn->close();
			
			User::model()->updateAll(array('lastLoginTime'=>$userobj->thisLoginTime,'thisLoginTime'=>$now,'lastLoginIp'=>$userobj->thisLoginIp,'thisLoginIp'=>$ip),'userId=:userId',array(':userId'=>$userobj->userId));
			
			echo json_encode(array('errorCode'=>0,'key'=>$key,'username'=>$userobj->userName,'uid'=>$userobj->userId,'time'=>$now));
			Yii::app()->end();
			
		}else{
			echo json_encode(array('errorCode'=>4,'message'=>'用户名或密码不能为空'));
			Yii::app()->end();
		}
	}
	
	public function actionT(){
		$result = HttpClient("site/adminlogin", array('username'=>"test",'password'=>"123456",'ip'=>"127.0.0.1"));
		//BaseFunctions::writeLog(json_encode($result));
	}
	
	public function actionT2(){
		$this->render('upload');
	}
	
	public function actionUp(){
		error_reporting(E_ALL | E_STRICT);
		$sParamName = isset($_REQUEST['videofiles'])?$_REQUEST['videofiles']:'files';
		$upload_handler = new UploadHandler(array('param_name'=>$sParamName));
	}
	
	public function action404()
	{
		echo "404";
	}
	
	public function actionError()
	{
		echo "404";
	}
}