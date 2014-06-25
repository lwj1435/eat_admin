<?php

class BaseController extends Controller{
		public function actionIndex()
		{
			
		}
		
		public function checkData($aRequest){
			$key = "mmzybydxwdjcl";
			if (!isset($aRequest['k'])||!isset($aRequest['d'])||!isset($aRequest['t'])) {
				return false;
			}
			$sStr = is_array($aRequest['d'])?json_encode($aRequest['d']):$aRequest['d'];

			
// 			echo $sStr.$aRequest['t'].$key;
// 			echo "----------";
// 			echo md5($sStr.$aRequest['t'].$key);
// 			echo "----------";
// 			echo $aRequest['k'];
			
			return ($aRequest['k']==md5($sStr.$aRequest['t'].$key))
				?true:false;
		}
		
// 		/**
// 		 * 类型转换
// 		 * 		s 字符串
// 		 * 		d 日期
// 		 * 		i 数字
// 		 * 		a 数组
// 		 * @param unknown $data
// 		 * @param string $ftype 
// 		 * @param unknown $ttype 
// 		 */
// 		public function dealData($data,$ftype,$ttype){
// 			switch ($ftype){
// 				case 's':
// 					return $ttype=='s'?trim($data):(
// 								$ttype=='d'?trim($data):(
// 									$ttype=='i'?trim($data):(
// 										$ttype=='a'?$this->stringAndArray($data):$data)));
// 					break;
// 				case 'd':
// 					return $ttype=='s'?$data:(
// 							$ttype=='d'?$data:(
// 									$ttype=='i'?strtotime($data):$data));
// 					break;
// 				case 'i':
// 					return $ttype=='s'?$data:(
// 							$ttype=='d'?$data:(
// 									$ttype=='i'?strtotime($data):$data));
// 					break;
// 				case 'a':
// 					break;
// 				default:
// 					return $data;
// 					break;
// 			}
// 		}
		
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


		public function changeToAr($str,$arr){
			$aStrArr = $this->stringAndArray($str);
			$aRe = array();
			foreach ($aStrArr as $iKey => $sVal){
				if ($sVal) {
					if (array_key_exists($sVal,$arr)) {
						$aRe[$sVal] = $arr[$sVal];
					}
				}
			}
			return $aRe;
		}
		
		public function getConfigArr($strFun){
			$o = new ConfigModel();
			return $o->$strFun();
		}
		
		public function test($control){
			echo "<xmp>";
			print_r($control);
			echo "</xmp>";
		}
		
		public function changeUrl($sUrl){
			if (!$sUrl) {
				return "";
			}
			return "http://testadmin.77tng.com/files/".$sUrl;
		}
}
?>