<?php

class SiteController extends Controller
{	
	public function actionAdminLogin()
	{
		if(isset($_REQUEST['username'])&&isset($_REQUEST['password'])) 
		{
			$username = htmlspecialchars(trim($_REQUEST['username']));
			$password = htmlspecialchars(trim($_REQUEST['password']));
			$ip = htmlspecialchars(trim($_REQUEST['ip']));
			
			
			$user = new User();
			$userobj = $user->find('account_name=:userName and type = 2', array(':userName'=>$username));
			
			if($userobj == null)
			{
				echo json_encode(array('errorCode'=>5,'message'=>'用户名或者密码错误'));
				Yii::app()->end();
			}
			
			if($userobj->password!=$password){
				echo json_encode(array('errorCode'=>5,'message'=>'用户名或者密码错误'));
				Yii::app()->end();
			}
			$now = time();
			
			$key = MD5Crypt::Encrypt ( $userobj->id.":".$userobj->username.":".$now, 100 );
			
			$mredis = new MRedisClass;
			$conn = $mredis->getConnect();
			$mredis->add('user:'.$userobj->id, array('username' => $userobj->username, 'this_login_time' => $now),'hash');
			$conn->setTimeout('user:'.$userobj->id, 3600*24);
			$conn->close();
			
			User::model()->updateAll(array('last_login_time'=>$userobj->this_login_time,'this_login_time'=>$now,'last_login_ip'=>$userobj->last_login_ip,'this_login_ip'=>$ip),'id=:userId',array(':userId'=>$userobj->id));
			
			echo json_encode(array('errorCode'=>0,'key'=>$key,'username'=>$userobj->username,'uid'=>$userobj->id,'time'=>$now,'merchantId'=>$userobj->merchant_id));
			Yii::app()->end();
			
		}else{
			echo json_encode(array('errorCode'=>4,'message'=>'用户名或密码不能为空'));
			Yii::app()->end();
		}
	}
	
	public function actionError(){
		if($error=Yii::app()->errorHandler->error){
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}else{
			$this->render('404');
		}
	}
	
	public function actionAdminLogout()
	{
		Yii::import('ext.dao.MRedisClass');
		$mredis = new MRedisClass;
		$conn = $mredis->getConnect();
		$conn->del('user:'.$id);
		$conn->close();
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		
        $model=new LoginForm;  
  
        // collect user input data  
        if(isset($_POST['username'])&&isset($_POST['password']))  
        {  
            $model->attributes=$_POST['LoginForm'];  
            // validate user input and redirect to the previous page if valid  
            if($model->validate() && $model->login())  
            {  
                //ucenter  
//                Yii::import('application.vendors.ucenter');  
//                include_once 'ucenter.php';  
                $script = uc_user_synlogin(Yii::app()->user->id);  
                $this->render('loginsuc', array('script' => $script));  
                Yii::app()->end();  
            }  
        }  
        // display the login form  
        $this->render('login',array('model'=>$model));  
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        Yii::app()->user->logout();  
        //ucenter  
//        Yii::import('application.vendors.ucenter');  
//        include_once 'ucenter.php';  
        $script = uc_user_synlogout();  
        $this->render('logoutsuc', array('script' => $script));  
        Yii::app()->end(); 
	}
	
	/**
	 * test redirs
	 */
	public function actionRtest(){
		Yii::app()->redis->getClient()->set("myKey", "Your Value");
		echo Yii::app()->redis->getClient()->get("myKey"); // outputs "Your Value"
		Yii::app()->redis->getClient()->del("myKey"); // deletes the key
	}
	
	/**
	 * test redirs list
	 */
	public function actionRlist(){
		$list = new ARedisList("animal");
		$list->add("cats");
		$list->add("dogs");
		$list->add("fish");
		foreach($list as $i => $val) {
			echo $val." ";
		}
		$list->clear(); // delete the list
	}
	
	/**
	 * test redirs set
	 */
	public function actionRSet(){
		$set = new ARedisSet("aNameForYourSet");
		$set->add(1);
		$set->add(2);
		$set->add(3);
		echo $set->count; // outputs 3
		$set->add(3);
		echo $set->count; // still 3, cannot add the same value more than once
		foreach($set as $val) {
			echo $val." ";
		}
	}
	
	/**
	 * test redirs store set
	 */
	public function actionRSSet(){
		$sortedSet = new ARedisSortedSet("aNameForYourSortedSet");
		$sortedSet->add("myValue", 0.4);
		$sortedSet->add("myOtherValue", 0.8);
		$sortedSet->add("myOtherOtherValue", 0.9);
		foreach($sortedSet as $key => $score) {
			echo $key.": ".$score." ";
		}
	}
	
	/**
	 * hash test
	 * //TODO have problem
	 */
	public function actionRhash(){
		$hash = new ARedisHash("myHashNameHere");
		$hash->whatever = "someValue";
		$hash->greeting = "hello world";
		echo $hash->count; // outputs 2
	}
	
	/**
	 * test redirs other
	 */
	public function actionRother(){
		//Using Redis for Counters
	
		//Often we need to store counters for a particular database table or row, with YiiRedis this is fast and easy.
	
		$counter = new ARedisCounter("totalPageViews");
		$counter->increment();
		echo $counter->getValue();
		//Using Redis for Mutexes
	
		//Mutexes are useful to ensure that only one client can access a particular resources at a time.
	
		$mutex = new ARedisMutex("someOperation");
		$mutex->block(); // blocks execution until the resource becomes available
		// do something
		$mutex->unlock(); // release the lock
	}
	
	/**
	 * tset file bug write
	 */
	public function actionFileBugTest(){
		BaseFunctions::writeLog("test");
	}
	
	public function actionMysqlTest(){
		//$oMysql = new MySqlClass();
		$aParam = array(
				"name"=>array('type'=>'string','val'=>"李文锦22"),
				"psw"=>array('type'=>"string","val"=>"123456"),
				"birthday"=>array('type'=>"date","val"=>"2014-03-03")
		);
		echo "<xmp>";
		print_r(Yii::app()->objMySql->add("user", $aParam, true));
		//var_dump($oMysql->add("user", $aParam, true));
		echo "</xmp>";
	}
	
	public function actionMysqlTestUpdate(){
		$oMysql = new MySqlClass();
		$aParam = array(
				"name"=>array('type'=>'string','val'=>"lalala"),
				"psw"=>array('type'=>"string","val"=>"123456"),
				"birthday"=>array('type'=>"date","val"=>"2014-03-03")
		);
		echo "<xmp>";
		var_dump($oMysql->update("user", "id = 1", $aParam, true));
		echo "</xmp>";
	}
	
	public function actionMysqlTestDel(){
		$oMysql = new MySqlClass();
		echo "<xmp>";
		var_dump($oMysql->del("user", "id = 3", true));
		echo "</xmp>";
	}
	
	public function actionMysqlTestPage(){
		$oMysql = new MySqlClass();
		echo "<xmp>";
		var_dump($oMysql->pageGet("*", "user", "1", 1, 10, '', '', true,true));
		echo "</xmp>";
	}
	
	public function actionRedisAdd(){
		Yii::app()->redis->getClient()->set("myKey", "李文锦1");
		echo Yii::app()->redis->getClient()->get("myKey"); // outputs "Your Value"
		if (Yii::app()->redis->getClient()->exists("myKey1")){
			//Yii::app()->redis->getClient()->del("myKey");
		}else{
			echo "11111111111111111111111111111";
		}
		//Yii::app()->redis->getClient()->del("myKey");
		//Yii::app()->redis->getClient()->del("myKey"); // deletes the key
	}
	
	public function actionRedislist(){
		// 		$list = new ARedisList("aNameForYourListGoesHere");
		// 		$list->add("cats");
		// 		$list->add("dogs");
		// 		$list->add("fish");
		// 		foreach($list as $i => $val) {
		// 			echo $val." ";
		// 		}
		$list2 = new ARedisList("aNameForYourListGoesHere");
		foreach($list2 as $i => $val) {
			echo $val." ";
		}
		//$list->clear(); // delete the list
	}
	
	/*
	 * test redis set
	*/
	public function actionRedisSet(){
		$set = new ARedisSet("aNameForYourSet");
		$set->add(1);
		$set->add(2);
		$set->add(3);
		echo $set->count; // outputs 3
		$set->add(3);
		echo $set->count; // still 3, cannot add the same value more than once
		foreach($set as $val) {
			echo $val." ";
		}
	}
	
	/*
	 * test redis set
	*/
	public function actionRedisSetGet(){
		$set = new ARedisSet("aNameForYourSet");
		echo $set->count; // still 3, cannot add the same value more than once
		foreach($set as $val) {
			echo $val." ";
		}
	}
	
	/**
	 * test redis store set key => value
	 */
	public function actionRedisStoreSet(){
		$sortedSet = new ARedisSortedSet("aNameForYourSortedSet");
		$sortedSet->add("myValue", 0.4);
		$sortedSet->add("myOtherValue", 0.4);
		$sortedSet->add("myOtherOtherValue", 0.9);
		foreach($sortedSet as $key => $score) {
			echo $key.": ".$score." ";
		}
	}
	
	/**
	 * test redis hash
	 */
	public function actionRedisHash(){
		//Yii::app()->redis->getClient()->hset("123","789", "lwj");
	
		$hash = new ARedisHash("myweb");
		$hash->add("yahoo", "yahoo.com");
		$hash->add("yahoo", "baidu.com");
		$hash->add("baidu", "yahoo.com");
		echo "<xmp>";
		//var_dump($hash);
		var_dump($hash->getData());
		echo "</xmp>";
		echo $hash->count; // outputs 2
		echo "<br/>--------------------------------<br/>";
		$hash = new ARedisHash("myweb2");
		echo "<xmp>";
		//var_dump($hash);
		var_dump($hash->getData());
		echo "</xmp>";
		echo $hash->count; // outputs 2
		echo "<br/>--------------------------------<br/>";
		$hash = new ARedisHash("myweb");
		echo "<xmp>";
		//var_dump($hash);
		var_dump($hash->getData());
		echo "</xmp>";
		echo $hash->count; // outputs 2
	}
	
	/**
	 * test redis hash
	 */
	public function actionRedisHashGet(){
		//Yii::app()->redis->getClient()->hset("123","789", "lwj");
	
		$hash = new ARedisHash("myweb");
		echo "<xmp>";
		//var_dump($hash);
		var_dump($hash->getData());
		echo "</xmp>";
	
	}
	
	/**
	 * test redis my extends
	 */
	public function actionRedisMyTestAdd(){
		//add
		$OMyRedis = new MyRedisClass();
		$aParam = array(
				"name"=>array('type'=>'string','val'=>"李文锦"),
				"psw"=>array('type'=>"string","val"=>"123456"),
				//hash
				"pswHash"=>array('type'=>"hash","val"=>array("psw1"=>"123","psw2"=>"321")),
				//set
				"pswSet"=>array('type'=>"set","val"=>array("psw1"=>"123","psw2"=>"321")),
				//storeset
				"pswStoreset"=>array('type'=>"storeset","val"=>array("psw1"=>"123","psw2"=>"321")),
				//list
				"pswlist"=>array('type'=>"list","val"=>array("psw1"=>"123","psw2"=>"321")),
				"id"=>array('type'=>'string','val'=>"156"),
				"&pri"=>"id"
				//"birthday"=>array('type'=>"date","val"=>"2014-03-03")
		);
		echo "<xmp>";
		var_dump(Yii::app()->objRedis->add("user", $aParam, true));
		echo "</xmp>";
		//update
		//del
	}
	
	/**
	 * test redis my extends
	 */
	public function actionRedisMyTestDel(){
		//del
		$OMyRedis = new MyRedisClass();
		$aParam = array(
				"name"=>array('type'=>'string','val'=>"sssssssssssssssssssssssssss"),
				"psw"=>array('type'=>"string","val"=>"123456"),
				//hash
				"pswHash"=>array('type'=>"hash","val"=>array("psw1"=>"123","psw2"=>"321")),
				//set
				"pswSet"=>array('type'=>"set","val"=>array("psw1"=>"123","psw2"=>"321")),
				//storeset
				"pswStoreset"=>array('type'=>"storeset","val"=>array("psw1"=>"123","psw2"=>"321")),
				//list
				"pswlist"=>array('type'=>"list","val"=>array("psw1"=>"123","psw2"=>"321")),
				//"birthday"=>array('type'=>"date","val"=>"2014-03-03")
		);
		echo "<xmp>";
		var_dump($OMyRedis->del("user", $aParam, true));
		echo "</xmp>";
		//update
		//del
	}
	
	public function actionBaseModel(){
		$oModel = new BaseModel("user");
		echo "<xmp>";
		print_r($oModel);
		echo "</xmp>";
	
		$oModel->test($oModel->add(array("id"=>"","userName"=>"testUser","userPsw"=>"testPssword"),true));
		//ok
	}
	
	public function actionBaseModelDel(){
		$oModel = new BaseModel("user");
		echo "<xmp>";
		print_r($oModel);
		echo "</xmp>";
		$oModel->test($oModel->delById(137,true));
		//ok
	}
	
	public function actionBaseModelFind(){
		$oModel = new BaseModel("user");
		echo "<xmp>";
		print_r($oModel);
		echo "</xmp>";
		$oModel->test($oModel->findById(130,true));
		//ok
	}
	
	public function actionBaseModelUpdate(){
		$oModel = new BaseModel("user");
		$oModel->test($oModel);
		$aParam = array("userName"=>"test222User","userPsw"=>"testPsswo22rd");
		//$oModel->updateById(121, $aParam);
		$oModel->test($oModel->updateById(121,$aParam,true));
	}

	public function actionTMerchant(){
		$oModel = new Merchant();
		$oModel->test($oModel);
	}
	
	public function actionTBook(){
		$oModel = new Book();
		$oModel->test($oModel);
	}
	
	public function actionTTakeOut(){
		$oModel = new TakeOut();
		$oModel->test($oModel);
	}
}