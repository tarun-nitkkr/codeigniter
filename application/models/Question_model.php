<?php

class Question_model extends CI_Model
{
	private $q_id;
	private $q_data;
	function __construct()
	{
		parent::__construct();
	}

	public function set_question_data($value)
	{
		$this->q_data = $value;
	}

	public function get_question_data()
	{
		return $this->q_data;
	}
	public function get_question_detail($q_id);
	{
		$query = "select * from question where q_id = '".$q_id."'";
		$execute = $this->db->query($query);
		if($execute->num_rows()>0)
		{
			$q_data = array('u_id'=>$row->u_id,
		'q_title'=>$row->q_title,
		'q_data'=>$row->q_data,
		'no_of_likes'=>$row->no_of_likes,
		'q_create_date'=>$row->create_on,
		'q_modified_date'=>$row->last_modified,
		'q_num_answer'=>$row->no_of_answer);

		$this->set_question_data($q_data);
		return 1;
		}

		else
		{
			return 0;
		}


	}


// Returning list of all the questions of a particular tag_id for Tags_detail page __F

	public function get_list_of_questions($tag_id)
	{
		$i = 0;
		$query = "select q_id from question_tag where tag_id='".$tag_id."'";
		$execute = $this->db->query($query);
		if($execute->num_rows()>0)
		{
			while($execute->num_rows()>0)
			{
				$q_id = $row->q_id;
				$new_query = "select q_title from user_profile where q_id='".$q_id."'";
				$execute = $this->db->query($new_query);
				if($execute->num_rows>0)
				{
					$list_questions[$q_id][$i] = $row->q_title;
				}
				$i = $i+1;
			}
		}
		else
			{
				echo "error in listing all questions of particular Tag\n";
				return 0;
			}
	}
}