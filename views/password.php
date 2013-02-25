<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"  >
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>阅读志</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />
    <style>
          .hero-unit{
          		padding: 10px;
          }
    </style>

<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('li:has(a[href="<?php echo base_url()?>index.php/myprofile"])').addClass("active");//highlight current page in top-navbar
    //icon hover effect
    $('a[href="<?php echo base_url()?>index.php/myprofile"] i').addClass("icon-white");
    $('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
                               function(){$(this).find('i').removeClass("icon-white");}
                        );
    $('a[rel="tooltip"]').tooltip('hide');
    $('.help-block').hide(); 
});

function validate(){

	$('.help-block').hide(); 
	//**************** password ***************************
	     
	if( $('#newPass').val().length == 0 ){//if no entry for password
		$('#newPass-help').fadeIn();
		$('#newPass').select();
		return false;									
	}
	if( $('#newPass').val().length < 6){//password too short
		$('#newPass-less').fadeIn();
		$('#newPass').select();
		return false;
	}
	
	if( $('#newPass').val() != $('#newPassConf').val() ){//password not consistent
		$('#newPass-notSame').fadeIn();
		$('#newPass').select();
		return false;
	}
}
</script>


  </head>

  <body>

    <?php include('navbar.php') ?>

    <div class="container">
    <?php 
        if(isset($notice))
            echo '<div class="alert alert-success fade in" id="alert" style="max-width:400px; margin:0px auto 10px;">你的信息已经更新成功！
                  <button class="close" data-dismiss="alert">×</button></div>'; 
    ?>
	    <div class="hero-unit" style="max-width: 700px; margin: auto auto 10px;">
		  <?php $attr = array('class'=>'form-horizontal','onsubmit'=>'return validate()');
		   echo form_open('people/change_password',$attr); ?>
	            <fieldset>
		          <legend>修改密码</legend>
				  <div class="control-group">
				    <label class="control-label" for="">当前密码</label>
				    <div class="controls">
				      <input class="input" type="password" id="curPass" name="curPass">
				      <?php echo form_error('curPass'); ?>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="">新密码</label>
				    <div class="controls">
				      <a href="#" rel="tooltip" data-original-title="密码至少6位"><input class="input" type="password" id="newPass" name="newPass"></a>
				      <?php echo form_error('newPass'); ?>
				      <p id="newPass-help" class="help-block">请设置密码</p>
				      <p id="newPass-less" class="help-block">密码不足6位</p>
				      <p id="newPass-notSame" class="help-block">两次输入的密码不一致</p>
				      <!--<div class="progress progress-striped active" style="margin: 10px 0;">
				          <div class="bar" style="width: 60%;"></div>
				      </div>
				      <span class="help-inline">密码强度</span> -->
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="">确认新密码</label>
				    <div class="controls">
				      <input class="input" type="password" id="newPassConf" name="newPassConf">
				      <?php echo form_error('newPassConf'); ?>
				    </div>
				  </div>
		      </fieldset>
	          <div class="form-actions">
	            <button type="submit" class="btn btn-primary">保存修改</button>
	            <a href="myprofile" class="btn">Cancel</a>
	          </div>
	      </form>
		</div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
</body>
</html>