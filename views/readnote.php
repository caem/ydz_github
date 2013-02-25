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
    <?php include('navbar.php') ?>
    <div class="container-fluid">
      <div class="row-fluid"> 
        <div class="span8"> 
          <!--1st segment starts here-->
          <div class="">
		  <span style="font-size: 16pt;" class="label label-warning">《<?php echo $note['book_info'][0]['book_title'] ?>》</span>&nbsp所有笔记：
		  <br /><br />
          <?php $comm_counter = 0 ?>            				
          <?php foreach ( $note['note'] as $note_item): ?>
 			  <ul class="pagebox" style="list-style: none;">
 			   <li>
				<strong style="color: #0088D0;">
					<?php echo date('Y-m-d',strtotime( $note_item['note_date'])) ?>
				</strong>

				<a href="../editnote/<?php echo $note_item['note_id'] ?>">编辑</a>
				<a href="#" onclick="return del('../delnote/<?php echo $note_item['note_id'] ?>/<?php echo $note['book_info'][0]['book_id'] ?>')">删除</a>
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
        
        <div class="well span4" style="background-color: whiteSmoke;">
           <table class="table table-condensed">
               <tbody>
	    		  <tr>
	    		    <td colspan="2">
	    		      <h3>《<?php echo $note['book_info'][0]['book_title'] ?>》</h3>
	    		    </td>
	    		  </tr>
	    		  <tr>
	    		    <td style="width: 35%;">
	    	          <img src="<?php echo $note['book_info'][0]['book_cover'] ?>" class="thumbnail" alt="" style=""  width="65" height="90"/>	
	    	        </td>  
	    			<td>
	    				<ul style="list-style: none;">
	    					<li class="booklist"><span class="label">作者</span> <?php echo $note['book_info'][0]['book_author'] ?></li>
	    					<li class="booklist"><span class="label label-warning">出版社</span> <?php echo $note['book_info'][0]['book_press'] ?></li>
	    					<li class="booklist"><span class="label label-info">ISBN</span> <?php echo $note['book_info'][0]['book_isbn'] ?></li>
	    					<li class="booklist"><span class="label label-info">开始阅读</span> <?php echo date('Y-m-d',strtotime( $note['book_info'][0]['meta_begin'])) ?></li>
	    					<li class="booklist"><span class="label label-info">预计天数</span> <?php echo $note['book_info'][0]['meta_duration'] ?>天</li>
	    					<li class="booklist"><span class="label label-info">已读天数</span> <?php echo $note['book_info'][0]['meta_duration'] ?>天</li>
	    					<li class="booklist"><span class="label label-info">笔记总数</span> <?php echo $note['book_info'][0]['meta_sum'] ?>条</li>
	    				</ul>
	    			</td>
	    		  </tr>
	    	   </tbody>
           </table>
           <hr>
           <div class="" style="margin-top: 10px;">           
              <p>
                <a class="btn btn-primary btn-large" href="../readnote_flow/<?php echo $note['book_info'][0]['book_id'] ?>">开启阅读流</a> &nbsp——让阅读更加赏心悦目
              </p>
              <br/>
              <p>
                <a class="btn btn-large" style="width: auto;" href="/index.php/mine/newnote/<?php echo $note['book_info'][0]['book_id'] ?>"  >添加笔记</a>
              </p>

          </div>               	  		
        </div><!--/.well -->    
      </div><!--/row-->
      
      <?php include('footer.php') ?>
    </div><!--/.fluid-container-->
    
    
    
    

    <div class="modal hide" id="delModal" style="max-width: 400px; top: 70%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>温馨提示</h3>
      </div>
      <div class="modal-body">
	    <p style="text-align: center;">一旦删除将无法恢复，你确定要删除这条笔记吗？</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">取消</a>
        <a href="#" class="btn btn-primary" id="delConf">确定</a>
      </div>
    </div>
    
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
$(document).ready(function(){
  $('.commsubm.disabled').hide();//hide 提交中... in comment submit form
  
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
              var data={"note_id":id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'};
              $.ajax({
                    type: "POST",
                    url: "../comment",
                    data: data,
                    beforeSend: function() { // add the loadng image
                            $("#comment"+id).append('<img src="/img/facebook_style_loader.gif" />');
                          },
                    success: function(result) {
                        $("img[src='/img/facebook_style_loader.gif']").remove();
                        $("#comment"+id).append(result).hide().fadeIn(); 
                        $(".reply").before('<a class="commDel" style="cursor:pointer; float:right;margin-left:15px;">删除</a>');
                    }
              });
           }else {
        $("#comment"+id).toggle('fade');
           }
      
});

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
                'reply_to':reply_to
               };
			$.ajax({
                    type: "POST",
                    url: "<?php echo base_url()?>index.php/comment/write_comment",
                    data: data,
                    beforeSend: function() { // add the loadng image
                            //$(this).append('<img src="/img/facebook_style_loader.gif" />');
                          },
                    success: function(result) {
                       socket.emit("reply_to",reply_to);  //notification
                        //$("img[src='/img/facebook_style_loader.gif']").remove();
                        $("#comment"+id).find('div').remove(); //clear previous comments for reloading them all next
                        $("#form"+id).find('textarea').val('');//clear textarea
                        $("#comm_counter"+id).html(parseInt($("#comm_counter"+id).html())+1); //update comment counter
                        $("#comment"+id).append(result).hide().fadeIn();
                        $(".reply").before('<a class="commDel" style="cursor:pointer; float:right; margin-left:15px;">删除</a>'); 
                        
                        $("#form"+id).find('textarea').attr("disabled", false);
                        $("#form"+id).find('button').attr("disabled", false);
                    }
              });
}


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
                                  //$('#delCommModal').modal('hide');         
                                  $("img[src='/img/facebook_style_loader.gif']").remove();
                                  $("#comment"+noteid).find('div').remove(); //clear previous comments for reloading them all next
                                  //$("#comm_counter"+noteid).html(parseInt($("#comm_counter"+noteid).html())-1); //update comment counter
                                  $("#comment"+noteid).append(result).hide().fadeIn();
                                  $(".reply").before('<a class="commDel" style="cursor:pointer; float:right; margin-left:15px;">删除</a>');
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

function del(url){
  $('#delModal').modal('show');
  $('#delConf').attr("href",url);
}
</script>
</html>
