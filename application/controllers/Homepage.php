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
		$html_string='';
		for($i=1; $i<=$result['no']; $i++)
		{
			$data=$set[$i];
			$row='	<tr id="row_'.$data['q_id'].'"><a onclick="alpha(this.id);" class="question_row" id="question_row_'.$data['q_id'].'">
    				<div class="panel panel-default" id="panel_'.$data['q_id'].'">
  					<div class="panel-heading" id="row_header_'.$data['q_id'].'"><h3>'.$data['title'].'</h3></div>
  					<div class="panel-body" id="row_body_'.$data['q_id'].'">No of Answer:'.$data['no_ans'].'    Likes:'.$data['no_like'].'  Created On:'.$data['created_on'].'</div>
  					<div class="panel-footer" id="row_footer_'.$data['q_id'].'">'.$data['tag_csv'].'</div>
					</div>	
					</a>				
  					</tr>';
  			$html_string.=$row;
		}
		// $response=array(
		// 		'result'=>$html_string
		// 	//'result'=> $this->load->view('homepage_view','',true)
		// 	);

		//echo json_encode($response);
		echo $html_string;
		}

		if($input_data['type']=='followed')
		{
			$user_data=$_SESSION['user_data'];
			$user_id=$user_data['u_id'];
			$result=$model->get_followed_question($input_data, $user_id);
			$set=$result['set'];
			$html_string='';
			for($i=1; $i<=$result['no']; $i++)
			{
			$data=$set[$i];
			$row='	<tr id="row_'.$data['q_id'].'"><a onclick="alpha(this.id);" class="question_row" id="question_row_'.$data['q_id'].'">
    				<div class="panel panel-default" id="panel_'.$data['q_id'].'">
  					<div class="panel-heading" id="row_header_'.$data['q_id'].'"><h3>'.$data['title'].'</h3></div>
  					<div class="panel-body" id="row_body_'.$data['q_id'].'">No of Answer:'.$data['no_ans'].'    Likes:'.$data['no_like'].'  Created On:'.$data['created_on'].'</div>
  					<div class="panel-footer" id="row_footer_'.$data['q_id'].'">'.$data['tag_csv'].'</div>
					</div>
					</a>
  					</tr>';
  			$html_string.=$row;
			}
		// $response=array(
		// 		'result'=>$html_string
		// 	//'result'=> $this->load->view('homepage_view','',true)
		// 	);

		//echo json_encode($response);
		echo $html_string;

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

		echo json_encode($data);


	}


}
