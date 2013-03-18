<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function index()
	{
		$data['pageTitle'] = 'Login / Register';
		$data['mainBlock'] = 'auth/form';
		$data['test'] = 'We be loggin in and regisrurin an stuffz';
		$this->load->view('inc/container', $data);
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */