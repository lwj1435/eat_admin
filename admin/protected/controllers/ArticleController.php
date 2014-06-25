<?php

class ArticleController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionIndex()
	{
		HttpClient($url, $data);
		$this->render('articlelist',array('catalogs'=>$catalogs));
	}
	
	public function actionEditArticle()
	{	
		$catalogs = getCatalogs();
		
		$article = new ArticleForm();
		if(isset($_POST['ArticleForm'])){
			$article->attributes=$_POST['ArticleForm']; 
			if($article->validate()){
				
			}
		}
		
		$this->render('editarticle',array('model'=>$article,'catalogs'=>$catalogs));
	}
	
}