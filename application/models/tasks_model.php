<?php
class Tasks_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * User Tasks
	 *
	 * Retreive all non-completed tasks for the logged in user.
	 */
	public function usertasks()
	{
		$get = $this->db->get_where('tasks', array('tasks.owner' => $this->session->userdata('uid'), 'tasks.completed' => '0'));
		return $get->result_array();
	}
	/**
	 * Recently Completed
	 *
	 * Get completed tasks
	 *
	 * If called from the tasks index, it will limit to 3; but more will be pulled via controller declaration for the archive.
	 */
	public function recentcomp($limit = 3)
	{
		$get = $this->db->get_where('tasks', array('tasks.owner' => $this->session->userdata('uid'), 'tasks.completed' => '1'), $limit);
		return $get->result_array();
	}

	/**
	 * Add a new Tasks
	 *
	 * Insert a new Task
	 */
	public function add()
	{
		// Modify the inputted due date for 
		$duedate = $this->input->post('duedate');
		if($duedate == '') {
			$duedate = '0000-00-00';
		}

		$sqldata = array(
			'title' => $this->input->post('title'),
			'slug' => slugIt($this->input->post('title')),
			'notes' => $notes = $this->input->post('notes'),
			'duedate' => $duedate,
			'owner' => $this->session->userdata('uid'),
			'access' => $this->input->post('access'),
			'created' => date("Y-m-d H:i:s")
			);

		$insert = $this->db->insert('tasks', $sqldata);
		if($insert) {
			return $sqldata['slug'];
		} else {
			die(mysql_error());
		}
	}

	public function edit()
	{

		$duedate = $this->input->post('duedate');
		if($duedate == '') {
			$duedate = '0000-00-00';
		}
		
		$data = array(
			'title' => $this->input->post('title'),
			'slug' => slugIt($this->input->post('title')),
			'notes' => $this->input->post('notes'),
			'duedate' => $duedate,
			'owner' => $this->session->userdata('uid'),
			'access' => $this->input->post('access'),
			'edited' => date("Y-m-d H:i:s")
			);

		$update = $this->db->update('tasks', $data, array('tasks.id' => $this->input->post('taskid')));
		if($update)
		{
			return $data['slug'];
		}
		else
		{
			die(mysql_error());
		}
	}

	public function listing($id, $slug)
	{
		$get = $this->db->get_where("tasks", array('tasks.owner' => $id, 'tasks.slug' => $slug));
		if($get->num_rows() > 0)
		{
			return $get->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	public function delete($id)
	{
		$this->db->delete('tasks', array('tasks.id' => $id));
		return;
	}

	public function delete_c($id)
	{
		$del = $this->db->delete('comments', array('comments.noteid' => $id));
		if(!$del) { die(mysql_error()); }
		return;
	}

	public function addcomment($file = '')
	{
		$id = $this->input->post('taskid');
		$sql = array(
			'note' => $this->input->post('notes'),
			'task' => $this->input->post('taskid'),
			'owner' => $this->session->userdata('uid'),
			'submitted' => date('Y-m-d H:i:s')
			);
		$insert = $this->db->insert('comments', $sql);
		if($insert)
		{
			return TRUE;
		}
		else
		{
			die(mysql_error());
		}
	}

	public function get_notes($id)
	{
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('task', $id);
		$this->db->join('users', 'users.id = comments.owner', 'left');
		$get = $this->db->get();
		if($get)
		{
			return $get->result_array();
		}
	}

	public function complete($id)
	{
		$data = array(
				'completed' => 1,
				'completed_stamp' => date('Y-m-d H:i:s')
			);	
		$go = $this->db->update('tasks', $data, array('tasks.id'=>$id));
		if($go)
		{
			return TRUE;
		}
		else
		{
			die(mysql_error());
		}
	}

	public function report($id)
	{
		$go = $this->db->update('tasks', array('tasks.reported'=>1),array('tasks.id'=>$id));
		
		if($go)
		{
			return TRUE;
		}
		else
		{
			die(mysql_error());
		}
	}
}