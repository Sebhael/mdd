<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['pageTitle'] = 'Home Page';
		if($this->session->userdata('logged') == '')
		{
			$data['mainBlock'] = 'portal';
		}
		else
		{
			$data['mainBlock'] = 'portal';
		}
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	public function nav()
	{
		$data['pageTitle'] = 'Navigation';
		$data['modules'] = array('placeholder');
		$data['mainBlock'] = 'nav';
		$this->load->view('/inc/container', $data);
	}

	public function support()
	{
		$data['pageTitle'] = 'Need Help?';
		$data['modules'] = array('placeholder');
		$data['mainBlock'] = 'support';
		$this->load->view('/inc/container', $data);
	}

	public function copyright()
	{
		$data['pageTitle'] = 'Copyright Information';
		$data['modules'] = array('placeholder');
		$data['mainBlock'] = 'copyright';
		$this->load->view('/inc/container', $data);
	}

	public function tos()
	{
		$data['pageTitle'] = 'Terms of Service';
		$data['modules'] = array('placeholder');
		$data['mainBlock'] = 'terms';
		$this->load->view('/inc/container', $data);		
	}
}

/* End of file portal.php */
/* Location: ./application/controllers/portal.php */