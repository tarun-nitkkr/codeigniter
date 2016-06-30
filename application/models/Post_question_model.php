<?php
/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * User_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Post_question_model extends CI_Model
{
	
	function __construct()
	{
	
		parent::__construct();
	}


	public function insert_question_data($question_data)
	{
		
		//$user_data = $_SESSION['user_data'];
		//$u_id = $user_data['u_id'];
		//hard coding u_id
		$u_id = 20;
		$query_question = "insert into question(u_id,q_data,q_title) values('".$u_id."','".$question_data['q_data']."','".$question_data['q_title']."')";
		$execute_question = $this->db->query($query_question);
			
		//$file = file_get_contents($question_data['tag_name']);
		
		//$tag_name = "java,c,c++,php";
		//$file = file_get_contents($tag_name);
		$tag_name = $question_data['tag_name'];
	//	$data = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $tag_name));
		
		

		$query_get_q_id = "select q_id from question where u_id='".$u_id."' and q_data = '".$question_data['q_data']."' and q_title = '".$question_data['q_title']."'";
		$execute = $this->db->query($query_get_q_id);
		$row_q_id = $execute->row();

// I need to insert q_id and tag_id
		// $query_insert_quest = "insert into question_tag(q_id,u_id) values('".$row->q_id."','".$u_id."'') ";
		// $execute = $this->db->query($query_insert_quest);
		echo "Checking Array from csv to string";
		echo "<pre>";
		print_r($tag_name);
		echo "</pre>";
		//$query_tag = "select tag_id from tags where name IN ('".$tag_name."')";// I think here we can csv directly
		$query_tag = "select tag_id from tags where name IN ('Dennis','Jerry','Jack','Tobias')";
		$execute = $this->db->query($query_tag);
		//$row = $execute->row();
		$value1 = "";
		$value2 = "";
		$query_user_tag_relation = "";
		$flag = 0;
		$executecheck = $execute->result();

		echo "<pre>";
		print_r($executecheck);
		
		echo "</pre>";

		foreach ($execute->result() as $row)
		{
			
			if($flag == 0)
			{
				$value1 ="('".$u_id."','".$row->tag_id."')";
				$value2 ="('".$row_q_id->q_id."','".$row->tag_id."')";
				$flag = $flag+1;
			}
			else
			{
				$value1 .= ",('".$u_id."','".$row->tag_id."')";
				$value2 .=",('".$row_q_id->q_id."','".$row->tag_id."')";
			}
		}

		echo "Value1::".$value1;
		echo "Value2::".$value2;
		// noe inserting into question_tag and user_tag_relation

		$query_insert_quest_tag = "insert into question_tag(q_id,tag_id) values".$value2."";
		$execute = $this->db->query($query_insert_quest_tag);
		
		echo $query_insert_quest_tag;


		if($execute!="NULL")
		{
			echo "Inserted Value1";
		}
		$query_insert_user_tag_relation = "insert into user_tag_relation(u_id,tag_id) values".$value1."";
		$execute = $this->db->query($query_insert_user_tag_relation);
	if($execute!="NULL")
		{
			echo "not Inserted Value2";
		}
			 
		}
	}
