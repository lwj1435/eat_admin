<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ArticleForm extends CFormModel
{
	public $postId;
	public $postTitle;
	public $postLitpic;
	public $catalogId;
	public $postKeyword;
	public $postContent;
	public $postTag;

	public function rules()
	{
		return array(
			array('catalogId','required','message'=>'请选择分类！'),
			array('postTitle', 'required','message'=>'文章标题不能为空！'),
			array('postContent', 'required','message'=>'文章内容不能为空！'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'postTitle'=>'文章标题',
			'postContent'=>'文章内容',
		);
	}

}
