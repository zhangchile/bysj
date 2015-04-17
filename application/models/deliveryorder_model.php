<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DeliveryOrder_Model extends CI_Model {

	public $_table = "deliveryorder";
	public $_field = array('id','sid','number','time','booktime','status');

	/**
	*	@todo 获得所有的配送单
	* 
	*/
	public function getAllOrder($offset, $perpage, $dormitory, $status)
	{
		if($status != 'all')
			$this->db->where("status", $status);
		if($dormitory != '')
        	$this->db->where("sid", $dormitory);
        $this->db->order_by("time", "desc");
        $query = $this->db->get($this->_table, $perpage, $offset);
        return $query->result_array();
	}

	/**
	*	@todo 添加一条送水单
	*
	*/
	public function insertOrder($data)
	{
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
	}

	/**
	*	@todo 更新一条送水单
	*
	*/
	public function update($id, $data)
	{
		$this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
	}	

	/**
	*	@todo 获得某个送水单总数
	*
	*/
    public function getCount($sid = '') {
    	if($sid != '')
    		$this->db->where('sid', $sid);
       return $this->db->count_all_results($this->_table);
    }
}