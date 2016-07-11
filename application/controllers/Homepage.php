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


		if($input_data['type'] =='recent')
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

	
	public function user_interaction_details($u_id=0)
	{
		if($u_id==0)
		{
			$user_data=$_SESSION['user_data'];
			$user_id=$user_data['u_id'];
		}

		else
		{
			$user_id=$u_id;
		}
		$model=$this->getQuestionModel();
		
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
   			//$html.='<a href="#" onclick="tag_click(this.id);" id="tag_'.$tag.'"><span class="label label-default">'.$tag.'</span></a>&nbsp';
   			$html.='<button onclick="tag_click(this.id);" id="tag_'.$tag.'">'.$tag.'</button>&nbsp';
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

	//to populate the questions asked by user
	public function populate_asked_questions()
	{
		
		$user_data=$_SESSION['user_data'];
		$u_id=$user_data['u_id'];
		$from=$this->input->get('from');
		$model=$this->getQuestionModel();
		$result=$model->get_questions_ansked($u_id,$from);
		$set=$result['set'];
		//$html_string='';
		for($i=1; $i<=$result['no']; $i++)
		{
			$data=$set[$i];
			$this->load->view('Question_view',$data);
		}

	}

	//to populate the questions answered by user
	public function populate_answered_questions()
	{
		$user_data=$_SESSION['user_data'];
		$u_id=$user_data['u_id'];
		$from=$this->input->get('from');
		$model=$this->getQuestionModel();
		$result=$model->get_questions_answered($u_id,$from);
		$set=$result['set'];
		//$html_string='';
		for($i=1; $i<=$result['no']; $i++)
		{
			$data=$set[$i];
			$this->load->view('Question_view',$data);
		}

	}

	public function load_user_specific_question_view($arg)
	{
		if($arg=='asked')
		{
			$data=array('type'=>'ASKED QUESTIONS:');
		}
		else
		{
			$data=array('type'=>'ANSWERED QUESTIONS:');

		}
		
		$this->load->view('user_specific_question_view', $data);

	}



	//function to load specific user profile view
	public function load_user_profile_view($arg)
	{
		//call function to get the user data for the cuurent user_name
		$this->load->model('user_model');
		$model= new user_model;
		$user_data=$model->get_user_data($arg);

		$this->load->view('user_profile_view', $user_data);
	}

	//function to populate user_specific asked questions for profile page
	public function populate_asked_questions_with_u_id()
	{
		//$user_data=$_SESSION['user_data'];
		$u_id=$this->input->get('u_id');
		$from=$this->input->get('from');
		$model=$this->getQuestionModel();
		$result=$model->get_questions_ansked($u_id,$from);
		$set=$result['set'];
		//$html_string='';
		for($i=1; $i<=$result['no']; $i++)
		{
			$data=$set[$i];
			$this->load->view('Question_view',$data);
		}

	}


	//return the array wth the tags
	public function return_tag_array()
	{
		$this->load->model("tag_model");
		$model=new tag_model;
		$result= $model->get_tags_set();
		echo json_encode($result);
	}
	

	//to post question
	public function post_question()
	{
		$title=$this->input->post('title');
		$data=$this->input->post('data');
		$tag_csv=$this->input->post('tags');
		//echo $tag_csv;
		$model=$this->getQuestionModel();

		$user_data=$_SESSION['user_data'];
		$question_data=array(
			'q_data'=>$data,
			'q_title' => $title,
			'q_id' => $user_data['u_id'],
			'tag_name'=> $tag_csv
			);
		//echo $question_data['tag_name'];
		$result=$model->post_questionDB($question_data);
		$response=array('result' => $result);

		echo json_encode($response);

		
		

	}


	
	

	//function to get all tags for first login page
	public function get_all_tags()
	{
		$this->load->model('tag_model');
		$model= new tag_model;
		$result=$model->get_tags_set();
		$set=$result['set'];
			//$html_string='';
		$html="<h3>";
		for($i=0; $i<$result['no']; $i++)
		{
			$tag_name=$set[$i];
			$html.='<button class="btn-primary" onclick="tag_click(this.id);" id="tag_'.$tag_name.'">'.$tag_name.'</button>&nbsp&nbsp';
			if($i%10==0 && $i>0)
			{
				$html.="<br><br>";
			}
			
		}
		$html.="</h3>";
		echo $html;


	}



	//function to update the followed tags and isfirst=0 in user profile for the first login
	public function update_followed_tags_and_isfirst()
	{
		$tags=$this->input->get('tags');
		$user_data=$_SESSION['user_data'];
		$u_id=$user_data['u_id'];
		$data=array(
			'tags'=>$tags,
			'u_id'=> $u_id
			);
		$model=$this->getQuestionModel();
		$result=$model->update_user_tagDB($data);

		$this->load->model("user_model");
		$user_model=new user_model;
		$result2=$user_model->update_isfirst($u_id);
		$response=array('result'=>$result && $result2);
		echo json_encode($response);
	}


	//for solr search
	public function solr_search()
	{
		// $term = $this->input->post('srch-term');
		//  $this->load->model('Search_model');
		// $smodel = new Search_model;

		/* its example here you need to get it by POST the '$term'  __F*/
		// $term = "in lobortis tellus justo sit amet nulla";
		$term=$this->input->get('term');

		$stopwords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly' ,'make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero','.');
		
		
		$clean_terms = preg_replace('/\b('.implode('|',$stopwords).')\b/',' ',$term);

		$words = explode(" ",$clean_terms);

		$flag = 0;

		$word_query = "";

		foreach($words as $word)
		{
			
			if($word!='')
			{
				if($flag == 0)
				{
					$word_query = $word;
					$flag = 1;   
				}
				else
				{
					
					$word_query =$word_query."+OR+".$word;
				}
			}
		}

	

		$query_url = "http://localhost:8983/solr/collection1/select?q=q_title%3A('".$word_query."')&fl=*%2Cscore&wt=json&indent=true"; 

		 $get_url = file_get_contents($query_url);

		 $get_url_val = json_decode($get_url,true);

		 $question_array = $get_url_val['response']['docs'];

		 $len = sizeof($question_array);
	
		 if($len>0)
		 {
			 $set[]=array('q_id'=>$question_array['0']['id'],
			 		'u_id'=>$question_array['0']['u_id'],
			 		'q_data'=>$question_array['0']['q_data'],
			 		'no_of_answer'=>$question_array['0']['no_of_answer'],
			 		'q_title'=>$question_array['0']['q_title'],
			 		'no_of_likes'=>$question_array['0']['no_of_likes'],
			 		'score'=>$question_array['0']['score']);
			 $i=1;

			 while($i<$len)
			 {

			 	$question_detail = array('q_id'=>$question_array[$i]['id'],
			 		'u_id'=>$question_array[$i]['u_id'],
			 		'q_data'=>$question_array[$i]['q_data'],
			 		'no_of_answer'=>$question_array[$i]['no_of_answer'],
			 		'q_title'=>$question_array[$i]['q_title'],
			 		'no_of_likes'=>$question_array[$i]['no_of_likes'],
			 		'score'=>$question_array[$i]['score']
			 		);

			 	array_push($set,$question_detail);
			 	$i++;
			 }

			 $result=array(

					'set'=>$set,
					'no'=>$i
					);

			$set=$result['set'];
			
			for($i=0; $i<$result['no']; $i++)
			{
			$data=$set[$i];
			$this->load->view('Question_view',$data);
			}


		}

	}



}
