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
class Register_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/

	private $data;
	private $profile_url;
	private $activation_url;
	

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

	public function getUserData()
	{
		return $this->data;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setUserData($value)
	{
		$this->data = $value;
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
	public function write()
	{
		//var_dump($this->getData());
		//$user_info=array();
		$user_data=$this->getUserData();

		var_dump($user_data);
		$query="select * from user_profile order by u_id DESC  LIMIT 1";
		$u_id=0;

		$execute= $this->db->query($query);
		if($execute->num_rows() > 0){
			$row=$execute->row();
			$u_id=($row->u_id)+1;

		}
		else
		{
			$u_id=1;
		}

		
		$pass= md5($user_data['pass']);
		$date = date('Y-m-d H:i:s');
		

		$this->profile_url='profile_'.$u_id;

		$user_profile_data=array(
			'user_name' => $user_data['userid'],
			'email_id' => $user_data['emailid'],
			'about'=> $user_data['about_me'],
			'first_name'=> $user_data['f_name'],
			'last_name'=> $user_data['l_name'],
			'profile_pic_url'=> $this->profile_url,
			'registration_date'=> $date,
			'pass_hash' => $pass
			);

		if($this->db->insert('user_profile', $user_profile_data))
		{
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
}
