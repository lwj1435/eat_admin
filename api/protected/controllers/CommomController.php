<?php
class CommomController extends BaseController{
	public function actionMerComList(){
		$aData = json_decode($_REQUEST['d'],true);
		//$aData = $_REQUEST;
		// 		$aData = $_REQUEST;
		$iMerId =  isset($aData['merchant_id'])?$aData['merchant_id']:'1';
		$o = new ArticleModel();
		$aArticleArr = $o->getMerArticle("*",$iMerId);
		$reArr = array();
		foreach ($aArticleArr as $o){
			$re = array();
			$re['id'] = $o->id;
			$re['parent_id'] = $o->parent_id;
			$re['conment'] = $o->conment;
			$re['type'] = $o->type;
			$re['article_time'] = $o->article_time;
			$re['modify_time'] = $o->modify_time;
			$re['user_id'] = $o->user_id;
			$re['account_name'] = $o->account_name;
			$re['follow_num'] = $o->follow_num;
			$re['per'] = $o->per;
			$re['status'] = $o->status;
			$re['evaluate'] = $o->evaluate;
			$re['image_list'] = $o->image_list;
			$reArr[] = $re;
		}
		BaseFunctions::outputResult(true, $reArr);
	}
	
	public function actionAddCommon(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerId =  isset($aData['merchant_id'])?$aData['merchant_id']:'1';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'1';
		$sContext =  isset($aData['context'])?$aData['context']:'test';
		$fEvaluate = isset($aData['evaluate'])?$aData['evaluate']:'5';
		$fPer = isset($aData['per'])?$aData['per']:'10.0';
		$aImageList = isset($aData['image_list'])?$aData['image_list']:'';
		$o = new ArticleModel();
		$re = $o->addCommon($iMerId,$sContext,$fEvaluate,$fPer,$aImageList,$iUserId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionText(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerId =  isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$sContext =  isset($aData['a'])?$aData['a']:array();
		BaseFunctions::ouputToString($sContext);
	}
}
?>