<?php

class Createnote_model extends CI_Model 
{

	private $user_id;
	private $book_id;
	private $note_date;
	private $note_content; 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->user_id = $this->session->userdata['user_id'];
		$this->book_id = $this->input->post('book_id', TRUE);
		$this->note_date = date("Y-m-d H:i:s",time());	
		$this->note_content = $this->input->post('note_content', TRUE);
	}

	public function savenote($isNew = false) 
	{				
		$this->db->insert('ydz_note', 
			array(
				'user_id'=>$this->user_id, 
				'book_id'=>$this->book_id, 
				'note_date'=>$this->note_date, 
				'note_content'=>$this->note_content
				)
			);
		$date_diff = 0;
		//Cal the new date diff
		if ( !$isNew ) {
			$this->db->where('book_id', $this->book_id);
			$this->db->select('meta_begin');	
			//$sql = 'SELECT meta_begin FROM ydz_book_meta WHERE book_id = ? LIMIT 1';
			$query = $this->db->get('ydz_book_meta', 1);
			$meta_begin = 0;
			foreach ($query->result() as $row) {
				$meta_begin = $row->meta_begin;
			}
			$pre_date = strtotime($meta_begin);
			$now_date= mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
			$date_diff = abs(($now_date-$pre_date)/3600/24) + 1;
					//Update the meta_sum in ydz_book_meta
			$this->db->where(array('user_id'=>$this->user_id, 'book_id'=>$this->book_id));
			$this->db->set('meta_sum', 'meta_sum+1',FALSE);
			$this->db->set('meta_duration', $date_diff);
			$this->db->update('ydz_book_meta');
		}else {
			$date_diff = 1;
			$this->db->insert('ydz_book_meta', 
				array(
					'user_id'=>$this->user_id, 
					'book_id'=>$this->book_id, 
					'meta_sum'=>1,
					'meta_duration'=>1,
					'meta_begin'=>$this->note_date
				)
			);
			$this->db->where(array('user_id'=>$this->user_id));
			$this->db->set('book_sum', 'book_sum+1',FALSE);
			$this->db->update('ydz_user');
			$this->session->set_userdata('book_sum', $this->session->userdata['book_sum'] + 1);
		}
		



		$this->db->where(array('user_id'=>$this->user_id));
		$this->db->set('note_sum', 'note_sum+1',FALSE);
		$this->db->update('ydz_user');
		$this->session->set_userdata('note_sum', $this->session->userdata['note_sum'] + 1);
		
	}

}