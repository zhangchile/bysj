<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge extends CI_Controller {

    public $_sid; 

    public function __construct()
    {
        parent::__construct();

        $this->config->load('pager_config',TRUE);
        $this->load->model('recharge_model');
        $this->_sid = $this->session->userdata('sid');
    }

    public function index($page = 1)
    {

        $condition = $this->input->get();

        $type    = '';
        $status  = '';
        $operate = '';
        if($condition) {
            $type    = $condition['type']    == 'all' ? '': $condition['type'];
            $status  = $condition['status']  == 'all' ? '': $condition['status'];
            $operate = $condition['operate'] == 'all' ? '': $condition['operate'];
        }
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = 0;//$this->recharge_model->getAll($this->_sid, $offset, $perpage, $type, $status, $operate);
        //分页
        $total = 0;//$this->recharge_model->getCount($type, $operate, $status);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination');
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("student/recharge/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);
        //END
    	$this->load->view('student/recharge', array('data'=>$data));
    }
}