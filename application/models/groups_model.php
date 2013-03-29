<?php
class Groups_model extends CI_Model
{
	public function get($id)
	{
		$this->db->select('*')
			->from('groups')
			->where('groups.id',$id);
		$q = $this->db->get();
		return $q->row(); 
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