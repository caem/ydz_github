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
		  .hero-unit{
		  	padding: 10px 30px 10px 30px;
		  }	
	    </style>
	    
<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.brand').after('<a class="brand" href="" >: <span style="font-size:14px; color:white">正在阅读的人</span></a>');
	//icon hover effect
	$('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
	                           function(){$(this).find('i').removeClass("icon-white");}
	                    );
});

function del(url){
	$('#delModal').modal('show');
	$('#delConf').attr("href",url);
}
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
      <div class="" > 
        <!--1st segment starts here-->
        <div class="well reader_panel" >
          <span class="badge badge-warning pull-left book_title_label well" ><?php echo $book['book_title'] ?></span>
          <img alt="cover" src="<?php echo $book['book_cover'] ?>" class="pull-right"/>
          
          
          <table class="table-condensed pull-left" id="reader_book_info" >
          	<tbody>
          		<tr >
          			<td>	          				
          				<span class="label">作者</span> <?php echo $book['book_author'] ?>
          			</td>	
          		</tr>
          		<tr>
          			<td>	    	
          				<span class="label">ISBN</span> <?php echo $book['book_isbn'] ?>
          			</td>
          		</tr>
          		<tr>
          			<td>			
          				<span class="label">出版社</span> <?php echo $book['book_press'] ?>
          			</td>
          		</tr>
          		<tr>	
          			<td>					
          				<span class="label">页数</span> <?php echo $book['book_page'] ?>	
          			</td>
          		</tr>
          	</tbody>
        </table> 
        <div style="clear: both;"></div>
        </div> <!--end hero-unit-->
        
        <!--2nd segment starts here-->
        <div class="well" style="max-width: 600px;margin: 15px auto;">             				
         <?php foreach ( $readers as $theReader): ?>
				<img src="../../../img/head/<?php echo $theReader['avatar'] ?>" alt="" width="48" class="thumbnail pull-left" style="margin-right: 10px;"/>	
				<strong style="color: #0088D0;">
				    <?php echo $theReader['username'] ?>
           
					
          &nbsp@ <?php echo $theReader['note_date'] ?>
				</strong>
			<div class="note_content" style="margin:10px;">		
			    <?php echo $theReader['note_content'] ?>
			</div>
			<a href="../readnote/<?php echo $theReader['book_id'] ?>/<?php echo $theReader['user_id'] ?>" class="btn btn-mini btn-primary pull-right">更多TA的笔记</a>
			<div id="" style="clear: both;"></div>
			
			<hr>

          <?php endforeach ?> 

        </div> <!--end hero-unit-->
      </div><!--/span-->          
    </div> <!-- /container -->



  

</body>
</html>