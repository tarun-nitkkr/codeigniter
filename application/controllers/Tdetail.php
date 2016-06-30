<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tdetail extends CI_Controller {
//ini_set('max_execution_time', 0); 
//ini_set('memory_limit','2048M');
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	private $model;

	//public function initialize_model()
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('question_model');
		$this->model= new question_model;

	}


	public function getQuestionModel()
	{
		return $this->model;
	}





public function tag_detail($tag_name)
	{
			//$tag_name = 'Tobias';
		$this->load->model("Tag_model");
		$tmodel = new Tag_model;
		$tag_data = $tmodel->get_tag_detail($tag_name);

		//getting tag details

		$tag_id = $tmodel->get_tag_id();
		//echo "Tag id=" + $tag_id;
		$tag_description = $tmodel->get_tag_description();
		$tag_followers = $tmodel->get_tag_followers();

		$tag_data = array('tag_name'=>$tag_name,
			'tag_id'=>$tag_id,
			'tag_description'=>$tag_description,
			'tag_followers'=>$tag_followers,
			'tag_name'=> $tag_name
			);
		return $tag_data;

	}



	public function follow_unfollow($tag_id)
	{
	$data =$_SESSION['user_data'];
	$uu_id = $data['u_id'];

	$this->load->model("Tag_model");
	$tmodel = new Tag_model;
	$flag = $tmodel->fol_unfol($uu_id,$tag_id);
	return $flag;
	}




	public function tags()
	{
		$tag_name = $_SESSION['tag_name'];
		$tag_data=$this->tag_detail($tag_name);
		$_SESSION['tag_id']=$tag_data['tag_id'];
		$flag =$this->follow_unfollow($tag_data['tag_id']);
		$tag_data['flag']=''.$flag;
		echo json_encode($tag_data);
		
		

		
	}



	//function to retrieve questions with a particular tag
	public function retrieve_tag_question()
	{
		$tag_id=$_SESSION['tag_id'];
		$from=$this->input->get('from');

		$qmodel= $this->getQuestionModel();
		$result = $qmodel->get_list_of_questions($tag_id, $from);

		$set=$result['set'];
		//$html_string='';
		for($i=1; $i<=$result['no']; $i++)
		{
			$data=$set[$i];
			$this->load->view('Question_view',$data);
  			
		}
		// $response=array(
		// 		'result'=>$html_string
		// 	//'result'=> $this->load->view('homepage_view','',true)
		// 	);

		//echo json_encode($response);
		


		
		

	}


	//function to set follow tag for a user
	public function setFollow()
	{
		$tag_id=$_SESSION['tag_id'];
		$data=$_SESSION['user_data'];
		$u_id=$data['u_id'];
		$insert_data=array(
			'u_id'=>$u_id,
			'tag_id'=>$tag_id
			);
		$this->load->model("Tag_model");
		$tmodel = new Tag_model;
		$flag=$tmodel->setFollowDB($insert_data);
		if($flag)
		{
			$response=array('result'=>1);
		}
		else
		{
			$response=array('result'=>1);

		}

		echo json_encode($response);

	}


	//function to set unfollow tag for a user
	public function setUnfollow()
	{
		$tag_id=$_SESSION['tag_id'];
		$data=$_SESSION['user_data'];
		$u_id=$data['u_id'];
		$insert_data=array(
			'u_id'=>$u_id,
			'tag_id'=>$tag_id
			);
		$this->load->model("Tag_model");
		$tmodel = new Tag_model;
		$flag=$tmodel->setUnfollowDB($insert_data);
		if($flag)
		{
			$response=array('result'=>1);
		}
		else
		{
			$response=array('result'=>1);

		}

		echo json_encode($response);

	}




}
