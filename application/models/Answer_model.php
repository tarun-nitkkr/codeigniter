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
		/*if($rows>0)
		{

		while($i<$rows)
		{
			$answer_data[$i][0]=$execute[0];
			$answer_data[$i][1]=$execute[2];
			$answer_data[$i][2]=$execute[3];
			$answer_data[$i][3]=$execute[4];
			$answer_data[$i][4]=$execute[6];
			$answer_data[$i][5]=$execute[7];
			$i=$i+1;
		}*/
		if(!empty($execute)){
		$this->set_answer_data($execute);
		return true;
	}
	
	else
	{
		echo "Error in getting answer from table\n.";
	}
	}
}