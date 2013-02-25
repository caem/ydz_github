<?php

class Notification_model extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}
	public function unRead($user_id){
		$sql = "SELECT from_user_id FROM ydz_notification WHERE user_id=? and unRead !=0";
		return $this->db->query($sql, array($user_id))->result_array();
	}
	public function load_notification($user_id){
		$sql = "SELECT username as from_username,
					   content_id,
					   avatar,
					   date,
					   book_title,
					   ydz_comment.book_id as book_id,
					   com_content,
					   ydz_note.user_id as owner_id,
					   ydz_comment.note_id as note_id,
					   unRead
				FROM ydz_notification
				INNER JOIN ydz_user
				ON ydz_user.user_id = ydz_notification.from_user_id
				INNER JOIN ydz_comment
				ON ydz_comment.comment_id = ydz_notification.content_id
				INNER JOIN ydz_note
				ON ydz_note.note_id = ydz_comment.note_id
				INNER JOIN ydz_book 
				ON ydz_book.book_id = ydz_comment.book_id
				WHERE ydz_notification.user_id = ? ";
		return $this->db->query($sql, array($user_id))->result_array();
	}
	public function insert_notification($comm_id, $reply_to, $to_author, $note_owner){
		$from_user_id = $this->input->post('user_id', TRUE);
		$content_id = $this->input->post('note_id', TRUE);
		
		if ( $reply_to != "") {
			$sql = "SELECT user_id
					FROM ydz_user
					WHERE username = ?";
			$res = $this->db->query($sql, array($reply_to))->result_array();
			if ( count($res[0]) != 0 ) {
				$reply_to_id =$res[0]['user_id'];
				$data = array( 
						'date'=>date("Y-m-d H:i:s",time()), 
						'user_id'=>$reply_to_id,
						'from_user_id'=>$from_user_id,
						'content_id'=>$comm_id,
						'type'=>0 //type: 0 ---- new reply
				);
				$this->db->insert('ydz_notification', $data); 
			}
		}
		if ( $to_author != "" && $note_owner != $to_author) {
			$sql = "SELECT user_id
					FROM ydz_user
					WHERE username = ?";
			$res = $this->db->query($sql, array($to_author))->result_array();
			if ( count($res[0]) != 0 ) {
				$to_author_id =$res[0]['user_id'];
				$data = array( 
						'date'=>date("Y-m-d H:i:s",time()), 
						'user_id'=>$to_author_id,
						'from_user_id'=>$from_user_id,
						'content_id'=>$comm_id,
						'type'=>0 //type: 0 ---- new reply
				);
				$this->db->insert('ydz_notification', $data); 
			}
		}
		

	}

	public function load_sum($user_id) {
		$sql = "SELECT COUNT( * ) as total
				FROM  `ydz_notification` 
				WHERE user_id =? and unRead = 1";
		return $this->db->query($sql, array($user_id))->result_array();
	}

	public function readAll($user_id) {
		$sql = "UPDATE ydz_notification 
				SET unRead = 0 
				WHERE user_id = ? ";
		$this->db->query($sql, array($user_id));
	}
	public function del_notification($item_id) {
		$item_id = $this->input->post('comm_id', TRUE);
		$sql = "DELETE
				FROM ydz_notification
				WHERE content_id = ?";
		$this->db->query($sql, array($item_id));
	}
	
}