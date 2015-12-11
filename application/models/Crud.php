<?php 

/**
* 
*/
class Crud extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function read($tablename)
	{
		return $this->db->get($tablename);
	}

	function remove($tablename, $where)
	{
		return $this->db->delete($tablename, $where);
	}

	function write($tablename, $data)
	{
		return $this->db->insert($tablename, $data);
	}
}

 ?>