<?php

	class Notification_model extends CI_Model
	{
		


		function __construct()
		{
			parent::__construct();
		}

		public function retrieve($u_id)
		{
			$query="select * from notification where u_id=".$u_id."  order by n_id DESC LIMIT 5";
			$execute=$this->db->query($query);
	        if($execute->num_rows()>0)
			{

				$set[]=array();
				$i=0;	
				foreach ($execute->result() as $row) 
				{
					# code...
				//$row=$execute->row();
				$data=array(
					'q_id'=>$row->q_id,
					'details'=>$row->details,
					'is_viewed'=> $row->is_viewed,
					'n_id'=>$row->n_id
					);
				array_push($set, $data);

				$i++;

				}
				$result=array(

					'set'=>$set,
					'no'=>$i
					);
				return $result;
			}
			return 0;
		}



		//function to setViewed=1 when notification is visited
		public function setViewed($n_id)
		{
			$query="update notification set is_viewed=1 where n_id=".$n_id;
			if($this->db->query($query))
			{
				return 1;
			}
			return 0;

		}

		public function insert_notification($data)
		{
			if($this->db->insert('notification',$data))
			{
				return 1;
			}
			return 0;

		}
	}