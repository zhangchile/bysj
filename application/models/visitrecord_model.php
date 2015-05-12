<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitrecord_Model extends CI_Model {

	public $_table = "visitrecord";
	public $_field = array('id','studentid','truename','sex','reason','visitto','time');

	/**
	*	@todo 获得所有的配送单
	* 
	*/
	public function getAll($offset, $perpage, $time_start = '', $time_end = '')
	{
		if($time_start != '')
			$this->db->where("time >=", $time_start);
		if($time_end != '')
        	$this->db->where("time <=", $time_end);
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
    public function getCount($time_start, $time_end) {
		if($time_start != '')
			$this->db->where("time >=", $time_start);
		if($time_end != '')
        	$this->db->where("time <=", $time_end);
       return $this->db->count_all_results($this->_table);
    }
}