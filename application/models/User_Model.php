<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

	protected $user_table = 'user';

	public function insert_user(array $data) {
		$this->db->insert($this->user_table, $data);
		return $this->db->insert_id();
	}


	/**
	 * User Login
	 * ----------------------------------
	 * @param: email address
	 * @param: password
	 */
	public function user_login($email, $password)
	{
		$this->db->where('email', $email);
		$q = $this->db->get($this->user_table);


		if ($q->num_rows()) {
			$hash = $q->row('encrypted_password');

//			password_verify(md5($password), $user_pass)
			if (password_verify($password, $hash)) { //Compare Encrtpted Password
				return $q->row();
			} else {
				return null;
			}

			return null;
		} else {
			return null;
		}

	}

	/**
	 * Update Token
	 * @param: {array} User Data
	 */
	public function update_token($updated_data, $email)
	{
		$this->db->where('email', $email);
		$this->db->update($this->user_table,$updated_data);
	}

	public function is_token_valid($token,$id){
		$this->db->select("token");
		$this->db->from($this->user_table);
		$this->db->where("id",$id);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			if($token!=$row->token){
				return false;
			} else{
				return true;
			};
		}

	}
}
