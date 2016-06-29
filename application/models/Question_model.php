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
	


	public function get_question_detail($q_id)
	{
		$query = "select * from question where q_id =".$q_id;
		$execute = $this->db->query($query);

		if($execute->num_rows()>0)
		{
			$row=$execute->row();
		$q_data = array('u_id'=>$row->u_id,
		'q_title'=>$row->q_title,
		'q_data'=>$row->q_data,
		'no_of_likes'=>$row->no_of_likes,
		'q_create_date'=>$row->created_on,
		'q_modified_date'=>$row->last_modified,
		'q_num_answer'=>$row->no_of_answer
		);

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
		echo "Qmodel Tag id=" + $tag_id+"\n";
	//	$query = "select q_id from question_tag where tag_id='".$tag_id."'";
		$query = "select question.q_id,question.u_id,question.q_data,question.q_title,question.no_of_answer,question.no_of_likes,question.created_on from question_tag,question where question_tag.tag_id = '".$tag_id."' and question_tag.q_id = question.q_id";

		//$execute = $this->db->query($query);
		//$row = $execute->row();
		//echo "Check::table\n";
		//print_r($execute);





		$execute=$this->db->query($query);
		if($execute->num_rows()>0)
		{

			$set[]=array();
			$i=0;
			foreach ($execute->result() as $row) 
			{
				# code...
			//$row=$execute->row();
			$data=array(
				'q_id'=>$row->q_id,
				'u_id'=>$row->u_id,
				'q_data'=>$row->q_data,
				'q_title'=> $row->q_title,
				'no_of_answer'=> $row->no_of_answer,
				'no_of_like'=>$row->no_of_likes,
				'created_on'=> $row->created_on
			

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

		/*

		if($execute->num_rows()>0)
		{
			foreach ($execute->result() as $row) 
			{
			
				//$qq_id = $row->q_id;
				//$new_query = "select q_title from question where q_id='".$qq_id."'";
			//	$newexecute = $this->db->query($new_query);
				//if($newexecute->num_rows>0)
				//{
				//echo "inside array\n";
				//$newrow = $newexecute->row();
				$list_questions[$i][0] = $row->q_id;
				$list_questions[$i][1] = $row->u_id;
				$list_questions[$i][2] = $row->q_data;
				$list_questions[$i][3] = $row->q_title;
				$list_questions[$i][4] = $row->no_of_answer;
				$list_questions[$i][5] = $row->no_of_likes;
				$list_questions[$i][6] = $row->created_on;
				//echo $list_questions[$i][1];
				//echo "\n";	
			//}
				$i = $i+1;
			}


			// echo "This is the tag array\n";
			// echo "<pre>";
			// print_r($list_questions);
			// echo "</pre>";
			return $list_questions;
			
			
		}
		*/
		else
			{
				echo "error in listing all questions of particular Tag\n";
				return 0;
			}
	}


	public function get_recent_questions($data)
	{
		$query="SELECT UP.user_name,Q.q_id, Q.q_title, GROUP_CONCAT(T.name) as tag_name, Q.no_of_answer, Q.no_of_likes, Q.created_on  FROM question Q JOIN question_tag QT ON QT.q_id=Q.q_id JOIN tags T ON T.tag_id=QT.tag_id JOIN user_profile UP ON Q.u_id=UP.u_id
				GROUP BY Q.q_id, Q.q_title, Q.no_of_answer, Q.no_of_answer, Q.no_of_likes, Q.created_on
				ORDER BY Q.q_id DESC
				LIMIT ".$data['from'].",10";

		$execute=$this->db->query($query);
		if($execute->num_rows()>0)
		{

			$set[]=array();
			$i=0;
			foreach ($execute->result() as $row) 
			{
				# code...
			//$row=$execute->row();
			$data=array(
				'q_id'=>$row->q_id,
				'user_name'=>$row->user_name,
				'title'=> $row->q_title,
				'no_ans'=> $row->no_of_answer,
				'no_like'=>$row->no_of_likes,
				'created_on'=> $row->created_on,
				'tag_csv'=> $row->tag_name

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
		return 0;



	}



	public function get_followed_question($data, $user_id)
	{



		$query="SELECT UP.user_name,Q.q_id, Q.q_title, GROUP_CONCAT(T.name) as tag_name, Q.no_of_answer, Q.no_of_likes, Q.created_on  FROM user_tag_relation UT JOIN question_tag QT ON QT.tag_id=UT.tag_id 
				JOIN question Q ON QT.q_id=Q.q_id JOIN tags T ON T.tag_id=QT.tag_id JOIN user_profile UP ON Q.u_id=UP.u_id 
				WHERE UT.u_id=".$user_id."
				GROUP BY Q.q_id, Q.q_title, Q.no_of_answer, Q.no_of_answer, Q.no_of_likes, Q.created_on 
				ORDER BY Q.q_id DESC 
				LIMIT ".$data['from'].",10";
        $execute=$this->db->query($query);
        if($execute->num_rows()>0)
		{

			$set[]=array();
			$i=0;
			foreach ($execute->result() as $row) 
			{
				# code...
			//$row=$execute->row();
			$data=array(
				'q_id'=>$row->q_id,
				'user_name'=>$row->user_name,
				'title'=> $row->q_title,
				'no_ans'=> $row->no_of_answer,
				'no_like'=>$row->no_of_likes,
				'created_on'=> $row->created_on,
				'tag_csv'=> $row->tag_name

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
		return 0;



	}



	public function user_interaction_details_db($user_id)
	{
		$query="select * from user_interaction_table where u_id=".(int)$user_id;
		$execute=$this->db->query($query);
		$row=$execute->row();
		$data=array(
			'no_ans'=> $row->no_of_answers,
			'no_ques'=> $row->no_of_questions
			);
		return $data;
	}


	public function user_tag_relation_db($user_id)
	{
		$query='SELECT T.name FROM user_profile U JOIN user_tag_relation UT ON U.u_id=UT.u_id JOIN tags T ON T.tag_id=UT.tag_id WHERE U.u_id='.$user_id;
		$execute=$this->db->query($query);
		$set=array();
		$i=0;
		$csv='';
		if($execute->num_rows()>0)
		{
			foreach ($execute->result() as $row) {
				# code...
				$csv=$csv.$row->name.',';
				array_push($set, $row->name);
				$i++;

			}
			$csv=chop($csv,',');
			$result=array(
				'set'=> $set,
				'no'=> $i,
				'csv'=> $csv
				);
			return $result;
		}
		return 0;

		
	}

	public function get_q_data($q_id)
	{
		$query="SELECT UP.user_name,Q.q_id, Q.q_data, Q.q_title, GROUP_CONCAT(T.name) as tag_name, Q.no_of_answer, Q.no_of_likes, Q.created_on  FROM question Q JOIN question_tag QT ON QT.q_id=Q.q_id JOIN tags T ON T.tag_id=QT.tag_id JOIN user_profile UP ON Q.u_id=UP.u_id
WHERE Q.q_id=".$q_id."
GROUP BY Q.q_id, Q.q_data, Q.q_title, Q.no_of_answer, Q.no_of_answer, Q.no_of_likes, Q.created_on";
		$execute=$this->db->query($query);
		$row=$execute->row();
		$data=array(
				'q_id'=>$row->q_id,
				'user_name'=>$row->user_name,
				'title'=> $row->q_title,
				'data'=>$row->q_data,
				'no_ans'=> $row->no_of_answer,
				'no_like'=>$row->no_of_likes,
				'created_on'=> $row->created_on,
				'tag_csv'=> $row->tag_name

				);
		return $data;

	}

	public function answers_only()
	{
		$q_id=$_SESSION['q_id'];
		// $data=$_SESSION['user_data'];
		// $u_id=$data['u_id'];
		$query = "select A.*, UP.user_name from answer A join user_profile UP ON UP.u_id=A.u_id
					where A.q_id =".$q_id."
					order by a_id DESC";
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
				
			$data=array(
				'a_id'=>$row->a_id,
				'q_id'=>$row->q_id,
				'u_id'=>$row->u_id,
				'user_name'=>$row->user_name,
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
		else
		{
			return 0;
		}
	}
}