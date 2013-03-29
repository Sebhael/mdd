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

########################################################################
##	VIEW FUNCTIONS
##	The Following functions simply serve pages
########################################################################

	/**
	 * Index Page
	 *	Index isn't really used, so just redirect to the task listing anyways.
	 */
	public function index()
	{
		$this->lists();
	} ## End.Index()

	/**
	 * Lists Page
	 *	Complete listing of self-tasks
	 */
	public function lists() 
	{
		// Organizing two different values here, one to get all of the currently active tasks (tasks)
		// (comp) will return the last 3 recently completed tasks.
		$data['tasks'] = $this->tasks_model->usertasks();
		$data['comp'] = $this->tasks_model->recentcomp();

		# Basic Page Composition
		$data['pageTitle'] = 'Task List';
		$data['mainBlock'] = 'task/list';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	} ## End.Lists()

	/**
	 * Adding a Task View 
	 *	Simply just serves up the add form.
	 */ 
	public function add()
	{
		# Basic Page Composition
		$data['pageTitle'] = 'Adding a Task';
		$data['mainBlock'] = 'task/add_form';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	} ## End.Add()


########################################################################
##	CRUD'y FUNCTIONS
##	More dynamic content orientated pages, and CRUD functions
########################################################################

	/**
	 * Listing
	 *	Gets the requested task, and also searches for possible related tasks via the project field.
	 */
	public function listing($id='', $slug='')
	{
		// We'll be using the 3rd and 4th URI segment to try to find our tasks (owner ID & task slug)
		$id = $this->uri->segment(3);
		$slug = $this->uri->segment(4);

		// This is primarily to ensure we don't have an issue if there's no related tasks.
		$add_module = 'placeholder';
		
		// If there's no string to be found in the slug area, then we probably don't need to be here.
		if($slug == '') 
		{
			$this->index();
		} 
		else 
		{
			// Grab the task from the model
			$data['task'] = $this->tasks_model->listing($id,$slug);

			// Verify there's content in the project field
			if($data['task']['project'] != '')
			{
				// Build the project name for display on the listing
				$data['pro'] = '('.$data['task']['project'].')';
				// We'll get the project module activated for the sidebar
				$add_module = 'project';
				// Get any related project tasks for the sidebar
				$data['pro_mod'] = $this->tasks_model->get_projects($data['task']['projectSlug'], $data['task']['id']);
			}

			// Grab our comments for the task
			$data['notes'] = $this->tasks_model->get_notes($data['task']['id']);
		}

		// If this is a private task, and you're not the owner - toodles.
		if( ( $data['task']['access'] == 1) and ($this->session->userdata('uid') != $data['task']['owner']) )
		{
			redirect(base_url());
		}

		# Basic Page Composition
		$data['pageTitle'] = $data['task']['title'];
		$data['modules'] = array('placeholder', $add_module);
		$data['mainBlock'] = 'task/listing';
		$this->load->view('/inc/container', $data);
	} ## End.Listing()

	/**
	 * Edit Function
	 * OMG I LOVE EDITING STUFF
	 */
	public function edit($id, $slug)
	{
		// Snag the questioned task
		// 	Doing it the "dirty" way just to make sure we can get here via other methods than just the listing
		$get = $this->tasks_model->listing($id, $slug);

		// If there's even something to edit
		if(count($get) > 0)
		{
			// Add the form to a var
			$data['form'] = $get;

			// Build the project name back to (NAME) so that we can input it right where it was originally entered.
			if($get['project'] != '')
			{
				// (project)
				$data['pro'] = '('.$get['project'].')';
			}
		}
		else
		{
			// Nothing to edit, crybaby go home (i think that's how that song goes, idk, not a big rap fan)
			redirect(base_url());
		}

		# Basic Page Composition
		$data['pageTitle'] = 'Editing A Task';
		$data['mainBlock'] = 'task/edit';
		$data['modules'] = array('placeholder');
		$this->load->view('/inc/container', $data);
	} ## End.Edit()

	/**
	 * Processing
	 * This is for processing the initial Create
	 */
	public function process() {
		// @ TODO add validation
		$go = $this->tasks_model->add();

		// Build up the URL to aim towards that created task, so we can just redirect there afterwards.
		$url = base_url() . 'task/listing/' . $this->session->userdata('uid') . '/' . $go;
		// Set a flash to give a flashy success message (actually, that's a terrible green @todo - change crappy green success color)
		$this->session->set_flashdata('success','<div class="success">Task Created!</div>');
		// Grats yo
		redirect($url);
	} ## End.Process()

	/**
	 * ProcessE (E stands for edit, so subtle...you didn't see it though...are you ready? mind freak)
	 *	This is processing for the Update of a task
	 */ 
	public function processe()
	{
		$go = $this->tasks_model->edit();

		// Build up the URL to aim towards that created task, so we can just redirect there afterwards.
		$url = base_url() . 'task/listing/' . $this->session->userdata('uid') . '/' . $go;
		// Set a flash to give a flashy success message 
		$this->session->set_flashdata('success_e', '<div class="success">Task Edited!</div>');
		// Not giving you a grats this time. Editing is easy. Too easy. Hell, I edited this line 6 (was 5) times just writing it.
		redirect($url);
	} ## End.Processe()

	/**
     * Comment Processing
     *	Appends comments to the task.
     */
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
	} ## End.Comment()

	public function complete($id)
	{
		$redirect = $this->session->flashdata('redirect'); 
		$go = $this->tasks_model->complete($id);

		$this->session->set_flashdata('success_c','<div class="success">Task Completed!</div>');
		redirect($redirect, 'refresh');
	} ## End.Complete()

	public function delete($id)
	{
		$go = $this->tasks_model->delete($id);
		$this->session->set_flashdata('deletion','<div class="success">Task Successfully Deleted</div>');
		redirect('task/lists');
	} ## End.Delete()

	public function delete_c($id)
	{
		$redirect = $this->session->flashdata('redirect'); 
		$go = $this->tasks_model->delete_c($id);
		$this->session->set_flashdata('deletion_n','<div class="success">Note Deleted Successfully!</div>');
		redirect($redirect);
	} ## End.Delete_C()

	public function report($id)
	{
		$redirect = $this->session->flashdata('redirect'); 
		$go = $this->tasks_model->report($id);
		$this->session->set_flashdata('reported','<div class="success">This task has been reported. A staff member will be looking into the matter soon. Thank you.</div>');
		redirect($redirect);
	} ## End.Report()
}