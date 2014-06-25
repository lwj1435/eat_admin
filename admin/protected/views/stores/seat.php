
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo $this->createUrl("site/index");?>" title="主页" class="tip-bottom"><i class="icon-home"></i> 主页</a> 楼面坐席管理 </div>
    <h1><span class="icon"> <i class="icon-sitemap"></i> </span>楼面坐席管理</h1>
  </div>

  <div class="container-fluid">
  <?php echo $this->showDoingDiv();?><hr>
	<div class="quick-actions_homepage">
          <ul class="quick-actions-queue">
            <li><a><div class="qatitle bg_dg">现有坐席</div><div class="qnumber"><?php echo isset($cout)?$cout:0;?></div></a></li>
            <li><a><div class="qatitle bg_dg">空桌</div><div class="qnumber"><?php echo isset($nocout)?$nocout:0;?></div></a></li>
            <li><a><div class="qatitle bg_dg">满桌</div><div class="qnumber"><?php echo isset($fullcout)?$fullcout:0;?></div></a></li>
            <li><a><div class="qatitle bg_dg">停用</div><div class="qnumber"><?php echo isset($uncout)?$uncout:0;?></div></a></li>
            <li class="bg_lb"><a href="<?php echo $this->createUrl("stores/add");?>"><span class="label label-warning"><i class="icon-plus-sign"></i></span><div class="qbutton">新增坐席</div></a></li>
          </ul>
        </div>

    <div class="row-fluid"><hr>
    	<div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li><span class="icon"><i class="icon-ok"></i></span></li>
              <li class="active"><a data-toggle="tab" href="#tab1">使用中坐席</a></li>
              <li><a data-toggle="tab" href="#tab2">已停用坐席</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
				<div class="todo">
                      <ul>
                       <?php foreach ($list as $iListKey => $item): ?> 
                        <li class="clearfix">
                           <div class="txt"><?php echo isset($areaList[$iListKey])?$areaList[$iListKey]:'未知区域';?></div>
                           <div class="store-right"><a href="javascript:changeAreatStatus(<?php echo $iListKey;?>,2)"><span class="label label-important"><i class="icon-remove-sign"></i> 停用该区域</span></a></div>
                        </li>
                        <li class="clearfix">
								<div class="quick-actions_homepage">
                              		<ul class="quick-actions-store">
                        <?php foreach ($item as $aDetailItem):?>
                        			<li class="store">
                                		<ul>
		                                	<li class="check"><a href="javascript:changeSeatStatus(<?php echo $aDetailItem->id;?>,2,<?php echo $aDetailItem->status;?>)"><i class="icon-remove-sign"></i><br>停用</a></li>
                                    		
                                			<?php 
                                			//1开启 2停用 3占用
                                			if ($aDetailItem->status == 1) {
                                				?>
                                				<li class="bg_lg">
                                				<a href="javascript:changeSeatStatus(<?php echo $aDetailItem->id;?>,3,<?php echo $aDetailItem->status;?>)">
                                				<span class="label label-success ">空</span>
                                				<?php 
                                			}else if($aDetailItem->status == 3){
												?>
												<li class="bg_lo">
												<a href="javascript:changeSeatStatus(<?php echo $aDetailItem->id;?>,1,<?php echo $aDetailItem->status;?>)">
												<span class="label label-warning ">占</span>
												<?php 
											}else {
												?>
												<li class="bg_lo">
												<a href="javascript:changeSeatStatus(<?php echo $aDetailItem->id;?>,1,<?php echo $aDetailItem->status;?>)">
												<span class="label label-warning ">未知</span>
												<?php 
											}?>
                                    		<span class="store-txt"><?php echo BaseFunctions::changeShow('seatType',$aDetailItem->seat_type,'未知');?></span>
                                    		<br><div class="store-number"><?php echo $aDetailItem->seat_num;?></div></a></li>
                                    	</ul>
                                	</li>
                        <?php endforeach; ?> 
                        			</ul>
            					</div>
                      	</li>
                       <?php endforeach; ?> 
                      	
                      </ul>
            </div>
            </div>
            <div id="tab2" class="tab-pane">
                <div class="todo">
                       <?php foreach ($list2 as $iListKey => $item): ?> 

                      <ul>
                        <li class="clearfix">
                           <div class="txt"><?php echo isset($areaList[$iListKey])?$areaList[$iListKey]:'未知区域';?></div>
                            <div class="store-right"><a href="javascript:changeAreatStatus(<?php echo $iListKey;?>,1)"><span class="label label-important"><i class="icon-ok-sign"></i> 启用该区域</span></a></div>
                        </li>
                        <li class="clearfix">
								<div class="quick-actions_homepage">
                              		<ul class="quick-actions-store">
                        <?php foreach ($item as $aDetailItem):?>
                        			<li class="store">
                                		<ul>
		                                	<li class="check"><a href="javascript:changeSeatStatus(<?php echo $aDetailItem->id;?>,1,<?php echo $aDetailItem->status;?>)"><i class="icon-remove-sign"></i><br>启用</a></li>
                                    		
                                    		<li class="bg_lh"><a href=""><span class="label label-inverse ">停</span>
                                    		<span class="store-txt"><?php echo BaseFunctions::changeShow('seatType',$aDetailItem->seat_type,'未知');?></span>
                                    		<br><div class="store-number"><?php echo $aDetailItem->seat_num;?></div></a></li>
                                    		
                                    	</ul>
                                	</li>
                        <?php endforeach; ?> 
                        			</ul>
            					</div>
                      	</li>
                      </ul>
                       <?php endforeach; ?> 

            </div>
            </div>
          </div>
        </div>
              
    </div>
  </div>
</div>

<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.ui.custom.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/bootstrap.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.uniform.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/select2.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.js"></script> 
<script src="<?php echo Yii::app()->baseUrl;?>/js/matrix.tables.js"></script>

<script>
function changeSeatStatus(seatid,sta,oldsta){
    if(seatid>0){
		if(oldsta==3&&sta==2){
			if(confirm("本坐席正在占用中是否停用坐席")){
				document.getElementById("doingDiv").style.display="";
		  	   $.post("<?php echo $this->createUrl('stores/changeSeatStatus')?>",
		    			{
		    			id:seatid,
		    			status:sta
		    			},
		    			function(code,status){
		   					var tempData =eval("("+code+")");
		    				if(tempData.type){
// 		        				alert(tempData.msg);
		        				document.getElementById("doingDiv").style.display="none";
		    					location.reload(); 
		    				}else{
		    					if(confirm("垓台还有人占用中，是否停用?")){
		   							 $.post("<?php echo $this->createUrl('stores/changeSeatStatus')?>",
								  			{
								  			id:areaid,
								  			status:sta,
								  			type:1
								  			},
								  			function(code2,status){
								  				var tempData2 =eval("("+code2+")");
							    				document.getElementById("doingDiv").style.display="none";
// 								  				alert(tempData2.msg);
								  				//$("#content_code").text(code);
								 				location.reload(); 
								  	});  
		        				}
		        			}
		    				
		    			//$("#content_code").text(code);
		   			
		    	});  
	      }
		}else{
			document.getElementById("doingDiv").style.display="";
			$.post("<?php echo $this->createUrl('stores/changeSeatStatus')?>",
	    			{
	    			id:seatid,
	    			status:sta
	    			},
	    			function(code,status){
	   					var tempData =eval("("+code+")");
	    				if(tempData.type){
// 	        				alert(tempData.msg);
	    					location.reload(); 
	    				}else{
	    					if(confirm("垓台还有人占用中，是否停用?")){
	   							 $.post("<?php echo $this->createUrl('stores/changeSeatStatus')?>",
							  			{
							  			id:areaid,
							  			status:sta,
							  			type:1
							  			},
							  			function(code2,status){
							  				var tempData2 =eval("("+code2+")");
// 						    				document.getElementById("doingDiv").style.display="none";
// 							  				alert(tempData2.msg);
							  				//$("#content_code").text(code);
							 				location.reload(); 
							  	});  
	        				}
	        			}
	    				
	    			//$("#content_code").text(code);
	   			
	    	});  
		}
	}
}

function changeAreatStatus(areaid,sta){
    
    if(areaid>0){
		document.getElementById("doingDiv").style.display="";
	   $.post("<?php echo $this->createUrl('stores/changeAreaStatus')?>",
  			{
  			id:areaid,
  			status:sta
  			},
  			function(code,status){
  	  			if(sta==2){
// 					alert("已停用非占用坐席!");
  	  	  		}else{
//   					alert(code);
  	  			}
  			//$("#content_code").text(code);
				document.getElementById("doingDiv").style.display="none";
 			location.reload(); 
  	});  
    }else{
        alert("由于所点区域不存在,不能启用里面的坐席!");
    }
}
</script>

