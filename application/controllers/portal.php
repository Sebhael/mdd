<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {
	
	public function index()
	{
		$data['pageTitle'] = 'Testing This';
		$data['mainBlock'] = 'portal';
		$data['test'] = 'imma echo';
		$this->load->view('/inc/container', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */