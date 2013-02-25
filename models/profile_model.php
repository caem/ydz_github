<?php

class Profile_model extends CI_Model {
    public function __construct()
	{
		$this->load->database();
	}
	function get_myprofile($userid) 
	{		
		$query = $this->db->get_where('ydz_user',array('user_id =' => $userid));
		if ( $query->num_rows == 1)
		{
			return $query->row_array();
		}
	}
	function set_myprofile($userid) 
	{	
		$data = array(
		               'username' => $this->input->post('username'),
		               'status' => $this->input->post('status'),
		               'gender' => $this->input->post('gender')
		            );
		$this->db->update('ydz_user', $data, array('user_id' => $userid));
	}
	function change_password($userid) 
	{
		$data = array('password' => md5(($this->input->post('newPass', TRUE).'***&@)@%')));	   $this->db->update('ydz_user', $data, array('user_id' => $userid));
	}
}