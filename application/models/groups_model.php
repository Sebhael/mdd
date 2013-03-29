<?php
class Groups_model extends CI_Model
{
	public function getall()
	{
		$this->db->select('*')
			->from('groups')
			->where('groups.owner', $this->session->userdata('uid'));
		$get = $this->db->get();
		return $get->result_array();
	}
	public function get($id)
	{
		$this->db->select('*')
			->from('group_member')
			->where('group_member.group', $id)
			->join('groups', 'groups.id = group_member.group', 'left')
			->join('users', 'group_member.member = users.id', 'right');
		$q = $this->db->get();
		return $q->result_array(); 
	}

	public function insert()
	{
		$data = array(
				'name' => $this->input->post('name'),
				'owner' => $this->session->userdata('uid')
			);
		$hue = $this->db->insert('groups', $data);
		if($hue)
		{
			return $hue->insert_id();
		}
		else
		{
			die(mysql_error());
		}
	}

	public function edit()
	{

	}

	public function delete()
	{

	}

}