<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>选择书籍</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />

    <style type="text/css">
	  
      .hero-unit{
      		padding: 10px;
      }

    </style>
<script src="/script/jquery-1.7.2.min.js"></script>
<script src="/script/bootstrap.js"></script>


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>  
    <?php include('navbar.php') ?>   
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="widget" id="center_panel_500">        
            <div class="widget-header">
                <i class="icon-book"></i>
                <h3>选择书籍</h3>
            </div>
            <div class="widget-content">
                

                <div class="control-group" >
                   <div style="margin:0 auto;width:278px;">  
                    <input placeholder="请输入标题" data-provide="typeahead"  type="text" class="input pull-left" id="title" name="book_title" />
                    <button type="submit" id="check" class="btn btn-primary pull-left" style="margin-left:10px;">查询</button>
                    <div style="clear:both"></div>
                    <!-- <p id="checkfail" class="help-block" style="display: none;">
                      对不起，你要读的书还没有被我们收录。<br />如果你可以帮忙添加，我们将非常感激！
                    </p> -->
                  </div>
                  
                </div>

                <div class="control-group" id="bookinfo" style="display:none;">
                  <div id="select_book_info">
                    <img class="pull-left" id="cover" style="width:106px;"/>
                    <ul class="pull-left book_info">
                      <li ><span class="label select_book_item" >作者</span><span id="author"></span></li>
                      <li ><span class="label select_book_item" >出版社</span><span id="press"></span></li>
                      <li ><span class="label select_book_item" >出版日期</span><span id="date"></span></li>
                      <li ><span class="label select_book_item" >页数</span><span id="page"></span></li>
                      <li ><span class="label select_book_item" >ISBN</span><span id="isbn"></span></li>
                      <li id="bookAdded" style="display:none"></li>
                    </ul>
                     <div style="clear:both"></div>
                  </div>
                   
                </div>
                
            
            
                        
          <div class="form-actions" id="nextstep">
            <a  id="next" class="btn btn-primary">下一步</a>
            <a id="cancel" class="btn" href="/index.php/mine">放弃</a>
          </div>
       </div>
        
      </div>

      <?php include('footer.php') ?>



    </div> <!-- /container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
  
  <script src="/script/jquery-1.7.2.min.js"></script>
  <script src="/script/jquery.placeholder.min.js"></script>
  <script src="/script/bootstrap-typeahead.js"></script>
  <script>
  function getBookFromDouban(query) {
    var id = '';
  	var data={"title":query,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'};
  	$.ajax({
  	  type: "POST",
  	  url: "doubanApi",
  	  data: data,
      beforeSend: function() { // add the loadng image
                            $('#select_book_info').html('<img src="/img/facebook_style_loader.gif" />');
                          },
  	  success: function(results) {
  	      //console.log(results);
  	      $('#select_book_info').html(results);
  	      $('#bookinfo').show();
          var bookid = $('#bookAdded').html();
          if (bookid!=null)
              $('#next').attr('href',('/index.php/mine/newnote/'+bookid)); 
  	  }
  	});	
  }
  
  $(document).ready(function(){
  	$('.brand').after('<a class="brand" href="" >: <span style="font-size:14px; color:white">阅读新书</span ></a>');
  	//icon hover effect
  	$('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
  	                           function(){$(this).find('i').removeClass("icon-white");}
  	                    );
  });

    $(function() {
     $('#title').typeahead({  
        property: "book_title",     
        source: function (typeahead, query) {          
            if ( query!="" ) {
              var data={"title":query,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'};
              $.ajax({
                type: "POST",
                url: "checktitle",
                data: data,
                success: function(results) {
                    //console.log(results);
                    typeahead.process(eval(results));
                    if(results.length <= 2){
                          
//                        $('#nextstep').hide();
//                        $('#bookinfo').hide();
//                        $('#checkfail').fadeIn();
//                    	$('#addbook').fadeIn('slow');
                    }
                    else{
                    	$('#checkfail').fadeOut();
                    	$('#addbook').fadeOut('slow');
                    	$('#nextstep').show();
                    }                 
                }
              });    
            }//end if
        } ,
        
        onselect: function (obj) {
          $('#title').val(obj.book_title);
          $('#next').attr('href','/index.php/mine/newnote/'+obj.book_id);
          //alert(obj.book_isbn);
          var data={"book_id":obj.book_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'};
          $.ajax({
                type: "POST",
                url: "checkbookinfo",
                data: data,
                success: function(results) {
                    //console.log(results);
                    var t = eval(results);
                    
                    $('#cover').attr("src",t[0]['book_cover']);
                    $('#author').html(t[0]['book_author']);
                    $('#press').html(t[0]['book_press']);
                    $('#date').html(t[0]['book_date']);
                    $('#page').html(t[0]['book_page']);
                    $('#isbn').html(t[0]['book_isbn']);
                    $('#bookinfo').show();             
                }
          });  
        }

      });
      $('input, textarea').placeholder();
      /*
      $("#title").keydown(function (e) {
          alert(e.which);
      });*/

      $('#check').click(function() {
       getBookFromDouban( $('#title').val() );
       
       var e = jQuery.Event("keyup");
       e.which = 39 ; //keycode 39 refers to right button
       $('#title').trigger(e); //trigger keyup event to trigger lookup
  
      });
    });
  </script>
  </body>
</html>
