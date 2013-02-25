<?php
class Login extends CI_Controller 
{
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('email', '邮箱', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			redirect('welcome');
		}
		else
		{
			$this->load->model('login_model');
			$query = $this->login_model->validate();
			$this->load->model('notification_model');
       		
			if  ( isset($query) && $query->num_rows == 1)
			{
				$user_data = $query->row_array();
				$res = $this->notification_model->load_sum($user_data['user_id']);
				$notice = $this->notification_model->unRead($user_data['user_id']);
				$notice_sum = count($notice);
				if ( $res['0']['total'] == '' )
#				if ( isset($res[0]['total']) )
					$total = $res[0]['total'] ;
				else
				 	$total = 0;
				$data = array (
					'book_sum'=> $user_data['book_sum'] , 
					'note_sum' => $user_data['note_sum'] ,
					'user_id' => $user_data['user_id'],
					'username' => $user_data['username'],
					'avatar' => $user_data['avatar'],
					'status' => $user_data['status'],
					'notification_sum' => $total,
					'is_login' => TRUE,
					'unread_sum' => $notice_sum
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
}
