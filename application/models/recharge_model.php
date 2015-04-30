<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge_Model extends CI_Model {

	public $_table = "recharge";
	public $_field = array('id','sid','applytime','booktime','description','type','status');

	/**
	*	@todo 获得某个宿舍所有的水电单
	* 
	*/
	public function getAll($dormitory, $offset, $perpage, $type, $operate, $status)
	{
        $this->db->where("sid", $dormitory);
    	if($type != '')
    		$this->db->where('type', $type);
    	if($operate != '')
    		$this->db->where('operate', $operate);
    	if($status != '')
    		$this->db->where('status', $status);
        $this->db->order_by("applytime", "desc");
        $query = $this->db->get($this->_table, $perpage, $offset);
        return $query->result_array();		
	}

	/**
	*	@todo 获得所有的维修单
	* 	@param int 维修单类别，1-水电，2-土木，''==全部
	*	@return array
	*/
	public function getOrders($type = '', $offset, $perpage, $status = '')
	{
		if($type) {
        	$this->db->where("type", $type);
		}
		if($status) {
			$this->db->where("status", $status);
		}
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
	public function updateOrder($id, $data)
	{
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
	}	

	/**
	*	@todo 获得某个宿舍维修单总数
	*
	*/
    public function getCount($type, $operate, $status) {
    	if($type != '')
    		$this->db->where('type', $type);
    	if($operate != '')
    		$this->db->where('operate', $operate);
    	if($status != '')
    		$this->db->where('status', $status);
       return $this->db->count_all_results($this->_table);
    }

	/**
	*	@todo 获得某类维修单总数
	*
	*/
    public function getCountType($type = '', $status = '') {
    	if($type != '') {
    		$this->db->where('type', $type);
    	}
    	if($status != '') {
    		$this->db->where('status', $status);
    	}
       return $this->db->count_all_results($this->_table);
    }

}