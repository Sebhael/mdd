<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['pageTitle'] = 'Home Page';
		$data['mainBlock'] = 'portal';
		$data['test'] = 'imma echo';
		$this->load->view('/inc/container', $data);
	}

	public function nav()
	{
		$data['pageTitle'] = 'Navigation';
		$data['mainBlock'] = 'nav';
		$this->load->view('/inc/container', $data);
	}

	public function support()
	{
		$data['pageTitle'] = 'Need Help?';
		$data['mainBlock'] = 'support';
		$this->load->view('/inc/container', $data);
	}

	public function copyright()
	{
		$data['pageTitle'] = 'Copyright Information';
		$data['mainBlock'] = 'copyright';
		$this->load->view('/inc/container', $data);
	}

	public function tos()
	{
		$data['pageTitle'] = 'Terms of Service';
		$data['mainBlock'] = 'terms';
		$this->load->view('/inc/container', $data);		
	}
}

/* End of file portal.php */
/* Location: ./application/controllers/portal.php */