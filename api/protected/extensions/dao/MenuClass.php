<?php
class MenuClass
{

	public $menulist;
	
	public function getMenuListBySort()
	{
		$data = $this->getAllMenu();
		$this->getMenuListSort($data,0,0);
		$result = $this->menulist;
		return $result;
	}

	
	public function getMenuListSort($data,$id = 0,$level = 0) {

		$catalogs = $data; 
		
		$level++;
		foreach($catalogs as $catalog){
			if($catalog['catalogParentId'] == $id)
			{
				$catalog['level'] = $level;
				$this->menulist[] = $catalog;
				$this->getMenuListSort($data,$catalog['catalogId'],$level);
			}
		}

		return '';
	}

	public function getAllMenu()
	{	
		$mredis = new MRedisClass();
		$conn = $mredis->getConnect();
		
		$menu_ids = $conn->lRange('catalogId',0,-1);
		
		if(!empty($menu_ids))
		{
			$menu_arr = array();
			foreach($menu_ids as $k=>$v)
			{
				$menu_id = $conn->lGet('catalogId',$k);
				$temp = array();
				$temp['catalogId'] = $menu_id;
				$temp['catalogName'] = $conn->get('catalogName_'.$menu_id);
				$temp['catalogParentId'] = $conn->get('catalogParentId_'.$menu_id);
				$temp['catalogTodayIP'] = $conn->get('catalogTodayIP_'.$menu_id);
				$temp['catalogTodayPV'] = $conn->get('catalogTodayPV_'.$menu_id);
				$temp['catalogIp'] = $conn->get('catalogIp_'.$menu_id);
				$temp['catalogPv'] = $conn->get('catalogPv_'.$menu_id);
				$temp['postNumber'] = $conn->get('postNumber_'.$menu_id);
				$temp['catalogUpdateTime'] = $conn->get('catalogUpdateTime_'.$menu_id);

				$menu_arr[] = $temp;
			}
			$return = $menu_arr;
		}else{

			$sql = "select * from `l_catalog` where catalogDel=0";
			$menus = Yii::app()->db->createCommand($sql)->queryAll();

			if(!empty($menus)){

				foreach($menus as $menu){
					
					$conn->rPush('catalogId',$menu['catalogId']);
					$conn->mset(array(
						'catalogName_'.$menu['catalogId']=>$menu['catalogName'],
						'catalogParentId_'.$menu['catalogId']=>$menu['catalogParentId'],
						'catalogTodayIP_'.$menu['catalogId']=>$menu['catalogTodayIP'],
						'catalogTodayPV_'.$menu['catalogId']=>$menu['catalogTodayPV'],
						'catalogIp_'.$menu['catalogId']=>$menu['catalogIp'],
						'catalogPv_'.$menu['catalogId']=>$menu['catalogPv'],
						'postNumber_'.$menu['catalogId']=>$menu['postNumber'],
						'catalogUpdateTime_'.$menu['catalogId']=>$menu['catalogUpdateTime']
					));
					$return[] = $menu;
				}
			}else{
				$return = false;
			}
			
		}
		$conn->close();
		return $return;
	}

	public function AddMenu($menu_name,$menu_parentid)
	{
		$now = time();
		$sql = "INSERT INTO `l_catalog` (`catalogName`,`catalogParentId`,`catalogUpdateTime`) VALUES ('$menu_name','$menu_parentid','$now')";

		Yii::app()->db->createCommand($sql)->execute();
		$menu_id = Yii::app()->db->getLastInsertID();
		if($menu_id){
			$mredis = new MRedisClass();
			$conn = $mredis->getConnect();
			$conn->rPush('catalogId',$menu_id);
			$conn->mset(array(
				'catalogName_'.$menu_id=>$menu_name,
				'catalogParentId_'.$menu_id=>$menu_parentid,
				'catalogTodayIP_'.$menu_id=>0,
				'catalogTodayPV_'.$menu_id=>0,
				'catalogIp_'.$menu_id=>0,
				'catalogPv_'.$menu_id=>0,
				'postNumber_'.$menu_id=>0,
				'catalogUpdateTime_'.$menu_id=>$now
			));
			$conn->close();
			return $menu_id;
		}else{
			return false;
		}
	}
	
	public function getMenuInfoById($id)
	{
		$mredis = new MRedisClass();
		$conn = $mredis->getConnect();
		
		$catalogName = $conn->get('catalogName_'.$id);
		if($catalogName != false){
			
			$temp['catalogId'] = $id;
			$temp['catalogName'] = $conn->get('catalogName_'.$id);
			$temp['catalogParentId'] = $conn->get('catalogParentId_'.$id);
			$temp['catalogTodayIP'] = $conn->get('catalogTodayIP_'.$id);
			$temp['catalogTodayPV'] = $conn->get('catalogTodayPV_'.$id);
			$temp['catalogIp'] = $conn->get('catalogIp'.$id);
			$temp['catalogPv'] = $conn->get('catalogPv_'.$id);
			$temp['postNumber'] = $conn->get('postNumber_'.$id);
			$temp['catalogUpdateTime'] = $conn->get('catalogUpdateTime_'.$id);
		}else{
			$sql = "select * from `l_catalog` where catalogDel=0 and catalogId= '$id'";
			$menus = Yii::app()->db->createCommand($sql)->queryRow();
			$temp = $menus;
			
			$conn->rPush('catalogId',$id);
			$conn->mset(array(
				'catalogName_'.$id=>$temp['catalogName'],
				'catalogParentId_'.$id=>$temp['catalogParentId'],
				'catalogTodayIP_'.$id=>$temp['catalogTodayIP'],
				'catalogTodayPV_'.$id=>$temp['catalogTodayPV'],
				'catalogIp_'.$id=>$temp['catalogIp'],
				'catalogPv_'.$id=>$temp['catalogPv'],
				'postNumber_'.$id=>$temp['postNumber'],
				'catalogUpdateTime_'.$id=>$temp['catalogUpdateTime']
			));
		}
		$conn->close();
		
		return $temp;
	}

	public function UpdateMenu($id,$params=array())
	{
		$mredis = new MRedisClass();
		$conn = $mredis->getConnect();
		$paramarr = array();
		foreach($params as $key=>$value){
			$conn->set($key.'_'.$id,$value);
			$paramarr[] = " `$key` = '$value' ";
		}
		
		$conn->close();
		
		$paramstr = implode(',', $paramarr);
		
		$sql = "update `l_catalog` set $paramstr  where catalogDel=0 and catalogId= '$id'";
		return Yii::app()->db->createCommand($sql)->execute();
		
	}

	public function DelMenu($ids)
	{
		$mredis = new MRedisClass();
		$conn = $mredis->getConnect();
		
		$executearr = array();
		foreach($ids as $id){
			$conn->lRem('catalogId', $id, 0);
			$conn->delete(array(
				'catalogName_'.$id,
				'catalogParentId_'.$id,
				'catalogTodayIP_'.$id,
				'catalogTodayPV_'.$id,
				'catalogIp_'.$id,
				'catalogPv_'.$id,
				'postNumber_'.$id,
				'catalogUpdateTime_'.$id
				)
			);
			$sql = "update `l_catalog` set catalogDel=1 where catalogId= '$id'";
			$executearr[$id] = Yii::app()->db->createCommand($sql)->execute();
		}
		$conn->close();
		
		return $executearr;
	}
}