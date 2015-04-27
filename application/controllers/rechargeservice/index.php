<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    public $action; 
    public $_masterid;
    public $leftmenukey;

    public function __construct()
    {
        parent::__construct();
        $this->action = explode(",", $this->session->userdata("action"));
        $this->_masterid = $this->session->userdata("masterid");
        $this->load->model('recharge_model');
        $this->load->model('acl_model');
        $this->config->load('pager_config',TRUE);
        $this->leftmenukey = '/rechargeservice/';
    }

    public function index($page = 1)
    {
        $condition = $this->input->get();

        $type = '';
        $status = '';
        if($condition) {
            $type = $condition['type'] == 'all' ? '': $condition['type'];
            $status = $condition['status'] == 'all' ? '': $condition['status'];
        }
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->repareorder_model->getorders($type, $offset, $perpage, $status);
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));

        $this->load->view('rechargeservice/index');
    }
}