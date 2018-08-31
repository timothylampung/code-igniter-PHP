
<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';

class Users extends \Restserver\Libraries\REST_Controller
{
	public function __construct() {
		parent::__construct();
		// Load User Model
		$this->load->model('User_model','UserModel');
		$this->load->model('Listing_model','ListingModel');

	}
	/**
	 * User Register
	 * --------------------------
	 * @param: email
	 * @param: password
	 * --------------------------
	 * @method : POST
	 * @link : api/user/register
	 */
	public function register_post()
	{
		header("Access-Control-Allow-Origin: *");
		# XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)
		$_POST = $this->security->xss_clean($_POST);



			$insert_data = [
				'email' => $this->input->post('email'),
				'encrypted_password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'type' => $this->input->post('type'),
			];
			// Insert User in Database
			$output = $this->UserModel->insert_user($insert_data);
			if ($output > 0 AND !empty($output))
			{
				// Success 200 Code Send
				$message = [
					'status' => true,
					'message' => "User registration successful"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else
			{
				// Error
				$message = [
					'status' => FALSE,
					'message' => "Not Register Your Account."
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
			}

	}
	/**
	 * User Login API
	 * --------------------
	 * @param: email
	 * @param: password
	 * --------------------------
	 * @method : POST
	 * @link: api/user/login
	 */
	public function login_post()
	{
		header("Access-Control-Allow-Origin: *");
		$_POST = $this->security->xss_clean($_POST);

			$output = $this->UserModel->user_login($this->input->get('email',TRUE) , $this->input->get('password',TRUE));


		if (!empty($output)) {
			$token_data['email'] = $output->email;
			$user_token = $token = bin2hex(random_bytes(16));
			$return_data = [
				'id' => $output->id,
				'email' => $output->email,
				'type' => $output->type,
				'token' => $user_token,
			];// Login Success

			$status = [
				'code' => 200,
				'message' => 'Access Granted'
			];

			$message = [
				'status' => $status,
				'data' => $return_data
			];

			$updated_data = array(
				'token' => $user_token
			);


			$this->UserModel->update_token($updated_data, $output->email);


			$this->response($message, REST_Controller::HTTP_OK);
		}


			else {

				$message = [
					'status' => false,
					'data' => null,
					'message' => "Wrong Password or Username"
				];

				$this->response($message, REST_Controller::HTTP_OK);
			}

	}

	/**
	 * Listing
	 * --------------------------
	 * @param: token
	 * @param: user_id
	 * --------------------------
	 * @method : POST
	 * @link : api/user/listing
	 */
	public function get_listing_post()
	{
		header("Access-Control-Allow-Origin: *");
		$_POST = $this->security->xss_clean($_POST);

		$valid = $this->UserModel->is_token_valid($this->input->get('token',TRUE),$this->input->get('id',TRUE));


		if ($valid==true) {

			$data =  $this->ListingModel->get_listing($this->input->get('id',TRUE));

			$status = [
				'code' => 200,
				'message' => 'Listing Successfully Retrieved'
			];


			$message = [
				'status' => $status,
				'data' => $data
			];

			$this->response($message, REST_Controller::HTTP_OK);
		}


		else {

			$status = [
				'code' => 400,
				'message' => 'Bad Request'
			];

			$message = [
				'status' => $status,
				'data' => null,
			];

			$this->response($message, REST_Controller::HTTP_OK);
		}

	}

}
