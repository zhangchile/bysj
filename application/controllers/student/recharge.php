<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge extends CI_Controller {

    public $_sid; 

    public function __construct()
    {
        parent::__construct();

        $this->config->load('pager_config',TRUE);
        $this->_sid = $this->session->userdata('sid');
    }

    public function index()
    {
    	$this->load->view('student/recharge');
    }
}