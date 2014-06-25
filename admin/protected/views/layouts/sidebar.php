<?php 
/* @var $this Controller */ 

$merchant = '';
$goods = '';
$client = '';
$promotions = '';
$orders = '';
$consulting = '';
$honesty = '';
$feedback = '';
$stores = '';
$statistics = '';
$system = '';
$controllername = Yii::app()->controller->id;
$$controllername = 'open';
?>
<?php $this->beginContent('//layouts/main'); ?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
<?php 
$this->widget('zii.widgets.CMenu',array(
		'activeCssClass'=>'active',
		'activateItems'=>false,
 		'encodeLabel'=>false,
        'items'=>array(    
         	array('label'=>'<i class="icon icon-home"></i><span>主页</span>','url'=>array('/site/index'),'active'=>Yii::app()->controller->id == 'site'),    
            array('label'=>'<i class="icon icon-signal"></i><span>商户管理</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '),
            	'activateItems'=>false,
            	'items'=>array(
					array('label'=>'<span>介绍信息</span>','url'=>$this->createUrl('merchant/merchantIntroduce'),'active'=>Yii::app()->controller->id == 'merchant'&&$this->getAction()->getId()=='introduce'),
            		array('label'=>'<span>介绍资源</span>','url'=>$this->createUrl('merchant/resources'),'active'=>Yii::app()->controller->id == 'merchant'&&$this->getAction()->getId()=='resources'),
            	)
            ),    
            array('label'=>'<i class="icon icon-reorder"></i><span>电子菜单</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$goods),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>新增菜品</span>','url'=>$this->createUrl('goods/addGoods'),'active'=>Yii::app()->controller->id == 'goods'&&$this->getAction()->getId()=='index'),    
            		array('label'=>'<span>菜单管理</span>','url'=>$this->createUrl('goods/proList'),'active'=>Yii::app()->controller->id == 'goods'&&$this->getAction()->getId()=='proList'), 
	 
            		/*array('label'=>'<span>新增菜品</span>','url'=>$this->createUrl('goods/new'),'active'=>Yii::app()->controller->id == 'goods'&&$this->getAction()->getId()=='new'), 
					array('label'=>'<span>电子菜单管理</span>','url'=>$this->createUrl('goods/info'),'active'=>Yii::app()->controller->id == 'goods'&&$this->getAction()->getId()=='info'), */   
            		array('label'=>'<span>菜单资源管理</span>','url'=>$this->createUrl('goods/goodsResource'),'active'=>Yii::app()->controller->id == 'goods'&&$this->getAction()->getId()=='goodsResource'), 
					
					
					
            	)
            ),    
            array('label'=>'<i class="icon icon-th-list"></i> <span>客户管理</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$client),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>客户列表</span>','url'=>$this->createUrl('client/culist'),'active'=>Yii::app()->controller->id == 'client'&&$this->getAction()->getId()=='culist')
            	)
            ),
            array('label'=>'<i class="icon icon-download"></i> <span>促销、优惠</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$promotions),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>新增促销</span>','url'=>$this->createUrl('promotions/new'),'active'=>Yii::app()->controller->id == 'promotions'&&$this->getAction()->getId()=='new'),
            		array('label'=>'<span>新增优惠卷</span>','url'=>$this->createUrl('promotions/newCoupon'),'active'=>Yii::app()->controller->id == 'promotions'&&$this->getAction()->getId()=='newcoupon'),
            		array('label'=>'<span>促销优惠管理</span>','url'=>$this->createUrl('promotions/list'),'active'=>Yii::app()->controller->id == 'promotions'&&$this->getAction()->getId()=='list'),
            	)
            ),  
            array('label'=>'<i class="icon icon-print"></i> <span>订单管理</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$orders),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>新增预约</span>','url'=>$this->createUrl('orders/addReservation'),'active'=>Yii::app()->controller->id == 'orders'&&$this->getAction()->getId()=='addReservation'),
            		array('label'=>'<span>预约订单</span>','url'=>$this->createUrl('orders/reservation'),'active'=>Yii::app()->controller->id == 'orders'&&$this->getAction()->getId()=='reservation'),   
            		array('label'=>'<span>外卖订单</span>','url'=>$this->createUrl('orders/takeaway'),'active'=>Yii::app()->controller->id == 'orders'&&$this->getAction()->getId()=='takeaway'),   
            	)
            ),
			    array('label'=>'<i class="icon icon-sitemap"></i> <span>门店管理</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$stores),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>新增坐席</span>','url'=>$this->createUrl('stores/add'),'active'=>Yii::app()->controller->id == 'stores'&&$this->getAction()->getId()=='add'),
            		array('label'=>'<span>坐席管理</span>','url'=>$this->createUrl('stores/seat'),'active'=>Yii::app()->controller->id == 'stores'&&$this->getAction()->getId()=='seat'),  
            		array('label'=>'<span>营业管理</span>','url'=>$this->createUrl('stores/time'),'active'=>Yii::app()->controller->id == 'stores'&&$this->getAction()->getId()=='time'),  
            	)
            ),
            array('label'=>'<i class="icon icon-comments-alt"></i> <span>咨询管理</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$consulting),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>咨询管理</span>','url'=>$this->createUrl('consulting/consulting'),'active'=>Yii::app()->controller->id == 'consulting'&&$this->getAction()->getId()=='consulting'),  
            		array('label'=>'<span>发送推送</span>','url'=>$this->createUrl('consulting/push'),'active'=>Yii::app()->controller->id == 'consulting'&&$this->getAction()->getId()=='push'),  
            		array('label'=>'<span>发送短信</span>','url'=>$this->createUrl('consulting/ad'),'active'=>Yii::app()->controller->id == 'consulting'&&$this->getAction()->getId()=='ad'),  
            	)
            ),
            array('label'=>'<i class="icon icon-key"></i> <span>商户诚信</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$honesty),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>诚信详情</span>','url'=>$this->createUrl('honesty/honesty'),'active'=>Yii::app()->controller->id == 'honesty'&&$this->getAction()->getId()=='honesty'),  
            		array('label'=>'<span>评价详情</span>','url'=>$this->createUrl('honesty/evaluate'),'active'=>Yii::app()->controller->id == 'honesty'&&$this->getAction()->getId()=='evaluate'),  
            	)
            ),
            array('label'=>'<i class="icon icon-comment"></i> <span>服务反馈</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$feedback),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>新增反馈</span>','url'=>$this->createUrl('feedback/new'),'active'=>Yii::app()->controller->id == 'feedback'&&$this->getAction()->getId()=='new'),  
            		array('label'=>'<span>反馈管理</span>','url'=>$this->createUrl('feedback/feedback'),'active'=>Yii::app()->controller->id == 'feedback'&&$this->getAction()->getId()=='feedback'),  
            	)
            ),
        
             array('label'=>'<i class="icon icon-bar-chart"></i> <span>统计分析</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$statistics),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>预约统计</span>','url'=>$this->createUrl('statistics/reservation'),'active'=>Yii::app()->controller->id == 'statistics'&&$this->getAction()->getId()=='reservation'),  
            		array('label'=>'<span>外卖统计</span>','url'=>$this->createUrl('statistics/takeaway'),'active'=>Yii::app()->controller->id == 'statistics'&&$this->getAction()->getId()=='takeaway'),  
					array('label'=>'<span>访客统计</span>','url'=>$this->createUrl('statistics/visitors'),'active'=>Yii::app()->controller->id == 'statistics'&&$this->getAction()->getId()=='visitors'),  
            		array('label'=>'<span>客户统计</span>','url'=>$this->createUrl('statistics/client'),'active'=>Yii::app()->controller->id == 'statistics'&&$this->getAction()->getId()=='client'),  
            	)
            ),
            array('label'=>'<i class="icon icon-cogs"></i> <span>系统设置</span>','url'=>'#','itemOptions'=>array('class'=>'submenu '.$system),
            	'activateItems'=>false,
            	'items'=>array(
            		array('label'=>'<span>管理员管理</span>','url'=>$this->createUrl('system/manage'),'active'=>Yii::app()->controller->id == 'system'&&$this->getAction()->getId()=='manage'),  
            		array('label'=>'<span>权限管理</span>','url'=>$this->createUrl('system/competence'),'active'=>Yii::app()->controller->id == 'system'&&$this->getAction()->getId()=='competence'),  
            	)
            ), 
         ),    
));

?>
</div>
<!--sidebar-menu-->

	<?php echo $content; ?>

<?php $this->endContent(); ?>