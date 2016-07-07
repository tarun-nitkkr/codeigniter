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
class User_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/

	private $input_data;
	private $profile_url;
	private $activation_url;
	private $user_data;
	private $f_name;
	private $uu_id;
	//private $user_login_data=array();
	

	//private $user_login_data=array();
	
	function __construct()
	{
		parent::__construct();
		

	}

	/*
	* SET's & GET's
	* Set's and get's allow you to retrieve or set a private variable on an object
	*/


	/**
		ID
	**/

	/**
	* @return int [$this->_id] Return this objects ID
	*/
	// public function getData()
	// {
	// 	return $this->user_login_data;
	// }

	// *
	// * @param int Integer to set this objects ID to
	
	// public function setData($value)
	// {
	// 	$this->user_login_data = $value;
	// }


	public function getFirstName()
	{
		return $this->f_name;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setFirstName($value)
	{
		$this->f_name = $value;
	}
	
	public function setUserId($value)
	{
		$this->uu_id = $value;
	}

	public function getUserId()
	{
		return $this->uu_id;
	}











	public function getUserData()
	{
		return $this->user_data;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setUserData($value)
	{
		$this->user_data = $value;
	}
	

	public function getData()
	{
		return $this->input_data;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setData($value)
	{
		$this->input_data = $value;
	}

	public function getActivationUrl()
	{
		return $this->activation_url;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setActivationUrl($value)
	{
		$this->activation_url = $value;
	}


	public function getProfileUrl()
	{
		return $this->profile_url;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setProfileUrl($value)
	{
		$this->profile_url = $value;
	}
	/*
	* Class Methods
	*/

	/**
	*	Commit method, this will comment the entire object to the database
	*/


	//check field duplicacy
	public function check_field_duplicacy($data)
	{
		if($data['type']=='emailid')
		{
			//var_dump("Reached in model email root");
			//var_dump($data['data']);
			$query ="select * from user_profile where email_id='".$data['data']."'";
		}
		if($data['type']=='username')
		{
			$query ="select * from user_profile where user_name='".$data['data']."'";
		}


		$execute=$this->db->query($query);
		//var_dump($execute->num_rows());
		if($execute->num_rows() > 0)
		{
			// $query2="select * from user_profile where user_name='".$data['user_name']."'";
			// $execute2=$this->db->query($query2);
			// $row=$execute2->row();
			// $user_data
			return 0;
		}
		return 1;
	}



	
	public function check_cookie($data)
	{
		$query="select * from cookie_detail where user_name='".$data['user_name']."' and cookie_id='".$data['cookie_id']."'";
		$execute=$this->db->query($query);
		if($execute->num_rows() > 0)
		{
			// $query2="select * from user_profile where user_name='".$data['user_name']."'";
			// $execute2=$this->db->query($query2);
			// $row=$execute2->row();
			// $user_data
			return 1;
		}
		return 0;
	}



	public function set_cookie($user)
	{
		# code...
		$length = 20;

		$randomString = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

		$cookie_id=md5($randomString);
		$datetime=date('Y-m-d H:i:s');
		$data=array(
			'user_name' => $user,
			'cookie_id' => $cookie_id,
			'set_time' => $datetime
			);

		$query="select * from cookie_detail where user_name='".$user."'";
		$execute=$this->db->query($query);
		if($execute->num_rows() > 0)
		{
			$query2="update cookie_detail set cookie_id='".$data['cookie_id']."', set_time='".$data['set_time']."' where user_name='".$data['user_name']."'";
			if($this->db->query($query2))
			{
				return $cookie_id;
			}
			return 0;
		}
		else
		{

		if($this->db->insert('cookie_detail',$data))
		{
			return $cookie_id;
		}
		return 0;

		}
		
	}



	public function direct_login($user)
	{

		$query="select * from user_profile where user_name='".$user."'";
		$execute=$this->db->query($query);
		if($execute->num_rows() > 0)
		{
			$row=$execute->row();
			
			
			$temp_data=array(
				'u_id'=> $row->u_id,
				'first_name'=> $row->first_name,
				'last_name'=> $row->last_name,
				'about'=> $row->about,
				'pic_url'=>$row->profile_pic_url,
				'user_name'=> $row->user_name,
				'email_id'=> $row->email_id,
				'registration_date'=> $row->registration_date,
				'isactivated'=> $row->isActivated,

				);

			$this->setUserData($temp_data);

			return 1;
		}
		else
		{
			return 0;
		}
		

	}




public function check()
	{
		//var_dump($this->getData());
		$user_info=array();
		$data=$this->getData();
		$query="";
		$pass=md5($data['password']);
		if($data['query_type']=='user_name')
		{

		$query="select * from user_profile where user_name='".$data['user_name']."' and pass_hash='".$pass."'";
		}
		else
		{
			$query="select * from user_profile where email_id='".$data['user_name']."' and pass_hash='".$pass."'";
		}
		$execute = $this->db->query($query);
		if($execute->num_rows() > 0)
		{
			$row=$execute->row();
			
			
			$temp_data=array(
				'u_id'=> $row->u_id,
				'first_name'=> $row->first_name,
				'last_name'=> $row->last_name,
				'about'=> $row->about,
				'pic_url'=>$row->profile_pic_url,
				'user_name'=> $row->user_name,
				'email_id'=> $row->email_id,
				'registration_date'=> $row->registration_date,
				'isactivated'=> $row->isActivated,

				);

			$this->setUserData($temp_data);
			return 1;

		}
		else
		{
			return 0;
		}
		
	}




	public function write()
	{
		//var_dump($this->getData());
		//$user_info=array();
		$user_data=$this->getUserData();

		var_dump($user_data);
		// $query="select * from user_profile order by u_id DESC  LIMIT 1";
		// $u_id=0;

		// $execute= $this->db->query($query);
		// if($execute->num_rows() > 0){
		// 	$row=$execute->row();
		// 	$u_id=($row->u_id)+1;

		// }
		// else
		// {
		// 	$u_id=1;
		// }

		
		$pass= md5($user_data['pass']);
		$date = date('Y-m-d H:i:s');
		

		//$this->profile_url='profile_'.$u_id;

		$user_profile_data=array(
			'user_name' => $user_data['userid'],
			'email_id' => $user_data['emailid'],
			'about'=> $user_data['about_me'],
			'first_name'=> $user_data['f_name'],
			'last_name'=> $user_data['l_name'],
			'profile_pic_url'=> 'default',
			'registration_date'=> $date,
			'pass_hash' => $pass
			);

		if($this->db->insert('user_profile', $user_profile_data))
		{
			$query="select * from user_profile where user_name='".$user_data['userid']."'";
			$execute= $this->db->query($query);
			$row=$execute->row();
			$this->profile_url='profile_'.$row->u_id;
			$user_profile_data['profile_pic_url']=$this->profile_url;
			$query2="update user_profile set profile_pic_url='".$this->profile_url."' where user_name='".$user_profile_data['user_name']."'";
			$this->db->query($query2);


			//insert blank row in user interaction table
			$insert_data=array('u_id'=> $row->u_id);
			$this->db->insert('user_interaction_table', $insert_data);



			
			$this->setUserData($user_profile_data);

			$url=$this->generate_activation_url();
			if($url){
			$this->setActivationUrl($url);
			}
			else
			{
				return 0;
			}
			return 1;
		}
		else
		{
			return 0;
		}

		
	}



	public function generate_activation_url()
	{
		
		$data=$this->getUserData();
		
		$string="hello123"."validation".$data['email_id'];
		

		$code= md5($string);
		$url="http://www.askandanswer.com/index.php/login/validate?"."code=".$code."&email_id=".$data['email_id'];
		$update_query="update user_profile set verification_hash='".$code."' where email_id='".$data['email_id']."'";

		if($this->db->query($update_query))
		{
			return $url;
		}
		else
		{
			echo "activation_url generation error!";
			return 0;
		}
	}


	public function activate($data)
	{
		$query="select * from user_profile where email_id='".$data['emailid']."' and verification_hash='".$data['code']."'";
		$update="update user_profile set isActivated=1 where email_id='".$data['emailid']."'";
		$execute= $this->db->query($query);
		if($execute->num_rows() > 0)
		{
			if($this->db->query($update))
			{
				return 1;
			}
			else
			{
				echo "updation Error!";
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}




	public function generate_activation_url_pass_reset($input_data)
	{
		$string = "HeLlO!@#"."validation".$input_data;
		$code = md5($string);
		$url = "http://www.askandanswer.com/index.php/login/reset_password?"."code=".$code."&email_id=".$input_data;
		$fname_query = "select first_name from user_profile where email_id ='".$input_data."'";
		

		$update_query = "update user_profile set verification_hash='".$code."' where email_id='".$input_data."'";

		
		$execute= $this->db->query($fname_query);
		if($execute->num_rows() > 0){
			$row=$execute->row();
			$value=($row->first_name);
			$this->setFirstName($value);
		}
		else
		{
			echo " Error in reading First Name.\n";
		}



		if($this->db->query($update_query))
		{
			return $url;
		}
		else
		{
			echo "acttivation_url generation Failed!.\n";
			return 0;
		}
	}



	public function email_exists($input_data)
	{
		$query = $this->db->query("SELECT email_id FROM user_profile WHERE email_id='".$input_data."'");    
    	if($row = $query->row()){
       	 return TRUE;
   		 }else{
        	return FALSE;
    }
	}


	public function verify_hash($data)
	{
		$query="select u_id from user_profile where email_id='".$data['emailid']."' and verification_hash='".$data['code']."'";
		
		$execute= $this->db->query($query);
		if($execute->num_rows() > 0)
		{
			$row=$execute->row();
			$value=($row->u_id);

			$this->setUserId($value);
			return $value;
			//return 1;

		}
		else
		{
			return 0;
		}
	}


	public function set_new_password($newpassword,$email_id)
	{
		$pass_hash = md5($newpassword);
		$update_query = "update user_profile set pass_hash='".$pass_hash."' where email_id =
		'".$email_id."'";
		
		if($this->db->query($update_query)){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	//code for getting user name for question detail page __F

	public function getUsernameForQuestionPage($u_id)
	{
		//echo "username="+$u_id;
		$query = "select user_name from user_profile where u_id=".$u_id;
		$execute = $this->db->query($query);

		if($execute->num_rows()>0)
		{
			$row=$execute->row();
			return $row->user_name;
		}
		else{
			echo "Error in reading username\n";
			return 0;
		}
	}



	//function to get user data based on user_name
	public function get_user_data($user_name)
	{
		$query="select * from user_profile where user_name='".$user_name."'";
		$execute= $this->db->query($query);
		if($execute->num_rows() > 0)
		{
			$row=$execute->row();
			$user_data=array(
				'u_id'=> $row->u_id,
				'first_name'=> $row->first_name,
				'last_name'=> $row->last_name,
				'about'=> $row->about,
				'pic_url'=>$row->profile_pic_url,
				'user_name'=> $row->user_name,
				'email_id'=> $row->email_id,
				'registration_date'=> $row->registration_date,
				'isactivated'=> $row->isActivated,

			);
			return $user_data;

		}

		return 0;
		

		
	}
	
}

