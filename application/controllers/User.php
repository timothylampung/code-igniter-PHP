<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: Timothy Lampung
 * Date: 31/8/2018
 * Time: 6:36 AM
 */

class User extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		// Load User Model
		$this->load->model('User_model','UserModel');
		$this->load->model('Listing_model','ListingModel');
	}

	function login()
	{
		$data['title'] = 'Interview';
		$this->load->view("credential/login", $data);
	}

	function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run())
		{
			//true
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			//model function

			$output = $this->UserModel->user_login($email , $password);

			if(!empty($output))
			{
				$session_data = array(
					'email'     =>     $email
				);
				$this->session->set_userdata($session_data);
				redirect(base_url() . 'user/listing');
			}
			else
			{
				$this->session->set_flashdata('error', 'Invalid Username and Password');
				redirect(base_url() . 'user/login');
			}
		}
		else
		{
			//false
			$this->login();
		}
	}

	function logout()
	{
		$this->session->unset_userdata('email');
		redirect(base_url() . 'user/login');
	}


	function listing(){
		if($this->session->userdata('email') != '')
		{
			$data['list'] = $this->ListingModel->get_listing();
			$this->load->view("listing/list", $data);
		}
		else
		{
			redirect(base_url() . 'user/login');
		}
	}
	function delete_list() {
		$id = $this->uri->segment(3);
		$this->ListingModel->delete_list($id);
		redirect(base_url() . 'user/listing');

	}
}
