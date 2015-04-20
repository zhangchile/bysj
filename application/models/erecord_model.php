<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Erecord_Model extends CI_Model {

	public $_table = 'erecord';
	public $_field = array('id');

	/**
	*	取得电费记录
	*	@return array(array)
	*	
	*/
	public function get() 
	{

	}

	/**
	*	取得某一天电费记录
	*	@return array(array)
	*	
	*/
	public function getByDate() 
	{

	}
}