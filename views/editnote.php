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
			  	padding: 30px 10px 10px 10px;
			  }
		
		    </style>
<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	$('.brand').after('<a class="brand" href="" >: <span style="font-size:14px; color:white">编辑笔记</span ></a>');
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
          <div class="hero-unit" id = "create_note_panel">
			<span class="label label-warning" style="padding: 1px 1px; line-height: 26px; font-size: 24px; position: absolute; top: 10px; left: -15px; ">编辑笔记</span>
          	<h2 style="color: #08C; margin-bottom:20px;"><?php echo $note['book_info'][0]['book_title']?></h2>
          	<div id="create_note_bookinfo">
				    <span class="label label-info">开始时间</span><span style="margin:0 5px;"><?php echo date('Y-m-d',strtotime($note['book_info'][0]['meta_begin'])) ?></span>
				    <span class="label label-info" style="margin-left: 10px;">已读天数</span><span style="margin:0 5px;"><?php echo $note['book_info'][0]['meta_duration'] ?>天</span>
				    <span class="label label-info" style="margin-left: 10px;">笔记总数</span><span style="margin:0 5px;"><?php echo $note['book_info'][0]['meta_sum'] ?>条</span>

			</div>
	        <?php echo form_open('mine/updatenote/'); ?>
	        <input type="hidden" name="note_id" value=<?php echo $note_id ?>>	
	        <input type="hidden" name="book_id" value=<?php echo $note['book_info'][0]['book_id'] ?>>
	        <div id="textarea" >
				<textarea id="editor" name="note_content" style="margin:5px; padding: 5px;width: 100%;height: 376px;">
			<?php echo $note_content ?>	</textarea>
			</div>
			<input class="btn btn-info pull-right" value="保存修改" type="submit" id="submit" />
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
                                                'insertunorderedlist', '|', 'emoticons',  'link']
                                });
                        });
                </script>

	</body>
	<script type="text/javascript">
//	$('#submit').click(function checkcontent() {
//	      var text = $('#editor').val();
//	      if ( $.trim(text) == "" ) {
//	      	$('#confModal').modal('show');
//	      	$('#conf').click(function() {
//	              $('#confModal').modal('hide');
//	       });
//	      	return false;
//	      }else{
//	      	return true;
//	      }
//	      
//	});
	</script>
</html>
