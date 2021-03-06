<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WaterOrder_Model extends CI_Model {

	public $_table = "waterorder";
	public $_field = array('id','sid','time','number','status','billid','prize','watetype');

	/**
	*	@todo 获得某个所有的订水单
	* 
	*/
	public function getOrders( $offset, $perpage, $dormitory = '', $status = 'all')
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
	*	@todo 获得订单信息
	* 
	*/
	public function getOneOrder($id ,$sid)
	{
		$query = $this->db->get_where($this->_table, array('id'=>$id, 'sid'=>$sid));
		return $query->result_array();	
	}

	/**
	*	@todo 添加一条订水单
	*
	*/
	public function insertOrder($data)
	{
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
	}

	/**
	*	@todo 更新一条订水单
	*
	*/
	public function update($id, $data)
	{
		$this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
	}	

	/**
	*	@todo 获得某个订水单总数
	*
	*/
    public function getCount($sid = '') {
    	if($sid != '')
    		$this->db->where('sid', $sid);
       return $this->db->count_all_results($this->_table);
    }
}