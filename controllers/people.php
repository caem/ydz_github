<?php
class People extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	public function index() 
	{		
		$this->load->helper(array('form', 'url'));
		redirect('/');
	}
	
	public function mine()
	{				
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session'] ) && count($data['session'])>5)
		{
			$this->load->model('subscribe_model');
			$data['subscribe'] = $this->subscribe_model->show_subscribe($data['session'] ['user_id']);

			$this->load->model('book_info_model');
			$data['note'] = $this->book_info_model->load_latest($data['session'] ['user_id'], $data['session'] ['book_sum']);	       if($data['session'] ['book_sum'] != 0)
				$this->load->view('mine', $data);
			else
				$this->load->view('newmine', $data);
		}
		else
		{
			redirect('/');
		}
	}
	
	public function readnote($book_id)
	{		
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session']) && count($data['session'])>5)
		{
			if ( $book_id != NULL)
			{
				$this->load->model('book_info_model');
				$data['note'] = $this->book_info_model->load_note($book_id, $data['session']['user_id']) ;
			
				//show_404();
				if ( count($data['note']['note']) == 0)
				{
					
					show_404();
					return;
				}
				
				//****************************************************
				$this->load->model('comment_model');
				//get number of comment of each note
				foreach ($data['note']['note'] as $key => $value) {
					$data['total'][$key] = $this->comment_model->count_comment($value['note_id']);
				}
				
				//****************************************************
				
				
				$this->load->view('readnote', $data);
			}else
			{
				$this->index();
			}
		}
		else
		{
			redirect('/');
		}	
	}
	public function readnote_flow($book_id)
	{		
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session']) && count($data['session'])>5)
		{
			if ( $book_id != NULL)
			{
				$this->load->model('book_info_model');
				$data['note'] = $this->book_info_model->load_note($book_id, $data['session']['user_id']) ;
			
				//show_404();
				if ( count($data['note']['note']) == 0)
				{
					
					show_404();
					return;
				}		
				
				$this->load->view('readnote_flow', $data);
			}else
			{
				$this->index();
			}
		}
		else
		{
			redirect('/');
		}	
	}
	public function newnote($book_id)
	{
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session']) && count($data['session'])>5)
		{
			//if ( count($data['note']['note']) == 0)
			if ( $book_id != NULL)
			{
				$this->load->model('book_info_model');
				$data['note'] = $this->book_info_model->load_book($book_id, $data['session']['user_id']) ;
				
				if ( count($data['note']['book_info']) == 0 ){
					$this->load->model('selectbook_model');
					$res = $this->selectbook_model->checkbookinfo($book_id); 
					if ( count($res) != 0 ) {                        //check the book whether exist.
						$data['isNew'] = true;                       //new book to read
						$data['book_info'] = $res;
					} else {
						show_404();
					}
						
				}else{
					$data['isNew'] = false;
				}
				$this->load->view('newnote', $data);
			}else
			{
				$this->index();
			}
		}
		else
		{
			redirect('/');
		}	
	}
	public function postnote($isNew = 'false')
	{
		$book_id = $this->input->post('book_id', TRUE);
		$this->load->model('createnote_model');
		if ( $isNew == 'false' )
			$this->createnote_model->savenote();
		else 
			$this->createnote_model->savenote(true);
		redirect('/mine/readnote/'.$book_id);
	}
	public function myprofile() {
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session']) && count($data['session'])>5){
		   $this->load->model('profile_model');
		   $data['profile'] = $this->profile_model->get_myprofile($data['session']['user_id']);
			$this->load->view('myprofile',$data);
			$data['notice'] = null;
		}
	}
	public function set_myprofile() {
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session']) && count($data['session'])>5){
		   $this->load->model('profile_model');
		   $uid = $data['session']['user_id'];
		
		   $this->load->helper(array('form', 'url'));
	   	   $this->load->library('form_validation'); 
		   $this->form_validation->set_rules('username', '昵称', 'required|callback_username_check|callback_username_unique');
		   $this->form_validation->set_rules('gender', '性别', 'required');
		   $this->form_validation->set_message('username_unique','用户名已经存在');
		   $this->form_validation->set_message('username_check','用户名只能为英文字母、数字或下划线');
		   
		   if ($this->form_validation->run() == FALSE){
				$this->load->model('profile_model');
			   $data['profile'] = $this->profile_model->get_myprofile($data['session']['user_id']);
				$this->load->view('myprofile',$data);
				$data['notice'] = null;
		   }
		   else{
		       $this->profile_model->set_myprofile($uid);
			   // handle upload avatar
			   $config['upload_path'] = './img/head';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1024';
				$config['max_width']  = '800';
				$config['max_height']  = '600';
				// rename file name using user id
				$config['file_name'] = md5($uid);
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{
					
				}
				else
				{
					$fileinfo = $this->upload->data();
					$avadata = array( 'avatar' => $fileinfo['file_name'] );
					$this->load->database();
					$this->db->update('ydz_user', $avadata, array('user_id' => $uid));
				}
			
			   $this->load->database(); // update the session data
			   $query = $this->db->get_where('ydz_user',array('user_id' => $uid));
				$user_data = $query->row_array();
				$userdata = array (
					'book_sum'=> $user_data['book_sum'] , 
					'note_sum' => $user_data['note_sum'] ,
					'user_id' => $user_data['user_id'],
					'username' => $user_data['username'],
					'avatar' => $user_data['avatar'],
					'status' => $user_data['status'],
					'is_login' => TRUE
				);
				$this->session->set_userdata($userdata);
			
			   $data['profile'] = $this->profile_model->get_myprofile($uid);
			   $data['notice'] = 'update success';
	          $this->load->view('myprofile',$data);
	      }
		}
	}
	public function username_check($str)
	{
	    return ( ! preg_match("/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/", $str)) ? FALSE : TRUE;
	} 
	public function username_unique($username) {
	    $data['session'] = $this->session->all_userdata();
       $this->load->database();
		$query = $this->db->get_where('ydz_user',array('username =' => $username));
		if ( $query->num_rows == 1 && $username != $data['session']['username'])
			{
				return FALSE; //fail the test
			}
			else
			{
				return TRUE;
			}
    }	
	public function password() 
	{   
	    $data['session'] = $this->session->all_userdata();
	    if ( isset($data['session']) && count($data['session'])>5){
		$this->load->view('password',$data);
		$data['notice'] = null;
		}
	}
	public function change_password() {
		$data['session'] = $this->session->all_userdata();
		if ( isset($data['session']) && count($data['session'])>5)
		{
		   $this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
		   $this->form_validation->set_rules('curPass', '当前密码', 'callback_curPass_check');
		   $this->form_validation->set_rules('newPass', '新密码', 'required|min_length[6]|matches[newPassConf]'); 
		   $this->form_validation->set_rules('newPassConf', '确认密码', 'required|min_length[6]');
		   $this->form_validation->set_message('not_same', '确认密码与密码不一致');
		   $this->form_validation->set_message('curPass_check','当前密码错误');
		
		   if ($this->form_validation->run() == FALSE)
		   {
			 $this->load->view('password',$data);
			}else {
				$this->load->model('profile_model');
				$this->profile_model->change_password($data['session']['user_id']);
			    $data['notice'] = 'update success';
			    $this->load->view('password',$data);
			}
		    
		}
	}
	public function curPass_check($curPass) {
		$this->load->database();
		$data['session'] = $this->session->all_userdata();
		$userid = $data['session']['user_id'];
		$query = $this->db->get_where('ydz_user',array('user_id =' => $userid, 'password =' => md5($curPass.'***&@)@%')));
		if ( $query->num_rows == 1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	}
	public function editnote($note_id) {
		$data['session'] = $this->session->all_userdata();
		if(isset($data['session']) && count($data['session'])>5)
		{
		    if ( $note_id != NULL)
			{
			    $this->load->model('modify_note_model');
			    $note_info = $this->modify_note_model->noteinfo($note_id);
			    if($note_info == FALSE) show_404();
			    
			    $data['note_content'] = $note_info['note_content'];
			    $data['note_id'] = $note_id;
			
				$this->load->model('book_info_model');
				$data['note'] = $this->book_info_model->load_book($note_info['book_id'], $data['session']['user_id']) ;
				if ($data['note'] == NULL)
				{
					show_404();
				}
				$this->load->view('editnote', $data);
			}else
			{
				$this->index();
			}
		}
		else
		{
			redirect('/');
		}	
	}
	public function updatenote() {
		$data['session'] = $this->session->all_userdata();
		if(isset($data['session']) && count($data['session'])>5)
		{
			$this->load->model('modify_note_model');
			$book_id = $this->modify_note_model->editnote();
		   redirect('/mine/readnote/'.$book_id);
		}else
		{
			redirect('/');
		}	
	}
	public function delnote($id,$bookid) {
		$data['session'] = $this->session->all_userdata();
		if(isset($data['session']) && count($data['session'])>5)
		{
			$this->load->model('modify_note_model');
			if($this->modify_note_model->deletenote($id,$bookid)){ //if note deleted is not the last one of a book
				$note_info = $this->modify_note_model->noteinfo($id);
		   	    redirect('/mine/readnote/'.$bookid);
			}
			else
				redirect('/mine');
			
		}else
		{
			redirect('/');
		}	
	}

	public function selectbook(){
		$data['session'] = $this->session->all_userdata();
		if(isset($data['session']) && count($data['session'])>5)
		{
			$this->load->view('selectbook',$data);
			//$this->load->model('modify_note_model');
			//$book_id = $this->modify_note_model->editnote();
		    //redirect('/mine/readnote/'.$book_id);
		}else
		{
			redirect('/');
		}	
	}
	public function addbook(){
		$data['session'] = $this->session->all_userdata();
		if(isset($data['session']) && count($data['session'])>5){
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('book_title', '书名', 'required');
			$this->form_validation->set_rules('book_author', '作者', 'required');
			
			if ($this->form_validation->run() == FALSE){
				$this->load->view('selectbook',$data);
			} 
			else {
				$this->load->model('createbook_model');
				$this->createbook_model->savenote();
				$query = $this->createbook_model->get_book_by_title();
				$bookid = $query['book_id'];
				redirect('/mine/newnote/'.$bookid);
			}
        }
		else //user not login
		{
			redirect('/');
		}	
	}
	public function doubanApi(){
		$book = $this->input->post('title');
		$tag = urlencode($book);

         //将中文编码

        $q = file_get_contents('http://api.douban.com/book/subjects?tag='.$tag.'&start-index=1&max-results=1');
        //把查询的结果存储到$q。如果要搜索电影或音乐就将上面http://api.douban.com/book/里的book改为movie或//music，max-results后面是搜索返回的结果。
        $xml = simplexml_load_string($q,null,null,"http://www.douban.com/xmlns/");
        //使用php的simplexml解析xml文件

        $result = array();
        	$result['title']='';
			$result['book_date']=''; 
			$result['book_author']=''; 
			$result['book_cover']=''; 
			$result['isbn']='0000'; 
			$result['book_press']='';
			$result['page']='';

        $link = array();
        $link[@href] = "";
        foreach ($xml->children()->entry as $w){
         //第一个foreach循环查找xml文件中所有的entry元素
            foreach ($w->children($link[@href]) as $x){
         //第二个foreach循环查找entry元素下的<link>中的href属性

	            if($x[@rel] == 'self'){

		             $apiurl=$x[@href];
		             //当<link>中rel属性是self时，存储这个api的url地址
		             $Feed = file_get_contents($apiurl);
		             $xml = simplexml_load_string($Feed,null,null,"http://www.douban.com/xmlns/");

		             //再次解析上面获得的api的url地址中的xml，即搜索出来的每个书籍条目的详细内容
		            foreach ($xml->children($link[@href]) as $item){
		               if($item[@rel] == 'image'){
		             
		                     $str = $item[@href];
		             	     $str = str_replace('spic', 'mpic', $str);
		             	     $result['book_cover'] = $str;
		                }
		            }//用来获取书籍的图片

			        foreach($xml->attribute as $value){
				         if($value->attributes() == 'title'){
				            $result['title'] = $value;
				         }
				         if($value->attributes() == 'author'){
				           $result['book_author'] = $value;
				         } 
				         if($value->attributes() == 'isbn13'){
				           $result['isbn'] = $value;
				         }  
				         if($value->attributes() == 'publisher'){
				           $result['book_press'] = $value;
				         }
						  if($value->attributes() == 'pages'){
				           $result['page'] = $value;
				         }
				         if($value->attributes() == 'pubdate'){
				           $result['book_date'] = $value;
				         }//获取书名、作者等信息
			        }    

                }//end if 'self'                      
            }//end 2nd foreach              
        }

            if( $result['title']=='' || $result['isbn']=='0000'){
            	echo "对不起，没有匹配的记录";
            	return null;	
            }

 			  $this->load->database();
 			  $this->load->model('createbook_model');
 			  $query1 = $this->db->get_where('ydz_book',array('book_isbn' => $result['isbn']));

 			  if( isset($query1) && $query1->num_rows < 1 ){ // the requested book is not in db yet
            
				  $this->db->insert('ydz_book', 
							array(
								 //make $result[] string otherwise insert error
								'book_title'=>$result['title'].'', 
								'book_date'=>$result['book_date'].'', 
								'book_author'=>$result['book_author'].'', 
								'book_cover'=>$result['book_cover'].'', 
								'book_isbn'=>$result['isbn'].'', 
								'book_press'=>$result['book_press'].'',
								'book_page'=>$result['page'].''
								)
							);
			    }// else no need to insert
				
				 $query2 = $this->createbook_model->get_book_by_isbn($result['isbn'].'');
				 $bookid = $query2['book_id'];
				
						
            $finalResult = '
            	<img class="pull-left" id="cover" src="'.$result['book_cover'].'" style="width:106px;"/>
                    <ul class="pull-left book_info">
                      <li ><span class="label select_book_item" >作者</span><span id="author">'.$result['book_author'].'</span></li>
                      <li ><span class="label select_book_item" >出版社</span><span id="press">'.$result['book_press'].'</span></li>
                      <li ><span class="label select_book_item" >出版日期</span><span id="date">'.$result['book_date'].'</span></li>
                      <li ><span class="label select_book_item" >页数</span>'.$result['page'].'<span id="page"></span></li>
                      <li ><span class="label select_book_item" >ISBN</span>'.$result['isbn'].'<span id="isbn"></span></li>
					  <li style="display:none;" id="bookAdded">'.$bookid.'</li>
                    </ul>
                <div style="clear:both"></div>';
        	//echo json_encode( $result );
                echo $finalResult;
	}

	public function checktitle(){
		//$this->load->helper(array('form', 'url'));
		$title = $this->input->post('title', TRUE);
		//$title = $_POST['title'];
		//$title=$this->input->post("title");
		
		$this->load->model('selectbook_model');
		$data = $this->selectbook_model->checktitle($title);
		$result = array();
		
		foreach( $data as $key => $value )
		{
			$result[$key][ 'book_title' ] = urlencode( $value['book_title'] );
			$result[$key][ 'book_id' ] = $value['book_id'];
		}
		
		echo urldecode( json_encode( $result ) );
		//echo json_encode( $data );
	}
	public function checkbookinfo(){
		$book_id = $this->input->post('book_id', TRUE);
		$this->load->model('selectbook_model');
		$data = $this->selectbook_model->checkbookinfo($book_id);
		$result = array();
		
		foreach( $data as $key => $value )
		{
			$result[$key][ 'book_title' ] = urlencode( $value['book_title'] );
			$result[$key][ 'book_isbn' ] = $value['book_isbn'];
			$result[$key][ 'book_cover' ] = urlencode($value['book_cover']);
			$result[$key][ 'book_press' ] = urlencode($value['book_press']);
			$result[$key][ 'book_author' ] = urlencode($value['book_author']);
			$result[$key][ 'book_page' ] = $value['book_page'];
			$result[$key][ 'book_date' ] = date('Y-m-d',strtotime($value['book_date']));
		}
		echo urldecode( json_encode( $result ) );
	}
	public function comment() {
       $data['session'] = $this->session->all_userdata();
       $deleteTag = '';
        
       $note_id = $this->input->post('note_id', TRUE);
		$this->load->model('comment_model');
		$comments = $this->comment_model->get_comment($note_id);
		$result = '';
		foreach ($comments as $comm) {
		    if($data['session']['username']==$comm['username'])
		         $deleteTag = '<a class="commDel" style="cursor:pointer; float:right; margin-left:15px;">删除</a>';
		    else
		         $deleteTag = '<a style="cursor:pointer; float:right;" class="reply">回复</a>';
			$result = $result.'
					<div class="well comment" style="margin-bottom: 5px; padding: 5px; min-height: 50px;">
					  <img src="/img/head/'.$comm['avatar'].' " class="pull-left" alt="'.$comm['username'].'" style="width: 48px; height: 48px; margin-right: 10px;"/>'.$deleteTag.'
					  <div class="comm_id" value="'.$comm['comment_id'].'" style="display:none"></div>
					  <div class="note_id" value="'.$comm['note_id'].'" style="display:none"></div>
			  		  <p2>'.$comm['username'].' '.$comm['com_date'].'</p2><br />
			  		  <p2>'.$comm['com_content'].'</p2>
			  	    </div> 
					';
		}
		echo $result;
	}
}