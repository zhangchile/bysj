<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WaterOrder_Model extends CI_Model {

	public $_table = "waterorder";
	public $_field = array('id','sid','time','number','status','billid','prize','watetype');

	/**
	*	@todo 获得某个所有的订水单
	* 
	*/
	public function getOrders($dormitory, $offset, $perpage)
	{
        $this->db->where("sid", $dormitory);
        $this->db->order_by("time", "desc");
        $query = $this->db->get($this->_table, $perpage, $offset);
        return $query->result_array();		
	}

	/**
	*	@todo 添加一条订水单
	*
	*/
	public function insertOrder($data)
	{
        $this->db->insert($this->_table, $data);
        return $this->db->affected_rows();
	}

	/**
	*	@todo 获得某个订水单总数
	*
	*/
    public function getCount($sid) {
    	$this->db->where('sid', $sid);
       return $this->db->count_all_results($this->_table);
    }
}