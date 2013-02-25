<?php

class Comment_model extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_comment($note_id) {
		$sql = "SELECT
		              com_content,
		              comment_id,
						note_id,
		              com_date,
		              username,
		              avatar
		        FROM
		              ydz_comment a
		        INNER JOIN(
		              SELECT username, avatar, user_id
		              FROM ydz_user
		        ) b
		        ON a.user_id = b.user_id
		        WHERE a.note_id = ?";
		return $this->db->query($sql, array($note_id))->result_array();
	}
	public function count_comment($note_id) {
		$this->db->from('ydz_comment');
		$this->db->where('note_id',$note_id);
		return $this->db->count_all_results();
	}
	public function insert_comment() {
		
		$data = array( 
					'com_date'=>date("Y-m-d H:i:s",time()), 
					'note_id'=>$this->input->post('note_id',TRUE),
					'user_id'=>$this->input->post('user_id',TRUE),
					'com_content'=>$this->input->post('com_content',TRUE),
					'book_id'=>$this->input->post('book_id',TRUE)
				);
		$this->db->insert('ydz_comment', $data); 
	}
	public function del_comment() {
		$comm_id = $this->input->post('comm_id', TRUE);
		$this->db->delete('ydz_comment', array('comment_id' => $comm_id));
	}

}