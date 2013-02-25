
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container-fluid" >
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand">阅读志</a>
	    <div class="nav-collapse">    
	      <ul class="nav pull-right">
            <!--<form class="navbar-search pull-left" action="">
                <input type="text" class="search-query span2" placeholder="Search">
            </form>-->
            <li class="divider-vertical"></li>
            <li><a href="<?php echo base_url()?>index.php/mine" ><i class="icon-home"></i> 我的首页</a></li>
            <li><a href="<?php echo base_url()?>index.php/square" ><i class="icon-bullhorn"></i> 广场</a></li>
            <li><a href="<?php echo base_url()?>index.php/myprofile" ><i class="icon-user"></i> <?php echo  $session['username'] ?></a></li>
            <?php  $unRead_sum = $session['unread_sum']; ?>
            <li><a href="<?php echo base_url()?>index.php/notification" ><i class="icon-envelope"></i> 消息(<?php echo $unRead_sum; ?>)</a></li>
            <li><a href="http://www.yueduzhi.info/feedback.html"  ><i class="icon-question-sign"></i>意见反馈</a></li>
            <li><a href="<?php echo base_url()?>index.php/logout" ><i class="icon-off"></i> 登出</a></li>	            
	      </ul>
	    </div><!-- /.nav-collapse -->

    </div>
  </div>
</div>           <?php  $sum = $session['notification_sum']; ?>
  <div class="notification" style="display: <?php if ( $sum == 0 ) echo 'none'; ?>">
      <a href="<?php echo base_url()?>index.php/notification/">有<span id="msg_sum"><?php echo  $sum ?></span>条新消息</a>
  </div>
<script src="/n_server/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.min.js"></script>
<script>
    var port_url = '<?php echo base_url()?>'.slice(0, -1) + ':8889';
    var socket = io.connect(port_url);
    socket.emit("username","<?php echo  $session['username'] ?>");
    socket.on('message', function(data){
      $(".notification").show();
      var sum = parseInt($("#msg_sum").html()) + 1;
      $("#msg_sum").html(sum);
     
      if ( data.type == 0) {
      }else if ( data.type == 1) {
      }
    });  
    $(".notification").click(function(){
       $(".notification").hide();
       $("#msg_sum").html(0);
       /*
       $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>index.php/notification/readAll",
                success: function(results) {
                }                      
        }); 
        */

    });
    /*
    $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>index.php/notification/load_sum",
                success: function(results) {
                    //console.log(results);
                    if ( results != '0' ) {
                      $("#msg_sum").html(results);
                      $(".notification").show();  
                    }
                      
                }
    });  
  */

</script>
