<?php

class Subscribe_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	public function show_subscribe($user_id)
	{
		$sql = "SELECT 
								ydz_note.note_id,
								ydz_note.book_id,
								ydz_note.note_content, 	
								ydz_note.note_date,				
								ydz_book.book_cover,
								ydz_book.book_title,	
								ydz_book.book_id,
								ydz_user.username,
								ydz_user.user_id,
								ydz_user.avatar

								FROM ydz_subscribe
								INNER JOIN ydz_book
								ON ydz_book.book_id = ydz_subscribe.from_book_id
								INNER JOIN ydz_user
								ON ydz_user.user_id = ydz_subscribe.from_user_id
								INNER JOIN ydz_note
								WHERE ydz_note.book_id = from_book_id AND ydz_note.user_id = from_user_id AND ydz_subscribe.user_id = ?
								AND ydz_note.note_date
								IN (

									SELECT MAX( ydz_note.note_date ) AS note_date
									FROM ydz_note
									GROUP BY ydz_note.book_id
								)";
								
			return  $this->db->query($sql, array('user_id'=>$user_id))->result_array();		
	}

	public function add_subscribe($user_id, $from_user_id, $from_book_id)
	{
		$this->db->insert('ydz_subscribe', array("user_id"=>$user_id, "from_user_id"=>$from_user_id, "from_book_id"=>$from_book_id));
	}

	public function delete_subscribe($user_id, $from_user_id, $from_book_id)
	{
		$this->db->delete('ydz_subscribe', array("user_id"=>$user_id, "from_user_id"=>$from_user_id, "from_book_id"=>$from_book_id));
	}

}