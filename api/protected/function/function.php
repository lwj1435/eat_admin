<?php
function json_message($errorCode,$param,$other=array(),$message=''){

	$data['errorCode'] = 0;
	$data['result'] = $param;
	$data['message'] = $message;
	if(!empty($other)){
		foreach ($other as $v=>$k){
			$data[$v] = $k;
		}
	}
	return json_encode($data);
}


//	$id = 132;
//	$token = encrypt($id, 'E', 'nowamagic');
//	echo '加密:'.encrypt($id, 'E', 'nowamagic');
//	echo '<br />';
//	echo '解密：'.encrypt($token, 'D', 'nowamagic');

/*********************************************************************
 函数名称:encrypt
 函数作用:加密解密字符串
 使用方法:
 加密     :encrypt('str','E','nowamagic');
 解密     :encrypt('被加密过的字符串','D','nowamagic');
 参数说明:
 $string   :需要加密解密的字符串
 $operation:判断是加密还是解密:E:加密   D:解密
 $key      :加密的钥匙(密匙);
 *********************************************************************/
function encrypt($string,$operation,$key='')
{
	$key=md5($key);
	$key_length=strlen($key);
	$string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
	$string_length=strlen($string);
	$rndkey=$box=array();
	$result='';
	for($i=0;$i<=255;$i++)
	{
		$rndkey[$i]=ord($key[$i%$key_length]);
		$box[$i]=$i;
	}
	for($j=$i=0;$i<256;$i++)
	{
		$j=($j+$box[$i]+$rndkey[$i])%256;
		$tmp=$box[$i];
		$box[$i]=$box[$j];
		$box[$j]=$tmp;
	}
	for($a=$j=$i=0;$i<$string_length;$i++)
	{
		$a=($a+1)%256;
		$j=($j+$box[$a])%256;
		$tmp=$box[$a];
		$box[$a]=$box[$j];
		$box[$j]=$tmp;
		$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
	}
	if($operation=='D')
	{
		if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
		{
			return substr($result,8);
		}
		else
		{
			return'';
		}
	}
	else
	{
		return str_replace('=','',base64_encode($result));
	}
}


class Ender{
	private $enkey;//加密解密用的密钥
	private $rep_char='#';//替换加密后的base64字符串中的=,因为=在有些场合是禁止使用的，
	//这里可以用一个允许的字符作为替换。
	//构造参数是密钥
	public function __construct($key=''){
		if(!$key){
			$this->enkey=$key;
		}
	}
	//设置密钥
	public function set_key($key){
		$this->enkey=$key;
	}
	private function keyED($txt,$encrypt_key)
	{
		$encrypt_key = md5($encrypt_key);
		$ctr=0;
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++)
		{
			if ($ctr==strlen($encrypt_key)) $ctr=0;
			$tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1);
			$ctr++;
		}
		return $tmp;
	}
	//加密字符串
	public function encrypt($txt,$key='')
	{
		if(!$key){
			$key=$this->enkey;
		}
		srand((double)microtime()*1000000);
		$encrypt_key = md5(rand(0,32000));
		$ctr=0;
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++)
		{
			if ($ctr==strlen($encrypt_key)) $ctr=0;
			$tmp.= substr($encrypt_key,$ctr,1) .
			(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
			$ctr++;
		}
		$r=base64_encode($this->keyED($tmp,$key));
		$r=str_replace('=',$this->rep_char,$r);
		return $r;
	}
	//解密字符串
	public function decrypt($txt,$key='')
	{
		$txt=str_replace($this->rep_char,'=',$txt);
		$txt=base64_decode($txt);
		if(!$key){
			$key=$this->enkey;
		}
		$txt = $this->keyED($txt,$key);
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++)
		{
			$md5 = substr($txt,$i,1);
			$i++;
			$tmp.= (substr($txt,$i,1) ^ $md5);
		}
		return $tmp;
	}

}




//! defined ( 'WORKSPACE' ) && exit ( "Access Denied !" );
class MD5Crypt {
	/**
	 * Enter description here ...
	 * @param unknown_type $str
	 * @return string
	 */
	public final static function mdsha($str) {
		$code = substr ( md5 ( $str ), 10 );
		$code .= substr ( sha1 ( $str ), 0, 28 );
		$code .= substr ( md5 ( $str ), 0, 22 );
		$code .= substr ( sha1 ( $str ), 16 ) . md5 ( $str );
		return self::chkToken () ? $code : null;
	}
	/**
	 * Enter description here ...
	 * @param unknown_type $param
	 */
	private final static function chkToken() {
		return true;
	}
	/**
	 * Enter description here ...
	 * @param unknown_type $txt
	 * @param unknown_type $encrypt_key
	 * @return Ambigous <string, boolean>
	 */
	private final static function keyED($txt, $encrypt_key) {
		$encrypt_key = md5 ( $encrypt_key );
		$ctr = 0;
		$tmp = "";
		for($i = 0; $i < strlen ( $txt ); $i ++) {
			if ($ctr == strlen ( $encrypt_key ))
				$ctr = 0;
			$tmp .= substr ( $txt, $i, 1 ) ^ substr ( $encrypt_key, $ctr, 1 );
			$ctr ++;
		}
		return $tmp;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $txt
	 * @param unknown_type $key
	 * @return string
	 */
	public final static function Encrypt($txt, $key) {
		srand ( ( double ) microtime () * 1000000 );
		$encrypt_key = md5 ( rand ( 0, 32000 ) );
		$ctr = 0;
		$tmp = "";
		for($i = 0; $i < strlen ( $txt ); $i ++) {
			if ($ctr == strlen ( $encrypt_key ))
				$ctr = 0;
			$tmp .= substr ( $encrypt_key, $ctr, 1 ) . (substr ( $txt, $i, 1 ) ^ substr ( $encrypt_key, $ctr, 1 ));
			$ctr ++;
		}
		$_code = md5 ( $encrypt_key ) . base64_encode ( self::keyED ( $tmp, $key ) ) . md5 ( $encrypt_key . $key );
		return self::chkToken () ? $_code : null;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $txt
	 * @param unknown_type $key
	 * @return Ambigous <string, boolean>
	 */
	public final static function Decrypt($txt, $key) {
		$txt = self::keyED ( base64_decode ( substr ( $txt, 32, - 32 ) ), $key );
		$tmp = "";
		for($i = 0; $i < strlen ( $txt ); $i ++) {
			$md5 = substr ( $txt, $i, 1 );
			$i ++;
			$tmp .= (substr ( $txt, $i, 1 ) ^ $md5);
		}
		return self::chkToken () ? $tmp : null;
	}
	
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	private static $_key = 'lau';
}

//使用方法：

//define ( 'WORKSPACE', '.' . DIRECTORY_SEPARATOR );
//header ( "Content-Type: text/html; charset=utf-8" );
//
//include_once 'Core/Library/MD5Crypt.class.php';
//
//$a = MD5Crypt::Encrypt ( "A", 100 );
//echo "EnCode:" . $a, "<br />";
//echo "DeCode:" . MD5Crypt::Decrypt ( $a, 100 );


function getContentImgUrl($content)
{
	preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$content,$match);
	return $match[2];
}
//$ender=new Ender();
//
//$ender->set_key('jiubugaosuni');//设置密钥
//
//$str1='abc中文哦';
//
//$str2= $ender->encrypt($str1);
//
//$str3=$ender->decrypt($str2);
//
//echo $str1.'<br/>'.$str2.'<br/>'.$str3;
