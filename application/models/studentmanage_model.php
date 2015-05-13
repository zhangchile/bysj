<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studentmanage_Model extends CI_Model {

	public $_table = "studentmanage";
	public $_field = array('id','studentid','truename','sex','department','major','class','grade','dormitory');

	/**
	*	@todo 获得所有的水信息
	* 
	*/
	public function getAll($offset, $perpage, $dormitory, $studentid)
	{
		if($dormitory != '')
			$this->db->where("dormitory =", $dormitory);
		if($studentid != '')
        	$this->db->where("studentid =", $studentid);		
        $query = $this->db->get($this->_table, $perpage, $offset);
        return $query->result_array();		
	}

	/**
	*	@todo 获得水总数
	*
	*/
    public function getCount($dormitory, $studentid)
    {
		if($dormitory != '')
			$this->db->where("dormitory =", $dormitory);
		if($studentid != '')
        	$this->db->where("studentid =", $studentid);    	
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