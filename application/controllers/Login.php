<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->model('user_model');
		$this->model= new user_model;

	}


	public function getUserModel()
	{
		return $this->model;
	}



	public function index()
	{
		
		//$this->initialize_model();
		$this->load->helper('cookie');
		$this->load->library('encryption');
		//$key = $this->encryption->create_key(32);
		//var_dump($key);

		//delete_cookie('askandanswer_user_cookie');
		$key='0pR35l5Dp9t8F3y92K470nP4kmyoc4uy';

		$this->encryption->initialize(array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $key
        )
		);
		$user_cookie=$this->input->cookie('askandanswer_user_cookie', true);
		//var_dump($user_cookie);
		$cookie_value=$this->encryption->decrypt($user_cookie);
		//var_dump($cookie_value);
		$user_name= strstr($cookie_value, '+',true);
		$cookie_id= str_replace($user_name.'+', "", $cookie_value);
		$data=array(
			'user_name' => $user_name,
			'cookie_id' => $cookie_id
			);
		//var_dump($data);
		

		//var_dump($data);
		$model= $this->getUserModel();

		if($model->check_cookie($data))
		{
			if($model->direct_login($user_name))
			{
				$data=$model->getUserData();
				$_SESSION['user_data']=$data;
				//echo "direct login";
				$this->load->view('homepage_view');	
			}
			
		}
		else
		{
		$this->load->view('login_view_css');
		}
		//var_dump($user_cookie);


		//$this->load->helper(array('form', 'url')); 
	}


	public function login_call($data=0){
		

		$this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

		if(!$data)
		{
			$data = array(
				'user_name' => $this->input->post('userid'),
				'password' => $this->input->post('pass'),
				'query_type' => ''
			);
			if(strstr($data['user_name'],'@'))
			{
				$data['query_type']='emailid';
				$this->form_validation->set_rules('userid', 'Email', 'trim|required|valid_email');
			}
			else{
				$data['query_type']='user_name';
				$this->form_validation->set_rules('userid', 'Username', 'trim|required');
			}
		}
		
        
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]');
		if($this->form_validation->run()==FALSE)
		{
			echo json_encode(array('result' => validation_errors()));
			//echo ''.validation_errors();
			return;	
		}
		
			



		$this->load->library('encryption');
		//$key = $this->encryption->create_key(32);
		//var_dump($key);
		$key='0pR35l5Dp9t8F3y92K470nP4kmyoc4uy';

		$this->encryption->initialize(array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $key
        )
		);




		
		

		//var_dump($data);
		$model= $this->getUserModel();
		$model->setData($data);
		//var_dump($model->getData());

		$flag=$model->check();
		if($flag)
		{
			$user_data=$model->getUserData();
			if($user_data['isactivated'])
				{
					$_SESSION['user_data']=$user_data;
					// $_SESSION['user_id']=$user_data['u_id'];
					// $_SESSION['profile_url']=$user_data['pic_url'];
					$cookie_id=$model->set_cookie($user_data['user_name']);
					if(!$cookie_id)
					{
						echo "Error setting cookie";
					}

					$string=$user_data['user_name']."+".$cookie_id;

					$cookie_value=$this->encryption->encrypt($string);
					//var_dump($cookie_value);
					$cookie = array(
   					'name'   => 'askandanswer_user_cookie',
      				'value'  => $cookie_value,
       				'expire' => '200',
    				'domain' => '.askandanswer.com',
    				'path'   => '/'
    				);
					$this->input->set_cookie($cookie);
					
					//$array=array('result'=> $user_data['user_name']);
					//echo json_encode($array);
					//sleep(2);
					//$string=$this->load->view("register_view");
					$array=array('result'=> '1');
					echo json_encode($array);
				}

			else
			{
				$array=array('result'=> "<p>kindly activate your account first!</p>");
				echo json_encode($array);
			}
		}
		else
		{
			$array=array('result'=> "<p>Username/password didn't matched/found!</p>");
			echo json_encode($array);
		}

		

	}

	public function signup_view()
	{
		// $error='hello';
		$this->load->view('register_view');
	}

	public function validate()
	{
		$data=array(
			'code'=> $this->input->get('code'),
			'emailid'=> $this->input->get('email_id')
			
			);
		//

		$model= $this->getUserModel();

		$flag=$model->activate($data);

		if($flag)
		{
			echo "your account is successfully updated.";
			sleep(2);
			$this->load->view('login_view');

		}
		else
		{
			echo "there has been a error in validating your account";
		}


	}

	public function send_mail($emailid, $name ,$title, $message)
	{
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'discusswebservice@gmail.com',
		    'smtp_pass' => 'thisisubuntu',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

	    $config['newline'] = "\r\n";

		$this->load->library('email', $config);
		$this->email->from('discusswebservice@gmail.com');
        $this->email->to($emailid , $name);

        $this->email->subject($title);
        $this->email->message($message);  

        $this->email->send();

        echo $this->email->print_debugger();
	}




	public function register()
	{

		$input_data = array(
		'userid' => $this->input->post('userid'),
		'pass' => $this->input->post('pass'),
		'emailid'=> $this->input->post('emailid'),
		'f_name'=>$this->input->post('f_name'),
		'l_name' => $this->input->post('l_name'),
		'about_me' => $this->input->post('about_me'),
		
			);
		//var_dump($input_data);

		 //

		$model= $this->getUserModel();
		$model->setUserData($input_data);
		$flag=$model->write();

		$file_name=$model->getProfileUrl();
		if($flag)
		{
			//send validation mail
			$url=$model->getActivationUrl();
			$message="Kindly validate your Email-ID by clicking on this link->".$url;
			$title="ASKandANSWER-Email Verification";
			$this->send_mail($input_data['emailid'], $input_data['f_name'], $title, $message);

			echo "Verification Email sent.";



         $config['upload_path']   = './uploads'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 4000; 
         $config['max_width']     = 1920; 
         $config['max_height']    = 1080; 
         $config['file_name'] =  $file_name;
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload("profile")) {
            $error = array('error' => $this->upload->display_errors()); 
            echo "ERROR Encountered!";
            
         }
			
         else { 
            $data = array('upload_data' => $this->upload->data()); 
            var_dump($data);
            echo "Profile Successfully registered!";


           } 
  	       
         
		}
	}





	//function to check username duplicacy in the DB
	public function check_username()
	{
		
		$model=$this->getUserModel();
		$data = array(
				'data' => $this->input->get('data'),
				'type' => $this->input->get('type')
				
			);

		$flag=$model->check_field_duplicacy($data);
		//var_dump($flag);
		if(!$flag)
		{
			//var_dump("inside the flag controller");
			$array=array('result'=>"This ".$data['type']." is already registered!");
					echo json_encode($array);	
		}
		else 
		{
			$array=array('result'=>"0");
					echo json_encode($array);	
		}
		



	}


	//My code Farheen

	public function reset_password()
	{
		$data=array(
			'code'=> $this->input->get('code'),
			'emailid'=> $this->input->get('email_id')
			
			);
		//$this->load->model('Forgot_pass_model');


		$model= $this->getUserModel();

		$flag=$model->verify_hash($data);

		if($flag)
		{
			$this->load->view('Reset_Password_View',$data);
		}
		else
		{
			echo "there has been a error in validating your account";
		}


	}

	
	public function forget_password_load_view()
	{
		// $error='hello';
		$this->load->view('forgot_pass_view');
	}

	public function forgot_password()
	{
		$input_data = $this->input->post('emailid');

		//$this->load->model('Forgot_pass_model');

		$model= $this->getUserModel();
		//$model->setUserData($input_data);

		if($model->email_exists($input_data))
		{

			//NOW SEND THE EMAIL TO REGISTERED EMAIL ID
			//$model->generate_activation_url($input_data);
			$url=$model->generate_activation_url_pass_reset($input_data);
			$f_name = $model->getFirstName();
			$message="Kindly reset your ASKandANSWER password by clicking on this link->".$url;
			$title="ASKandANSWER- Reset Password";
			$this->send_mail($input_data, $f_name, $title, $message);

			echo "Reset Password Email sent.";
			
				echo "Click the link sent to you in your registered email id to reset the Password.!!\n";
				//sleep(5);
				//$this->load->view('login_view');
		}

	}



	public function enter_new_pass()
	{
		//$this->load->model('Forgot_pass_model');
		$model= $this->getUserModel();
		//$user_id = $model->getUserId();
		$newpassword = $this->input->post('pass');
		echo "Here is new  password set\n";
		$email_id = $this->input->post('email_id');
		echo $email_id;
		echo "Password=";
		echo $newpassword;
		//echo "$uu_id"+"\n";
		$flag = $model->set_new_password($newpassword,$email_id);
		if($flag)
			echo "Password Reset Successfully!!";
		else
			echo "Password reset Failed!!";

	}
	


	// public function tag()
	// {
	// 	$tag_name = $this->input->post("tag_name");
	// 	$this->load->model("Tag_model");
	// 	$model = new Tag_model;
	// 	$tag_data = Tag_model->get_tag_detail($tag_name);

	// 	//getting tag details

	// 	$tag_id = $model->get_tag_id();
	// 	$tag_description = $model->get_tag_description();
	// 	$tag_followers = $model->get_tag_followers();
	// 	$this->load->model("Question_model");
	// 	$model= new Question_model;
	// 	$list_questions = $model->get_list_of_questions();
	// 	$tag_data = array('tag_name'=>$tag_name,
	// 		'tag_id'=>$tag_id,
	// 		'tag_description'=>$tag_description,
	// 		'tag_followers'=>$tag_followers,
	// 		'list_questions'=>$list_questions);

	// 	$this->load->view("Tag_view",$tag_data);


	// }
	



	//for loading homepage view
	public function homepage()
	{
		$this->index();
		//$this->load->view('homepage_view');
	}

	//to logout the user
	public function logout()
	{
		$cookie = array(
   					'name'   => 'askandanswer_user_cookie',
      				'value'  => '',
       				'expire' => '10',
    				'domain' => '.askandanswer.com',
    				'path'   => '/'
    				);
		$this->input->set_cookie($cookie);

		session_unset();
		session_destroy();
		$this->load->view('login_view_css');
	}


}
