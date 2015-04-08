<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WaterOrder_Model extends CI_Model {

	public $_table = "waterorder";
	public $_field = array('id','sid','time','number','status','billid','prize','watetype');

	/**
	*	@todo 获得所有的订水单
	* 
	*/
	public function getAllOrder()
	{
		
	}
}