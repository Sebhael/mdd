<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Check for admin level, else give das boot
		if($this->session->userdata('admin') != 1)
		{
			redirect(base_url());
		}
		$this->load->model('admin_model');
	}

	/** 
	 * Newsletter Form
	 *	Serves email form to send newsletter
	 */
	public function newsletter()
	{
		$data['members'] = count($this->admin_model->addresses());
		$data['pageTitle'] = 'Newsletter Form';
		$data['mainBlock'] = 'email';
		$data['modules'] = array('placeholder');
		$this->load->view('inc/container', $data);		
	}

	/** 
	 * Email Function
	 *	Gathers all subscribed newsletter emails and sends them an email with the subject/body from the form.
	 */
	public function email()
	{
		// Load the Email library
		$this->load->library('email');
		
		// Get all the emails we want to send to.
		$emails = $this->admin_model->addresses();

		// Loop the emails
		foreach($emails as $email)
		{
			$this->email->clear(); // Since we are looping, we'll just clear the fields each time.

			$this->email->to($email['email']);
			$this->email->from('admin@vinticuffs.com','TaskManager Staff');
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('body'));

			// Away you go!
			$this->email->send();
		}
		redirect('admin/newsletter','refresh');
	}
}