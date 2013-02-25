<?php
class Comment extends CI_Controller 
{

	public function write_comment()
	{		
		$this->load->model('comment_model');
        $this->comment_model->insert_comment();
       	
       $note_id = $this->input->post('note_id', TRUE);
       $reply_to =  $this->input->post('reply_to', TRUE);
	   $comments = $this->comment_model->get_comment($note_id);
	    
		$result = '';
		$data['session'] = $this->session->all_userdata();
        $deleteTag = '';
        $comm_id = 0;
     

		foreach ($comments as $comm) {
		    if($data['session']['username']==$comm['username']){
		         $deleteTag = '<a class="commDel" style="cursor:pointer; float:right; margin-left:15px;">删除</a>';
		    }
		    else
		         $deleteTag = '<a style="cursor:pointer; float:right;" class="reply">回复</a>';  
			$result = $result.'
					<div class="well comment" style="margin-bottom: 5px; padding: 5px; min-height: 50px;">
					  <img src="/img/head/'.$comm['avatar'].' " class="pull-left" alt="'.$comm['username'].'" style="width: 48px; height: 48px; margin-right: 10px;"/>'.$deleteTag.'
					  <div class="comm_id" value="'.$comm['comment_id'].'" style="display:none"></div>
					  <div class="note_id" value="'.$comm['note_id'].'" style="display:none"></div>
			  		  <p2>'.$comm['username'].' '.$comm['com_date'].'</p2><br />
			  		  <p2>'.$comm['com_content'].'</p2>
			  	    </div> 
					';
			$comm_id = $comm['comment_id'];
		}

		if ( $reply_to != "" ) {
		    $this->load->model('notification_model');
		    $this->notification_model->insert_notification($comm_id, $reply_to); //update notification
		}	   
		echo $result;
	}
	public function del_comment() 
	{
		$this->load->model('comment_model');
		$this->comment_model->del_comment();
		$note_id = $this->input->post('note_id', TRUE);
		$comments = $this->comment_model->get_comment($note_id);
		$result = '';
		$data['session'] = $this->session->all_userdata();
       $deleteTag = '';
				        

		foreach ($comments as $comm) {
		    if($data['session']['username']==$comm['username'])
		         $deleteTag = '<a class="commDel" style="cursor:pointer; float:right; margin-left:15px;">删除</a>';
		    else
		         $deleteTag = '<a style="cursor:pointer; float:right;" class="reply">回复</a>';  
			$result = $result.'
					<div class="well comment" style="margin-bottom: 5px; padding: 5px; min-height: 50px;">
					  <img src="/img/head/'.$comm['avatar'].' " class="pull-left" alt="'.$comm['username'].'" style="width: 48px; height: 48px; margin-right: 10px;"/>'.$deleteTag.'
					  <div class="comm_id" value="'.$comm['comment_id'].'" style="display:none"></div>
					  <div class="note_id" value="'.$comm['note_id'].'" style="display:none"></div>
			  		  <p2>'.$comm['username'].' '.$comm['com_date'].'</p2><br />
			  		  <p2>'.$comm['com_content'].'</p2>
			  	    </div> 
					';
		}
		echo $result;
	}
	
}