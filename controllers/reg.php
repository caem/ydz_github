<?php
class Reg extends CI_Controller 
{
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	
		$this->load->view('register');
	}

	public function register()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', '昵称', 'required|callback_username_check|callback_username_unique');
		$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|matches[passconf]');
		$this->form_validation->set_rules('passconf', '确认密码', 'required|min_length[6]');
		$this->form_validation->set_rules('email', '邮箱', 'required|valid_email|callback_email_unique');
		$this->form_validation->set_message('not_same', '确认密码与密码不一致');
		$this->form_validation->set_message('email_unique','已经存在用此email注册的用户');
		$this->form_validation->set_message('username_unique','用户名已经存在');
		$this->form_validation->set_message('username_check','用户名只能为英文字母、数字或下划线');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		} else {
			$this->load->model('reg_model');
			$query = $this->reg_model->register();
			if  ( isset($query) && $query->num_rows == 1)
			{
				$user_data = $query->row_array();
				$data = array (
					'book_sum'=> $user_data['book_sum'] , 
					'note_sum' => $user_data['note_sum'] ,
					'user_id' => $user_data['user_id'],
					'username' => $user_data['username'],
					'avatar' => $user_data['avatar'],
					'status' => $user_data['status'],
					'notification_sum' => 0,
					'is_login' => TRUE
				);
				$this->session->set_userdata($data);
				redirect('mine');
			}
			else
			{
				redirect('welcome');
			}

		}

	}
	public function email_unique($email) {
	    $this->load->database();
		$query = $this->db->get_where('ydz_user',array('email =' => $email));
		if ( $query->num_rows == 1)
			{
				return FALSE; //fail the test
			}
			else
			{
				return TRUE;
			}
	}
	public function username_check($str)
	{
	    return ( ! preg_match("/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/", $str)) ? FALSE : TRUE;
	}
	public function username_unique($username) {
       $this->load->database();
		$query = $this->db->get_where('ydz_user',array('username =' => $username));
		if ( $query->num_rows == 1)
		{
			return FALSE; //fail the test
		}
		else
		{
			return TRUE;
		}
    }
	public function username_ajax() {
       $this->load->database();
		$username = $this->input->post('username', TRUE);
		$query = $this->db->get_where('ydz_user',array('username =' => $username));
				if ( $query->num_rows == 1)
				{
					echo 'fail'; //fail the test
				}
				else
				{
					echo 'OK';
				}
	}	
}
