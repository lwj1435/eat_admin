<?php
class ArticleClass
{
	
//	public function getPostByPage($params,$page,$offset,$sort,$asc = 'DESC')
//	{
//		$mredis = new MRedisClass();
//		$conn = $mredis->getConnect();
//		
//		$sort['BY'] = $sort;
//		$sort['SORT'] = $asc;
//		$par = array();
//		foreach($params as $param)
//		{
//			$par = $param."_";
//		}
//		$sort['GET'] = $par;
//		$sort['limit'] = array($page,$offset);
//		
//		if($catalogId){
//			$result = $conn->sort('catalog_postId',$sort);
//		}else{
//			$result = $conn->sort('postId',$sort);
//		}	
//		$conn->close();
//	}

	public function searchPost($key,$catalogId,$page,$offset,$sort,$asc = 'DESC') 
	{
		$condition = ' and del=0 ';
		if($key)
		{
			 $condition .= " and `postTitle` like '%$key%";
		}
		
		if($catalogId)
		{
			$catalogStr = implode(",", $catalogId) ;
			$condition = " and catalogId in ($catalogId) ";
		}
		
		if($sort)
		{
			$condition .= " order by  $sort $asc ";
		}
		
		$limit = '';
		if($page)
		{
			$limit .= " limit $page,$offset ";
		}

		$sql = "select * from `l_post` where 1 $condition $limit";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		
		$sqlcount = "select count(1) as count from `l_post` where 1 $condition ";
		$count = Yii::app()->db->createCommand($sqlcount)->queryAll();
		
		
		return array('result'=>$result,'count'=>$count[0]['count']);
	}

	public function AddPost($postTitle, $postLitpic,$catalogId,$postKeyword,$postContent,$postUpdateTime,$addUserId)
	{
		$sql = "INSERT INTO `l_post` (`postTitle`, `postLitpic`,`catalogId`,`postKeyword`,`postContent`,`postUpdateTime`,`addUserId`,`del`) VALUES ('$postTitle', '$postLitpic','$catalogId','$postKeyword','$postContent','$postUpdateTime','$addUserId','0')";
		Yii::app()->db->createCommand($sql)->execute();
		$post_id = Yii::app()->db->getLastInsertID();
		if($menu_id){
			$mredis = new MRedisClass();
			$conn = $mredis->getConnect();
			$conn->rPush('postId',$post_id);
			$conn->mset(array(
				'postTitle_'.$menu_id=>$menu_name,
				'postLitpic_'.$menu_id=>$menu_type,
				'catalogId_'.$menu_id=>$menu_desc,
				'postKeyword_'.$menu_id=>$menu_keyword,
				'postContent_'.$menu_id=>$menu_content,
				'addUserId_'.$menu_id=>$menu_parentid
			));
			$conn->close();
			return true;
		}else{
			return false;
		}
	}
	
	public function getPostById($id)
	{
		$mredis = new MRedisClass();
		$conn = $mredis->getConnect();
		
		$catalogName = $conn->get('postTitle_'.$id);
		if($catalogName){
			
			$temp['postId'] = $id;
			$temp['postTitle'] = $conn->get('catalogName_'.$menu_id);
			$temp['postLitpic'] = $conn->get('catalogType_'.$menu_id);
			$temp['catalogId'] = $conn->get('catalogDesc_'.$menu_id);
			$temp['postKeyword'] = $conn->get('catalogKeyword_'.$menu_id);
			$temp['postContent'] = $conn->get('catalogContent_'.$menu_id);
			$temp['addUserId'] = $conn->get('catalogParentId_'.$menu_id);
		}else{
			$sql = "select * from `l_post` where del=0 and postId = '$id'";
			$menus = Yii::app()->db->createCommand($sql)->queryAll();
			$temp = $menus[0];
		}
		$conn->close();
		
		return $temp;
	}

	public function UpdatePost($id,$params=array())
	{
		$mredis = new MRedisClass();
		$conn = $mredis->getConnect();
		
		$paramarr = array();
		foreach($params as $key=>$value){
			if($conn->exists($key))
			{
				$conn->set($key.'_'.$menu_id,$value);
			}
			$paramarr[] = " `$key` = '$value' ";
		}
		
		$conn->close();
		
		$paramstr = implode(',', $paramarr);
		
		$sql = "update `l_post` set $paramstr  where del=0 and postId= '$id'";
		return Yii::app()->db->createCommand($sql)->execute();
		
	}

	public function DelPost($id)
	{
		$mredis = new MRedisClass();
		$conn = $mredis->getConnect();
		
		$conn->lRem('postId', $id, 0);
		$conn->delete(array('postTitle_'.$id,'postLitpic_'.$id,'catalogId_'.$id,'postKeyword_'.$id,'postContent_'.$id,'addUserId_'.$id));

		$conn->close();

		$sql = "update `l_post` set del=1 where postId = '$id'";
		return Yii::app()->db->createCommand($sql)->execute();
		
	}
}