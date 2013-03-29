<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	public function index()
	{
		$uid = $this->session->userdata('uid');
		if($uid == '')
		{
			$this->memberlist();
		}
	}

	public function profile($member='')
	{
		$uid = $this->session->userdata('uid');
		$member = $this->uri->segment(3);
		if($member == '')
		{
			$data['member'] = $this->users_model->get_profile($uid);
		}
		$data['pageTitle'] = $data['member']['username']."'s Profile";
		$data['mainBlock'] = 'members/profile';
		$data['modules'] = array('placeholder');		
		$this->load->view('/inc/container', $data); 
	}

	public function memberlist()
	{
		
	}

	public function subscribe()
	{
		$actionjackson = $this->users_model->subToggle();
		redirect(base_url());
	}
}