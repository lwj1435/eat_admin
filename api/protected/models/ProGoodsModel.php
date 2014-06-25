<?php
class ProGoodsModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "pro_goods";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	
	/**
	 * 添加关系
	 * @param unknown $goods_id
	 * @param unknown $pro_id
	 * @return Ambigous <boolean, unknown>
	 */
	public function addProGoods($goods_id,$pro_id){
		$aParam = array();
		$aParam["goods_id"]=$goods_id;
		$aParam["pro_id"]=$pro_id;
		return $this->add($aParam,true);
	}

	/**
	 * 删除关系 双方的关系都删除
	 * @param unknown $iGoods
	 * @param unknown $rGoodsiD
	 * @return boolean
	 */
	public function delProGoodsRelation($iGoods,$proId){
		$sWhere = " goods_id = {$iGoods} and pro_id = {$proId} ";
		$re = $this->find("*", $sWhere);
		foreach ($re['msg'] as $data){
			if ($data['id']) {
				$this->delById($data['id']);
			}
		}
		return true;
	}
	
	/**
	 * 判断是否存在
	 * @param unknown $iGoods
	 * @param unknown $proId
	 * @return boolean
	 */
	public function isExit($iGoods,$proId){
		$sWhere = " goods_id = {$iGoods} and pro_id = {$proId} ";
		$re = $this->find("*", $sWhere,true);
		return (isset($re['msg'][0]['id'])&&$re['msg'][0]['id'])?true:false;
	}
	
	/**
	 * 获取促销关联的菜品
	 * @param unknown $iPro
	 */
	public function getProRelationGoods($iPro){
		return $this->getRelationArr($iPro);
	}
	
	/**
	 * 获取菜品关联的促销
	 * @param unknown $iPro
	 */
	public function getGoodsRelationGoods($iGoods){
		return $this->getRelationArr($iGoods,false);
	}
	
	
	private function getRelationArr($id,$bType=true){
		$sKey = $bType?"pro_id":"goods_id";
		$sValKey = $bType?"goods_id":"pro_id";
		$sWhere = "  $sKey = {$id} ";
		$re = $this->find("*", $sWhere);
		$rRe = array();
		foreach ($re['msg'] as $data){
			if ($data[$sValKey]) {
				$rRe[] = $data[$sValKey];
			}
		}
		return $rRe;
	}
}
?>

