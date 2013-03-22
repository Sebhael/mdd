<?php
class Tasks_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function usertasks()
	{
		$get = $this->db->get_where('tasks', array('tasks.owner' => $this->session->userdata('uid'), 'tasks.completed' => '0'));
		return $get->result_array();
	}

	public function recentcomp()
	{
		$get = $this->db->get_where('tasks', array('tasks.owner' => $this->session->userdata('uid'), 'tasks.completed' => '1'), 3);
		return $get->result_array();
	}

	public function add()
	{
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

}