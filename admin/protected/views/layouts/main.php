<?php 
/* @var $this Controller */ 
$baseurl = Yii::app()->baseUrl;
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<title>后台管理</title>
<meta charset="UTF-8" />
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/fullcalendar.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/uniform.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/select2.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/matrix-media.css" />
<link href="<?php echo $baseurl;?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/jquery.gritter.css" />
<link href='<?php echo $baseurl;?>/css/font.css' rel='stylesheet' type='text/css'>



<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo $baseurl;?>/css/matrix-media.css" />
<link href="<?php echo $baseurl;?>/font-awesome/css/font-awesome.css" rel="stylesheet" />

</head>
<body>

<!--Header-part-->
<div id="header">
  <h1>吃订你<br>LOGO</h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">欢迎 <?php echo Yii::app()->cache->get('username_'.Yii::app()->user->id);?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i>我的资料</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo $this->createUrl("site/logout");?>"><i class="icon-key"></i>退出</a></li>
      </ul>
    </li>
    <!--<li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>
        <li class="divider"></li>
        <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
        <li class="divider"></li>
        <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
        <li class="divider"></li>
        <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
      </ul>
    </li>-->
    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">系统设置</span></a></li>
    <li class=""><a title="" href="<?php echo $this->createUrl("site/logout");?>"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!--<div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>-->
<!--close-top-serch-->

	<?php echo $content; ?>

<!--Footer-part-->

        <div class="row-fluid">
          <div id="footer" class="span12">Copyright (C) 广州七升网络科技有限公司 2013-2014 All Rights Reserved 粤ICP证13071028号</div>
        </div> 

<!--end-Footer-part-->


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51272843-1', '77tng.com');
  ga('send', 'pageview');

</script>
</body>
</html>

