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
	<script src="/script/bootstrap-typeahead.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	    $('li:has(a[href="<?php echo base_url()?>index.php/mine"])').addClass("active");//highlight current page in top-navbar
	    //icon hover effect
	    $('a[href="<?php echo base_url()?>index.php/mine"] i').addClass("icon-white");
	    $('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
	                               function(){$(this).find('i').removeClass("icon-white");}
	                        );
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
    <?php include('navbar.php') ?>
    <div class="container-fluid">
      <div class="row-fluid"> 
        <div class="span8"> 

          <div class="well paper_list">    
          	
          		<ul class="nav nav-tabs" style="margin-top: -10px;">
          		  <li class="active">
          		    <a href="#note_item" data-toggle="tab">读过的书</a>
          		  </li>
          		  <li><a href="#subscribe_item" data-toggle="tab">订阅</a></li>
          		  <a id="readNew" class="btn btn-inverse pull-right" onclick="location='/index.php/mine/selectbook'" >阅读新书</a>
                </ul>
             <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="note_item">
          	    <?php foreach ( $note as $note_item): ?>
          	   <div class="pagebox"> 
          	    <div class="pull-left recent_book_cover" >
          	        <img style="border:0px;" src=<?php echo '"'.$note_item['book_cover'] .'"'  ?> alt="book image">
          	    </div>
          	    
          	    <strong><a href="#" style="font-size:1.5em;"><?php echo $note_item['book_title'] ?></a></strong>
          	    
          	    <div class="meta_info">
          	        <span class="label label-info">开始时间</span><span style="margin:0 5px;"><?php echo date('Y-m-d',strtotime($note_item['meta_begin'])) ?></span>
          	        <span class="label label-info">已读天数</span><span style="margin:0 5px;"><?php echo $note_item['meta_duration'] ?>天</span>
          	        <span class="label label-info">笔记总数</span><span style="margin:0 5px;"><?php echo $note_item['meta_sum'] ?>条</span>
          	    </div>
          	    
          	    <div class="note_content">
          	    	<?php echo $note_item['note_content'] ?>
          	    </div>	
          	    					
          	    						
          	    <div class="note_btn_panel">
          	    	<a class="btn btn-info" href="/index.php/mine/newnote/<?php echo $note_item['book_id'] ?>"  > 添加笔记</a>
			    <a class="btn btn-default" href="/index.php/mine/readnote/<?php echo $note_item['book_id'] ?>">浏览笔记</a>
			    <div><!-- JiaThis Button BEGIN -->
				    <div class="jiathis_style">
				    	<a href="http://www.jiathis.com/share?uid=0" class="jiathis jiathis_txt" target="_blank" style=""><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border="0"></a>
				    	<a class="jiathis_counter_style_margin:3px 0 0 2px"><span class="jiathis_button_expanded jiathis_counter jiathis_bubble_style" id="jiathis_counter_45" style="margin-top: 3px; margin-right: 0px; margin-bottom: 0px; margin-left: 2px; " title="累计分享7553次">7.6K</span></a>
				    </div>
				    <script type="text/javascript">
				    var jiathis_config = {do_not_track:'true',data_track_clickback:'true'};
				    </script>
				    <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=1" charset="utf-8"></script>
			    <!-- JiaThis Button END --></div>									
          	    </div>
		</div>

  <!--        	    <hr> -->
             <?php endforeach ?>
         	</div> <!--end of note_item-->

	         	<div class="tab-pane fade" id="subscribe_item">
	             <?php foreach ( $subscribe as $subscribe_item): ?>
	
	          	    <div class="pull-left sub_userhead" >
	          	        <img style="border:0px;" src="/img/head/<?php echo $subscribe_item['avatar'] ?>" class="thumbnail" width="48px" height="48px" alt="user head">
	          	    </div>
	          	    
	          	    <strong><a href="#" style="font-size:1.5em;"><?php echo $subscribe_item['book_title'] ?></a></strong>
	          	    
	          	    <div class="meta_info">
	          	    	<span class="label label-info">作者</span><span style="margin:0 5px;"><?php echo $subscribe_item['username'] ?></span>
	          	       <span class="label label-info">发布时间</span><span style="margin:0 5px;"><?php echo date('Y-m-d',strtotime($subscribe_item['note_date'])) ?></span>
	          	    </div>
	          	    
	          	    <div  class="note_content">
	          	    	<?php echo $subscribe_item['note_content'] ?>
	          	    </div>	
	          	    					
	          	    					
	          	    <div class="note_btn_panel">
	          	    	<a class="btn btn-default" href="/index.php/square/readnote/<?php echo $subscribe_item['book_id'] ?>/<?php echo $subscribe_item['user_id'] ?>">浏览笔记</a>									
	          	    </div>
	          		
	          	    <hr>
	             <?php endforeach ?>
	         	</div> <!--end of subscribe_item-->
	         </div><!--end of tab content-->
	             
           </div>
        </div><!--/span-->
        
        <?php include('sidebar.php') ?>    
      </div><!--/row-->
      
      <?php include('footer.php') ?>
      
    </div><!--/.fluid-container-->
    

      <script>
      $('.nav-tabs a').click(function (e) {
  			e.preventDefault();
	  		$(this).tab('show');
			})

      </script>
	
	</body>
</html>
