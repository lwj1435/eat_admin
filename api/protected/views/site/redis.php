<?php
		
Yii::app()->redis = new Redis();
$redis->connect('127.0.0.1',6379);

$redis->lpush('id', 1);  
$redis->set('name_1', 'tank');  
$redis->set('score_1',89);  
  
$redis->lpush('id', 2);  
$redis->set('name_2', 'zhang');  
$redis->set('score_2', 40);  
  
$redis->lpush('id', 4);  
$redis->set('name_4','ying');  
$redis->set('score_4', 70);  
  
$redis->lpush('id', 3);  
$redis->set('name_3', 'fXXK');  
$redis->set('score_3', 90);  

echo "<pre>";
/** 
 * 按score从大到小排序,取得id 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC'  
            );  
print_r($redis->sort('id',$sort)); //结果:Array ( [0] => 3 [1] => 1 [2] => 4 [3] => 2 )   
  
/** 
 * 按score从大到小排序,取得name 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC',  
            'GET'=>'name_*'  
            );  
print_r($redis->sort('id',$sort)); //结果:Array ( [0] => fXXK [1] => tank [2] => ying [3] => zhang )    
  
/** 
 * 按score从小到大排序,取得name，score 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC',  
            'GET'=>array('name_*','score_*')  
            );  
print_r($redis->sort('id',$sort));  
/** 
 *结果:Array 
        ( 
            [0] => fXXK 
            [1] => 90 
            [2] => tank 
            [3] => 89 
            [4] => ying 
            [5] => 70 
            [6] => zhang 
            [7] => 40 
        )) 
 */  
  
/** 
 * 按score从小到大排序,取得id，name，score 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC',  
            'GET'=>array('#','name_*','score_*')  
            );  
print_r($redis->sort('id',$sort));  

$redis->delete('id');
$redis->delete('score_*');
$redis->delete('name_*');

/** 
 *结果:Array 
        ( 
            [0] => 3 
            [1] => fXXK 
            [2] => 90 
            [3] => 1 
            [4] => tank 
            [5] => 89 
            [6] => 4 
            [7] => ying 
            [8] => 70 
            [9] => 2 
            [10] => zhang 
            [11] => 40 
        ) 
 */  


$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$redis->rpush('tst',"中文");
$redis->rpush('tst',"英文");
$redis->rpush('tst',"测试");

print_r($redis->lrange('tst',0,2));
print_r($redis->sort('tst',array('SORT' => 'desc','alpha'=>true)));

$redis->delete('tst');