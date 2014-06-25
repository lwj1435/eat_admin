<?php
class MsgController extends BaseController
{
	public function actionReplayMsg(){
		BaseFunctions::writeLog(json_encode($_REQUEST));
		$aData = json_decode($_REQUEST['d'],true);
		
		$reply_id = isset($aData['reply_id'])?$aData['reply_id']:'';
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$user_id = isset($aData['user_id'])?$aData['user_id']:'';
		$content = isset($aData['content'])?$aData['content']:'';
		
		$o = new TalkMsg();
		$re = $o->replyMsg($reply_id,$user_id,$merchant_id,$content);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionAddServerMsg(){
		$o = new ServerMsgModel();
		$aData = json_decode($_REQUEST['d'],true);
		$content = isset($aData['content'])?$aData['content']:'';
		$detail_content = isset($aData['detail_content'])?$aData['detail_content']:'';
		$userId = isset($aData['user_id'])?$aData['user_id']:'';
		$merId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$re = $o->addServerReply($content,$detail_content,$userId,$merId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionMsgList(){
		$aData = json_decode($_REQUEST['d'],true);
		$content = isset($aData['content'])?$aData['content']:'';
		$userId = isset($aData['user_id'])?$aData['user_id']:'';
		$merId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$pageVar = isset($aData['pageNum'])?$aData['pageNum']:1;
		$iSeatType = isset($aData['status'])?$aData['status']:0;
		$iCount = isset($aData['count'])?$aData['count']:1;
		$iPageNum = 10;
		$iCount = $iCount<1?1:$iCount;
		$pageVar= $pageVar<1?1:$pageVar;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		
		$deFoultCondition = ' first_id <> 0 and to_merchant_id = '.$merId;
		
		$allcriteria = new CDbCriteria();
		
		$allcriteria->order = 'id DESC';
		
		$allcriteria->condition = $deFoultCondition;
		
		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);
		
		$alllist = TalkLog::model()->findAll($allcriteria);
		
		$aReAll = array();
		foreach ($alllist as $i => $o){
			$aRe = array();
			$aRe['id'] = $o->id;
			$aRe['from_user_id'] = $o->from_user_id;
			$aRe['to_user_id'] = $o->to_user_id;
			$aRe['to_merchant_id'] = $o->to_merchant_id;
			$aRe['add_time'] = $o->add_time;
			$aRe['status'] = $o->status;
			$aRe['parent_id'] = $o->parent_id;
			$aRe['first_id'] = $o->first_id;
			$aRe['from_user_name'] = $o->from_user_name;
			$aRe['to_name'] = $o->to_name;
			$aRe['content'] = $o->content;
			$aRe['get_time'] = $o->get_time;
			$aRe['reply_time'] = $o->reply_time;
			$aRe['send_time'] = $o->send_time;
			$aRe['reply_content'] = $o->reply_content;
			$aReAll[] = $aRe;
		}
		BaseFunctions::ouputToString(array('records'=>$aReAll));
	}
	
	public function actionMsgDetail(){
		$aData = json_decode($_REQUEST['d'],true);
		$id = isset($aData['id'])?$aData['id']:'';
		$sName = isset($aData['name'])?$aData['name']:'';
		$merId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$deFoultCondition = ' first_id = '.$id.' or id =  '.$id;
		$allcriteria = new CDbCriteria();
		
		$allcriteria->order = ' send_time ASC ';
		
		$allcriteria->condition = $deFoultCondition;
		
		$allcount = TalkLog::model()->count($allcriteria);
		
		$alllist = TalkLog::model()->findAll($allcriteria);
		
		foreach ($alllist as $i => $o){
			$aRe = array();
			$aRe['id'] = $o->id;
			$aRe['from_user_id'] = $o->from_user_id;
			$aRe['to_user_id'] = $o->to_user_id;
			$aRe['to_merchant_id'] = $o->to_merchant_id;
			$aRe['add_time'] = $o->add_time;
			$aRe['status'] = $o->status;
			$aRe['parent_id'] = $o->parent_id;
			$aRe['first_id'] = $o->first_id;
			$aRe['from_user_name'] = $o->from_user_name;
			$aRe['to_name'] = $o->to_name;
			$aRe['content'] = $o->content;
			$aRe['get_time'] = $o->get_time;
			$aRe['reply_time'] = $o->reply_time;
			$aRe['send_time'] = $o->send_time;
			$aRe['reply_content'] = $o->reply_content;
			$aReAll[] = $aRe;
		}
		BaseFunctions::ouputToString(array('records'=>$aReAll));
	}
}
