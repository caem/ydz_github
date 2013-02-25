<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
	<meta charset="UTF-8" />
	<title>阅读志</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />

<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('li:has(a[href="<?php echo base_url()?>index.php/square"])').addClass("active");//highlight current page in top-navbar
    //icon hover effect
    $('a[href="<?php echo base_url()?>index.php/square"] i').addClass("icon-white");
    $('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
                               function(){$(this).find('i').removeClass("icon-white");}
                        );
                        
   
    
//    $('.avatar').popover({
//    	content: '<a class="btn btn-success">关注Ta</a>',
//    	trigger: 'click'
//    });
//    $('.popover').hover(function(){$(this).show()});

//		var isVisible = false;
//		
//		$('.avatar').popover({
//				content: '<p>m个人关注了Ta, Ta关注了n个人</p><p><a class="btn btn-success">关注Ta</a></p>',
//		        html: true,
//		        trigger: 'manual'
//		    }).mouseover(function(e) {
//		        if(!isVisible){
//			        $(this).popover('show');
//			        isVisible = true;
//			    }
//		        e.preventDefault();
//		    });
//		
//		$(document).click(function(e) {
//		  if(isVisible)
//		  {
//		    $('.avatar').each(function() {
//		         $(this).popover('hide');
//		     });  
//		         
//		     isVisible = false;
//		  }
//		
//		});
$('.avatar').popover({
				content: '<p>m个人关注了Ta, Ta关注了n个人</p><p><a class="btn btn-success">关注Ta</a></p>',
		        html: true,
		        trigger: 'hover',
		        delay: { hide: 3400 }
		    });


});



</script>
<script type="text/javascript">

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
    <?php if($signIn) include('navbar.php'); else{?>
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
      	            <li><a href="/index.php">登录</a></li>		            
      	          </ul>
      	        </div><!-- /.nav-collapse -->
            </div>
          </div>
        </div>
        <?php } ?>
    <div class="container-fluid">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="" >
        <h2>发现从这里开始</h2>
        <p>---阅读志是一个社会化阅读笔记社区</p>
        <br />
        <!--<ul class="nav nav-tabs">
          <li class="active"><a href="#home" data-toggle="tab">专业书籍</a></li>
          <li><a href="#profile" data-toggle="tab">小说</a></li>
          <li><a href="#messages" data-toggle="tab">传记</a></li>
          <li><a href="#settings" data-toggle="tab">其他</a></li>
        </ul>-->
        <div class="row-fluid" id="hotbook">
          <div class ="row_book" style = "width: 95%;">
          <?php 
          $count = 0;
          
          foreach ( $top_books as $book): 
            $count ++ ;
            if ( $count != 1 && $count % 3 == 1)
              echo '<div style="clear:both;"></div></div> <div class ="row_book" style = "width: 95%;">';  
            ?>
          <div class="span4">
          	<table class="table table-condensed">
          		<tbody>
          		  <tr>
          		    <td colspan="2">
          		      《<?php echo $book['book_title'] ?>》
          		    </td>
          		  </tr>
          		  <tr>
          		    <td style="width: 35%;">
          	          <img src="<?php echo $book['book_cover'] ?>" class="thumbnail" alt="" style="" id="ttt" width="65" height="90"/>	
          	        </td>  
          			<td>
          				<ul style="list-style: none;">
          					<li class="booklist"><span class="label">作者</span> <?php echo $book['book_author'] ?></li>
          					<li class="booklist"><span class="label label-warning">出版社</span> <?php echo $book['book_press'] ?></li>
          					<li class="booklist"><span class="label label-info">出版时间</span> <?php echo $book['book_date'] ?></li>
          					<li class="booklist"><span class="label label-info">ISBN</span> <?php echo $book['book_isbn'] ?></li>
          				</ul>
          			</td>
          		  </tr>
      			  <tr>
      			    <td colspan="2">
      			    	<a class="btn" href="square/readers/<?php echo $book['book_id'] ?>">正在阅读的人 &raquo;</a>
      				</td>	
      			  </tr>
          		 </tbody>
            </table>  
          </div>
          <?php endforeach ?> 
          <div style="clear:both;"></div></div>
          
        </div> <!--end of book row-fluid-->
        <!--<a class="btn btn-primary btn-large">更多热门书籍 &raquo;</a>-->
        
        
        <hr>
        <div class="alert alert-error" style="max-width: 80px; text-align: center;">
          <h3>阅读达人</h3>
        </div>
        <br />
        <div class="row-fluid" id="hotpeople">
        	<div class ="row_book" style = "width: 95%;">
		        <?php 
		        $count = 0;
		        
		        foreach ( $top_users as $user): 
		          $count ++ ;
		          if ( $count != 1 && $count % 3 == 1)
		            echo '<div style="clear:both;"></div></div> <div class ="row_book" style = "width: 95%;">';  
		          ?>
	            <div class="span4 well" style="padding-bottom: 0px;">
		            <table class="table"> 
			    		<tbody>
			    		  <tr>
			    		    <td style="width: 25%;">
			    	          <img src="/img/head/<?php echo $user['avatar'] ?>" rel="popover" class="thumbnail avatar" alt="" style="float: left; margin-right: 5px;" width="48" height="48"/></a>	
			    	        </td>  
			    			<td>
			    				<ul style="list-style: none;">
			    					<li class="booklist"><span class="label">昵称</span>&nbsp <?php echo $user['username'] ?> </li>
			    					<li class="booklist"><span class="label label-warning">状态</span> <?php echo $user['status'] ?></li>
			    				</ul>
			    			</td>
			    		  </tr>
			    		  <tr>
			    		    <td colspan="2" >
			    		    	<ul style="list-style: none; margin: 0px;padding: 10px; background-color: #E6E6E6;" class="well">
			    		    		<li>阅读总数 <span class="badge"><?php echo $user['book_sum'] ?></span></li>
			    		    		<li>笔记总数 <span class="badge"><?php echo $user['note_sum'] ?></span></li>
			    		    	</ul> 
			    			</td>	
			    		  </tr>
			    		 </tbody>
		            </table>
	            </div>
	            <?php endforeach ?>
            </div> <!--end of row_book class div-->
        </div> <!--end of ppl row-fluid-->
        

        
      </div><!--/.fluid-container-->
       
      <?php include('footer.php') ?>
	</body>
</html>
