<?php
class Pengguna_model extends CI_Model
{

	public function add_user($data)
	{
		$this->db->insert('users', $data);
		return true;
	}

	public function import_pengguna($data)
	{
		$this->db->insert_batch('users', $data);
	}

	//---------------------------------------------------
	// get all users for server-side datatable processing (ajax based)
	public function get_pengguna()
	{
		return $this->db->query("SELECT a.* FROM users a
			WHERE a.role != 1 ");
	}

	// Count total users by role
	public function count_all_users_by_role($role)
	{

		if ($role != '') {
			$this->db->where('role', $role);
		} else {
			$this->db->where('role !=', 1);
		}
		return $this->db->count_all_results('users');
	}

	//---------------------------------------------------
	// Get all users for pagination
	public function get_all_users_for_pagination($limit, $offset)
	{
		$wh = array();
		$this->db->order_by('created_at', 'desc');
		$this->db->limit($limit, $offset);

		if (count($wh) > 0) {
			$WHERE = implode(' and ', $wh);
			$query = $this->db->get_where('users', $WHERE);
		} else {
			$query = $this->db->get('users');
		}
		return $query->result_array();
		//echo $this->db->last_query();
	}

	//---------------------------------------------------
	// Get user detial by ID
	public function get_user_by_id($id)
	{
		$query = $this->db->query("SELECT * 
			FROM users a
			WHERE a.id='$id'
			");
		return $query->row_array();
	}

	//---------------------------------------------------
	// Edit user Record
	public function edit_user($data, $id)
	{
		$this->db->where('id', $id);
		
		$this->db->update('users', $data);
		return true;
	}

	public function role()
	{	
		$this->db->where('id !=', 1);
		return $this->db->get('role')->result_array();

	}


}
