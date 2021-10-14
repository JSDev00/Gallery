<?php 


class Load_images{
	public function get_images($find=''){
	
		$DB = new Database();
		$limit = 9;
		$page_number = isset($_GET['page'])?$_GET['page']:1;
		$page_number = $page_number < 1 ? 1 : $page_number;
		$offset = ($page_number - 1) * $limit;

		if($find===''){

		$query = "select * from images order by id desc limit $limit offset $offset";
	
		return $DB->read($query);
		}else{
		$find=esc($find);			
		$query = "select * from images WHERE title like '%$find%' order by id desc limit 12";
		$arr['find'] = $find;
		return $DB->read($query);
		}
	}
	public function get_total(){
		$DB = new Database();
		$query = "select * from images";
		return count($DB->read($query));

	}
	public function get_single_image($url_address){


		$DB = new Database();
		$query = "update images set view = view + 1 where url_address = :url limit 1";
		$arr['url'] = $url_address;
	    $DB->write($query,$arr);



		$query = "select * from images where url_address = :url limit 1";
		$arr['url'] = $url_address;
		$data = $DB->read($query,$arr);
		return $data[0]; 

	}
}