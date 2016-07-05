/<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model
{

	function __construct()
	{
		parent:: __construct();
	}

	public function get_search_page($term)
	{
		$query = "select tag_name from tags where tag_name LIKE %'".$term."'% order by no_of_likes LIMIT 0,10";

		$i =0;
		$execute = $this->db->query($query);
		//$row = $execute->rows();

		foreach ($execute->result() as $row) 
			{
			$data[$i][0]=$row->q_id;
			$data[$i][1]=>$row->q_title;
			}

			return $data;
	}
}

		// if($execute->num_rows()>0)
		// {

		// 	$result['0']='user';
		// 	$result['1']='$term';
		// 	return $result;
			
		// }
		// else
		// {
		// 	$query = "select tag_name from tags where tag_name='".$term."'";
		// 	$execute = $this->db->query($query);

		// 	if($execute->num_rows()>0)
		// 	{
		// 		$result['0']='$term';
		// 		return $result;
		// 	}
		// 	else
		// 	{
		// 		//fire ajax erro
		// 		$result['0']='error';
		// 		return $result;
		// 	}
		// }	
	