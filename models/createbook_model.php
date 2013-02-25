<?php

class Createbook_model extends CI_Model 
{

	private $book_id;
	private $book_title;
	private $book_date;
	private $book_author;
	private $book_cover;
	private $book_isbn;
	private $book_url;
	private $book_press;
	private $book_page;


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->user_id = $this->input->post('book_id', TRUE);
		$this->book_title = $this->input->post('book_title', TRUE);
		$this->book_date = $this->input->post('book_date', TRUE);
		$this->book_author = $this->input->post('book_author', TRUE);
		$this->book_cover = $this->input->post('book_cover', TRUE);
		$this->book_isbn = $this->input->post('book_isbn', TRUE);
		$this->book_url = $this->input->post('book_url', TRUE);
		$this->book_press = $this->input->post('book_press', TRUE);
		$this->book_page = $this->input->post('book_page', TRUE);
	}

	public function savenote() 
	{				
		if ($this->input->post('book_isbn', TRUE)=='') {
			$this->book_isbn = null;
		}
		if ($this->input->post('book_date', TRUE)=='') {
			$this->book_date = null;
		}
		if ($this->input->post('book_cover', TRUE)=='') {
			$this->book_cover = '/img/bookcover/default.jpg';
		}
		$this->db->insert('ydz_book', 
			array(
				'book_id'=>$this->book_id, 
				'book_title'=>$this->book_title, 
				'book_date'=>$this->book_date, 
				'book_author'=>$this->book_author, 
				'book_cover'=>$this->book_cover, 
				'book_isbn'=>$this->book_isbn, 
				'book_url'=>$this->book_url,
				'book_press'=>$this->book_press,
				'book_page'=>$this->book_page
				)
			);
	}
	public function get_book_by_title() {
		$this->load->database();
		$this->db->select('book_id');
		$this->db->order_by('book_id desc');
		$this->db->limit(1);
		$query = $this->db->get_where('ydz_book',array('book_title =' => $this->book_title));
		if ( $query->num_rows == 1)
		{
			return $query->row_array();
		}
		else return FALSE;
	}
	public function get_book_by_isbn($isbn) {
			$this->load->database();
			$this->db->select('book_id');
			$this->db->order_by('book_id desc');
			$this->db->limit(1);
			$query = $this->db->get_where('ydz_book',array('book_isbn =' => $isbn));
			if ( $query->num_rows == 1)
			{
				return $query->row_array();
			}
			else return FALSE;
		}
}