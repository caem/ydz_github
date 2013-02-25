<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />
    <style type="text/css">

      .hero-unit{
      		padding: 10px;
      }

	  .hero-unit p{
	  	font-size: 12px;
	  	color: red;
	  }

    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
      $('a[rel="tooltip"]').tooltip('hide');

      $('.help-block').hide();  
      
      //*************************check username exist**********************//
      $("#username").change(function() { 
         $("#status").hide();
         var usr = $("#username").val();         
         if(usr.length != ''){
         $("#status").show();
         $("#status").html('检测中&nbsp<img src="/img/loader.gif">');
             
             var data = {"username" : usr,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'};
             
             $.ajax({  
             type: "POST",  
             url: "reg/username_ajax",  
             data: data, 
             success: function(msg){      
                  $("#status").ajaxComplete(function(event, request, settings){  
         	               if(msg == 'OK')
         	               { 
         	                   $(this).html(' <span class="label label-success" >可用!</span>');
         	               }  
         	               else  
         	               {  
			               
         	               	   $(this).html(' <span class="label label-warning">已经存在!</span>');
         	               }  
                           
                  });
             }  //end success
           });    
         } //end if
         
 
     });
     //*************************END check username exist**********************//  
});

function validate(){
     //**************** username ***************************
           $('.help-block').hide(); 
           
           if( $('#username').val().length == 0 ){ 
                $('#username-help').fadeIn();
                $('#username').select();
                return false;
           } 
           
           var pattern = /^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/;
           var info = $('#username').val();
           if( !pattern.test(info) ){
                $('#username-error').fadeIn();
                $('#username').select();
                return false;
           }
          
           
      //**************** password ***************************
           
		if( $('#password1').val().length == 0 ){//if no entry for password
			$('#password1-help').fadeIn();
			$('#password1').select();
			return false;									
		}
		if( $('#password1').val().length < 6){//password too short
			$('#password1-less').fadeIn();
			$('#password1').select();
			return false;
		}
		
		if( $('#password1').val() != $('#password2').val() ){//password not consistent
			$('#password2-notSame').fadeIn();
			$('#password2').select();
			return false;
		}
		
		//**************** email ***************************
		
		if( $('#email').val().length == 0 ){ 
                $('#email-help').fadeIn();
                $('#email').select();
                return false;
           }
           
           var pattern = /([\w\-]+\@[\w\-]+\.[\w\-]+)/;
           var info = $('#email').val();
           if( !pattern.test(info) ){
                $('#email-error').fadeIn();
                $('#email').select();
                return false;
           }
        


  return true;
}

</script>
  </head>
  <body>
  
    <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container-fluid" >
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              <a class="brand" href="/">阅读志</a>
      	        <div class="nav-collapse">
      	          
      	          <ul class="nav pull-right">
      	          	<li class="active"><a >注册</a></li>
      	            <li><a href="/">登录</a></li>
      	            <!--<li class="divider-vertical"></li>-->
      	          </ul>
      	        </div><!-- /.nav-collapse -->
            </div>
          </div>
        </div>
    
  
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" id="center_panel_500">
      
      <?php $attr = array('class'=>'form-horizontal','style'=>'padding-top:10px;','onsubmit'=>'return validate()');
       echo form_open('reg/register',$attr); ?>
        
<!--        <div class="form-horizontal" style="padding-top:10px;" onsubmit="return validate()">-->
            <fieldset id="">
                <legend>注册</legend>

                <div class="control-group">
                   <label class="control-label" for="input01">* 昵称<span id="status" style="color: #00BDF1;"></span></label>
                   
                   <div class="controls">
                   <a href="#" rel="tooltip" data-original-title="昵称由英文字母、下划线或者数字组成"><input type="text" class="input" id="username" name="username"></a>
                   <?php echo form_error('username'); ?>
                      
                      <p id="username-help" class="help-block">请选择一个用户名</p>
                      <p id="username-error" class="help-block">用户名只能为英文字母、数字或下划线</p>
                   </div>
                </div>

                <div class="control-group">
                   <label class="control-label" for="input">* 密码</label>
                   <div class="controls">
                      <a href="#" rel="tooltip" data-original-title="密码至少6位"><input type="password" class="input" id="password1" name="password" maxlength="32" placeholder=""></a>
                      <?php echo form_error('password'); ?>
                      <p id="password1-help" class="help-block">请设置密码</p>
                      <p id="password1-less" class="help-block">密码不足6位</p>
                   </div>
                </div>

                <div class="control-group">
                   <label class="control-label" for="input">* 再次输入密码</label>
                   <div class="controls">
                      <input type="password" class="input" id="password2" name="passconf" maxlength="32" >
                      <?php echo form_error('passconf'); ?>
                      <p id="password2-notSame" class="help-block">两次输入的密码不一致!</p>
                   </div>
                </div>
                
                <div class="control-group">
                   <label class="control-label" for="input">* 邮箱</label>
                   <div class="controls">
                      <input type="text" class="input" id="email" name="email">
                      <?php echo form_error('email'); ?>
	                      <p id="email-help" class="help-block">请输入您的邮箱</p>
                      <p id="email-error" class="help-block">无效的邮箱地址!</p>
                   </div>
                </div>
            </fieldset>
        
           
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">提交</button>
            <button type="reset" class="btn" >重写</button>
          </div>
        </form>
      </div>




    </div> <!-- /container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
      <hr>


  </body>
</html>
