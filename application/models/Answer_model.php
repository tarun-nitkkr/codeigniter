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
	public function get_answers_data()
	{
		return $this->answer_data;
	}
	public functions get_answers($q_id)
	{
		$query = "select * from answer where q_id = '".$q_id."'order by created_on ASC";
		$execute = $this->db->query($query);
		$i=0;
		if($execute->num_rows()>0)
		{
		while($execute->num_rows()>0)
		{
			$answer_data[i][0]=$row->a_id;
			$answer_data[i][1]=$row->u_id;
			$answer_data[i][2]=$row->a_data;
			$answer_data[i][3]=$row->upvotes;
			$answer_data[i][4]=$row->created_on;
			$answer_data[i][5]=$row->last_modified;
			$i=$i+1;
		}
		$this->set_answer($answer_data);
		return true;
	}
	else
	{
		echo "Error in getting answer from table\n."
	}
	}
}