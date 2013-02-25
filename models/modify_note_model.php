<?php

class Modify_note_model extends CI_Model 
{

	private $user_id;
	private $note_id;
	private $book_id;
	private $note_date;
	private $note_content; 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->user_id = $this->session->userdata['user_id'];
		$this->note_id = $this->input->post('note_id', TRUE);
		$this->book_id = $this->input->post('book_id', TRUE);
		$this->note_date = date("Y-m-d H:i:s",time());
		$this->note_content = $this->input->post('note_content', TRUE);
	}

	public function editnote() 
	{				
		$data = array( 
			'note_date'=>$this->note_date, 
			'note_content'=>$this->note_content
		);
		$this->db->where('note_id',$this->note_id);
		$this->db->update('ydz_note',$data);
		return $this->book_id;
	}
	public function deletenote($id,$book_id) {
		$this->db->delete('ydz_note', array('note_id' => $id));
		
		$this->db->where(array('user_id'=>$this->user_id, 'book_id'=>$book_id));
		$this->db->set('meta_sum', 'meta_sum-1',FALSE);
		$this->db->update('ydz_book_meta');
		
		$this->db->where(array('user_id'=>$this->user_id));
		$this->db->set('note_sum', 'note_sum-1',FALSE);
		$this->db->update('ydz_user');
		$this->session->set_userdata('note_sum', $this->session->userdata['note_sum'] - 1);

		$query = $this->db->get_where('ydz_note',array('user_id'=>$this->user_id, 'book_id'=>$book_id));

		if ( $query->num_rows < 1){ //if the note is the last note of a book
			$this->db->where(array('user_id'=>$this->user_id));
			$this->db->set('book_sum', 'book_sum-1',FALSE);
			$this->db->update('ydz_user');
			$this->session->set_userdata('book_sum', $this->session->userdata['book_sum'] - 1);

			$this->db->delete('ydz_book_meta', array('user_id'=>$this->user_id, 'book_id'=>$book_id));
			return FALSE;
		}
		else return TRUE;

	}
	public function noteinfo($noteid) {
		$query = $this->db->get_where('ydz_note',array('note_id =' => $noteid));
		if ( $query->num_rows == 1)
		{
			return $query->row_array();
		}
		else return FALSE;
	}

}