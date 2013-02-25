<?php
class Logout extends CI_Controller 
{
	public function index()
	{
		$this->load->helper(array('url'));
		$this->session->sess_destroy();
		redirect('/');

	}
}