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

	/**
	 * ## VIEW FUNCTIONS ##
	 *
	 * The following functions render views.
	 */ 

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
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	/**
	 * Adding (maybe deleting) a task form (just checked, it's adding.)
	 */ 
	public function add()
	{
		$data['pageTitle'] = 'Adding a Task';
		$data['mainBlock'] = 'task/add_form';
		$data['modules'] = array('placeholder');
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
			$data['notes'] = $this->tasks_model->get_notes($data['task']['id']);
		}
		if( ( $data['task']['access'] == 1) and ($this->session->userdata('uid') != $data['task']['owner']) )
		{
			redirect(base_url());
		}
		$data['pageTitle'] = $data['task']['title'];
		$data['modules'] = array('placeholder');
		$data['mainBlock'] = 'task/listing';
		$this->load->view('/inc/container', $data);
	}

	public function edit($id, $slug)
	{
		$get = $this->tasks_model->listing($id, $slug);
		if(count($get) > 0)
		{
			$data['form'] = $get;
		}
		else
		{
			redirect(base_url());
		}
		$data['pageTitle'] = 'Editing A Task';
		$data['mainBlock'] = 'task/edit';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	}

	/**
	 * ## PROCESSING FUNCTIONS ##
	 *
	 * The following functions are used for CRUD purposes.
	 */

	public function process() {
		// @ TODO add validation
		$go = $this->tasks_model->add();

		$url = base_url() . 'task/listing/' . $this->session->userdata('uid') . '/' . $go;
		$this->session->set_flashdata('success','<div class="success">Task Created!</div>');
		redirect($url);
	}

	public function processe()
	{
		$go = $this->tasks_model->edit();
		$url = base_url() . 'task/listing/' . $this->session->userdata('uid') . '/' . $go;
		$this->session->set_flashdata('success_e', '<div class="success">Task Edited!</div>');
		redirect($url);
	}

	public function comment()
	{
		// If there's something in the file field
		if( @$_FILES['asset'] != '')
		{
		}
		$go = $this->tasks_model->addcomment();
		if($go)
		{
			redirect($this->input->post('redirect'));
		}
	}

	public function complete($id)
	{
		$redirect = $this->session->flashdata('redirect'); 
		$go = $this->tasks_model->complete($id);

		$this->session->set_flashdata('success_c','<div class="success">Task Completed!</div>');
		redirect($redirect, 'refresh');
	}

	public function delete($id)
	{
		$go = $this->tasks_model->delete($id);
		$this->session->set_flashdata('deletion','<div class="success">Task Successfully Deleted</div>');
		redirect('task/lists');
	}

	public function delete_c($id)
	{
		$redirect = $this->session->flashdata('redirect'); 
		$go = $this->tasks_model->delete_c($id);
		$this->session->set_flashdata('deletion_n','<div class="success">Note Deleted Successfully!</div>');
		redirect($redirect);
	}

	public function report($id)
	{
		$redirect = $this->session->flashdata('redirect'); 
		$go = $this->tasks_model->report($id);
		$this->session->set_flashdata('reported','<div class="success">This task has been reported. A staff member will be looking into the matter soon. Thank you.</div>');
		redirect($redirect);
	}
}