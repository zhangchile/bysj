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
        $this->load->model('visitrecord_model');
        $this->load->library("dormitory");
        $this->config->load('pager_config',TRUE);
        $this->leftmenukey = '/visitrecord/';
    }

    public function index($page = 1)
    {
        $condition = $this->input->get();

        $time_start = '';
        $time_end = '';
        if($condition) {
            $time_start = $condition['time_start'] == '' ? '': strtotime($condition['time_start']);
            $time_end   = $condition['time_end'] == '' ? '': strtotime($condition['time_end']);
        }
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
        $data = $this->visitrecord_model->getall($offset, $perpage, $time_start, $time_end);
        $sidebar_data = $this->acl_model->GetSiderBar($this->session->userdata("masterid"));

// var_dump($data);
        //分页
        $total = $this->visitrecord_model->getCount($time_start, $time_end);

        $totalpage = ceil($total / $perpage);

        $this->load->library('pagination'); 
        $pager_config = $this->config->item('pager_config');
        $pager_config['base_url'] = site_url("visitrecord/index/index");
        $pager_config['total_rows'] = $total;//获取总数
        $pager_config['per_page'] = $perpage; //设置每页显示的条数
        $pager_config['uri_segment'] = 4;
        $this->pagination->initialize($pager_config);

        //END
        $this->load->view("visitrecord/index", array('data' => $data, 'sidebar' => $sidebar_data));
    }


    public function update()
    {
        $data = $this->input->get();
        if(!$data) show_404();
        // var_dump($data);
        $arr = array(
                'id' => $data['id'],
                'status' => $data['status']
            );
        $flag = $this->repareorder_model->updateOrder($arr['id'], $arr);
        redirect('reparedepartment/index/');
    }
}