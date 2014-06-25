<?php
class GoodsGoodsModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "goods_goods";
		parent::__construct($sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	
	/**
	 * 添加关系
	 * @param unknown $iGoods
	 * @param unknown $rGoodsiD
	 * @return boolean
	 */
	public function addGoodsRelation($iGoods,$rGoodsiD){
		if (!$iGoods||!$rGoodsiD) {
			return false;
		}
		if ($this->isExitRelation($iGoods,$rGoodsiD)) {
			return false;
		}
		$aParam = array(
				'goods_id'=>$iGoods,
				'connection_id'=>$rGoodsiD
		);
		$this->add($aParam);
		$this->delGoodsRelationDetail($rGoodsiD,$iGoods);
		$aParam = array(
				'goods_id'=>$rGoodsiD,
				'connection_id'=>$iGoods
		);
		$this->add($aParam);
		return true;
	}
	
	/**
	 * 删除所有关系
	 * @param unknown $iGoods
	 */
	public function delAllRelation($iGoods){
		$sWhere = " goods_id = {$iGoods} or connection_id = {$iGoods} ";
		$re = $this->find("*", $sWhere);
		foreach ($re['msg'] as $data){
			if ($data['id']) {
				$this->delById($data['id']);
			}
		}
		return true;
	}
	
	/**
	 * 删除关系 双方的关系都删除
	 * @param unknown $iGoods
	 * @param unknown $rGoodsiD
	 * @return boolean
	 */
	public function delGoodsRelation($iGoods,$rGoodsiD){
		$this->delGoodsRelationDetail($iGoods,$rGoodsiD);
		$this->delGoodsRelationDetail($rGoodsiD,$iGoods);
		return true;
	}
	
	private function delGoodsRelationDetail($iGoods,$rGoodsiD){
		$sWhere = " goods_id = {$iGoods} and connection_id = {$rGoodsiD} ";
		$re = $this->find("*", $sWhere);
		foreach ($re['msg'] as $data){
			if ($data['id']) {
				$this->delById($data['id']);
			}
		}
		return true;
	}
	
	public function isExitRelation($iGoods,$rGoodsiD){
		$sWhere = " goods_id = {$iGoods} and connection_id = {$rGoodsiD} ";
		$re = $this->find("*", $sWhere);
		return (isset($re['msg'][0]['id'])&&$re['msg'][0]['id'])?true:false;
	}
	
	/**
	 * 统计数量
	 * @param unknown $iGoods
	 * @return number
	 */
	public function countGreensRelation($iGoods){
		$sFind = " sum(1) as num ";
		$sWhere = " goods_id = {$iGoods} ";
		$re = $this->find($sFind, $sWhere);
		return isset($re['msg'][0]['num'])?($re['msg'][0]['num']?$re['msg'][0]['num']:0):0;
	}
	
	/**
	 * 获取相关菜品
	 * @param unknown $iGoods
	 * @return multitype:
	 */
	public function getGreensRelation($iGoods){
		if (!$iGoods){
			return BaseFunctions::returnResult(true, array());
		}
		$sWhere = " goods_id = {$iGoods} ";
		$aRe = $this->pageGet("*", $sWhere,1,1000);
		$rRe = array();
		foreach ($aRe['records'] as $re){
			$rRe[] = $re['connection_id'];
		}
		return $rRe;
	}
}