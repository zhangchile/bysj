<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Erecord_Model extends CI_Model {

	public $_table = 'erecord';
	public $_field = array('id','sid','useage','totalprize','oneprize','date');

	/**
	*	取得电费记录
	*	@param string 时间区域，week or month
	*	@return array(array)
	*	
	*/
	public function get($timeunit, $sid) 
	{
		$now = time();
		switch ($timeunit) {
			case 'week':
				$from = strtotime("-7 day");
				break;
			case 'month':
				$from = strtotime('last month');
				break;			
			default:
				$from = strtotime("-7 day");
				break;
		}
		$this->db->where("date >=", $from);
		$this->db->where("date <=", $now);
		$this->db->where("sid", $sid);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	/**
	*	取得某一天电费记录
	*	@param string 日期
	*	@return array(array)
	*	
	*/
	public function getByDate($date, $sid) 
	{
		$time = strtotime($date);
		$this->db->where("date", $time);
		$this->db->where("sid", $sid);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
}