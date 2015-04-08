<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DeliveryOrder_Model extends CI_Model {

	public $_table = "deliveryorder";
	public $_field = array('id','sid','number','time','booktime','status');

	/**
	*	@todo 获得所有的配送单
	* 
	*/
	public function getAllOrder()
	{
		
	}
}