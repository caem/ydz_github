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
    
    	  p.help-block{
    	  	font-size: 14px;
    	  	color: red;
    	  }
    	  .controls{
    	  	max-width: 200px;
    	  }
    	  .hero-unit p{
    	  	font-size: 12px;
    	  }
    </style>

<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.help-block').hide();
    $('li:has(a[href="<?php echo base_url()?>index.php/myprofile"])').addClass("active");//highlight current page in top-navbar
    //icon hover effect
    $('a[href="<?php echo base_url()?>index.php/myprofile"] i').addClass("icon-white");
    $('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
                               function(){$(this).find('i').removeClass("icon-white");}
                        );
                        
    //*************************check username exist**********************//
         $("#username").change(function() { 
            $("#status").hide();
            var usr = $("#username").val();         
            if(usr.length != '' && usr!="<?php echo $profile['username'] ?>"){
            $("#status").show();
            $("#status").html(' 检测中 <img src="/img/loader.gif">');
                
                var data = {"username" : usr,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'};
                
                $.ajax({  
                type: "POST",  
                url: "<?php echo base_url()?>index.php/reg/username_ajax",  
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
	    <div class="widget" style="max-width: 700px; margin: auto auto 10px;">
		  <?php $attr = array('class'=>'form-horizontal','onsubmit'=>'return validate()');
		   echo form_open_multipart('people/set_myprofile',$attr); ?>
	            
	          <div class="widget-header">
		          <i class="icon-user"></i>
		          <h3>个人信息</h3>
	          </div>
		        <div class="widget-content">
				  <div class="control-group">
		            <label class="control-label">登录名</label>
		            <div class="controls">
		              <p style="font-size: 15px;"><?php echo $profile['email'] ?></p>
		              <span><a class="btn" href="password">修改密码</a></span>	              
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="">昵称<span id="status" style="color: #00BDF1;"></span></label></label>
		            <div class="controls">
		              <input class="input-medium" type="text" id="username" name="username" value="<?php echo $profile['username'] ?>">
		              <span style="color: red;"><?php echo form_error('username'); ?></span>
		              <p id="username-help" class="help-block">请选择一个用户名</p>
		              <p id="username-error" class="help-block">用户名只能为英文字母、数字或下划线</p>
		            </div>
		          </div>
		          
		          <div class="control-group">
	                <label class="control-label" for="">上传头像</label>
	                <div class="controls">
	                  <input class="input-file" type="file" name="userfile">
	                </div>
	              </div>
		 
			      <div class="control-group">
		            <label class="control-label" for="">性别</label>	
				    <div class="controls">
		              <label class="radio">
		                <input type="radio" name="gender" value="m" <?php if($profile['gender']=='m') echo 'checked="true"';?> >
		                男
		              </label>
		              <label class="radio">
		                <input type="radio" name="gender" value="f" <?php if($profile['gender']=='f') echo 'checked="true"';?> >
		                女
		              </label>
		              <label class="radio">
		                <input type="radio" name="gender" value="u" <?php if($profile['gender']=='u') echo 'checked="true"';?> >
		                保密
		              </label>
		            </div>
		          </div>
		          <div class="control-group">
		            <label class="control-label" for="textarea">个人简介</label>
		            <div class="controls">
		              <textarea class="input-xlarge" id="status" rows="3" name="status"><?php echo $profile['status'] ?></textarea>
		            </div>
		        </div> 
		      
	              <div class="form-actions">
	            <button type="submit" class="btn btn-primary">保存修改</button>
	            <a href="mine" class="btn">Cancel</a>
	          </div>
	            </div>
	      </form>
		</div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
</body>
</html>