<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends SBaseController//CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/sidebar';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function httpClient($url,$data=array())
	{
		$client = HttpClientClass::quickPost(Yii::app()->params['api'].$url, $data);
		$result = json_decode($client->getContent(),true);
		if (isset($result['type'])&&isset($result['msg'])) {
			if(!$result['type']&&$result['msg'] == 100||$client->getContent() == NULL)
			{
				Yii::app()->user->logout();
				Yii::app()->session->clear();
				Yii::app()->session->destroy();
				echo LoginTimeOutAlert();
				Yii::app()->end();
			}
		}
		return $result;
	}
	
	public function dataChannel($sAction,$sFunc,$data=array())
	{
		//data 
		$t = time();
		$iRand = rand(1,1000);
		$sStr = is_array($data)?json_encode($data):$data;
		$aSendArr = array('k'=>$this->encodeStr($data,$t),'d'=>$sStr,'t'=>$t,'p'=>$iRand);
		
		$client = HttpClientClass::quickPost(Yii::app()->params['api'].$sAction."/".$sFunc, $aSendArr);
		$result = json_decode($client->getContent(),true);
		if (isset($result['type'])&&isset($result['msg'])) {
			if(!$result['type']&&$result['msg'] == 100||$client->getContent() == NULL)
			{
				Yii::app()->user->logout();
				Yii::app()->session->clear();
				Yii::app()->session->destroy();
				echo LoginTimeOutAlert();
				Yii::app()->end();
			}
		}
		return $result;
	}
	
	public function encodeStr($data,$time){
		$key = 'mmzybydxwdjcl';
		$sStr = is_array($data)?json_encode($data):$data;
		return md5(json_encode($data).$time.$key);
	}
	
	public function tempA($aData){
		echo "<xmp>";
		print_r($aData);
		echo "</xmp>";
	}
	
	public function tempAlert($str="lala"){
		echo "<script>alert('{$str}');</script>";
	}
	
	public function isInArray($val,$arr){
		$arr = is_array($arr)?$arr:$this->stringAndArray($arr);
		BaseFunctions::writeLog($val." <-------> ".json_encode($arr));
		foreach ($arr as $iK=>$v){
			if ($v == $val) {
				return true;
			}
		}
		return false;
	}
	
// 	/**
// 	 *
// 	 * @param unknown $data
// 	 * @param bool $bType 如果是true就是string转换成数组，若果是false那么就是数组转string
// 	 * @return multitype:
// 	 */
// 	public function stringAndArray($data,$bType=true){
// 		//字符只能是一个字符
// 		$sSymbol = ",";
// 		//string to array
// 		if ($bType) {
// 			$data = trim($data);
// 			$ilen = strlen($data);
// 			if (!$data||$ilen<3) {
// 				return array();
// 			}
// 			if ($data[0]==$sSymbol) {
// 				$data = strtr($data,1);
// 			}
// 			if ($data[$ilen-1]==$sSymbol) {
// 				$data = strtr($data,0,-1);
// 			}
// 			return explode($sSymbol, $pizza);
// 		}else{
// 			if (!is_array($data)) {
// 				return $sSymbol.$sSymbol;
// 			}
// 			$sData = $sSymbol;
// 			foreach ($data as $iKey => $sVal){
// 				$sData .= $sVal.$sSymbol;
// 			}
// 			$sData .= $sSymbol;
// 			return $sData;
// 		}
// 	}
	
	/**
	 *
	 * @param unknown $data
	 * @param bool $bType 如果是true就是string转换成数组，若果是false那么就是数组转string
	 * @return multitype:
	 */
	public function stringAndArray($data,$bType=true){
		//字符只能是一个字符
		$sSymbol = ",";
		//string to array
		if ($bType) {
			$data = trim($data);
			$ilen = strlen($data);
			if (!$data||$ilen<3) {
				return array();
			}
			// 				if ($data[0]==$sSymbol) {
			// 					$data = strtr($data,1);
			// 				}
			// 				if ($data[$ilen-1]==$sSymbol) {
			// 					$data = strtr($data,0,-1);
			// 				}
			return explode($sSymbol, $data);
		}else{
			if (!is_array($data)) {
				return $sSymbol.$sSymbol;
			}
			$sData = $sSymbol;
			foreach ($data as $iKey => $sVal){
				$sData .= $sVal.$sSymbol;
			}
			$sData .= $sSymbol;
			return $sData;
		}
	}
	
	public  function getMerGoods($iRemoveId=''){
		//	GetMerGoods
		$re = $this->dataChannel("Goods", "GetMerGoods",array("merchant_id"=>Yii::app()->cache->get('merchant_'.Yii::app()->user->id)));
		$re =  $re['msg']?$re['msg']:array();
		if ($iRemoveId){
			unset($re[$iRemoveId]);
		}
		return $re;
	}
	
	public function getAllCustomer(){
		$criteria = new CDbCriteria();
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$criteria->order = 'id DESC ';
		$criteria->condition = ' mrchant_id = '.$merid;
		
		$list = CustomerMsg::model()->findAll($criteria);
		$re = array();
		foreach ($list as $o){
			$re[$o->id] = $o->c_name;
		}
		return $re;
	}
	
	public function showResult($iResult,$iType=1,$form=NULL,$model=NULL,$iTime=2000){
		if ($iResult==1) {
			$sMSG = $iType=1?"操作成功!":"删除成功";
			echo '<div class="alert alert-success alert-block"> <a class="close" id="errorDiv" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading"><span class="icon"><i class="icon-ok-sign"></i></span> '.$sMSG.'</h4>
    </div><script>
						setTimeout(function(){
							 
							 
							$("#errorDiv").click();
							 
							 
							},'.$iTime.');</script>';
		}else if($iResult==2){
			echo '<div class="alert alert-error alert-block"> <a class="close" id="errorDiv" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading"><span class="icon"><i class="icon-exclamation-sign"></i></span> 操作错误!</h4>';
			echo $form&&$model?$form->errorSummary ( $model, "","",array ('class' => 'errorMessage',) ):'';
			echo '</div><script>
						setTimeout(function(){
							 
							 
							$("#errorDiv").click();
							 
							 
							},'.$iTime.');</script>';
			
		}else if($iResult==3){
			
		}else{
		}
	}
	
	public function showResultSuper($iResult,$iType=1,$sErrMsg=NULL,$iTime=2000){
		if ($iResult==1) {
			$sMSG = $iType=1?"操作成功!":"删除成功";
			echo '<div class="alert alert-success alert-block"> <a class="close" id="errorDiv" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading"><span class="icon"><i class="icon-ok-sign"></i></span> '.$sMSG.'</h4>
    </div><script>
						setTimeout(function(){
	
	
							$("#errorDiv").click();
	
	
							},'.$iTime.');</script>';
		}else if($iResult==2){
			echo '<div class="alert alert-error alert-block"> <a class="close" id="errorDiv" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading"><span class="icon"><i class="icon-exclamation-sign"></i></span> 操作错误!</h4>';
			echo $sErrMsg;
			echo '</div><script>
						setTimeout(function(){
	
	
							$("#errorDiv").click();
	
	
							},'.$iTime.');</script>';
				
		}else if($iResult==3){
				
		}else{
		}
	}
	
	public function showDoingDiv(){
		echo '<div class="alert" id="doingDiv" style="display: none;"> <a class="close" data-dismiss="alert" href="#">×</a>
		<div style="text-align:center;"><strong>操作处理加载中,请稍后.....</strong></div>
		</div>';
	}
	


	public function isExit($arr,$key){
		foreach ($arr as $a){
			if (isset($a['id'])) {
				if ($a['id']==$key) {
					return $a['id'];
				}
			}
		}
		return false;
	}
}