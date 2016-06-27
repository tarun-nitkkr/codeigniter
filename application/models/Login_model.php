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
class Login_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/

	private $user_data=array();

	private $user_login_data=array();
	
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
	public function getData()
	{
		return $this->user_login_data;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setData($value)
	{
		$this->user_login_data = $value;
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
	

	/*
	* Class Methods
	*/

	/**
	*	Commit method, this will comment the entire object to the database
	*/
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
}



	
	

