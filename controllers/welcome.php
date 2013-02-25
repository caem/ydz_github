<?php
class Welcome extends CI_Controller
{
	public function index ()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	
		$this->load->view('index');
	}
}