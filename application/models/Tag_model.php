<?php

	class Tag_model extends CI_Model
	{
		private $tag_id;
		private $tag_name;
		private $no_of_followers;
		private $tag_description;


		function __construct()
		{
			parent::__construct();
		}

		public function set_tag_id($value)
		{
			$this->tag_id = $value;
		}

		public function set_tag_name($value)
		{
			$this->tag_name = $value;
		}

		public function set_tag_description($value)
		{
			$this->tag_description= $value;
		}

		public function set_tag_followers($value)
		{
			$this->no_of_followers = $value;
		}



		public function get_tag_id()
		{
			return $this->tag_id;
		}

		public function get_tag_name()
		{
			 return $this->tag_name;
		}

		public function get_tag_description()
		{
			return $this->tag_description;
		}

		public function get_tag_followers()
		{
			return $this->no_of_followers;
		}



		public function get_tag_detail($tag_name)
		{
			$start = 0;
			$end = 10;

			$tag_query = "select * from tags where name ='".$tag_name."' LIMIT ".$start.",".$end."";
			//$execute = query($ta);

			$execute= $this->db->query($tag_query);
			//$row = $execute->row();
			$row=$execute->row();
			if($execute->num_rows() > 0){
				$row=$execute->row();
				$tag_id=($row->tag_id);
				$tag_name = ($row->name);
				$tag_description = ($row->description);
				$no_of_followers = ($row->no_of_followers);
				$this->set_tag_id($tag_id);
				$this->set_tag_name($tag_name);
				$this->set_tag_description($tag_description);
				$this->set_tag_followers($no_of_followers);
				return 1;
			}
			else
			{
				return 0;
			}
		}


		public function fol_unfol($uu_id,$tag_id)
		{
			$query="select tag_id from user_tag_relation where tag_id='".$tag_id."' and u_id='".$uu_id."'";
			$execute = $this->db->query($query);
			if($execute->num_rows()>0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}



		//function to set follow tag for a user in db
		public function setFollowDB($data)
		{
			if($this->db->insert('user_tag_relation',$data))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}


		//function to unfollow tag for a user in db
		public function setUnfollowDB($data)
		{
			$query="delete from user_tag_relation where u_id=".$data['u_id']." and tag_id=".$data['tag_id'];

			if($this->db->query($query))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}



		//function to give a set of tags input in the db
		public function get_tags_set()
		{
			$query="select name from tags";
			$execute=$this->db->query($query);
			//$tag_set=[]
			if($execute->num_rows() > 0)
			{
				//echo "hello";
				$tag_set=array();
				$i=0;	
				foreach ($execute->result() as $row) 
				{
					# code...
				
				
				array_push($tag_set, $row->name);

				$i++;

				}
				$result=array(

				'set'=>$tag_set,
				'no'=>$i
				);
				return $result;

			}
			//echo "hello3";
			return 0;

		}
	}