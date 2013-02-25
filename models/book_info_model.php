<?php

class Book_info_model extends CI_Model 
{
	public function load_latest($user_id, $book_sum)
	{
		$this->load->database();
		/*
		$this->db->select('ydz_latest_note.note_id, ydz_latest_note.book_id, ydz_book.book_title, ydz_note.note_content, ydz_book_meta.meta_begin, ydz_book_meta.meta_duration, ydz_book_meta.meta_sum');
		$this->db->from('ydz_latest_note');
		$this->db->limit($book_sum);
		$this->db->where('user_id', $user_id);
		$this->db->join('ydz_book', 'ydz_book.book_id = ydz_latest_note. book_id');
		$this->db->join('ydz_note', 'ydz_note.note_id = ydz_latest_note. note_id');
		$this->db->join('ydz_book_meta', 'ydz_book_meta.book_id = ydz_latest_note. book_id');
		
		$sql = "SELECT 
							ydz_latest_note.note_id, 
							ydz_latest_note.book_id,
							ydz_note.note_content,
							ydz_latest_note.recent,
							ydz_book.book_cover,
							ydz_book.book_title,	
							ydz_book.book_id,					
							ydz_book_meta.meta_begin, 
							ydz_book_meta.meta_duration, 
							ydz_book_meta.meta_sum
							FROM ydz_latest_note
							INNER JOIN ydz_book 
							ON ydz_book.book_id = ydz_latest_note. book_id
							INNER JOIN ydz_note
							ON ydz_note.note_id = ydz_latest_note. note_id
							INNER JOIN ydz_book_meta
							ON ydz_book_meta.book_id = ydz_latest_note. book_id AND ydz_book_meta.user_id = ydz_latest_note.user_id
							WHERE ydz_latest_note.user_id= ?
							"; */
		$sql = "SELECT 
							a.note_id,
							a.book_id,
							a.note_content, 					
							ydz_book.book_cover,
							ydz_book.book_title,
							ydz_book.book_author,
							ydz_book.book_date,
							ydz_book.book_isbn,
							ydz_book.book_press,

							ydz_book.book_id,					
							ydz_book_meta.meta_begin, 
							ydz_book_meta.meta_duration, 
							ydz_book_meta.meta_sum
							FROM ydz_note a
							INNER JOIN 
							(
								SELECT MAX(ydz_note.note_date) AS note_date , ydz_note.book_id FROM ydz_note GROUP BY ydz_note.book_id
							) b 
							ON a.book_id = b.book_id and a.note_date = b.note_date						
							INNER JOIN ydz_book 
							ON ydz_book.book_id = a.book_id
							INNER JOIN ydz_book_meta
							ON ydz_book_meta.book_id = a.book_id AND ydz_book_meta.user_id = a.user_id
							WHERE a.user_id= ?
							GROUP BY a.book_id 
							ORDER BY a.note_date DESC";
							

		return  $this->db->query($sql, array('user_id'=>$user_id))->result_array();
	}
	public function load_note($book_id , $user_id)
	{
			$this->load->database();
			$sql_book = "SELECT 
							ydz_user.user_id,
							ydz_user.username,
							ydz_book.book_id,
							ydz_book.book_cover,
							ydz_book.book_title,	
							ydz_book.book_author,
							ydz_book.book_isbn,
							ydz_book.book_page,
							ydz_book.book_press,
							ydz_book_meta.meta_begin, 
							ydz_book_meta.meta_duration, 
							ydz_book_meta.meta_sum
							FROM ydz_book 
							INNER JOIN ydz_book_meta
							ON ydz_book_meta.book_id = ydz_book.book_id AND ydz_book_meta.user_id = ?
							INNER JOIN ydz_user
							ON ydz_user.user_id = ?
							WHERE ydz_book.book_id = ? 
					";
			$sql_note = "SELECT  
							ydz_note.note_id,
							ydz_note.note_content,
							ydz_note.note_date							
							FROM ydz_note 
							WHERE ydz_note.book_id = ? and ydz_note.user_id = ?
					";	
			$data['note'] = $this->db->query($sql_note, array($book_id, $user_id))->result_array();
			$data['book_info'] = $this->db->query($sql_book, array($user_id, $user_id,$book_id))->result_array();
			return $data;  
/*
			$sql = "SELECT 
								ydz_note.note_content,
								ydz_note.note_date,
								ydz_book.book_id,
								ydz_book.book_cover,
								ydz_book.book_title,	
								ydz_book.book_author,
								ydz_book.book_isbn,
								ydz_book.book_page,
								ydz_book.book_press,
								ydz_book_meta.meta_begin, 
								ydz_book_meta.meta_duration, 
								ydz_book_meta.meta_sum
								FROM ydz_note
								INNER JOIN ydz_book
								ON ydz_book.book_id = ydz_note. book_id
								INNER JOIN ydz_book_meta
								ON ydz_book_meta.book_id = ydz_note. book_id
								WHERE ydz_note.note_id= ? and ydz_note.user_id = ?";
			
			return  $this->db->query($sql, array($note_id, $user_id))->result_array();
			*/
	}
	public function load_book($book_id, $user_id)
	{
			$this->load->database();
			$sql_book = "SELECT 
							ydz_book.book_title,
							ydz_book.book_id,
							ydz_book_meta.meta_begin,
							ydz_book_meta.meta_duration, 
							ydz_book_meta.meta_sum
							FROM ydz_book
							INNER JOIN ydz_book_meta
							ON ydz_book_meta.book_id = ydz_book.book_id AND ydz_book_meta.user_id = ?
							WHERE ydz_book.book_id = ?
					";
			$sql_note = "SELECT  
							ydz_note.note_content,
							ydz_note.note_date							
							FROM ydz_note 
							WHERE ydz_note.book_id = ? and ydz_note.user_id = ?
					";	
			$data['note'] = $this->db->query($sql_note, array($book_id, $user_id))->result_array();
			$data['book_info'] = $this->db->query($sql_book, array($user_id, $book_id))->result_array();
			return $data;  
	}
	public function get_book_info($book_id) {
		$this->load->database();
		$query = $this->db->get_where('ydz_book',array('book_id =' => $book_id));
		if ( $query->num_rows == 1)
		{
			return $query->row_array();
		}
		else return FALSE;
	}
}
