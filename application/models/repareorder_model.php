<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repareorder_Model extends CI_Model {

	public $_table = "repareorder";
	public $_field = array('id','sid','applytime','booktime','description','type','status');

	/**
	*	@todo 获得所有的维修单
	* 
	*/
	public function getAllOrder($dormitory, $offset, $perpage)
	{
        $this->db->where("sid",$dormitory);
        $this->db->order_by("applytime", "desc");
        $query = $this->db->get($this->_table, $perpage, $offset);
        return $query->result_array();		
	}

	/**
	*	@todo 添加一条维修单
	*
	*/
	public function insertOrder($data)
	{
        $this->db->insert($this->_table, $data);
        return $this->db->affected_rows();
	}

	/**
	*	@todo 更新一条维修单
	*
	*/
	public function updateOrder($sid, $data)
	{
        $this->db->where('sid', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
	}	

	/**
	*	@todo 获得维修单总是
	*
	*/
    public function geCount($sid) {
    	$this->db->where('sid', $sid);
       return $this->db->count_all_results($this->_table);
    }	
}