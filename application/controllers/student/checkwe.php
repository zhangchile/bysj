<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkwe extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("acl_model");
        $this->load->model("notice_model");
        $this->config->load('pager_config',TRUE);

    }

    public function index()
    {
    	$this->load->view('student/checkwe');
    }
}