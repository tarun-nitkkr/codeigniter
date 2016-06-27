<?php

	Class Forgot_pass_model extends CI_Model
	{

		private $f_name;
		private $uu_id;

		function __construct()
	{
		parent::__construct();
	}

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



}
	
	