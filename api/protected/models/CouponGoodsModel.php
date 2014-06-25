<?php
class CouponGoodsModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "coupon_goods";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	public function addCouponGoods($goods_id,$coupon_id){
		$aParam = array();
		$aParam["goods_id"]=$goods_id;
		$aParam["coupon_id"]=$coupon_id;
		$aParam["status"]=0;
		return $this->add($aParam,true);
	}

	public function updateCouponGoods($id,$goods_id,$coupon_id,$status){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["goods_id"]=$goods_id;
		$aParam["coupon_id"]=$coupon_id;
		$aParam["status"]=$status;
		return $this->updateById($id,$aParam,true);
	}
	
/**
	 * 获取促销关联的菜品
	 * @param unknown $iPro
	 */
	public function getCoupRelationGoods($iPro){
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
		$sKey = $bType?"coupon_id":"goods_id";
		$sValKey = $bType?"goods_id":"coupon_id";
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

