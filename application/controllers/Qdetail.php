<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qdetail extends CI_Controller {

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


	public function send_notification($data)
	{
		$this->load->helper('email_helper');
		send_mail($data['email_id'],$data['name'],$data['subject'],$data['body']);

	}

	//function to bind with notification model and update notification table
	public function update_notification_table($data)
	{
		$this->load->model('notification_model');
		$n_model=new notification_model;
		$n_model->insert_notification($data);

	}

	public function load_question_id()
	{
		$q_id=$this->input->get('q_id');
		$_SESSION['q_id']=$q_id;
		$result=array('result'=>"updated");
		echo json_encode($result);

	}

	public function load_view()
	{
		
		$this->load->view('question_detail_view');
	}

	public function load_question_detail()
	{
		$q_id=$_SESSION['q_id'];
		$model=$this->getQuestionModel();
		$data=$model->get_q_data($q_id);
		//generate question div html
		$html='<div class="panel panel-primary" id="panel_question">
      		<div class="panel-heading" id="question_title"><h3>'.$data['title'].'</h3><span class="badge">'.$data['user_name'].'</span></div>
      		<div class="panel-body" id="question_body">'.$data['data'].'</div>
    		</div>
			<h3><span class="label label-success" style="float:left;">Answers<span class="badge">'.$data['no_ans'].'</span></span><span class="label label-info" style="float:right;">Posted on<span class="badge">'.$data['created_on'].'</span></span></h3><br><br><h4>TAGS</h4><h4>';
		

		$tag_csv=$data['tag_csv'];
		//$html.=$tag_csv;
		$tag=strtok($tag_csv, ",");
		while ($tag !== false) 
		{
   			$html.='<a onclick="tag_click(this.id);" id="tag_'.$tag.'"><span class="label label-default">'.$tag.'</span></a>&nbsp;';
    		$tag = strtok(",");
		}
		$html.='</h4>';

		echo $html;

		
	}

	public function load_answers()
	{
		$model=$this->getQuestionModel();
		$result=$model->answers_only();
		$usr_data=$_SESSION['user_data'];
		$set=$result['set'];
		$html='';
		for($i=1; $i<=$result['no']; $i++)
		{
			$data=$set[$i];
			if($data['u_id']==$usr_data['u_id'])
			{
				$data['button']='<button data-toggle="modal" data-target="#myeditModal" class="btn btn-success btn-sm" style="float:right;" onclick="edit_answer_model();"><span class="glyphicon glyphicon-pencil"></span>Edit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
				$data['data_id']='id="editable_answer_data"';
			}
			else
			{
				$data['button']='';	
				$data['data_id']='';
			}
			//$html.=$this->load->view('answer_view',$data,true);
			$this->load->view('answer_view',$data);
		}
		//echo $html;
	}




	public function post_answer()
	{
		$a_data=$this->input->post('a_data');
		$user_data=$_SESSION['user_data'];
		$u_id=$user_data['u_id'];
		$q_id=$_SESSION['q_id'];
		$model=$this->getQuestionModel();
		$data=array(
			'a_data'=>$a_data,
			'q_id'=>$q_id,
			'u_id'=>$u_id
			);
		$flag=$model->post_answerDB($data);
		

		//need a procedure to send notification email to the contributors of the question the question

		
		$result=$model->get_contributors($q_id);
		$set=$result['set'];
		$email_data=array(
			'subject'=>'Activity on a Question answered by you',
			'body'=>'There has been a new answer to the question you earlier answered, find out more- www.askandanswer.com'
			);
		for($i=1; $i<=$result['no']; $i++)
		{
			$data=$set[$i];
			$email_data['email_id']=$data['email_id'];
			$email_data['name']=$data['name'];

			//update the notification table
			$n_data=array(
				'u_id'=>$data['u_id'],
				'details'=>"There has been a new answer to the question you earlier answered",
				'q_id'=>$q_id
				);
			$this->update_notification_table($n_data);
			$this->send_notification($email_data);
		}

		$result=$model->get_question_owner($q_id);
		$email_data=array(
			'subject'=>'Activity on a Question answered by you',
			'body'=>'There has been a new answer to the question you earlier asked, find out more- www.askandanswer.com'
			);
		$email_data['email_id']=$result['email_id'];
		$email_data['name']=$result['name'];
		$n_data=array(
				'u_id'=>$result['u_id'],
				'details'=>"There has been a new answer to the question you asked",
				'q_id'=>$q_id
				);
		$this->update_notification_table($n_data);
		$this->send_notification($email_data);



		$response=array('result'=>$flag);
		//procedure to update the notification table for contibutors
		echo json_encode($response);
	}


	//function to update edited answer
	public function post_edited_answer()
	{
		$a_data=$this->input->post('a_data');
		$user_data=$_SESSION['user_data'];
		$u_id=$user_data['u_id'];
		$q_id=$_SESSION['q_id'];
		$model=$this->getQuestionModel();
		$data=array(
			'a_data'=>$a_data,
			'q_id'=>$q_id,
			'u_id'=>$u_id
			);
		$flag=$model->post_edited_answerDB($data);
		$response=array('result'=>$flag);
		echo json_encode($response);
	}


	

}