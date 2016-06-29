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

			$tag_query = "select * from tags where name ='".$tag_name."'";
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
	}