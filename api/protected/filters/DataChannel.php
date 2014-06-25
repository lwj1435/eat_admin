<?php

class DataChannel extends CFilter {
	protected function preFilter($filterChain)
	{
		if ($this->checkData($_REQUEST)) {
			return true;
		}
		echo BaseFunctions::ouputToString(BaseFunctions::returnResult(false, "错误验证"));
		return false;
	}
	
	protected function postFilter($filterChain)
	{
		
	}
}

?>