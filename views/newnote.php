<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
	<meta charset="UTF-8" />
	<title>阅读志</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="/script/jquery-1.7.2.min.js"></script>
	<script src="/script/jquery.placeholder.min.js"></script>
	<script src="/script/bootstrap.js"></script>
	
	
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />

<script type="text/javascript">
$(document).ready(function(){
	$('.brand').after('<a class="brand" href="" >: <span style="font-size:14px; color:white">添加笔记</span ></a>');
	//icon hover effect
	$('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
	                           function(){$(this).find('i').removeClass("icon-white");}
	                    );
});

</script>

</head>
<body>
	<?php include('navbar.php') ?>
    <div class="container-fluid" style="max-width: 840px; margin: 0 auto;position: relative;">
      <div class="row-fluid"> 
        <div class="span12"> 

          <!--1st segment starts here-->
          <div class="hero-unit " id="create_note_panel">
			<span class="label label-warning" id = "create_note_label">添加笔记</span>
          	<h2 id="create_note_title"><?php echo $isNew ? $book_info[0]['book_title']: $note['book_info'][0]['book_title']?></h2>
          	<div id = "create_note_bookinfo">
				    <span class="label label-info">开始时间</span><span style="margin:0 5px;"><?php echo $isNew ? date("Y-m-d",time()) : date('Y-m-d',strtotime($note['book_info'][0]['meta_begin'])); ?></span>
				    <span class="label label-info" style="margin-left: 10px;">已读天数</span><span style="margin:0 5px;"><?php echo $isNew ? 1 : $note['book_info'][0]['meta_duration'] ?>天</span>
				    <span class="label label-info" style="margin-left: 10px;">笔记总数</span><span style="margin:0 5px;"><?php echo $isNew ? 0 : $note['book_info'][0]['meta_sum'] ?>条</span>

				    <?php
				    	//if ( $note['book_info'][0]['meta_sum'] > 3) :
				    ?>
				    <a class="label label-info pull-right" id="pagedown">下一页</a>
				    <a class="label label-info pull-right" id="pageup" style="margin-right: 10px;">上一页</a>
				    
				    <a  class="pull-right note_switch" style="color: #08C; margin-right: 10px; text-decoration: none;cursor:pointer;<?php echo $isNew?"display:none":"" ?>">显示笔记</a>
			</div>
			<hr id="end_note">
          	<!--<img style="margin-bottom:10px;" src="/img/bookcover/5.jpg" />-->
	          <div class="note_list" >	
	          	<?php 
	          		$count = 1;
	          		if ( !$isNew ) {
	          			foreach ($note['note']  as $note_item ) {
	          	?>
	          	<!--position: absolute;border: 1px solid #08C;color:#08C;right: 120px;-->
	          	<div class="itemt" style="display:none;">
	          	<div id="turn_page">
	          		<span class="label label-info mark" style="position: absolute; left: 0px;" >第<?php echo $count ?>篇</span>
	          		<span class="label label-info" style="position: absolute; right: 0px;" ><?php echo date('Y-m-d',strtotime($note_item['note_date'])) ?></span>
	          	</div>
	          	<p><?php echo $note_item['note_content']?></p></div>
				
				
				<?php 	$count ++;
				 		}
				 	} //end if
				?>
			</div>
			
			<hr id="end_note">
			<div style="position: relative; margin: 5px;height: 14px;">
	          		<span class="label label-info" style="position: absolute; right: 0px;" >现在</span>
	        </div>
	        <?php echo $isNew ? form_open('mine/postnote/true') : form_open('mine/postnote/'); ?>	
	        <input type="hidden" name="book_id" value=<?php echo $isNew ? $book_info[0]['book_id'] : $note['book_info'][0]['book_id'] ?>>
	        
	        <div id="textarea" >
				<textarea id="editor" name="note_content" id="new_note_content" style="margin:5px; padding: 5px;width: 100%; height: 376px;">
				</textarea>
			</div>
			<input class="btn btn-info pull-right" type="submit" value="添加笔记" id="submit"/>
          </div> <!--end out-most hero-unit-->
          <!--2nd segment starts here-->
          
      	</div>
      </div>

      <?php include('footer.php') ?>
    </div><!--/.fluid-container-->


<div class="modal hide" id="confModal" style="max-width: 400px; top: 70%;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>温馨提示</h3>
  </div>
  <div class="modal-body">
    <p style="text-align: center;">当前笔记内容为空，请您撰写笔记内容后再进行提交。</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary" id="conf">确定</a>
  </div>
</div>
	</body>

		<script charset="utf-8" src="/editor/kindeditor-min.js"></script>
		<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="note_content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'link']
				});
			});
		</script>		

<script>
// 		$('#submit').click(function checkcontent() {
//              var text = $('#editor').val();
//              if ( $.trim(text) == "" ) {
//              	$('#confModal').modal('show');
//              	$('#conf').click(function() {
//                      $('#confModal').modal('hide');
//               });
//              	return false;
//              }else{
//              	return true;
//              }
//              
//    	});
		$(function() {
			var isVisible = false;
			var $note_list = $(".note_list");
 			var note_sum = $note_list .find(".itemt").length;
 			var total_height = 30;			
 			var $first = $last = $note_list .find(".itemt:last");
 			var $row_num = 2;             // the rows of note per page
 			var showed = ($row_num < note_sum ) ? $row_num : note_sum;
 			var isTop = false;
 			var isBottom = true;
 			$('input, textarea').placeholder();
 			
 			//$note_list .find(".itemt").hide();
 			for ( var i = 0 ; i < showed ; i ++) {			
 				$first.show();
 				total_height += $first.height();
 				var $_prev =$first.prev();
 				if ( $_prev.height() == null ) {
 					isTop = true;
 				} else {
 					$first = $first.prev();
 				}
 			}
 			if ( note_sum != 1 ) {
 				$first = $first.next(); //the $first point to the first element which be shown now.
 			}
 			$note_list.css("height",total_height +"px");

 			$('#pageup').click(function() {	
 				if ( !isTop) {
 					
 					if ($first.prev().height() == null ) {
 						isTop = true;
 						return ;
 					} else {
 						$first = $first.prev();					 					
	 					total_height += $first.height() 
	 					total_height -= $last.height();
	 					$first.css('height', $first.height());
	 					$last.css('height', $last.height());
						$note_list.css("height",total_height +"px");
	 					$first.slideDown();
	 					$last.slideUp();
	 					$last = $last.prev();	
						if ( $last != $first) {
	 						isBottom = false;
	 					}
 					}
				}	
 			});

 			$('#pagedown').click(function() {
 				if ( !isBottom ) {
 					 if ( $last.next().height() == null ) {
 						isBottom = true;
 					}else {						
 						$last = $last.next();
 						$first.css('height', $first.height());
	 					$last.css('height', $last.height());
 						total_height += $last.height() 
 						total_height -= $first.height() ;

						$note_list.css("height",total_height +"px");
						$last.slideDown();
						$first.slideUp();
						$first = $first.next();
						if ( $last != $first) {
 							isTop = false;	
 						}
 					}
 				}
 			});

 			if (isVisible === false) {
 				$note_list.hide();
 				$('#end_note').hide();
 				$('#pagedown').hide();
 				$('#pageup').hide();
 			}
 			
 			$('.note_switch').click(function(){

 				if ( isVisible ) {
 					$note_list.slideUp();
 					$('#end_note').slideUp();
 					$(this).text('显示笔记');
 					$('#pagedown').hide();
 					$('#pageup').hide();
 					isVisible = false;
 				} else {
 					$note_list.slideDown();
 					$('#end_note').slideDown();
 					$(this).text('隐藏笔记');
 					if ( $row_num < note_sum) {
 						$('#pagedown').show();
 						$('#pageup').show();
 					}
 					isVisible = true;
 				}
 				
 			});

		});

	</script>
</html>
