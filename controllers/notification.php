<?php
class Notification extends CI_Controller 
{
	private $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$data['session'] = $this->session->all_userdata();
		if( !isset($data['session']) && count($data['session'])<=5)
			redirect('/');
		$this->user_id = $data['session']['user_id'];
	}
	public function index() {
		$data['session'] = $this->session->all_userdata();
		$data['session']['unread_sum']=0;
		$this->load->model('notification_model');
       	$data['notification'] = $this->notification_model->load_notification($this->user_id);	
       	$this->notification_model->readAll($this->user_id);		
       	$this->session->set_userdata('notification_sum', 0);
		$this->load->view('notification' , $data);

	}
	public function load_sum($user_id) {
		$this->load->model('notification_model');
       	$total = $this->notification_model->load_sum($user_id);
       	return $total[0]['total'];
	}
	/*ajax version
	public function load_sum() {
		$this->load->model('notification_model');
       	$total = $this->notification_model->load_sum($this->user_id);
       	echo $total[0]['total'];
	}
	*/

	public function del_notification() {
		$this->load->model('notification_model');
       	$total = $this->notification_model->del_notification();
       	echo "y";	
	}

	public function readAll() {
		$this->load->model('notification_model');
       	$total = $this->notification_model->readAll($this->user_id);
       	echo "y";	
	}

}
