<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model
{

	function __construct()
	{
		parent:: __construct();
	}

	public function get_search_page($term)
	{
		$query = "select user_name from user_profile where user_name = '".$term."'";
		$execute = $this->db->query($query);

		if($execute->num_rows()>0)
		{

			$result['0']='user';
			$result['1']='$term';
			return $result;
			
		}
		else
		{
			$query = "select tag_name from tags where tag_name='".$term."'";
			$execute = $this->db->query($query);

			if($execute->num_rows()>0)
			{
				$result['0']='$term';
				return $result;
			}
			else
			{
				//fire ajax erro
				$result['0']='error';
				return $result;
			}
		}	
	}