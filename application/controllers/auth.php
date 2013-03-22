<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	}

	/**
	 * Index Controller
	 */
	public function index()
	{
		$data['pageTitle'] = 'Login / Register';
		$data['mainBlock'] = 'auth/form';
		$data['test'] = 'We be loggin in and regisrurin an stuffz';
		$this->load->view('inc/container', $data);
	}

	/**
	 * Process (Non-Facebook Login) Authentication
	 */
	public function process()
	{
		/* Check Validation Rules (@app/config/form_validation.php) */
		if($this->form_validation->run() == FALSE)
		{
			/* Apparently we are lacking a username or password in the field...shame on you...*/
			$this->index();
		}

		/* Send to users_model to validate the user's credentials to the database */
		$validate = $this->users_model->validate();

		if($validate) // If a match...
		{
			/* Session Vars */
			$session = array(
					'logged' => 1,
					'username' => $validate['username'],
					'uid' => $validate['id']
				);
			/* Set Session Data */
			$this->session->set_userdata($session);
			/* Successful Login Message @TODO--MSG_SUCCESS Constant */
			$this->session->flashdata('test','testing');
			/* Carry on my friend, and bring me back some beer...*/
			redirect(base_url(),'refresh');
		} else {
			/* Username or Password doesn't exist, send back to the form */
			/* @TODO--Additional validation/response information */
			$this->index();
		}
	}

	/**
	 * Process (Facebook) Authentication
	 */
	public function facebook() 
	{
		$fbConfig = array(
				'appId' => '118757384981558',
				'secret' => 'b8661a50b28b325634ea1fceb6d31572'
			);
		$this->load->library('facebook', $fbConfig);

		$user = $this->facebook->getUser();

		if ($user) {
			try {
				$data['user_profile'] = $this->facebook->api('/me');
			} catch (FacebookApiException $e) {
				$user = null;
			}
		}
		if ($user) {
			$data['logout_url'] = $this->facebook->getLogoutUrl();
		} else {
			$data['login_url'] = $this->facebook->getLoginUrl();
		}

		$data['pageTitle'] = 'Facebook Register';
		$data['mainBlock'] = 'auth/facebook';
		$this->load->view('inc/container', $data);
	}

	public function register()
	{
		$reg = $this->users_model->register();
	}

	/**
	 * Logoff Controller
	 *
	 * I didn't want to be here anyways.
	 */ 
	public function logoff()
	{
		$this->session->sess_destroy();
		$this->index();
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */