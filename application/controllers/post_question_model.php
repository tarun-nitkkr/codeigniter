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


	public function insert_question_data($question_data)
	{
		$user_data = $_SESSION['user_data'];
		$u_id = $user_data['u_id'];
		$query = "insert into question(u_id,q_data,q_title,) values('".$u_id."','".$question_data->q_data."','".$question_data->q_title."')";
		$execute = $this->db->query($query);
		
	}