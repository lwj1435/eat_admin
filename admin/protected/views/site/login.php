<?php 
/* @var $this Controller */ 
$baseurl = Yii::app()->baseUrl;
?>
<!DOCTYPE html>
<html lang="en">
   <head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo $baseurl;?>/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo $baseurl;?>/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo $baseurl;?>/css/matrix-login.css" />
        <link href="<?php echo $baseurl;?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='<?php echo $baseurl;?>/css/font.css' rel='stylesheet' type='text/css'>

    </head>
    <body>
        

<div id="loginbox">
        	<div class="control-group normal_text"> <h2>吃订你LOGO</h2></div>             

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'loginform', 
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array(
		'class'=>'form-vertical',
		'action'=>$this->createUrl('site/login')
	)
)); 
?>
				<div class="control-group normal_text"><h3>一个帐户，畅享吃订你商家管理！</h3><h3><img src="<?php echo $baseurl;?>/img/user65.png" alt="Logo" /></h3>登录即可继续使用商家管理后台！</div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"></i></span><?php echo $form->textField($model,'username',array('placeholder'=>'用户名')); ?><font color=red><?php echo $form->error($model,'username'); ?></font>
                        </div>
                    </div>
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><?php echo $form->passwordField($model,'password',array('placeholder'=>'密码')); ?><font color=red><?php echo $form->error($model,'password'); ?></font>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-large btn-info" id="to-recover">忘记密码?</a></span>
                    <span class="pull-right"><input type="submit"  class="btn btn-large btn-success" value='登陆后台' /></span>
                </div>
        <?php 
            $this->endWidget(); 
        ?>
        
	    <?php 
	       $form=$this->beginWidget('CActiveForm', array(
				'id'=>'recoverform',
				'htmlOptions'=>array(
					'class'=>'form-vertical',
					'action'=>'#'
				)
			)); 
		?>
				<p class="normal_text">请填写您的商户名称、商户ID，或者是您绑定的手机号码：</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-user"></i></span><input type="text" placeholder="商户名 / 商户ID" />
                        </div>
                    </div>
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-phone-sign"></i></span><input type="text" placeholder="绑定的手机号码" />
                        </div>
                    </div>               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-large btn-success" id="to-login">返回登录</a></span>
                    <span class="pull-right"><a class="btn btn-large btn-info"/>取回密码</a></span>
                </div>
        <?php 
            $this->endWidget(); 
        ?>
        </div>
        <div class="row-fluid">
          <div id="footer" class="span12"><br><p>Copyright (C) 广州七升网络科技有限公司 2013-2014 All Rights Reserved 粤ICP证13071028号</p></div>
        </div>           
        <script src="<?php echo $baseurl;?>/js/jquery.min.js"></script>  
        <script src="<?php echo $baseurl;?>/js/matrix.login.js"></script> 
    </body>

</html>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51272843-1', '77tng.com');
  ga('send', 'pageview');

</script>