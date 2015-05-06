<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rechargeprize_Model extends CI_Model {

	public $_table = "rechargeprize";
	public $_field = array('id','water','electricity');

	/**
	*	@todo 获得所有的水电单价
	* 
	*/
	public function getAll()
	{
        $query = $this->db->get($this->_table);
        return $query->result_array();		
	}

	/**
	*	@todo 更新水
	*
	*/
    public function update($id, $data)
    {
		$this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
}