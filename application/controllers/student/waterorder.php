<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WaterOrder extends CI_Controller {

    public $_sid; 

    public function __construct()
    {
        parent::__construct();
        $this->_sid = $this->session->userdata('sid');
        $this->load->model('repareorder_model');
        $this->config->load('pager_config',TRUE);
    }

    public function index()
    {
    	$this->load->view('student/waterorder');
    }
}