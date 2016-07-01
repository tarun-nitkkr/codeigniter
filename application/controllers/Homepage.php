<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

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


	public function populate_question_recent()
	{
		$input_data=array(
			'type'=> $this->input->get('type'),
			'from'=> $this->input->get('from')
			);


		$model=$this->getQuestionModel();


		if($input_data['type']=='recent')
		{
		$result=$model->get_recent_questions($input_data);

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
		//echo $html_string;
		}

		if($input_data['type']=='followed')
		{
			$user_data=$_SESSION['user_data'];
			$user_id=$user_data['u_id'];
			$result=$model->get_followed_question($input_data, $user_id);
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
			//$_SESSION['question_data']=$question_data
		//echo $html_string;

		}

	}

	
	public function user_interaction_details()
	{
		$model=$this->getQuestionModel();
		$user_data=$_SESSION['user_data'];
		$user_id=$user_data['u_id'];
		$result1=$model->user_interaction_details_db($user_id);
		$result2=$model->user_tag_relation_db($user_id);

		$data=array(
			'no_ans'=> $result1['no_ans'],
			'no_ques'=> $result1['no_ques'],
			'tag_set' => $result2['set'],
			'no_tag'=> $result2['no'],
			'tag_csv'=> $result2['csv']
			);
		$tag_csv=$data['tag_csv'];
		$tag=strtok($tag_csv, ",");
		$html='<h4>';
		while($tag !== false) 
		{
   			$html.='<a onclick="tag_click(this.id);" id="tag_'.$tag.'"><span class="label label-default">'.$tag.'</span></a>&nbsp;';
    		$tag = strtok(",");
		}
		$html.='</h4>';
		$data['html']=$html;

		echo json_encode($data);


	}

	public function temp()
	{

		$this->load->view('question_detail_view');
	}

	public function load_tag_name()
	{
		
		$tag_name=$this->input->get('tag_name');
		$_SESSION['tag_name']=$tag_name;
		$result=array('result'=>"updated");
		echo json_encode($result);
	}

	public function load_tag_view()
	{
		$this->load->view("tag_detail_view");
	}



	//to retrieve notifications
	public function retrieve_notification()
	{
			$this->load->model("notification_model");
			$model=new notification_model;
			$user_data=$_SESSION['user_data'];
			$u_id=$user_data['u_id'];
			$result=$model->retrieve($u_id);
			$set=$result['set'];
			//$html_string='';
			for($i=1; $i<=$result['no']; $i++)
			{
			$data=$set[$i];
			$this->load->view('notification_view',$data);
			}


	}

	//to set notification viewed status=1
	public function setViewed_Notification()
	{
		$n_id=$this->input->get('n_id');

		$this->load->model("notification_model");
		$model=new notification_model;
		$flag=$model->setViewed($n_id);

		$response=array('result'=>$flag);

		echo json_encode($response);

	}

}
