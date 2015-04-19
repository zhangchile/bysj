<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Water_Model extends CI_Model {

	public $_table = "water";
	public $_field = array('id','name','prize');

	/**
	*	@todo 获得所有的水信息
	* 
	*/
	public function getAll()
	{
        $query = $this->db->get($this->_table);
        return $query->result_array();		
	}

	/**
	*	@todo 获得水总数
	*
	*/
    public function getCount() 
    {
       return $this->db->count_all_results($this->_table);
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