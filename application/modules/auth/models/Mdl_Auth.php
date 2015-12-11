<?php 

/**
* 
*/
class Mdl_Auth extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_user($tablename, $where)
	{
		$sql = $this->db->get_where($tablename, $where);
		return $sql;
	}
}

 ?>