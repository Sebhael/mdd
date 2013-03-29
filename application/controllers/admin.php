<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin') != 1)
		{
			redirect(base_url());
		}
		$this->load->model('admin_model');
	}

	public function newsletter()
	{
		$data['members'] = count($this->admin_model->addresses());
		$data['pageTitle'] = 'Newsletter Form';
		$data['mainBlock'] = 'email';
		$data['modules'] = array('placeholder');
		$this->load->view('inc/container', $data);		
	}

	public function email()
	{
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$this->email->initialize($config);
		
		$emails = $this->admin_model->addresses();
		foreach($emails as $email)
		{
			$this->email->clear();

			$this->email->to($email['email']);
			$this->email->from('admin@vinticuffs.com','TaskManager Staff');
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('body'));
			$this->email->send();
		}
		exit();
		redirect('admin/newsletter','refresh');
	}
}