<?php

class Selectbook_model extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function checktitle($title) 
	{		
		
		//$title = $this->input->post('title', TRUE);
		$sql = "SELECT book_title,book_id
				FROM ydz_book
				WHERE book_title LIKE ?
				LIMIT 5";

		return $this->db->query($sql,array("%".$title."%"))->result_array();
	}
	public function checkbookinfo($book_id) {
		$sql = "SELECT *
				FROM ydz_book
				WHERE book_id = ?";

		return $this->db->query($sql,array($book_id))->result_array();
	}
}