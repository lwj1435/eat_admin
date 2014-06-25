<?php
/**
 * 
 * @author Administrator
 * rule test 
 */
class RuleTest {
	/**
	 * create ruleTest object
	 */
	public function __struct(){
		$this->getRule();	
	}
	
	/**
	 * test rule 
	 * @param unknown $sRuleKey
	 * @param unknown $sStr
	 * @return array(type => �ɹ����,msg=> ������߳ɹ�����Ϣ)
	 */
	public function testRule($sRuleKey,$sStr){
		
		return array("type"=>true,"msg"=>"success");
	}
	
	/**
	 * get rule from config file
	 */
	private static function getRule(){
		//$this->aRuleArr = yii::import("application.data.RuleConfig.php");
	}
	
	public function init(){
		
	}
	
}

?>