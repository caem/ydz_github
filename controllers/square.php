<?php
class Square extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	public function index() {
		$data['session'] = $this->session->all_userdata();
		//if ( isset($data['session'] ) && count($data['session'])>5)
		if(true)
		{
           $this->load->model('square_model');
           if ( isset($data['session'] ) && count($data['session'])>5)
           		$data['signIn'] = true;
           	else
           		$data['signIn'] = false;
           $data['top_books'] = $this->square_model->get_top_book();
           $data['top_users'] = $this->square_model->get_top_user();
		   $this->load->view('square',$data);
		}
		else
		{
			redirect('/');
		}
	}
	public function readers($bookid) {
		$data['session'] = $this->session->all_userdata();
		//if ( isset($data['session'] ) && count($data['session'])>5)
		if(true)
		{

			if ( isset($data['session'] ) && count($data['session'])>5)
           		$data['signIn'] = true;
           	else
           		$data['signIn'] = false;
			$this->load->model('book_info_model');
			$data['book'] = $this->book_info_model->get_book_info($bookid);
			$this->load->model('square_model');
			$data['readers'] = $this->square_model->get_readers($bookid);
			$this->load->view('readers',$data);
		}
		else
		{
			redirect('/');
		}
	}
	public function readnote($book_id,$owner_id)
	{		
		$data['session'] = $this->session->all_userdata();
		//if ( isset($data['session']) && count($data['session'])>5)
		if(true)
		{

			if ( isset($data['session'] ) && count($data['session'])>5)
           		$data['signIn'] = true;
           	else
           		$data['signIn'] = false;
			if ( $book_id != NULL && $owner_id != NULL)
			{
				$this->load->model('book_info_model');
				$data['note'] = $this->book_info_model->load_note($book_id, $owner_id) ;
			
				//show_404();
				if ( count($data['note']['note']) == 0)
				{
					show_404();
					return;
				}
				
				//****************************************************
				$this->load->model('comment_model');
				//get number of comment of each note
				foreach ($data['note']['note'] as $key => $value) {
					$data['total'][$key] = $this->comment_model->count_comment($value['note_id']);
				}
				
				//****************************************************
				
				$this->load->model('profile_model');
		        $data['author'] = $this->profile_model->get_myprofile($owner_id);

		        $data['booklist'] = $this->book_info_model->load_latest($owner_id,0);

		        if( isset($data['session']) && count($data['session'])>5){
		        	$data['hasSub'] = $this->hasSub($data['session']['user_id'],$owner_id,$book_id);
		        	$this->load->model('subscribe_model');
		        	$data['subscribe'] = $this->subscribe_model->show_subscribe($data['session']['user_id']);
		        }
		        $data['from_user_id'] = $owner_id;

		        
				
				$this->load->view('readnote_square', $data);
			}else
			{
				$this->index();
			}
		}
		else
		{
			redirect('/');
		}	
	}

    public function readnote_flow($book_id,$owner_id)
	{		
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session']) && count($data['session'])>5)
		{
			if ( $book_id != NULL)
			{
				$this->load->model('book_info_model');
				$data['note'] = $this->book_info_model->load_note($book_id, $owner_id);
			
				//show_404();
				if ( count($data['note']['note']) == 0)
				{
					show_404();
					return;
				}		
				$data['owner_id'] = $owner_id;
				$this->load->view('readnote_flow_square', $data);
			}else
			{
				$this->index();
			}
		}
		else
		{
			redirect('/');
		}	
	}

	public function comment() {
       $data['session'] = $this->session->all_userdata();
       $deleteTag = '';
        
      $note_id = $this->input->post('note_id', TRUE);
		$this->load->model('comment_model');
		$comments = $this->comment_model->get_comment($note_id);
		$result = '';
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

	public function subscribe(){
		$subscriber = $this->input->post('user_id', TRUE);
		$book_id = $this->input->post('from_book_id', TRUE);
		$owner_id = $this->input->post('from_user_id', TRUE);
		$this->load->model('subscribe_model');
		$this->subscribe_model->add_subscribe($subscriber,$owner_id,$book_id);
	}
	public function unSubscribe(){
		$subscriber = $this->input->post('user_id', TRUE);
		$book_id = $this->input->post('from_book_id', TRUE);
		$owner_id = $this->input->post('from_owner_id', TRUE);
		$this->load->model('subscribe_model');
		echo $this->subscribe_model->delete_subscribe($subscriber,$owner_id,$book_id);
	}
	private function hasSub($user_id, $from_user_id, $from_book_id){
		$this->load->database();
		$query = $this->db->get_where('ydz_subscribe',
			                           array('user_id' => $user_id,
			                           	     'from_user_id' => $from_user_id,
											 'from_book_id' => $from_book_id,)
		                             );
		if ( $query->num_rows == 1)
			{
				return TRUE; //fail the test
			}
			else
			{
				return FALSE;
			}
	}

}
	