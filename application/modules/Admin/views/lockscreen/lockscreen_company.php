<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Company Lockscreen</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="<?php echo site_url();?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo site_url();?>assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->
<!-- BEGIN CSS TEMPLATE -->
<link href="<?php echo site_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="error-body no-top">
<div class="container">
  <div class="lockscreen-wrapper animated  flipInX">
  <div class="row ">
    <div class="col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-4 col-xs-offset-2">
    <?php echo show_notification(); ?>
              <span style="<?= $displayData ?>" >
              <?php echo show_valnotif(); ?>
              </span>
		<div class="profile-wrapper"> 
			<img width="69" height="69" data-src-retina="<?php echo site_url();?>assets/img/profiles/avatar2x.jpg" data-src="<?php echo site_url();?>assets/img/profiles/avatar.jpg" src="<?php echo site_url();?>assets/img/profiles/avatar.jpg" alt=""> 
		</div>
		<form class="user-form" action="<?php echo site_url('company/lockscreen');?>" method="post">
			<h2 class="user"> <?php echo $firstName;?> <span class="semi-bold"><?php echo $lastName;?></span></h2>
			<input type="hidden" name="txtusername" value="<?php echo $username;?>" >
			<input type="password" name="txtpassword" placeholder="Password" >
			<button type="submit" class="btn btn-primary "><i class="fa fa-unlock"></i></button>
		</form>
    </div>
   </div>
  </div>
  <div id="push"></div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK-->
<script src="<?php echo site_url();?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo site_url();?>assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo site_url();?>assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
<script src="<?php echo site_url();?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {	
	$("img").unveil();
});	
</script>
<!-- BEGIN CORE TEMPLATE JS -->
<!-- END CORE TEMPLATE JS -->
</body>
</html>