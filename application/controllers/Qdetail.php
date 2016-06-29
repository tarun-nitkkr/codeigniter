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

}
