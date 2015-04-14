<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dormitory_Model extends CI_Model {
	protected $_table = 'dormitory';
	protected $_field = array('id','sid','password','type','department','waterleft');

	/**
	*	@todo 获得宿舍剩余水量
	*
	*/
    public function getWaterLeft($sid) 
    {
    	$query = $this->db->get_where($this->_table, array('sid'=>$sid));
    	return $query->result_array();
    }

	/**
	*	@todo 更新宿舍信息
	*
	*/
	public function update($sid, $data)
	{
		$this->db->where('sid', $sid);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
	}
}