<?php
include('script/parse/simple_html_dom.php');
class Spider extends CI_Controller 
{
	
	private function _setCookie($url)
	{
		$cookie_file = dirname(__FILE__).'/cookie.txt';
		$ch = curl_init($url); //初始化
		//curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
		curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file); //存储cookies
		curl_exec($ch);
		curl_close($ch);
	}
	public  function get_book_link($tag, $num = 100)
	{
		//$url = 'http://book.douban.com/subject/1786670/';
		$tag = urldecode($tag);
		$url = "http://book.douban.com/tag/".$tag."?&type=T&start=";		
		$cookie_file = dirname(__FILE__).'/cookie.txt';
		$links = array();
		$this->_setCookie($url);
 		
		$count = 0;
		
		header("Content-type: text/html; charset=utf-8");
		for ( $i = 0 ; $i < $num ; $i += 1 )
		{
			if ( $i != 0 && $i % 3 == 0 )
			{
				echo "sleep <br />";
				$ch = curl_init("http://douban.com"); //初始化
				//curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
				curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file); //存储cookies
				curl_exec($ch);
				curl_close($ch);
				//sleep(10);
			}
				
			echo "Page: " . $i . "<br />";
			//$url =;
			$index = 0;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL,  $url . $count);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curl, CURLOPT_COOKIEJAR,  $cookie_file); //存储cookies
		   	//curl_setopt($curl, CURLOPT_COOKIEJAR,  $temp_file); 
		   	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
		    $test = curl_exec($curl);
		    curl_close($curl);
			$html = str_get_html($test);
			$t = $html->find('a[class=nbg]');
			if (empty($t))
			{
				//$i -- ;
				echo "ERROR <br />";
				//return ;
				continue;
			}else{
				//$cookie = $cookie_file;
				foreach($t as $item)
				{
					//$cookie = $temp_file;
					$links[$count + $index] = $item->href;
					//echo $links[$count + $index]. "<br />";									
					$index ++;
				}
			}	
			$count += 20;			
		}
		
		echo "Complete!";
		$this->load->model('spider_model');
		$this->spider_model->save_link($tag,$links);
	}

	public function get_book_info($tag)
	{
		$data = array('书名'=>"",'封面'=>"",'原作名'=>"", '作者'=>"", '出版社'=>"", '页数'=>"","ISBN"=>"" ,"定价"=>"");
		$dic = array('书名','封面','原作名', '作者', '出版年', '出版社', '页数' ,"ISBN", "定价");
		$cookie_file = dirname(__FILE__).'/cookie.txt';
		$count = 1;
		$this->load->model('spider_model');
		header("Content-type: text/html; charset=utf-8");
		$links = $this->spider_model->load_link(urldecode($tag));
		//echo $link[0]['link'] . "<br />";
		
		foreach ( $links as $item)
		{
			set_time_limit ( 0 );
			//echo $item['link'] . "<br />";
			if ( $count != 0 && $count % 50 == 0 )
			{
				//echo "sleep <br />";
				$ch = curl_init("http://douban.com"); //初始化
				//curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
				curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file); //存储cookies
				curl_exec($ch);
				curl_close($ch);
				sleep(10);
			}
			$url = $item['link'] ;
			echo $url . "<br>";
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
		     curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
		    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		    $test = curl_exec($curl);
		    curl_close($curl);
		    if ($test == null){
		    	echo "curl error!! <br>";
		    	continue;
		    }
		    $html = str_get_html($test);
		   // $test = file_get_contents($url);
		    /*
		    try {
		    	$html = str_get_html($test);
		    }catch (exception e){
		    	continue;
		    }
			*/
			$isItem = false;
			$ItemName = "";
			//
			$title = $html->find('span[property=v:itemreviewed]') ;
			if ( $title != null )
			{
				foreach($title as $t)
				{
					$data["书名"] = $t->plaintext;
					echo $count.".".$data["书名"] . "<br />";
				}
				$cover = $html->find('img[title="点击看大图"]');
				foreach($cover as $t)
				{
					$data["封面"] = $t->src;
					//echo $data["封面"] . "<br />";
				}
				foreach($html->find('div[id=info]') as $element )
				{	
					foreach($element->find('text') as $item )
					{
						$item = str_replace(":", "", $item);
						$item = str_replace("/", "", $item);
						$item = preg_replace("/\s/", "", $item);
						if ( in_array($item , $dic) )
						{
								$isItem = true;
								$ItemName = $item;										
						}else{
							if ( strcmp($item,"") && $isItem)
							{
								//echo $item."<br />";
								$isItem = false;
								$data[$ItemName] = $item;
								//echo $data[$ItemName]."<br />";
							}
								
						}
							
					}
				}	
				$count ++;
				$this->spider_model->save_book_info($data);
			} else {
				echo "ERROR! <br />";
				//return;
				continue;
				//$i -= 20;
			}
	
		}	
		echo "Complete!";
        	//foreach($element->find('span[class=pl]') as $info )
        	//	echo $info->plaintext . '<br>';
        	
		/*$curl = curl_init();
	    $url = "http://book.douban.com/tag/%E5%B0%8F%E8%AF%B4";
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $data = curl_exec($curl);
	 	echo $data;

	    //preg_match( '/id="s_sina2".*?pic=(.*?)".?target=/', $data , $result );
	    //echo '<a target="_blank" href="'.$url.'"> <img src="'. $result[1].'" /></a>';
	    curl_close($curl);
	    */
	
	}
	public function export() {
		$this->load->model('spider_model');
		$this->spider_model->export() ;
		echo "Complete";
	}

}