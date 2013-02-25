<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>消息中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->

    <script src="/script/jquery-1.7.2.min.js"></script>
    <script src="/script/jquery.placeholder.min.js"></script>
    <script src="/script/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" media="screen"  href="/script/ydz.css" />
    <style type="text/css">
      .hero-unit{
      		padding: 10px;
      }
    </style>

  </head>
  <body>

    <?php include('navbar.php') ?> 
<div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="widget" id="center_panel_600">
        <div class="widget-header">
            <i class="icon-envelope"></i>
            <h3>消息中心</h3>
        </div>
        <div class="widget-content">

          <script type="text/javascript">var unreadCount=0;</script>

          <div class="accordion" id="accordion2">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                  未读消息
                </a>
              </div>
              <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <?php foreach ( $notification as $item):
                        $date_diff = 0;
                        $stamp = "";
                        if ( $item['unRead'] == 1) {
                          $pre_date = strtotime( $item['date']);
                          $now_date= mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
                          $date_diff = (int)abs(($now_date-$pre_date)/3600/24) + 1;
                          switch ($date_diff){
                            case 0: 
                                $stamp = "今天";
                                break;
                            case 1:
                                $stamp = "昨天";
                                break;
                            case 2:
                                $stamp = "前天";
                                break;
                            default:
                                $stamp = $date_diff."天前";
                          }

                      ?>
                        <div style="position:relative" class="nitem" id ="nitem<?php echo $item['content_id']?>">
                          <div class="pull-left alert alert-success" style="width: 80%;">
                             <img class="noti_userhead" src="/img/head/<?php echo $item['avatar'] ?>"/><?php echo $item['from_username'] ?> 在
                             <a href="<?php echo base_url()?>index.php/square/readnote/<?php echo $item['book_id']?>/<?php echo $item['owner_id']?>#comment<?php echo $item['note_id']?>-<?php echo $item['content_id'] ?>">《<?php echo $item['book_title']?>》</a>中回复了你
                             <div class="pull-right"><?php echo $stamp?>&nbsp&nbsp&nbsp<a class="commDel" id="<?php echo $item['content_id']?>">删除</a></div>
                          </div>
                          <div class="pull-left" style="width: 80%;padding: 10px;">
                              <?php echo $item['com_content'] ?> 
                          </div>
                          
                          <div style="clear:both"></div>
                        </div>
                      <?php } endforeach ?>
                 </div> <!--end of accordion-inner-->
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                  已读消息
                </a>
              </div>
              <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner">
                   <?php foreach ( $notification as $item): 
                     $date_diff = 0;
                     $stamp = "";
                     if ( $item['unRead'] == 0) { 
                       $pre_date = strtotime( $item['date']);
                       $now_date= mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
                       $date_diff = (int)abs(($now_date-$pre_date)/3600/24) ;
                       switch ($date_diff){
                         case 0: 
                             $stamp = "今天";
                             break;
                         case 1:
                             $stamp = "昨天";
                             break;
                         case 2:
                             $stamp = "前天";
                             break;
                         default:
                             $stamp = $date_diff."天前";
                       }
                     ?>
                     
                     
                     <div style="position:relative" class="nitem" id ="nitem<?php echo $item['content_id']?>" >
                       <div class="pull-left alert alert-success" style="width: 80%;">
                           <img class="noti_userhead" src="/img/head/<?php echo $item['avatar'] ?>"/><?php echo $item['from_username'] ?> 在
                           <a href="<?php echo base_url()?>index.php/square/readnote/<?php echo $item['book_id']?>/<?php echo $item['owner_id']?>#comment<?php echo $item['note_id']?>-<?php echo $item['content_id'] ?>">《<?php echo $item['book_title']?>》</a>中回复了你
                           <div class="pull-right"><?php echo $stamp?>&nbsp&nbsp&nbsp<a class="commDel" id="<?php echo $item['content_id']?>">删除</a></div>
                           
                       </div>
                       <div class="pull-left" style="width: 80%;padding: 10px;">
                           <?php echo $item['com_content'] ?> 
                       </div>
                       
                       <div style="clear:both"></div>

                     </div> 
                   <?php } endforeach ?>
                </div> <!--end of accordion-inner-->
              </div>
            </div>
          </div>
        </div>  


      </div> <!--end of hero-unit out-most-->

      <?php include('footer.php') ?>
    </div> <!-- /container -->
  <div class="modal hide" id="delCommModal" style="max-width: 400px; top: 70%;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>温馨提示</h3>
  </div>
  <div class="modal-body">
    <p style="text-align: center;">你确定要删除这条消息吗？</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="delCommConf">确定</a>
  </div>
</div>
  </body>
  <script>
  $(document).ready(function(){
      $('li:has(a[href="<?php echo base_url()?>index.php/notification"])').addClass("active");//highlight current page in top-navbar
      //icon hover effect
      $('a[href="<?php echo base_url()?>index.php/notification"] i').addClass("icon-white");
      $('.nav.pull-right li:not(".active")').hover(function(){$(this).find('i').addClass("icon-white");},
                                 function(){$(this).find('i').removeClass("icon-white");}
                          );
  });
    $(".commDel").click(function() {
              var commid = $(this).attr("id");
              $('#delCommModal').modal('show');
              $('#delCommConf').click(function() {
                          var data={
                                    'comm_id':commid,
                                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash()?>'
                                    };
                          $.ajax({
                                type: "POST",
                                url: "<?php echo base_url()?>index.php/notification/del_notification",
                                data: data,
                                beforeSend: function() { // add the loadng image
                                        $('#delCommModal').modal('hide');
                                        $("#nitem"+commid).remove();
                                      },
                                success: function(result) {
                                    //$('#delCommModal').modal('hide');
                                }
                          });  
                      }
               );
    });
  </script>
</html>
