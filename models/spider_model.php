<?php

class Spider_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	public function save_link($tag , $links)
	{
		foreach ( $links as $item)
			$this->db->insert('ydz_spider_links', array('tag'=>$tag, 'link'=>$item));
	}
	public function load_link($tag)
	{
		$sql = "SELECT link 
				FROM ydz_spider_links
				WHERE tag = ?";
		return  $this->db->query($sql, array($tag))->result_array();
	}
	public function save_book_info($data)
	{
		//foreach ( $data as $item)
			$this->db->insert('ydz_spider_book', array('书名'=>$data['书名'], '封面'=>$data["封面"] ,'原作名'=>$data['原作名'], '作者'=>$data['作者'], '出版社'=>$data['出版社'], '页数'=>$data['页数'], '出版年'=>$data['出版年'], '定价'=>$data['定价'], 'ISBN'=>$data['ISBN']));
	}
	public function export()
	{
		$sql = "SELECT *
				FROM ydz_spider_book";
		$spider_book = $this->db->query($sql)->result_array();
		header("Content-type: text/html; charset=utf-8");
		$count = 1;
		foreach ( $spider_book as $item ) {
			set_time_limit ( 0 );
			//echo $item['书名'];
			try {
				$this->db->insert('ydz_book',
				array(
					'book_title'=>$item['书名'],
					'book_cover'=>$item['封面'],
					'book_author'=>$item['作者'],
					'book_press'=>$item['出版社'],
					'book_page'=>$item['页数'],
					'book_isbn'=>$item['ISBN'],
					'book_date'=>'2012-7-4 00:00:00'
					)
				);
				echo $count .". " .$item['书名'] .'<br>';
				$count ++;
			} catch (Exception $e) {
				echo "skip a duplicate book";
			}

		}
	}
}