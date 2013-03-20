<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['pageTitle'] = 'Home Page';
		$data['mainBlock'] = 'task/add_form';
		$data['test'] = 'imma echo';
		$this->load->view('/inc/container', $data);
	}

	public function lists() {
		$data['pageTitle'] = 'Task List';
		$data['mainBlock'] = 'task/list';
		$this->load->view('/inc/container', $data);
	}

	public function add()
	{
		$data['pageTitle'] = 'Adding a Task';
		$data['mainBlock'] = 'task/add_form';
		$this->load->view('/inc/container', $data);
	}

	public function listing()
	{
		$data['pageTitle'] = '#task name#';
		$data['mainBlock'] = 'task/listing';
		$this->load->view('/inc/container', $data);
	}
}