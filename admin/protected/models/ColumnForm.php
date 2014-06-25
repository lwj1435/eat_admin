<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ColumnForm extends CFormModel
{
	public $catalogParentId;
	public $catalogName;
	public $catalogType;
	public $catalogDesc;
	public $catalogKeyword;
	public $catalogContent;

	public function rules()
	{
		return array(
			array('catalogName', 'required','message'=>'栏目名称不能为空！'),
			array('catalogType', 'required','message'=>'请选择栏目类型！'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'catalogName'=>'栏目名称',
			'catalogType'=>'栏目类型',
		);
	}

}
