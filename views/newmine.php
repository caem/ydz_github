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

	  .well{
	  	padding: 30px 30px 10px 30px;
	  	color: #D0D0D0;
	  }
	  		
    </style>
<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('li:has(a[href="<?php echo base_url()?>index.php/mine"])').addClass("active");//highlight current page in top-navbar
    //icon hover effect
    $('a[href="<?php echo base_url()?>index.php/mine"] i').addClass("icon-white");
    $('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
                               function(){$(this).find('i').removeClass("icon-white");}
                        );
    
//    $('html').mouseenter(
//    	function blink(){
//    		$('#readNew').fadeTo(
//    			600, //interval
//    			0.4, //opacity
//    			function(){
//    				$('#readNew').fadeTo(600,1.0);
//    				blink();
//    			}
//    		)
//    	}
//    );
    
});



</script>
</head>
<body>
    <?php include('navbar.php') ?>
    <div class="container-fluid">
      <div class="row-fluid"> 
        <div class="span8"> 
          
          <!--2nd segment starts here-->
          <div class="well">             				
          	
          		<ul class="nav nav-tabs" style="margin-top: -10px;">
          		  <li class="active">
          		    <a href="#">读过的书</a>
          		  </li>
          		  <li><a href="#">订阅</a></li>
          		  <a id="readNew" style="color: white;" class="btn btn-inverse pull-right" onclick="location='/index.php/mine/selectbook'" >阅读新书</a>
                </ul>
                <div class="note-content">
          	      <h3>当前还没有任何笔记</h3>
             	</div>
             	
               
             
           </div> <!--end out-most hero-unit-->
           <div class="pagebox">
           	    <h3>你要做的是：</h3>
           	    <br />
           	    <ul>
           	      <li>点击 “阅读新书” <i class="icon-arrow-right"></i> 选择书籍</li>	
           	      <li>找到正在阅读的书籍，点击下一步 <i class="icon-arrow-right"></i> 写下你关于这本书的第一篇笔记</li>
           	      <li>顶部导航栏的“广场” <i class="icon-arrow-right"></i> 浏览或订阅别人的笔记</li>
           	    </ul>
           </div>
        </div><!--/span-->
        
        <?php include('sidebar.php') ?>    
      </div><!--/row-->
      <?php include('footer.php') ?>
    </div><!--/.fluid-container-->
	
	</body>
</html>
