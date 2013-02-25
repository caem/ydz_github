<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
	<meta charset="UTF-8" />
	<title>阅读志</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/script/jquery-1.7.2.min.js"></script>
    <script src="/script/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />

		<style type="text/css">
		  .hero-unit{
		  	padding: 10px 30px 10px 30px;
		  }	
	    </style>

</head>
<body>
    <?php if($signIn) {include('navbar.php');} else{?>
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
      <div class="row-fluid"> 
        <div class="span8"> 
          <!--1st segment starts here-->
	      <div class="well">
	              <h3>《<?php echo $note['book_info'][0]['book_title'] ?>》</h3>
	              
	              
		          <img alt="cover" src="<?php echo $note['book_info'][0]['book_cover'] ?>" class="pull-right"/>
		          
		          <table class="table-condensed pull-left" id="readnote_book_info">
		          	<tbody>
		          		<tr>
		          			<td>	          				
		          				<span class="label">作者</span> <?php echo $note['book_info'][0]['book_author'] ?>
		          			</td>
		          			<td>
		          			    <span class="label"> 开始阅读</span> <?php echo date('Y-m-d',strtotime( $note['book_info'][0]['meta_begin'])) ?>
		          			</td>	
		          		</tr>
		          		<tr>
		          			<td>	    	
		          				<span class="label">ISBN</span> <?php echo $note['book_info'][0]['book_isbn'] ?>
		          			</td>
		          			<td>
		          				<span class="label">预计天数</span> <?php echo $note['book_info'][0]['meta_duration'] ?>天
		          			</td>
		          		</tr>
		          		<tr>
		          			<td>			
		          				<span class="label">出版社</span> <?php echo $note['book_info'][0]['book_press'] ?>
		          			</td>
		          			<td>
		          				<span class="label">已读天数</span> <?php echo $note['book_info'][0]['meta_duration'] ?>天
		          			</td>
		          		</tr>
		          		<tr>	
		          			<td>					
		          				<span class="label">页数</span> <?php echo $note['book_info'][0]['book_page'] ?>	
		          			</td>
		          			<td>
		          				<span class="label">笔记总数</span> <?php echo $note['book_info'][0]['meta_sum'] ?>条</li>	
		          			</td> 
		          		</tr>
		          		
		          		<?php if($signIn==true && $author['username'] != $session['username']){ ?>
		          		<tr>
		          		   <td>
		          		   <?php if($hasSub){ ?>
		          		   	<button class="btn span4" onclick="unSubscribe()">取消订阅</button>
		          		   <?php }else{ ?>
		          		    <button class="btn btn-warning span4" onclick="subscribe()">订阅</button>
		          		   <?php } ?> 
		          		   </td>
		          		</tr>
		          		<?php } ?>
		          	</tbody>
	          </table> 
	              <div style="clear: both;"></div>
	          
	          </div> <!--end of well-->
	
          <!--2nd segment starts here-->
          <div class="">
          
                    <?php $comm_counter = 0 ?>            				
                    <?php foreach ( $note['note'] as $note_item): ?>
           			  <ul class="pagebox" style="list-style: none;">
           			   <li>
          				<strong style="color: #0088D0;">
          					<?php echo date('Y-m-d',strtotime( $note_item['note_date'])) ?>
          				</strong>
          
          				
            			<div style="margin: 5px;">		
            			    <?php echo $note_item['note_content'] ?>
            			    <br />
            			    <div style="margin-top: 5px;">
            			      <a value="<?php echo $note_item['note_id'] ?>" class="comm" style="cursor: pointer;">
            			        评论(<span id="comm_counter<?php echo $note_item['note_id']?>"><?php echo $total[$comm_counter++] ?></span>)
            			      </a>
            			    </div>
            			    
            			    <div id="comment<?php echo $note_item['note_id'] ?>" class="commdiv" style="display: none;">
            			    </div> <!--end of .comment div-->
            			    <div class="comment_form" style="display: none;">
            			    	<form id="form<?php echo $note_item['note_id'] ?>">
            			    	    <textarea placeholder="<?php echo $session['username'] ?>:" name="comm_content" class="span8" style="min-width:240px;" rows="3" maxlength="800"></textarea>
            			    	    <?php echo form_error('comm_content'); ?>
            			    		<button class="btn btn-info btn-mini" style="max-width: 40px;" onclick="subComm(<?php echo $note_item['note_id'] ?>)">提交</button>
            			    	</form>
            			    </div>			
            			</div>
          		   </li>
          		   </ul>
                    <?php endforeach ?> 
                      
          		  </div> <!--end out-most widget-->
        </div><!--/span-->
        
        <div class="span4"> 
            <!--statistic display section-->
        	<div class="well sidebar-nav" style="background-color: whiteSmoke; padding-bottom: 10px;">
        	   <h3>Ta的信息</h3>
        	   <hr style="margin: 5px 0px;">
			   <table>
			   	<tbody>
			   	  <tr>
			   	    <td style="width: 50%;">
			           <div class="" style="margin-right: 12%;">
					<img src="/img/head/<?php echo $author['avatar'] ?>" class="thumbnail" alt="<?php echo  $author['username'] ?>" class="fl headimg" style="width: 48px; height: 48px; display: inline;"/>
					<?php echo  $author['username'] ?>
				  </div>	
			         </td>  
					    <td rowspan="2">
					      <ul class="nav nav-pills well" style="width: 120px;padding: 10px;">
					  <li><a href="#">笔记总数&nbsp <span class="badge badge-info"><?php echo $author['note_sum'] ?></span></a></li>
					  <li><a href="#">阅读总数&nbsp<span class="badge badge-warning"><?php echo $author['book_sum'] ?></span></a></li>
					  <li><a href="#">收藏&nbsp&nbsp<span class="badge badge-success">0</span>&nbsp&nbsp</a></li>
					</ul>
					    </td>
					  </tr>
					  <tr>
					    <td>  <?php $stat_note = $author['note_sum']*100/($author['note_sum'] +$author['book_sum']+1); 
					                $stat_book = $author['book_sum']*100/($author['note_sum'] +$author['book_sum']+1);
					                $stat_mark = (0                   *100)/($author['note_sum'] +$author['book_sum']+1);
					          ?>  
							<ul class="" >
							  <li class="label stats label-info" style="width: <?php echo $stat_note+4 ?>%;"><?php echo $author['note_sum'] ?></li>
							  <li class="label stats label-warning" style="width: <?php echo $stat_book+4 ?>%;"><?php echo $author['book_sum'] ?></li>
							  <li class="label stats label-success" style="width: <?php echo $stat_mark+4 ?>%;">0</li>
							</ul>
						</td>	
					  </tr>
				    </tbody>
				  </table> 	    
			   
			</div><!--/.well -->
            <div class="well sidebar-nav" style="background-color: whiteSmoke;">
       	  		<span class="label label-info" style="font-size: 14px;">Ta最近在读</span>
       	  	    <hr>
       	  	    <?php foreach ( $booklist as $book): ?>
       	  	    <table class="table table-condensed">
       	  	    		<tbody>
       	  	    		  <tr>
       	  	    		    <td colspan="2">
       	  	    		      《<?php echo $book['book_title'] ?>》
       	  	    		    </td>
       	  	    		  </tr>
       	  	    		  <tr>
       	  	    		    <td style="width: 35%;">
       	  	    	          <img src="<?php echo $book['book_cover'] ?>" class="thumbnail" alt="" style=""  width="65" height="90"/>	
       	  	    	        </td>  
       	  	    			<td>
       	  	    				<ul style="list-style: none;">
       	  	    					<li class="booklist"><span class="label">作者</span> <?php echo $book['book_author'] ?></li>
       	  	    					<li class="booklist"><span class="label label-warning">出版社</span> <?php echo $book['book_press'] ?></li>
       	  	    					<li class="booklist"><span class="label label-info">ISBN</span> <?php echo $book['book_isbn'] ?></li>
       	  	    				</ul>
       	  	    			</td>
       	  	    		  </tr>
       	  	    		 </tbody>
       	  	    </table>
       	  	    <?php endforeach; ?>
       	  		<!--<ul style="margin: 15px;">

       	  			<?php foreach ( $booklist as $book_item ): ?>
       	  				<li style="list-style: none;">
       	  				    <a href="#">《<?php echo $book_item['book_title'] ?>》</a>
       	  				    <img style="position: relative;left: 10%;" class="thumbnail" width="65" height="90" src= "<?php echo $book_item['book_cover'] ?>" alt="book cover">
       	  				</li>
       	  			<?php endforeach; ?>
       	  		</ul>-->
           </div><!--/.well -->
        
        </div>
            
      </div><!--/row-->
      <?php include('footer.php') ?>
    </div><!--/.fluid-container-->

<div class="modal hide" id="delCommModal" style="max-width: 400px; top: 70%;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>温馨提示</h3>
  </div>
  <div class="modal-body">
    <p style="text-align: center;">一旦删除将无法恢复，你确定要删除这条评论吗？</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="delCommConf">确定</a>
  </div>
</div>

	</body>

<script type="text/javascript">
 var reply_to = "";
 var to_author = "<?php echo $note['book_info'][0]['username'] ?>";
 var now_user = "<?php echo $session['username'] ?>";
 var isMatch = false;
 var ref_comment_id;
 var ref_note_id; 

$(document).ready(function(){
  $('.commsubm.disabled').hide();//hide 提交中... in comment submit form
  var url = window.location;
  var pattern = /#comment(\d+)-(\d+)/gi;
  //var pattern2 = /readnote\/\d\/(\d+)/gi
  var match = pattern.exec(url);
  //var user_id = pattern2.exec(url);
/*
  if ( user_id != null && user_id.length == 2) {
		to_author = user_id[1];	
  }
  */
  if ( match != null && match.length == 3){
        ref_note_id= match[1];
        ref_comment_id = match[2];
        var who = "#box" + ref_note_id;
       
        $(who).click();
        isMatch = true;
  }

  $('.brand').after('<a class="brand" href="" >: <span style="font-size:14px; color:white">浏览笔记</span ></a>');
  $('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
                             function(){$(this).find('i').removeClass("icon-white");}
                      );
  $('.comment_form').hide();
});

$(".comm").live("click",function() { 
      var id = $(this).attr("value");   
      $("#comment"+id).siblings('.comment_form').toggle();

//count the element in comment div so as to enable/disable ajax
           if( $("#comment"+id).find('div').size() <= 0 && $(this).find('span').html() > 0 ){
              var data={'note_id':id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'};
              $.ajax({
                    type: "POST",
                    url: "../../comment",
                    data: data,
                    beforeSend: function() { // add the loadng image
                            $("#comment"+id).append('<img src="/img/facebook_style_loader.gif" />');
                          },
                    success: function(result) {
                        
                        $("img[src='/img/facebook_style_loader.gif']").remove();
                        $("#comment"+id).append(result).hide().fadeIn();
                        if (isMatch) {
                          now = ".comm_id[value=" + ref_comment_id + "]";
                         $(now).show();
                          $("html,body").animate({scrollTop: $(now).offset().top - 42}, 1000); //42 is the height of navbar
                          $("#comment"+id).siblings('.comment_form').show();
                        }
                    }
              });
           }else {
        $("#comment"+id).toggle('fade');
           }
});


$(".commDel").live("click",function() {
  var commid = $(this).parent().find('.comm_id').attr("value");
  var noteid = $(this).parent().find('.note_id').attr("value");
  $('#delCommModal').modal('show');
  $('#delCommConf').live("click",function() {
                        var data={
                                  'comm_id':commid,
                                  'note_id':noteid,
                                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'
                                  };
                        $.ajax({
                              type: "POST",
                              url: "<?php echo base_url()?>index.php/comment/del_comment",
                              data: data,
                              beforeSend: function() { // add the loadng image
                                      $('#delCommModal').modal('hide');
                                      $("#comment"+noteid).append('<img src="/img/facebook_style_loader.gif" />');
                                    },
                              success: function(result) {
                                  $("img[src='/img/facebook_style_loader.gif']").remove();
                                  $("#comment"+noteid).find('div').remove(); //clear previous comments for reloading them all next
                                  //$("#comm_counter"+noteid).html(parseInt($("#comm_counter"+noteid).html())-1); //update comment counter
                                  $("#comment"+noteid).append(result).hide().fadeIn();
                              }
                        });  
                    }
             );
});

$(".reply").live("click",function() {
                      var str = $(this).parent().find('p2:first').html();
                      str = str.split(' ');
                      replyTo = str[0];
                      $(this).parent().parent().next().find('textarea').focus();
                      $(this).parent().parent().next().find('textarea').val('回复'+replyTo+': ');                
                  }
            );
            
function subComm(note_id) { 
      
      var id = note_id;
       if($.trim($("#form"+id).find('textarea').val())=='') return false;
       
       $("#form"+id).find('textarea').attr("disabled", true);
       $("#form"+id).find('button').attr("disabled", true);
       
       var text = $("#form"+id).find('textarea').val();
       var pattern = /\u56DE\u590D(.*?):/gi;
        var match = pattern.exec(text);
        if ( match != null && match.length == 2) {
			reply_to = match[1];
		}
		 
      //\u56DE\u590D(.*):;
      
      var data={
                'note_id':id,
                'book_id':<?php echo $note['book_info'][0]['book_id']?>,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>',
                'user_id':<?php echo $session['user_id'] ?>,
                'com_content':$("#form"+id).find('textarea').val(),
                'reply_to':reply_to,
				'to_author':to_author
               };
      $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php/comment/write_comment",
            data: data,
            beforeSend: function() { // add the loadng image
                //    $(this).append('<img src="/img/facebook_style_loader.gif" />');
                  },
            success: function(result) {
                //socket.emit("username","test user");
				if ( reply_to != "" )
					socket.emit("reply_to",reply_to);  //notification
				if ( to_author != "" && to_author != now_user )
					socket.emit("reply_to",to_author);  //notification
               // $("img[src='/img/facebook_style_loader.gif']").remove();
                $("#comment"+id).find('div').remove(); //clear previous comments for reloading them all next
                $("#form"+id).find('textarea').val('');//clear textarea
                $("#comm_counter"+id).html(parseInt($("#comm_counter"+id).html())+1); //update comment counter
                $("#comment"+id).append(result).hide().fadeIn();
                
                $("#form"+id).find('textarea').attr("disabled", false);
                $("#form"+id).find('button').attr("disabled", false);
            }
      });
}
function subscribe(){
     var data={
                'user_id':<?php echo $session['user_id'] ?>,
                'from_user_id':<?php echo $from_user_id ?>,
                'from_book_id':<?php echo $note['book_info'][0]['book_id']?>,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'
               };
    $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php/square/subscribe",
            data: data,
            beforeSend: function() { 
                      $(this).attr("disabled", true);
                  },
            success: function(result) {
                window.location.reload(true);
            }
      });

}
function unSubscribe(){
     var data={
                'user_id':<?php echo $session['user_id'] ?>,
                'from_user_id':<?php echo $from_user_id ?>,
                'from_book_id':<?php echo $note['book_info'][0]['book_id']?>,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'
               };
    $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php/square/unSubscribe",
            data: data,
            beforeSend: function() { 
                      $(this).attr("disabled", true);
                  },
            success: function(result) {
                window.location.reload(true);
            }
      });

}



</script>
</html>
