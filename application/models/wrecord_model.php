<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wrecord_Model extends CI_Model {

	public $_table = 'wrecord';
	public $_field = array('id','sid','useage','totalprize','oneprize','date');

	/**
	*	取得水费记录
	*	@return array(array)
	*	
	*/
	public function get() 
	{
		$this->db->where($this->_table, array());
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	*	取得某一天水费记录
	*	@return array(array)
	*	
	*/
	public function getByDate() 
	{
		$this->db->where($this->_table, array())
		$query = $this->db->get();
		return $query->result_array();
	}
}