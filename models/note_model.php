<?php
class Note_model extends CI_Model 
{
	public function __construct ()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insert()
	{
		$data = array(
			'userid' => $this->input->post('userid', TRUE), //True to adtop XSS filter
			'page' => $this->input->post('page', TRUE),
			'content' => $this->input->post('content', TRUE ),
			'date' => 
		);
		
		return $this->db->insert('news', $data);	
	}
}