<?php

class Reg_model extends CI_Model 
{
	private $email; 
	private $password;
	private $username;
	public function __construct()
	{
		$this->load->database();
		$this->email = $this->input->post('email', TRUE);
		$this->password = md5(($this->input->post('password', TRUE).'***&@)@%'));	
		$this->username = $this->input->post('username', TRUE);
	}

	public function register() 
	{				
		$this->db->insert('ydz_user', 
			array( 
			       'username'=>$this->username, 
				   'email'=>$this->email, 
			      'password'=>$this->password,
			      'gender'=> 'u',
			      'avatar'=> 'default.jpg' 
			)
		);
		$query = $this->db->get_where('ydz_user',array('email'=>$this->email, 'password'=>$this->password), 1);
		if ( $query->num_rows == 1)
		{
			return $query;
		}
	}

	public function is_available()
	{
		$qurey = $this->db->get_where('ydz_user',array('email'=>$this->email), 1);
		$qurey = $this->db->or_where('username', username); 
		if ( $query->num_rows == 1)
		{
			return false;
		} else {
			return true;
		}
	}
}