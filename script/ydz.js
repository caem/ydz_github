$(document).ready(function(){
    $('.help-block').hide();
    $('a[rel="tooltip"]').tooltip('hide');
    $('#hero2').mouseenter(
        function blink(){
            $('#readNew').fadeTo(
                300, //interval
                0.4, //opacity
                function(){
                    $('#readNew').fadeTo(300,1.0);
                    blink();
                }
            )
        }
    );
    $('#submit').click(function checkcontent() {
      var text = $('#new_note_content').val();
      if ( text == "" ) {
        $('#confModal').modal('show');
        $('#conf').click(function() {
              $('#confModal').modal('hide');
              $('#new_note_content').focus();
       });
        return false;
      }else{
        return true;
      }      
});



 });



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


function validate(){
     //**************** username ***************************
           $('.help-block').hide(); 
           
           if( $('#username').val().length == 0 ){ 
                $('#username-help').fadeIn();
                $('#username').select();
                return false;
           } 
           
           var pattern = /^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/;
           var info = $('#username').val();
           if( !pattern.test(info) ){
                $('#username-error').fadeIn();
                $('#username').select();
                return false;
           }
          
           
      //**************** password ***************************
           
        if( $('#password1').val().length == 0 ){//if no entry for password
            $('#password1-help').fadeIn();
            $('#password1').select();
            return false;                                   
        }
        if( $('#password1').val().length < 6){//password too short
            $('#password1-less').fadeIn();
            $('#password1').select();
            return false;
        }
        
        if( $('#password1').val() != $('#password2').val() ){//password not consistent
            $('#password2-notSame').fadeIn();
            $('#password2').select();
            return false;
        }
        
        //**************** email ***************************
        
        if( $('#email').val().length == 0 ){ 
                $('#email-help').fadeIn();
                $('#email').select();
                return false;
           }
           
           var pattern = /([\w\-]+\@[\w\-]+\.[\w\-]+)/;
           var info = $('#email').val();
           if( !pattern.test(info) ){
                $('#email-error').fadeIn();
                $('#email').select();
                return false;
           }

  return true;
}  // end of validate

// *****************       push notice     *******************

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

  // *****************     end of push notice     *******************