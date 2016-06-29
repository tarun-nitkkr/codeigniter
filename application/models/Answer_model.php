<?php
class Answer_model extends CI_Model
{
	private $answer_data;
	function __construct()
	{
		parent::__construct();
	}

	public function set_answer_data($value)
	{
		$this->answer_data=$value;
	}		
	public function get_answer_data()
	{
		return $this->answer_data;
	}
	public function get_answers($q_id)
	{
		$query = "select * from answer where q_id = '".$q_id."'order by created_on ASC";
		$execute = $this->db->query($query)->result_array();
		$i=0;
		$rows = sizeof($execute);
		$answer_data[0][0]=0;

		if(!empty($execute)){
		$this->set_answer_data($execute);
		return true;
	}
	
	else
	{
		echo "Error in getting answer from table\n.";
	}
	}

	public function answers_only()
	{
		$q_id=$_SESSION['q_id'];
		$query = "select * from answer where q_id = '".$q_id."'order by a_id DESC";
		//$execute = $this->db->query($query)->result_array();
		$execute=$this->db->query($query);
		//$execute=$this->db->query($query);
		if($execute->num_rows()>0)
		{

			$set[]=array();
			$i=0;
			foreach ($execute->result() as $row) 
			{
				# code...
			//$row=$execute->row();
				$name = "select user_name from user_profile where ='".$row->$u_id."'";
				$exec = $this->db->query($name);
				$rown = $execute->result();
				$user_name=$rown->user_name;
			$data=array(
				'a_id'=>$row->a_id;
				'q_id'=>$row->q_id,
				'u_id'=>$row->$u_id,
				'user_name'=>$user_name;
				'a_data'=> $row->a_data,
				'upvotes'=> $row->upvotes,
				'created_on'=> $row->created_on,
				'last_modified'=> $row->last_modified
				);
			array_push($set, $data);

			$i++;

			}
			$result=array(

				'set'=>$set,
				'no'=>$i
				);
			return $result;
		}
	}
}