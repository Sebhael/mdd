<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('groups_model');

		/* Filthy unauthed scoundrels have no place here, shoo */
		if($this->session->userdata('logged') == '')
		{
			redirect('/auth', "redirect");
		}
	}

	public function index()
	{
		$data['stuff'] = $this->groups_model->getall();
		$data['pageTitle'] = 'Task List';
		$data['mainBlock'] = 'groups/index';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	public function add()
	{
		$data['pageTitle'] = 'Task List';
		$data['mainBlock'] = 'groups/add';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	public function id($id)
	{
		$id = $this->uri->rsegment(3);
		if($id == '')
		{
			redirect('groups/index', 'refresh');
		}
		$data['group'] = $this->groups_model->get($id);

		$data['pageTitle'] = 'A Group!';
		$data['mainBlock'] = 'groups/listing';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	public function members()
	{
		$data['pageTitle'] = 'Task List';
		$data['mainBlock'] = 'task/list';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	public function edit()
	{
		$data['pageTitle'] = 'Task List';
		$data['mainBlock'] = 'task/list';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	public function delete()
	{

	}

	public function process()
	{
		$insert = $this->groups_model->insert();
		$url = base_url() . 'groups/id/' . $insert;
		redirect($url);

	}

}