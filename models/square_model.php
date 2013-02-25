<?php

class Square_model extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_readers($book_id) {

		$sql = "SELECT 
							a.note_id,
							a.book_id,
							a.note_content,
							a.note_date,
							ydz_user.user_id,
							ydz_user.username,
							ydz_user.avatar
							FROM (select * from(select * from ydz_note ORDER BY ydz_note.note_date DESC) AS x
							GROUP BY user_id,book_id) AS a
							INNER JOIN ydz_user
							ON ydz_user.user_id = a.user_id
							WHERE a.book_id = ?";	
		
		return $this->db->query($sql, array($book_id))->result_array();
	}
	public function get_top_book() {
		$sql = "SELECT 
						b.book_id,
						book_date, 
						book_title,	                            
						book_author,
						book_isbn,	                            
						book_press,
						book_cover
						FROM ydz_book b
		               
						INNER JOIN 
						(
							SELECT 
									SUM(meta_sum) AS meta_sum_total,
			                     book_id
									FROM ydz_book_meta
									GROUP BY book_id
						) a
						ON a.book_id = b.book_id
						ORDER BY meta_sum_total DESC";
	    return $this->db->query($sql)->result_array();
	}
	public function get_top_user(){
		$sql = "SELECT * FROM ydz_user
						 ORDER BY note_sum DESC
						 LIMIT 6";
	    return $this->db->query($sql)->result_array();	
	}
}