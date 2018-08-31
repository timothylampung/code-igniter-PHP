<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Listing_model extends CI_Model
{

	protected $listing_table = 'listing';
	protected $user_table = 'user';

	/**
	 * Get List By UserId
	 * ----------------------------------
	 */
	public function get_listing($uid)
	{
		if ($uid==null OR $uid==0) {
			$id = $this->get_userid(); //Get By Session
		}	else{
			$id= $uid; //Get By Json
		}

		$this->db->select("id,list_name,distance,user_id");
		$this->db->from($this->listing_table);
		$this->db->where("user_id",$id);
		$query = $this->db->get();
		return $query->result();
	}



	public function delete_list($id){
		$this->db->where('id', $id);
		$this->db->delete($this->listing_table);
	}


	public function get_userid(){
		$this->db->select("id");
		$this->db->from($this->user_table);
		$this->db->where("email",$this->session->userdata('email'));
		$query = $this->db->get();

		foreach ($query->result() as $row)
		{
			return $row->id;
		}

	}


}
