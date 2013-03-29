<?php
class Users_model extends CI_Model {
	
	protected $username;
	protected $password;

	public function __construct()
	{
		parent::__construct();
	}

	public function validate($username='', $password='')
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$password = sha1($password);

		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		if ( $query->num_rows() < 1 )
		{
			return FALSE;
		}
		else
		{
			return $query->row_array();
		}
	}

	public function insert()
	{
		$sql = array(
			'username' => $this->input->post('username'),
			'password' => sha1($this->input->post('password')),
			'email' => $this->input->post('email'),
			'created_at' => date("Y-m-d H:i:s")
			);
		$register = $this->db->insert('users', $sql);
		if($register)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_profile($id)
	{
		$sql = $this->db->get_where('users', array('users.id' => $id));
		return $sql->row_array();
	}

	public function subToggle()
	{
		$this->db->select('newsletter')
			->from('users')
			->where('users.id', $this->session->userdata('uid'));
		$check = $this->db->get();

		$nl = $check->row();

		if($nl->newsletter == 1)
		{ $value = 0; }
		else
		{ $value = 1; }
	
		$update = $this->db->update('users', array('newsletter'=>$value), array('users.id' => $this->session->userdata('uid')));

		return TRUE;
	}
}