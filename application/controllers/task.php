<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tasks_model');

		/* Filthy unauthed scoundrels have no place here, shoo */
		if($this->session->userdata('logged') == '')
		{
			redirect('/auth', "redirect");
		}
	}

	public function index()
	{
		$data['pageTitle'] = 'Home Page';
		$data['mainBlock'] = 'task/add_form';
		$data['test'] = 'imma echo';
		$this->load->view('/inc/container', $data);
	}

	/**
	 * Complete listing of self-tasks
	 */
	public function lists() {
		$data['tasks'] = $this->tasks_model->usertasks();
		$data['comp'] = $this->tasks_model->recentcomp();
		$data['pageTitle'] = 'Task List';
		$data['mainBlock'] = 'task/list';
		$this->load->view('/inc/container', $data);
	}

	/**
	 * Adding (maybe deleting) a task form (just checked, it's adding.)
	 */ 
	public function add()
	{
		$data['pageTitle'] = 'Adding a Task';
		$data['mainBlock'] = 'task/add_form';
		$this->load->view('/inc/container', $data);
	}

	/**
	 * Single Task Listing
	 */
	public function listing($id='', $slug='')
	{
		$id = $this->uri->segment(3);
		$slug = $this->uri->segment(4);
		if($slug == '') {
			$this->index();
		} else {
			$data['task'] = $this->tasks_model->listing($id,$slug);
		}
		$data['pageTitle'] = $data['task']['title'];
		$data['mainBlock'] = 'task/listing';
		$this->load->view('/inc/container', $data);
	}

	public function process() {
		$go = $this->tasks_model->add();
		$url = base_url() . 'task/listing/' . $go;
		$this->session->set_flashdata('success','<div class="success">Task Created!</div>');
		redirect($url);
	}

	public function delete($id)
	{
		$go = $this->tasks_model->delete($id);
		$this->session->set_flashdata('deletion','<div class="success">Task Successfully Deleted</div>');
		redirect('task/lists');
	}
}