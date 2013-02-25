<div class="span4 pagebox test_paper_effect"> 
    <!--statistic display section-->
	<div class="well sidebar-nav" style="background-color:transparent !important;border:none; padding-bottom: 10px;">
			   <table>
			   	<tbody>
			   	  <tr>
			   	    <td style="width: 50%;">
			           <div class="" style="margin-right: 12%;">
					<img src="/img/head/<?php echo $session['avatar'] ?>" class="thumbnail" alt="<?php echo  $session['username'] ?>" class="fl headimg" style="width: 48px; height: 48px; display: inline;"/>
					<?php echo  $session['username'] ?>
				  </div>	
			         </td>  
					    <td rowspan="2">
					      <ul class="nav nav-pills well" style="width: 120px;padding: 10px;">
					  <li><a href="#">笔记总数&nbsp <span class="badge badge-info"><?php echo  $session['note_sum'] ?></span></a></li>
					  <li><a href="#">阅读总数&nbsp<span class="badge badge-warning"><?php echo  $session['book_sum'] ?></span></a></li>
					  <li><a href="#">收藏&nbsp&nbsp<span class="badge badge-success">0</span>&nbsp&nbsp</a></li>
					</ul>
					    </td>
					  </tr>
					  <tr>
					    <td>  <?php $stat_note = $session['note_sum']*100/($session['note_sum'] +$session['book_sum']+1); 
					                $stat_book = $session['book_sum']*100/($session['note_sum'] +$session['book_sum']+1);
					                $stat_mark = (0                   *100)/($session['note_sum'] +$session['book_sum']+1);
					          ?>  
							<ul class="" >
							  <li class="label stats label-info" style="width: <?php echo $stat_note+4 ?>%;"><?php echo $session['note_sum'] ?></li>
							  <li class="label stats label-warning" style="width: <?php echo $stat_book+4 ?>%;"><?php echo $session['book_sum'] ?></li>
							  <li class="label stats label-success" style="width: <?php echo $stat_mark+4 ?>%;">0</li>
							</ul>
						</td>	
					  </tr>
				    </tbody>
				  </table> 	    
<!--			   <hr style="margin: 5px 0;">
			   <a id="readNew" class="btn btn-inverse" href="/index.php/mine/selectbook">阅读新书</a>-->
			</div><!--/.well -->
	       
    <!--  recent reading starts here-->
    <div class="well sidebar-nav" style="background-color: transparent !important; border: none;">
       	  		<span class="label label-info" style="font-size: 14px;">最近阅读</span>
       	  	    <hr>
       	  		<ul style="margin: 15px;">

       	  			<?php
       	  				$this->load->helper('url');
       	  				$url = uri_string();
       	  				if ( !stristr($url , 'readnote') )
       	  				{
       	  					
       	  					foreach ( $note as $book_item ): 
       	  			?>
       	  				<li><a href="#"><?php echo $book_item['book_title'] ?></a></li>
       	  			<?php
       	  				  	endforeach;
       	  				} else {
       	  					foreach ( $note['book_info'] as $book_item ):
       	  			?>
       	  				<li><a href="#"><?php echo $book_item['book_title'] ?></a></li>
       	  			<?php
       	  					endforeach;
       	  				}
       	  			?>
       	  		</ul>
           </div><!--/.well -->
           
<!--  <div class="well sidebar-nav" style="background-color: whiteSmoke;">
  		<span class="label label-info" style="font-size: 14px;">标签云</span>
  		<hr>
			<div class="inner" style="line-height: 2.5em;">
				<a class="label label-success" style="font-size: medium;">心理学</a>
				<a class="label label-success" style="font-size: medium;">价值观</a>
				<a class="label label-success" style="font-size: medium;">理想</a>
				<a class="label label-success" style="font-size: medium;">商业模式</a>
				<a class="label label-success" style="font-size: medium;">成功</a>
				<a class="label label-success" style="font-size: medium;">读书</a>
				<a class="label label-success" style="font-size: medium;">经济学原理</a>
			</div>
</div><!--/.well --*>-->

</div><!--/span-->
