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
        $this->load->model('studentmanage_model');
        $this->load->library("dormitory");
        $this->config->load('pager_config',TRUE);
        $this->leftmenukey = '/studentmanage/';
    }

    public function index($page = 1)
    {
        $condition = $this->input->get();

        $dormitory = '';
        $studentid = '';
        if($condition) {
            $dormitory = $condition['dormitory'] == '' ? '': $condition['dormitory'];
            $studentid   = $condition['studentid'] == '' ? '': $condition['studentid'];
        }
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->studentmanage_model->getall($offset, $perpage, $dormitory, $studentid);
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));

// var_dump($data);
        //分页
        $total = $this->studentmanage_model->getCount($dormitory, $studentid);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination'); 
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("studentmanage/index/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);

        //END
        $this->load->view("studentmanage/index", array('data' => $data, 'sidebar' => $sidebar_data));
    }
}