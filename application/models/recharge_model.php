<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge_Model extends CI_Model {

	public $_table = "recharge";
	public $_field = array('id','sid','billid','type','operate','status','changes','date');

	/**
	*	@todo 获得某个宿舍所有的水电单
	* 
	*/
	public function getAll($dormitory, $offset, $perpage, $type, $status, $operate)
	{
        $this->db->where("sid", $dormitory);
    	if($type != '')
    		$this->db->where('type', $type);
    	if($operate != '')
    		$this->db->where('operate', $operate);
    	if($status != '')
    		$this->db->where('status', $status);
        $this->db->order_by("date", "desc");
        $query = $this->db->get($this->_table, $perpage, $offset);
        return $query->result_array();		
	}

	/**
	*	@todo 获得所有的充值请求
	*	@return array
	*/
	public function getOrders($offset, $perpage, $type, $status, $operate, $sid)
	{
		if($sid != '')
    		$this->db->where('sid', $sid);
		if($type != '')
    		$this->db->where('type', $type);
    	if($status != '')
    		$this->db->where('status', $status);
    	if($operate != '')
    		$this->db->where('operate', $operate);
        $this->db->order_by("date", "desc");
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
        return $this->db->insert_id();
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
	*	@todo 更新一条订单
	*
	*/
	public function update($id, $data)
	{
		$this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
	}	

	/**
	*	@todo 获得某个宿舍维修单总数
	*
	*/
    public function getCount($type, $operate, $status, $sid) {
    	if($sid != '')
    		$this->db->where('sid', $sid);
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