<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
	<meta charset="UTF-8" />
	<title>阅读志</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />
		<style type="text/css">
	      input.input-medium{
	      	margin-left: 5px;
	      }
	      
	    </style>
	<script src="/script/jquery-1.7.2.min.js"></script>
	<script src="/script/bootstrap.js"></script>	
	
	<script type="text/javascript">
	$(document).ready(function(){
		$('#ydz_tooltip').tooltip();
	});
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-34041237-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
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
          <a class="brand" href="/intro">阅读志</a>
  	        <div class="nav-collapse">
  	          
  	          <ul class="nav pull-right">
<!--  	            <li class="divider-vertical"></li>-->
				<li><a href="/index.php/square">广场</a></li>
  	            <li><a href="/index.php/reg">注册</a></li>	            
  	          </ul>
  	        </div><!-- /.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid" style="margin-top: 60px;">
      <div class="row-fluid"> 
        <div class="span8">
          <a href="/intro" rel="tooltip" id="ydz_tooltip" title="点击观看介绍"><img src="/img/logo1.png" alt="" style="margin-left: 80px;" width="220" /></a>
        </div><!--/span-->
        
        
        <div class="span4">
           <div class="well sidebar-nav" style="background-color: whiteSmoke;">
        		<?php echo form_open('login/'); ?>		
        		<fieldset style="text-align: center;">
        		    <legend>用户登录</legend>
        		    <div class="control-group">
        		        邮箱 <input type="text" class="input-medium" name="email" >
        		    </div>
        		    
        		    <div class="control-group">
        		        密码 <input type="password" class="input-medium" name="password" >
        		    </div>
        	    </fieldset>
        		  <p style="text-align: center;">
        			<input type="submit" id="loginButton" class="btn btn-primary" value="登录"/>
        			<a type="button" id="regButton" class="btn" href="/index.php/reg"/>现在注册 </a>
        	      </p>
        	      <br />
        	      <p style="text-align: center;">测试账户：test@gmail.com <br />密码：12345678</p>
           </div><!--/.well -->
         </div><!--/span-->
        
      </div><!--/row-->
      

      <?php include('footer.php') ?>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


  

</body>
</html>
