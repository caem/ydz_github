<?php

class Login_model extends CI_Model {
	function validate() 
	{		
		$this->load->database();
		$email = $this->input->post('email', TRUE);
		$password = md5(($this->input->post('password', TRUE).'***&@)@%'));	
		
		$query = $this->db->get_where('ydz_user',array('email'=>$email, 'password'=>$password), 1);
		if ( $query->num_rows == 1)
		{
			return $query;
		}
	}
}