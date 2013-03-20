<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	public function index()
	{
		$data['pageTitle'] = 'Login / Register';
		$data['mainBlock'] = 'auth/form';
		$data['test'] = 'We be loggin in and regisrurin an stuffz';
		$this->load->view('inc/container', $data);
	}

	public function process()
	{
		// dc724af18fbdd4e59189f5fe768a5f8311527050


		$username = $this->input->post('username');
		$password = $this->input->post('password');

		/* Testing */
		$username = 'Testing';
		$password = 'testing';
		## End

		$password = sha1($password);

		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		print_r($query->result()); exit();	
	}

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

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */