<?php
yii::import("");
/**
 * 
 * @author Administrator
 * rule test 
 */
class RuleTest {
	static private $oRuletest;
	static public function getRuleTest(){
		if ($this->oRuletest) {
			return $this->oRuletest;
		}else{
			$this->oRuletest = self::__struct();
			return $this->oRuletest;
		}
	}
	
	private function __struct(){
		
	}
	
	public function testRule($sRuleKey,$sStr){
		
		return true;
	}
}

?>