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

	public function get_list_of_questions($tag_id, $from)
	{
		$query="SELECT UP.user_name,Q.q_id, GROUP_CONCAT(QT.tag_id) ,Q.q_title, GROUP_CONCAT(T.name) as tag_name, Q.no_of_answer, Q.no_of_likes, Q.created_on  FROM question Q JOIN question_tag QT ON QT.q_id=Q.q_id 
				JOIN tags T ON T.tag_id=QT.tag_id JOIN user_profile UP ON Q.u_id=UP.u_id 
				where QT.tag_id=".$tag_id."
				GROUP BY Q.q_id, Q.q_title, Q.no_of_answer, Q.no_of_answer, Q.no_of_likes, Q.created_on 
				ORDER BY Q.q_id DESC
				LIMIT ".$from.",10";
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




	//function to update answer in the db
	public function post_edited_answerDB($data)
	{
		
		$query="update answer set a_data='".$data['a_data']."' where q_id=".$data['q_id']." and u_id=".$data['u_id'];
		if($this->db->query($query))
		{
			return 1;
		}
		return 0;

	}

	//function to post the answer into db
	public function post_answerDB($data)
	{
		
		$query="update question set no_of_answer=no_of_answer+1 where q_id=".$data['q_id'];
		if($this->db->insert('answer',$data) && $this->db->query($query))
		{
			return 1;
		}
		return 0;

	}


//to get the list of all the users who answeres on that question
	public function get_contributors($q_id)
	{
		$query="SELECT UP.first_name, UP.email_id, UP.u_id  from question Q JOIN answer A ON A.q_id=Q.q_id JOIN user_profile UP ON UP.u_id=A.u_id
		WHERE Q.q_id=".$q_id;
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
				
				'name'=>$row->first_name,
				'email_id'=>$row->email_id,
				'u_id'=>$row->u_id
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



	//function to get the question owner details
	public function get_question_owner($q_id)
	{
		$query="SELECT UP.first_name, UP.email_id, UP.u_id  from question Q JOIN user_profile UP ON UP.u_id=Q.u_id
		WHERE Q.q_id=".$q_id;
		$execute=$this->db->query($query);

		if($execute->num_rows() > 0)
		{
			$row=$execute->row();
			$data=array(
					
					'name'=>$row->first_name,
					'email_id'=>$row->email_id,
					'u_id'=>$row->u_id
					);
			return $data;


		}
		return 0;
		
	}
public function	get_list_of_answered_question()
{
	//$userdata = $_SESSION['user_data'];
	//$u_id = $user_data['u_id'];
	$u_id=19;

	$query = "select q_title from answer,question where answer.u_id = '".$u_id."' and answer.q_id = question.q_id";
	$execute = $this->db->query($query)->result_array();

	echo "<pre>";
	print_r($execute);
	echo "</pre>";
	return $execute;
}

public function user_asked_questions()
{
	// $userdata = $_SESSION['user_data'];
	// $u_id = $user_data['u_id'];
	$u_id=19;

	$query = "select COUNT(q_id) as count_quest from question where u_id = '".$u_id."'";
	$execute = $this->db->query($query);
	$row = $execute->row();
	$num_question_asked = $row->count_quest;

	if($execute->num_rows()>0)
	{
		return $num_question_asked;
	}
	else
	{
		return 0;
	}

}
}