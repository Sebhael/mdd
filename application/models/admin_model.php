<?php
class Admin_model extends CI_Model
{
	public function addresses()
	{
		$this->db->select('email')
			->from('users')
			->where('newsletter', '1');
		$sql = $this->db->get();
		if($sql)
		{
			return $sql->result_array();
		}
		else
		{
			die(mysql_error());
		}
	}
}